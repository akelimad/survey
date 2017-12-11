<?php 

$req_civi1 = mysql_query( "SELECT * FROM prm_civilite where id_civi = '".$reponse['id_civi']."' ");     

$ncivi1 = mysql_fetch_array( $req_civi1 );

$civilite = $ncivi1['civilite'];

$select01 = mysql_query("select * from root_email_auto where ref='h' ");

$reponse01 = mysql_fetch_array($select01);

$a = mysql_num_rows($select01);

$from_email=$reponse01["email"];

$obj_emp =$reponse01["objet"];

$new_msg = $reponse01["message"];

$p_joint = $reponse01["p_joint"];

$nom_s=$civilite.' '.$reponse['prenom'].' '.$reponse['nom'];

//$lien_s=$offre['Name'];

// Génère : message

$var = array("{{nom_candidat}}", "{{email_candidat}}", "{{mot_passe}}");

$replace   = array($nom_s, $email, $mdp);

$message_employeur = str_replace($var, $replace, $new_msg);

$msg_pj='';

if($reponse01["p_joint"]!='')  {

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

$from_email=$reponse01["email"];

}

                

                $headers  = 'MIME-Version: 1.0' . "\r\n";

                $headers .= $hd;

                $headers .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

                $headers .= 'Bcc: '.$admin_email.''."\r\n";

                $objet=$obj_emp;

                $message = ''.$message_employeur.'<br/>'; 

                $message .=$msg_pj ;



            //  mail($email1,$objet,$message,$headers);

                

            //  Insertion corespondances

            

$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse01["id_email"];



$sql_mail= ' INSERT into corespondances Values ("","'.safe($obj_emp).'","'.safe($nom_s).'","'.safe($d).'","'.safe($type_email).'",

    "'.safe($type_c).'","'.safe($message_employeur).'") ';



mysql_query($sql_mail);

                        /*

                        if(mysql_query($sql)) echo "ok";

                        else echo "ko ---> ".$sql; 

                        */

/*

ini_set("SMTP", "vps.lycom.ca");

ini_set("smtp_port", 465;//tester avec 465

ini_set("sendmail_from","info@lycom.ma");

*/

        if(mail($email,$objet,$message,$headers))



        {



array_push($message_succ,"<ul>

<li style='color:#468847'>Un nouveau mot de passe vient de vous être envoyé à l'adresse indiquée. Verifier votre boite email d'ici 

quelque minutes. Dans le cas où vous ne recevez pas d'e-mail, merci de vérifier dans votre dossier junk ou spam mail </li>

   <li style='color:#468847'>Vous allez être redirigé dans quelques secondes.</ul>");





       $mdp = md5($mdp);



        mysql_query("UPDATE candidats SET mdp='".$mdp."' ,status=1 where email = '".safe($email)."'");

        }



        else



        { 

array_push($message_succ,"<font face='Verdana' size='2' color=red >Un problème est survenu lors de l'envoi de votre mot de passe. Contactez l'admin du site. <br><br><input class=\"espace_candidat\" type='button' value='Retry' onClick='history.go(-1)'></font>");





        }

?>