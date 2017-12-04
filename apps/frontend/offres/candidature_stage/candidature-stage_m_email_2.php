<?php
$select = mysql_query("select * from root_email_auto where ref='m' ");
$reponse = mysql_fetch_array($select);
$a = mysql_num_rows($select);
$from_email=$reponse["email"];
$obj_emp =$reponse["objet"];
$new_msg = $reponse["message"];
$p_joint = $reponse["p_joint"]; 
$nom_s=$rep['prenom'].' '.$rep['nom'];
$var = array("{{nom_candidat}}" );
$replace   = array($nom_s );
$message_admin = str_replace($var, $replace, $new_msg); 
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
$objetselect = mysql_query("select * from root_email_auto where ref='a' ");
$objetreponse = mysql_fetch_array($objetselect);
$obj_stage =$objetreponse["objet"];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";
$headers .= 'Bcc: '.$from_email."\r\n";
$message = ''.$message_admin.'<br/>'; 
$message .= '<h4>NOM ECOLE : </h4>'.$nomecole.'<br/><h4>TYPE DE STAGE : </h4>'.$typestage.'<br/>'; 
$message .= '<h4>ENTITE DEMANDER : </h4>'.$entite.'<br/><h4>DUREE DE STAGE : </h4>'.$duree_stage.'<br/>'; 
$message .= '<h4>OBJET DE STAGE : </h4>'.$objet_stage.'<br/><h4>MOTIVATION : </h4>'.$motivations.''; 
mail($from_email,$obj_stage,$message,$headers);
?>
