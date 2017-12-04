<?php

 
/*
$s___0="localhost";$u___0="lpee_user";$p___0="2015lpee";$b___0="lpee_etalent";
//$serveur="localhost";$user="lpee_user";$passwd="2015lpee";$bdd="lpee_etalent";
//*/
 
//$serveur="localhost";$user="root";$passwd="";$bdd="etalent";

require_once dirname(__FILE__) . "/../../../../config/config.php";
 
    $sql = mysql_query("select * from offre ");
 
 
					
						//* --------------------------   insertion dans la table his_off_partag
						
$select = mysql_query("select * from root_email_auto where ref='q' ");

            $reponse = mysql_fetch_array($select);

            $a = mysql_num_rows($select);
            
            $from_email=$reponse["email"];
            $obj_emp =$reponse["objet"];
            $new_msg = $reponse["message"];
            $p_joint = $reponse["p_joint"];
            
 	// ------------------------- pour test : envoi email aux 3 candidats moin d'un an  */  
//$sql_r="SELECT * from candidats where year(last_connexion) <= DATE_SUB(NOW(),INTERVAL 1 YEAR) limit 0,3 ";

    // ------------------------- Vrais requête  :   candidats n’avez pas actualisé leur profile plus de 1 an */  
$sql_r="SELECT * from candidats where year(last_connexion) >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ";

echo $sql_r;
//*
$query4 = mysql_query($sql_r);
while($data4 = mysql_fetch_assoc($query4)){


					 
		
$email = $data4['email'];
 if(!empty($email)){

                    if( $data4['id_civi']==1) $civi='M.'; 
                    elseif($data4['id_civi']==2) $civi='Mlle'; 
                    elseif($data4['id_civi']==4) $civi='Mme'; 
                    else $civi='';

            $nom_s=$civi.' '.$data4['prenom'].' '.$data4['nom']; 
			
                $var = array("{{nom_candidat}}", "{{lien_confirmation}}");
                $replace   = array($nom_s, $urlcandidat);
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
       
             
                }
                
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= $hd;
                $headers .= 'From:   <'.$conf_info_email_contact.'>' . "\r\n";
                //$headers .= 'Bcc: '.$from_email.''."\r\n";
                $objet=$obj_emp;
                $message = '
                '.$message_employeur.'<br/>'; 
                $message .=$msg_pj ;

     
//////////////////////////
		mail($email,$objet,$message,$headers);
		'X-Mailer: PHP/'.phpversion();
 }
 /////////////////////////////////////
 }
//*/
 
?> 