<?php

session_start();
	  	require(dirname(__FILE__).'/../../../../../config/config.php');
		
?>
		
<!DOCTYPE html>
<html>
<head> 


<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>

				  
</head>
<body>


<div id="fils">
<div id="fade" style="background: rgba(0, 0, 0, 1);"></div>
<div class="popup_block" style="width: 400px;height: 100px; z-index: 999; top: 30%; left: 40%;">
<div class="titleBar"><div class="title">Envoi des emails   </div><a href="<?php echo $_SESSION['page_courant '] ; ?>"><div class="close" style="cursor: pointer;">close</div></a></div>
<div id="contenu" class="content" style="width: 360px;height: 40px;">



<?php 
		
if( isset($_POST['email2']) && $_POST['email2'] != '' )
{

        ////////////////////////////////Récupération des données du formulaires///////////////////////////////  
        $m_email      = isset($_POST['email1'])     ? $_POST['email1']      : "";
        $m_emails     = isset($_POST['email2'])    ? $_POST['email2']      : "";
        $m_sujet      = isset($_POST['sujet'])     ? $_POST['sujet']      : "";
        $m_message    = isset($_POST['message'])   ? $_POST['message']      : "";
        //$txt_msg      = "E-talent"; 
        ////////////////////////////////////////////////////////////////////////////
		/*
        $select1 = mysql_query("select * from email_type where id_email='$m_sujet' ");
            $reponse1 = mysql_fetch_array($select1);
            $a = mysql_num_rows($select);
            //*/
            $from_email=$m_email;//$reponse1["email"];
            $obj_emp =$m_sujet;//$reponse1["objet"];
            $new_msg = $m_message;//$reponse1["message"];
            //$p_joint = $reponse1["p_joint"];
             
         
                /*
				$var = array("{{message}}");                
                $replace   = array($m_message);
                $message_employeur = str_replace($var, $replace, $new_msg);
				//*/
                $message_employeur = $new_msg;
                $msg_pj="";
            
 
        ////////////////////////////////////////////////////////////////////////////
//----------------------------------------------------------------------------------------------------------------------

$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");
$temp = explode(".", $_FILES["piecejointe"]["name"]);
$extension = end($temp);
      //   $f_name_path = "" . __DIR__ . $file_courrier . $n_f .".". $extension;

//echo $f_name_path."<br>";

if (($_FILES["piecejointe"]["size"] < 2000000)&& in_array($extension, $allowedExts)) {
  if ($_FILES["piecejointe"]["error"] > 0) {
    echo "Return Code: " . $_FILES["piecejointe"]["error"] . "<br>";
  } else { 
    if (file_exists($file_courrier . $_FILES["piecejointe"]["name"])) {
     // echo $_FILES["piecejointe"]["name"] . " already exists. ";
    } else {
      //move_uploaded_file($_FILES["piecejointe"]["tmp_name"], $f_name_path );
      //copy($_FILES["piecejointe"]["tmp_name"], $f_name_path );
     // echo "Stored in: " . "../../upload/upload_pj/" . $_FILES["piecejointe"]["name"];
    }
  }
        //  $_nomFichier = $_FILES['piecejointe']['name'];/* GET File Variables */ 
        $tmpName = $_FILES['piecejointe']['tmp_name']; 
        $fileType = $_FILES['piecejointe']['type']; 
        $fileName = (isset($_FILES['piecejointe']['name']) and $_FILES['piecejointe']['name']!='') ? $_FILES['piecejointe']['name'] : '1' ; 
} else {
 // echo "Fichier non validé";
}   
//------------------------------------------------------------------------------------------------------------------------- 
$m_emails=str_replace(' ','',$m_emails);
$m_emails = rtrim($m_emails, ',');
$emails_t  =explode(",", $m_emails);
    $i='';
    foreach ($emails_t as &$email) {
	$i=$i+1;
 
    $passage_ligne = "\n";
//}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = '';
$message_html = $message_employeur  ;
//==========
 
//=====Lecture et mise en forme de la pièce jointe.
if(isset($fileName) and  $fileName != ''){
$fichier   = fopen($tmpName, "r");
$attachement = fread($fichier, filesize($tmpName));
$attachement = chunk_split(base64_encode($attachement));
fclose($fichier);
}
//==========
 
//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = $obj_emp;
//=========
 
//=====Création du header de l'e-mail.
$header = "From: ".$nom_site." <".$from_email.">".$passage_ligne;
$header.= "Reply-to: \"Admin email\" <".$from_email.">".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
 
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
 
//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
 
//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========
 
 
 
$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
//=====Ajout de la pièce jointe.
/*
if($reponse1["p_joint"]!='')  {

              $hd='Content-Type: multipart/mixed; charset=utf-8' . "\r\n";
             
                
            //=====Lecture et mise en forme de la pièce jointe.
            $fichier=file_get_contents('../../../apps/upload/backend/upload_courrier/'.$p_joint);
            
            $fichier=chunk_split( base64_encode($fichier) );
            //=====Ajout de la pièce jointe.
            
            $msg_pj= "Content-Type: application/msword; name=\"$p_joint\"\r\n".
                     "Content-Transfer-Encoding: base64\r\n".
                     "Content-Disposition: attachment; filename=\"$p_joint\"\r\n\n".
                     "$fichier".$passage_ligne."--".$boundary;
            $message.=$msg_pj;
            
            }
			//*/
if(isset($fileName) and  $fileName != '1'){	
$message.= "Content-Type: image/jpeg; name=\"".$fileName."\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
$message.= "Content-Disposition: attachment; filename=\"".$fileName."\"".$passage_ligne;
$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
}


$filenamePJ = (isset($_POST['pj'])) ? $_POST['pj'] : '';
$pathPJ = dirname(__FILE__).$file_courrier3.$filenamePJ."";
if(!empty($filenamePJ))
{
//  echo $path2;
  $fpPJ = fopen ($pathPJ, 'rb');
  $contentPJ = fread ($fpPJ, filesize ($pathPJ));
  fclose ($fpPJ);

  $content_encode_PJ = chunk_split (base64_encode ($contentPJ));
  
  $D_PJ=preg_replace("([^a-zA-Z.-\s_])", "", $filenamePJ);
  $PJ_titre= $filenamePJ;
  $extension = substr(strrchr($PJ_titre, "."), 1);
   $PJ_titre=  substr($PJ_titre, 0,strlen($PJ_titre)-strlen($extension)-1);
  $typemime = "application/octet-stream";
   if(strpos($D_PJ, ".pdf"))
   $typemime = "application/pdf";
   if(strpos($D_PJ, ".doc"))
   $typemime = "application/msword";
    $message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: ".$typemime."; name=\"PJ ".$PJ_titre."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n"; 

  $message .= "Content-Disposition: attachment; filename=\"PJ ".$PJ_titre." \n\n";
  
  $message .= $content_encode_PJ . "\n";

  $message .= "\n\n";
  
}

$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
//========== 
//=====Envoi de l'e-mail.

mail($email,$sujet,$message,$header);

//==========//==========//==========//==========//  
    }
	




if ( $i!='') {

			//  Insertion corespondances
				/*			
		$d=date("Y.m.d-H.i.s"); $type_email="Envoi manuel"; $type_c="Candidature transféré";
		$sql_mail= ' insert into corespondances Values ("","'.$subject.'","'.$_SESSION["abb_admin"].'","'.$d.'","'.$type_email.'","'.$type_c.'","'.$msg1.'") ';
			mysql_query($sql_mail);
				//*/		
        echo  '<font color="#277405">Email envoy&eacute; avec succ&egrave;s </font>'; 
			
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '] .'" />   ';
		 
		}
    else 
	{
        echo  '<font color="#FF0000"> Erreur d\'envoi</font>';
		echo '  <meta http-equiv="refresh" content="0;'.$_SESSION['page_courant '] .'" />   ';
		}

}
else	{
 echo  '<font color="#FF0000">les champs "Votre email" et "Email du destinataire" sont obligatoires</font>';
 
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant_t'] .'" />   ';
		}
?> 



</div>
</div>
</div>


</body>
</html>