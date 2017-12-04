 
<?php


        if(isset($_POST['partager']))   
        {
            $select1232 = mysql_query("select * from root_email_auto where ref='l' ");
			$reponse1232 = mysql_fetch_array($select1232);
			$from_email=$reponse1232["email"];
			$objet = "Offre d'emploi de ".$nom_site;
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";
			//$headers .= 'Bcc: '.$from_email."\r\n";

			$id_offre = isset($_POST['id_offre'])  ? $_POST['id_offre'] : "";


          foreach($_POST['checkbox'] as $checkbox){
					if(isset($checkbox)){
					
						//* --------------------------   insertion dans la table his_off_partag
						
						$id_p=$checkbox;
						$sql_partenaire = mysql_query("SELECT * FROM  partenaire where id_parte  = '".$id_p."' ");
						$rep_partenaire = mysql_fetch_assoc($sql_partenaire);
							   
							$partenaire = $rep_partenaire['nom'];
							$lien_offre='<a href="'.$site.'offres/index.php?id='.$id_offre.'">'.$site.'offres/index.php?id='.$id_offre.'</a>';
							$email = $rep_partenaire['email'];
							$message = $rep_partenaire['message'];
							
								$var = array("{{nom}}", "{{lien}}");
								$replace   = array($partenaire, $lien_offre);
								$new_msg = str_replace($var, $replace, $message);
							
						 // INSERT INTO his_off_partag      
						$date_his_p = date("Y-m-d H:i:s");            
						mysql_query("INSERT INTO his_off_partag VALUES ('','$id_offre','$id_p','$date_his_p')");    
										
						// -------------------------    */ 
						
						mail($email, $objet, $new_msg, $headers);
					}
					  else { echo 'cochez au moins une case!';  }
		}
	
	}
?>
 