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
		$txt_area=$email_c='';
 
		if(isset($_SESSION['select_s']) and $_SESSION['select_s']!=''){
	$result_unique =  array_keys(array_flip($_SESSION['select_s'])); 
	
            for ($i = 0; $i < count($result_unique); $i++){   
                            $email_c .= " ".$result_unique[$i]." ,";
               } 
			$txt_area=substr($email_c, 0, -1);
			 
	}	 
	
	
// debut --------------------------------------------------------------------------------
function generateRandomString($length = 6) {

    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, strlen($characters) - 1)];

    }

    return $randomString;

}

// Echo the random string.

// Optionally, you can give it a desired string length.

$gen_pass=generateRandomString();
// fin--------------------------------------------------------------------------------
	
if( isset($_POST['email2']) && $_POST['email2'] != '' )
{
		$expediteur = $_POST['email1'];
		$destinataire = $_POST['email2'];
		$subject = $_POST['sujet'];
		$msg = $_POST['message'];  
		
		$msg_s = $_POST['message_suit']; 
		
		//$subject = 'Votre avis sur ce candidat'; 
	 
		$replyto = $expediteur; 
		
				$message_f = $msg;
				
                $var = array( "{{site}}", "{{email}}", "{{mot_passe}}");
                $replace   = array( $site.'backend/stages/', $destinataire, $gen_pass);
                $message_f .= str_replace($var, $replace, $msg_s);
		
		
		
			      // on génère une frontière
  $boundary = '-----=' . md5 ( uniqid  ( rand () ) );
  


  
 

  
  
////////////////////////////////////////////////////////////////////////////

 

  $headers = 'From: '.$expediteur.'' . "\r\n";
  $headers .= "Reply-To: ".$replyto."\r\n";
 // $headers .= 'Bcc: '.$admin_email.'."\r\n";

  $headers .= "MIME-Version: 1.0\n";

  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";



  $message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: text/html; charset=\"utf-8\"\n";

  $message .= "Content-Transfer-Encoding: 8bit\n\n";
		
	$msg1=	"".$message_f."";
	
  $message .= $msg1."\r\n\r\n";
 
  $message .= "\n"; 
//////////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////////////

  //$objet='Nouvelle Candidature pour le poste de '.$offre['Name'];
if ( mail ($destinataire, $subject, $message, $headers)) {

			//  Insertion corespondances			
$d=date("Y.m.d-H.i.s"); 
$type_email="Envoi manuel"; $type_c="Listes candidats pour stage";
$sql_mail= ' INSERT into corespondances Values ("","'.safe($subject).'","'.safe($_SESSION["abb_admin"]).'","'.safe($d).'","'.safe($type_email).'","'.safe($type_c).'","'.safe($msg1).'","") ';
//echo $sql_mail;
mysql_query($sql_mail);
			
			
			
  					//  Insertion liste_stage	
$sql_liste_stage= " INSERT INTO liste_stage VALUES 
('','".safe($txt_area)."','".safe($destinataire)."','".md5($gen_pass)."','".safe($d)."') ";
//echo $sql_liste_stage;
mysql_query($sql_liste_stage);	 
			 
				
        echo  '<font color="#277405">Email envoy&eacute; avec succ&egrave;s </font>'; 
		 

		 echo '  <meta http-equiv="refresh" content="1;../../candidatures/candidature_stage/" />   ';
		 
		}
    else 
        echo  '<font color="#FF0000">Une erreur est survenue</font>';

}
else	{
 echo  '<font color="#FF0000">les champs "Votre email" et "Email du destinataire" sont obligatoires</font>';
 
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant_c'] .'" />   ';
		}
?> 



</div>
</div>
</div>


</body>
</html>