<?php





 

$query1 = mysql_query("SELECT * FROM  alert where alert.activate='true'  "); 

$start = microtime(true);

		

while ($data4 = mysql_fetch_assoc($query1)){

		//////////////////////////

		$titre = $data4['titre'];

		$query = mysql_query("SELECT count(*) as count, offre.* FROM  offre  where id_offre like '$id' and Name like '%$titre%'  "); 

		$start = microtime(true);

		$data3 = mysql_fetch_assoc($query);

 

		$ofname = $data3['Name'];

		$cpname = $data3['count'];

		$candidat = $data4['candidats_id'];

 

		if($cpname > 0){

		

		  

					$query22 = mysql_query("select * from candidats  where    candidats.candidats_id='$candidat'  "); 



					 

							$start = microtime(true);

							$data22 = mysql_fetch_assoc($query22);

							if($data22['email']!='') {

									$nom = $data22['nom'];

									$prenom = $data22['prenom'];

									$email = $data22['email'];

							 

									$sql = "select * from root_configuration ";

									$select = mysql_query($sql);

									$reponse = mysql_fetch_assoc($select);  

									$nom_site       =$reponse['nom_site'];

						 



												//////////////////////////

												$message = "<p>Bonjour <b>" . $prenom . " " . $nom . ",</b></p>

												<p>une offre d´emploi correspondent à votre alerte « <b>".$titre. "</b> » :</p>

												<br/>

												<table width='70%'>

												<thead>

												<tr>

												<th style='border:1px solid #5e90c7;padding:5px;background-color: #537FC4;

												text-align:left;font-size:14px;font-weight:700;color:#ffffff;width:35%'>Titre de l'offre</th>

												<th style='border:1px solid #5e90c7;padding:5px;background-color: #537FC4;

												text-align:left;font-size:14px;font-weight:700;color:#ffffff;width:35%'>Date de publication</th>

												<th style='border:1px solid #5e90c7;padding:5px;background-color: #537FC4;

												text-align:left;font-size:14px;font-weight:700;color:#ffffff;width:20%'>Action</th>

												</tr>

												</thead>

												<tbody>

												<tr style='background-color:#c4d7ed'>

												<td style='border:1px solid #5e90c7;padding:5px'><b>".$ofname."</b></td>

												<td style='border:1px solid #5e90c7;padding:5px;font-weight:700'>

												<b>".date('d.m.Y',strtotime($data3['date_insertion']))."</b></td>

												<td style='border:1px solid #5e90c7;padding:5px'>

												<a href='$urloffre/index.php?id=$id' style='font-weight:700' target='_blank'>Postuler</a></td>

												</tr>

												</tbody>

												</table>

												<br/>

												<p>Cordialement</p>";

												$from_emaiil = $conf_admin_email;

												$objet = "Offre d´emploi correspondant à votre alerte ".$titre." '$nom_site ' ";         

												$headers1  = 'MIME-Version: 1.0' . "\r\n";      

												$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

												$headers1 .= "From: $nom_site <$info_contact>" . "\r\n";

												$headers1 .= 'Bcc: '.$from_emaiil."\r\n";

												mail($email, $objet, $message, $headers1);

												'X-Mailer: PHP/'.phpversion();

										 

												///////////////////////////////////////////////////

								 



							}



					



			}

		////////////////////////



}



///////////////////////////

 ?>

