<?php
 
$name = $user_last_name; 
$prenom = $user_first_name   ; 
$from  = $user_email  ; 
$tel =$user_tel;
$dest = $destination   ;    
$l_site =  $site  ;  
  
	
$select = mysql_query("select * from root_email_auto where ref='b' ");
$reponse = mysql_fetch_array($select);
$a = mysql_num_rows($select);

$from_email=$reponse["email"];


 
	// Plusieurs destinataires
     $to  = $conf_admin_email; // notez la virgule  . ', ';  $to .= '';
/*
    $emailfrom = $to;

    $headers = "From: $emailfrom \n" .
            "Content-Type: text/html; charset=utf8\n"; //ISO-8859-15
	 
//*/
    $body = "<p>Bonjour</p>";

    $body .= "<p><b>Probl&egrave;me signale sur le site  : </b>" . $l_site." avec le ticket : <b>".$ticket."</b></p>";            

    $body .= "<p><b> Date : </b>" .date('d.m.Y h:i:s')."</p>";

    $body .= "<p><b> Nom : </b>" .$name."</p>";

    $body .= "<p><b> Pr&eacute;nom : </b>" .$prenom."</p>";

    $body .= "<p><b> Email : </b>" .$from."</p>";
	
    $body .= "<p><b> Telephone : </b>" .$tel."</p>";

    $body .= "<p><b> Sujet : </b>" .$subject."</p>";

    $body .= "<p><b> Message : </b>" .$message."</p>";
                
    $body .= "<p>Cordialement</p>";
	
    $obbjet =  utf8_decode(" Signaler un probléme sur ").$l_site." avec le ticket : ".$ticket ;         
	// solution de probléme de codage é --> Ã©  =  utf8_decode("Signaler un probléme")
 





//----------------------------------------------------------------------------------------------------------------------

 // echo $file_upload_pj3."<br>"; 
 
$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");
$temp = explode(".", $fileName);
$extension = end($temp);
$n_f=rand().date("Y.m.d-H.i.s").".". $extension;
          $f_name_path = "" . __DIR__ . $file_upload_pj3 . $n_f ;

 // echo $n_f."***1<br>";
 // echo $extension."***2<br>";
 // echo $f_name_path."***3<br>";
 

if (($fileSize < 2000000)&& in_array($extension, $allowedExts)) {
  if ($fileError > 0) {
    // echo "Return Code: " . $fileError . "<br>";
  } else { 
    if (file_exists($file_upload_pj . $fileName)) {
       //echo $fileName . " already exists. ";
    } else {
      //move_uploaded_file($tmpName, $f_name_path );
       copy($tmpName, $f_name_path );
       // echo "Stored in: " . "../../upload/upload_pj/" . $fileName;
	    mysql_query("INSERT INTO root_signale_prob_pj VALUES ('','".$id_prob."','".$n_f."')");
    }
  }
           $_nomFichier = $fileName;/* GET File Variables */ 
        $tmpName = $tmpName; 
        $fileType = $fileType; 
        $fileName = (isset($fileName) and $fileName!='') ? $fileName : '' ; 
} else {
   //echo "Fichier non validé";
}   
 
    $passage_ligne = "\n";
//}
/*

//*/
$from_email_cc = $conf_admin_email_s_prob;
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = '';
$message_html = $body  ;
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
$sujet = $obbjet ;
//=========
 
//==========//==========//==========//==========// 
if($fileError == 0 ) {	
//==========//==========//==========//==========// 
//=====Création du header de l'e-mail.
$header = "From: ".$nom_site." <".$from_email.">".$passage_ligne;
$header.= "Reply-to: \"Admin email\" <".$from_email.">".$passage_ligne;
$header.= "Cc: "  . $from_email_cc  . "\r\n";
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
 
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
 
//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
 
//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========
 
 
 
$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
//=====Ajout de la pièce jointe

$message.= "Content-Type: image/jpeg; name=\"".$fileName."\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
$message.= "Content-Disposition: attachment; filename=\"".$fileName."\"".$passage_ligne;
$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;


$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
//========== 
//=====Envoi de l'e-mail.
//==========//==========//==========//==========// 
} else {
//==========//==========//==========//==========// 
	
	$header  = "From: ".$nom_site." <".$from_email.">".$passage_ligne;
    $header .= "Content-Type: text/html;  charset=\"ISO-8859-1\" \n";  
	$header .= 'Cc:  ' . $from_email_cc . $passage_ligne;
 
	$message= $passage_ligne.$message_html.$passage_ligne;
//==========//==========//==========//==========// 
}
//==========//==========//==========//==========// 
mail($to,$sujet,$message,$header);

//==========//==========//==========//==========// 



 
?>