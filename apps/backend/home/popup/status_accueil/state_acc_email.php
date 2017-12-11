<?php

$select1 = mysql_query("select * from root_email_auto where ref='$ref' ");

$reponse1 = mysql_fetch_array($select1);

$a = mysql_num_rows($select);

$from_email=$reponse1["email"];

$obj_emp =$reponse1["objet"];

$new_msg = $reponse1["message"];

$p_joint = $reponse1["p_joint"];

$select11 = mysql_query("select * from candidats where candidats_id='$idcand' ");

$reponse11 = mysql_fetch_array($select11);

$select12 = mysql_query("select * from prm_civilite where id_civi='".$reponse11["id_civi"]."' ");

$reponse12 = mysql_fetch_array($select12);

$nom_s=$reponse12["civilite"].' '.$reponse11["prenom"].' '.$reponse11["nom"];

$email1=$reponse11["email"];

$date_postulation= $reponse['date_candidature'];

$statu_candidature=$status;

$date_statu=$dt1;

$lieu_statu=$lieu; 

$lien_confirmation='<a href="'.$site.'confirmation_statu.php?id_agenda='.$id_agenda.'"> <b>Confirmer</b></a> ';

$select13 = mysql_query("select * from offre where id_offre='".$reponse["id_offre"]."' ");

$reponse13 = mysql_fetch_array($select13);

$titre_offre=$reponse13['Name'];

            //$lien_s=$offre['Name'];

            // Génère : message

                $var = array("{{nom_candidat}}", "{{date_postulation}}", "{{statu_candidature}}", "{{date_statu}}", "{{lieu_statu}}", "{{lien_confirmation}}", "{{titre_offre}}");              

                $replace   = array($nom_s,$date_postulation , $statu_candidature, $date_statu,$lieu_statu, $lien_confirmation, $titre_offre);

                $message_employeur = str_replace($var, $replace, $new_msg);

                $msg_pj="";

            if($reponse1["p_joint"]!='')  {



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

mail($email1,$objet,$message,$headers);



$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $obj_emp;

$ref_filiale = $reponse13['ref_filiale'];               

$sql_mail= ' insert into corespondances Values ("","'. safe($obj_emp).'","'. safe($nom_s).'","'. safe($d).'","'. safe($type_email).'","'. safe($obj_emp).'",

    "'. safe($message_employeur).'","'. safe($ref_filiale).'") ';

                mysql_query($sql_mail);

?>