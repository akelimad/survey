<?php
$sql_001="select * from candidats where candidats_id = '$idcand'";
$select001  = mysql_query($sql_001);
$reponse001 = mysql_fetch_array($select001);
$req_civi1 = mysql_query( "SELECT * FROM prm_civilite where id_civi = '".$reponse001['id_civi']."' ");     
$ncivi1 = mysql_fetch_array( $req_civi1 );
$civilite = $ncivi1['civilite'];
if($ref!=''){
$select = mysql_query("select * from root_email_auto where ref='$ref' ");
$reponse = mysql_fetch_array($select);
$a = mysql_num_rows($select);
$from_email=$reponse["email"];
$obj_emp =$reponse["objet"];
if($ref=="all_s"){
$obj_emp = $status." || ".$titre_site;
}
$new_msg = $reponse["message"];
$p_joint = $reponse["p_joint"];
$nom_s=$civilite.' '.$reponse001['prenom'].' '.$reponse001['nom'];


$select_date = mysql_query("select * from candidature_stage where candidats_id='$idcand' ");
$reponse_date = mysql_fetch_array($select_date);
$date_postulation=$reponse_date["date"];
$lien_confirmation='<a href="'.$site.'confirmation/?is='.$id_agenda.'"> <b>Confirmer</b></a> ';

$var = array("{{nom_candidat}}", "{{date_postulation}}", "{{statu_candidature}}","{{lien_confirmation}}");              
$replace   = array($nom_s,$date_postulation , $status, $lien_confirmation);
$message_employeur = str_replace($var, $replace, $new_msg);
/*
$var = array("{{nom_candidat}}");
$replace   = array($nom_s);
$message_employeur = str_replace($var, $replace, $new_msg); 
*/
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
mail($reponse001['email'],$objet,$message,$headers);
$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["id_email"];

//$ref_filiale = $offre['ref_filiale'];     
$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["intituler"];
$sql_mail= ' INSERT into corespondances Values ("","'. safe($obj_emp).'","'. safe($nom_s).'",
      "'. safe($d).'","'. safe($type_email).'","'. safe($type_c).'",
            "'. safe($message_employeur).'","") ';


mysql_query($sql_mail);
}
?>