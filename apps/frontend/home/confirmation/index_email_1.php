<?php

$select = mysql_query("select * from root_email_auto where ref='b' ");



            $reponse = mysql_fetch_array($select);



            $a = mysql_num_rows($select);

            

            $from_email=$reponse["email"];

            $obj_emp =$reponse["objet"];

            $new_msg = $reponse["message"];

            $p_joint = $reponse["p_joint"];

            

                    if($reponse10_c['id_civi']==1) $civi='Mr'; 

                    elseif($reponse10_c['id_civi']==2) $civi='Mlle'; 

                    elseif($reponse10_c['id_civi']==4) $civi='Mme'; 

                    else $civi='';

            $nom_s=$civi.' '.$reponse10_c['prenom'] .' '.$reponse10_c['nom'] ; 

            //$lien_s=$offre['Name'];

            // Génère : message

                $var = array("{{nom_candidat}}", "{{email_candidat}}", "{{mot_passe}}");

                $replace   = array($nom_s, $reponse10_c['email'], $reponse10_c['nl_partenaire']);

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

                $headers .= 'Bcc: '.$admin_email.''."\r\n";

                $objet=$obj_emp;

                $message = '

                '.$message_employeur.'<br/>'; 

                $message .=$msg_pj ;



                mail($email1,$objet,$message,$headers);

                

            //  Insertion corespondances

            

$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["id_email"];



$sql_mail= ' insert into corespondances Values ("","'.safe($obj_emp).'","'.safe($nom_s).'","'.safe($d).'","'.safe($type_email).'",

    "'.safe($type_c).'","'.safe($message_employeur).'") ';



mysql_query($sql_mail);

?>