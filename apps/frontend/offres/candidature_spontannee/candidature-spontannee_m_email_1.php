<?php 

$req_civi1 = mysql_query( "SELECT * FROM prm_civilite where id_civi = '".safe($array['id_civi'])."' ");     

$ncivi1 = mysql_fetch_array( $req_civi1 );

$civilite = $ncivi1['civilite'];

$select = mysql_query("select * from root_email_auto where ref='d' ");

$reponse = mysql_fetch_array($select);

$a = mysql_num_rows($select);

$from_email=$reponse["email"];

$obj_emp =$reponse["objet"];

$new_msg = $reponse["message"];

$p_joint = $reponse["p_joint"]; 

$nom_s=$civilite.' '.$array['prenom'].' '.$array['nom'];

$var = array("{{nom_candidat}}");

$replace   = array($nom_s);

$message_employeur = str_replace($var, $replace, $new_msg); 

$msg_pj='';

if($reponse["p_joint"]!='')  {

$hd='Content-Type: multipart/mixed; charset=iso-8859-1' . "\r\n";

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

$hd='Content-type: text/html; charset=iso-8859-1' . "\r\n";

//$from_email=$admin_email;

}

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= $hd;

$headers .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

//$headers .= 'Bcc: '.$from_email."\r\n";

$objet=$obj_emp;

$message = ''.$message_employeur.''; 

$message .=$msg_pj ;

mail($array['email'],$objet,$message,$headers);

$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["id_email"];



$sql_mail= ' INSERT into corespondances Values ("","'.safe($obj_emp).'","'.safe($nom_s).'","'.safe($d).'",

  "'.safe($type_email).'","'.safe($type_c).'","'.safe($message_employeur).'") ';



mysql_query($sql_mail);

?>