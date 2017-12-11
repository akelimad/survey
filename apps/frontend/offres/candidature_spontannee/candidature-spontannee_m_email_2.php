<?php

$select = mysql_query("SELECT * from root_email_auto where ref='l' ");

$reponse = mysql_fetch_array($select);

$a = mysql_num_rows($select);

$from_email=$reponse["email"];

$obj_emp =$reponse["objet"];

$new_msg = $reponse["message"];

$p_joint = $reponse["p_joint"]; 

$nom_s=$array['prenom'].' '.$array['nom'];

$var = array("{{nom_candidat}}");

$replace   = array($nom_s);

$message_admin = str_replace($var, $replace, $new_msg); 

$msg_pj='';

if($reponse["p_joint"]!='')  {

$hd='Content-Type: multipart/mixed; charset=utf-8' . "\r\n";

                  //=====Lecture et mise en forme de la pièce jointe.

                  $fichier=file_get_contents($file_courrier.$p_joint);

                  $fichier=chunk_split( base64_encode($fichier) );

                  //=====Ajout de la pièce jointe.

                  $msg_pj= "Content-Type: application/msword; name=\"$p_joint\"\r\n".

                  "Content-Transfer-Encoding: base64\r\n".

                  "Content-Disposition: attachment; filename=\"$p_joint\"\r\n\n".

                  "$fichier";

                  }

else {

$hd='Content-type: text/html; charset=utf-8' . "\r\n";

//$from_email=$admin_email;

}

$boundary = '-----=' . md5 ( uniqid  ( rand () ) );

$selecCV=mysql_query("SELECT * from cv  where id_cv = ".safe($_POST['cv'])."");

$councv = mysql_num_rows($selecCV);

$result_cv =mysql_fetch_array($selecCV);

// on va maintenant lire le fichier et l'encoder

$dossier = dirname(__FILE__) . $file_cv;

$path = $dossier."".$result_cv['lien_cv'];

echo '<div style="display:none;">';

$fp = fopen ($path, 'rb');

$content = fread ($fp, filesize ($path));

fclose ($fp);

echo "</div>";

$content_encode = chunk_split (base64_encode ($content));

$cv=$result_cv['lien_cv'];



$titre = '<br><tr>';

$headers = 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

$headers .= 'Bcc: '.$from_email."\r\n";

$headers .= "MIME-Version: 1.0\n";

$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";

$message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";

$message .= "--" . $boundary . "\n";

$message .= "Content-Type: text/html; charset=\"utf-8\"\n";

$message .= "Content-Transfer-Encoding: 8bit\n\n";

$requet0=mysql_query("select * from prm_civilite where id_civi= ".safe($array['id_civi'])." ");



if($requet0){ 

    $resutl0=mysql_fetch_assoc($requet0) ;   $civili = $resutl0['civilite'];

}                        

$message .= ''.$message_admin.''.$motivation.'';

$msg= $message;

$message .= "\n";

$message .= "--" . $boundary . "\n";

$message .= "Content-Type: application/octet-stream; name=\"CV ".$cv."\"\n";

$message .= "Content-Transfer-Encoding: base64\n";

$message .= "Content-Disposition: attachment; filename=\"CV ".$cv."\n\n";

$message .= $content_encode . "\n";

$message .= "\n\n";

$message .= "--" . $boundary . "--\n";

$objet='Nouvelle Candidature spontanée ';

mail ($from_email, $objet, $message, $headers);

?>