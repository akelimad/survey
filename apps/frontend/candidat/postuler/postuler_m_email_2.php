<?php

   // on génère une frontière

$boundary = '-----=' . md5 ( uniqid  ( rand () ) ); 

$selecCV=mysql_query("select * from cv  where id_cv = ".$_POST['cv']."");

$councv = mysql_num_rows($selecCV);

$result_cv =mysql_fetch_array($selecCV);

  // on va maintenant lire le fichier et l'encoder

$dossier = dirname(__FILE__) . $file_cv2;

$path = $dossier."".$result_cv['lien_cv'];

 echo '<div style="display:none;">';

  $fp = fopen ($path, 'rb');



  $content = fread ($fp, filesize ($path));

  fclose ($fp);

echo "</div>";

  $content_encode = chunk_split (base64_encode ($content));



  $cv=$result_cv['lien_cv'];

  //$cv=preg_replace("([^a-zA-Z.-\s_])", "", $result_cv['lien_cv']);

if(isset($_POST['Letter']) && $_POST['Letter'] != "")

{

            $select_model = mysql_query("select  * from lettres_motivation 

              where id_lettre = '". $_POST['Letter']."' ");

          

          $lettre = mysql_fetch_array($select_model);

   $dossier = dirname(__FILE__) . $file_lm2;

    $path2 = $dossier."".$lettre['lettre'];

//  echo $path2;

   echo '<div style="display:none;">';

  $fp2 = fopen ($path2, 'rb');



  $content2 = fread ($fp2, filesize ($path2));

  fclose ($fp2);

echo "</div>";



  $content_encode2 = chunk_split (base64_encode ($content2));



  $lettre_m=$lettre['lettre'];  

  //$lettre_m=preg_replace("([^a-zA-Z.-\s_])", "", $lettre['lettre']);

   // $lettre_titre= $lettre['titre'];

}

 if(!empty($motivation))

 $titre = ''.$motivation.'';

else

$req_civi1 = mysql_query( "SELECT * FROM prm_civilite where id_civi = '".$array['id_civi']."' ");     

$ncivi1 = mysql_fetch_array( $req_civi1 );

$civilite = $ncivi1['civilite'];

$select = mysql_query("select * from root_email_auto where ref='p' ");

$reponse = mysql_fetch_array($select);

$a = mysql_num_rows($select);

//$from_email=$reponse["email"];



$select_email = mysql_query("select Contact from offre where id_offre='$id_offre' ");

$reponse_email = mysql_fetch_array($select_email);

$from_email=$reponse_email["Contact"];



$obj_emp =$reponse["objet"];

$new_msg = $reponse["message"];

$p_joint = $reponse["p_joint"]; 

$nom_s=$civilite.' '.$array['prenom'].' '.$array['nom'];

$lien_s=$offre['Name'];

$var = array("{{nom_candidat}}", "{{titre_offre}}");

$replace   = array($nom_s, $lien_s);

$message_admin = str_replace($var, $replace, $new_msg); 

$msg_pj='';

$titre = '<br><tr>';

  $headers = 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

  $headers .= 'Bcc: '.$admin_email.''."\r\n";

  $headers .= "MIME-Version: 1.0\n";

  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";

  $message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";

  $message .= "Content-Transfer-Encoding: 8bit\n\n";

  $message .= ' '.$message_admin.''.$motivation1.'';

$msg= $message;









if(isset($_POST['Letter']) && $_POST['Letter'] != "")

{

  /*

        $typemime = "application/octet-stream";

     if(strpos($lettre_m, ".pdf") || strpos($lettre_m, ".PDF") )

     $typemime = "application/pdf";

     if(strpos($lettre_m, ".doc") || strpos($lettre_m, ".docx") || strpos($lettre_m, ".DOC") || strpos($lettre_m, ".DOCX") || strpos($lettre_m, ".rtf") || strpos($lettre_m, ".RTF")  )

     $typemime = "application/msword";



  $message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: ".$typemime."; name=\"LM ".$lettre_m."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n";

  $message .= "Content-Disposition: attachment; filename=\"Lettre de Motivation\n\n";

  $message .= $content_encode2 . "\n";

  $message .= "\n\n";

*/

  $message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: application/octet-stream; name=\"LM ".$lettre_m."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n";

  $message .= "Content-Disposition: attachment; filename=\"LM ".$lettre_m."\n\n";

  $message .= $content_encode2 . "\n";

  $message .= "\n\n";

 } 

$message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: application/octet-stream; name=\"CV ".$cv."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n";

  // mettez inline au lieu de attachment

  // pour que l'image s'affiche dans l'email

  $message .= "Content-Disposition: attachment; filename=\"CV ".$cv."\n\n";

  $message .= $content_encode . "\n";

  $message .= "\n\n";

$message .= "--" . $boundary . "--\n";

$objet=''.$obj_emp.''.$lien_s.'';



  mail($from_email, $objet, $message, $headers);

$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["id_email"];



$sql_mail= ' INSERT into corespondances Values ("","'.safe($obj_emp).'","'.safe($nom_s).'","'.safe($d).'","'.safe($type_email).'",

  "'.safe($type_c).'","'.safe($message_admin).'") ';



mysql_query($sql_mail);

?>