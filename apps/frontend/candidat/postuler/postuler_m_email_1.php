<?php

$id_candidat = $_SESSION['abb_id_candidat'];

$req = mysql_query("SELECT * from candidats where candidats_id='".safe($id_candidat)."' ");

$rep = mysql_fetch_array($req);



$req_civi1 = mysql_query( "SELECT * FROM prm_civilite where id_civi = '".safe($rep['id_civi'])."' ");     

$ncivi1 = mysql_fetch_array( $req_civi1 );

$civilite = $ncivi1['civilite'];



$select = mysql_query("SELECT * from root_email_auto where ref='i' ");

$reponse = mysql_fetch_array($select);

$a = mysql_num_rows($select);

$from_email=$reponse["email"];

$obj_emp =$reponse["objet"];

$new_msg = $reponse["message"];

$p_joint = $reponse["p_joint"]; 



$nom_s=$civilite.' '.$rep['prenom'].' '.$rep['nom'];

$lien_s=$offre['Name'];

// Génère : message

$var = array("{{nom_candidat}}", "{{titre_offre}}");

$replace   = array($nom_s, $lien_s);

$message_employeur = str_replace($var, $replace, $new_msg); 

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

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= $hd;

$headers .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

//$headers .= 'Bcc: '.$from_email.''."\r\n";

$objet=$obj_emp;

$message = ''.$message_employeur.''; 

$message .=$msg_pj ;







$ref_filiale = $offre['ref_filiale'];

mail($em,$objet,$message,$headers);

//  Insertion corespondances

$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["id_email"];

$sql_mail= ' insert into corespondances Values ("","'.safe($obj_emp).'","'.safe($nom_s).'","'.safe($d).'","'.safe($type_email).'",

    "'.safe($type_c).'","'.safe($message_employeur).'","'.safe($ref_filiale).'") ';

mysql_query($sql_mail);


$offre = getDB()->findOne('offre', 'id_offre', $_GET['id_offre']);
$notifMessage  = '<p>Une nouvelle candidature a été reçu sur l\'offre: '.$offre->Name;
$notifMessage .= '</p><p>Pour consulter les nouvelles candidatures <strong><a href="'.site_url('backend/module/candidatures/candidature/list/0').'">cliquez ici</a></strong></p>';
\App\Mail\Mailer::send(get_setting('email_e'), 'Nouvelle candidature reçu', $notifMessage, ['isHTML' => true]);

?>