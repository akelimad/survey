  

	<?php

	$select_formations = mysql_query("SELECT * from formations where candidats_id = '".$id_candidat."' LIMIT 0 , 1");

		$formations = mysql_fetch_array($select_formations); 

	/////////////////////////////////////////////////////////////////////

	if(!($formations))	{

	/////////////////////////////////////////////////////////////////////

	?>

	  <!-- START  div class='texte'  -->

      <div class='texte'>	  

	  <br><br><br>

	  <center><h2>Il faut au mois avoir enregistré une formation pour postuler à une offre.<h2></center>

	   </div>

	  <!-- END  div class='texte'  -->

	<?php

	/////////////////////////////////////////////////////////////////////

	}	else	{

	/////////////////////////////////////////////////////////////////////

	?>  

	  <!-- START  div class='texte'  -->

      <div class='texte'>

	  

        <?php

if(!isset($id_candidat) || $id_candidat == "" || !isset($id_offre) || $id_offre == "")

      {	

	  

	  	$_SESSION["url"] = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];  		

?>

        <h1>CANDIDATURES SPONTANEES</h1>

		

		

        <table width="100%" border="0">

          <tr>

            <td><div class="subscription" >

                <h1>Affecter cette offre à un candidat</h1>

              </div></td>

          </tr>

          <tr>

            <td align="justify"><ul>

                <li>Pour affecter cette offre à un candidat, vous devez être connecté à votre espace administrateur.</li>

              </ul></td>

          </tr>

        </table>

        <?php

	  }

else

 {

		 if(isset($_POST['send']))

	 {

	 	$id_offre   = isset($_POST['id_offre'])   ? $_POST['id_offre'] 		   : "";

		$motivation = isset($_POST['motivation']) ? trim($_POST['motivation']) : "";

		

		$select_offre = mysql_query("SELECT * from offre where id_offre = '$id_offre'");

		$offre = mysql_fetch_array($select_offre);

		if(empty($motivation) && 2==1)

		{

		?>

		

        <h1>CANDIDATURES SPONTANEES</h1>

        <h2 style="text-transform: uppercase;">Affecter au candidat l’offre : <b><?php echo $offre['Name']; ?></b></h2>

        <h3>Informations incomplètes</h3>

        <ul>

          <li style="color:#FF0000">Vous n'avez pas précisez votre motivation pour ce poste!</li>

        </ul>

        <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post">

          <table width="100%" border="0">

            <tr>

              <td colspan="4">

									<div style=" float: right; padding: 10px 5px 0px 0px;">

									 <a href="<?php echo $_SESSION['page_courant ']; ?>" style=" border-bottom: none; ">

											<img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

									</a>

									</div>

			  <div class="subscription" style="margin: 10px 0pt;">

                  <h1> Récapitulatif de l'offre </h1>

                </div></td>

            </tr>

            <tr>

            <td width="85%">

            <table width="100%">

            <tr>

              <td width="33%"><b>Date de publication</b></td>

              <td width="23%"><b>Intitulé du poste</b></td>

              <td width="25%"><b>Lieu d'emploi</b></td>

            </tr>

        

            </table>

         

 

            </td>

            </tr>

            <tr>

              <td><?php echo date("d-m-Y",strtotime($offre['date_insertion'])); ?></td>



              <td width="6%"><?php echo $offre['Name']; ?></td>

              <td width="6%"><?php

		  $select_lieu = mysql_query("select localisation from prm_localisation where id_localisation = '".$offre['id_localisation']."' ");

		  $lieu = mysql_fetch_array($select_lieu);

		  echo $lieu['localisation'];

		  ?>              </td>

            </tr>

            <tr>

              <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>Motivation pour le poste </h1>

                </div></td>

            </tr>

            <tr>

              <td colspan="4"><label>Lettre de motivation </label>

                <font color="red">*</font> <br />

                <textarea name="motivation" id="editor1" cols="80" rows="8"></textarea>

                <script type="text/javascript">

				CKEDITOR.replace( 'editor1',

													{

													width : "450px",

													height : "60px"

													});

		  </script>

              </td>

            </tr>

            <tr>

              <td colspan="4"><div class="ligneBleu"></div>

                <input name="id_offre" class="espace_candidat" type="hidden" value="<?php echo $id_offre; ?>" />

                <input name="id_candidat" class="espace_candidat" type="hidden" value="<?php echo $id_candidat; ?>" />

                <input name="send" class="espace_candidat" type="submit" value="Confirmer l’affectation" />

              </td>

            </tr>

          </table>

        </form>

        <?php

		}

		else

		{

		



        	include('postuler_m_pertinence.php'); 

											 

			$motivation1 =str_replace("'", "\'", $motivation); 

		if(isset($_POST['Letter']) && $_POST['Letter'] != "")

			$id_lettre= $_POST['Letter'];

		else

			$id_lettre= '0';

		if(isset($_POST['cv']) && $_POST['cv'] != "")

			$id_cv= $_POST['cv'];

		else

			$id_cv= '0';



			$date_i = date("Y-m-d");

			$insertion = mysql_query("INSERT INTO candidature 

                VALUES ('','".safe($id_candidat)."', '".safe($id_cv)."' ,'".safe($id_lettre)."',

                 '".safe($id_offre)."','".safe($motivation1)."','".safe($date_i)."',

                 'En attente','".safe($percent)."','' )");

            $id_cd = mysql_insert_id(); 

            $insertion_historique = mysql_query("INSERT INTO historique 

                (`id_candidature`, `status`, `date_modification`,`utilisateur`) 

                VALUES ('".safe($id_cd)."','En attente','".safe($date_i)."','".safe($email)."')");



			$succes = mysql_affected_rows();

			

			 include ( "./postuler_m_note.php"); 

			  

			if($succes > 0)

			{ 

				echo  "<br/><h1>CANDIDATURES SPONTANEES</h1>	<h2  style=' text-transform: uppercase;'>Affecter au candidat l’offre : <b>".$offre['Name']."</b></h2>";

				echo "Cette candidature a bien été affectée avec succès.";

                //session_unset();

                //session_destroy();

                //echo '<meta http-equiv="refresh" content="2;URL='.$urladmin.'/login/">';

				echo '<br /><br /><a href="'.$_SESSION['page_courant '].'" class="espace_candidat" style="color:white">Retour</a>';

				 

$select = mysql_query("select * from courrier_type where type_cand='Reponse a une annonce' ");



            $reponse = mysql_fetch_array($select);



            $a = mysql_num_rows($select);



            if($a)  {



			  $hd='Content-Type: multipart/mixed; charset=iso-8859-1' . "\r\n";

			  $from_email=$reponse["expediteur"];

            $obj_emp =$reponse["objet"];

			$new_msg = $reponse["message"];

			$p_joint = $reponse["p_joint"];

			

			$nom_s=$array['prenom'].' '.$array['nom'];

			$lien_s=$offre['Name'];

			// Génère : message

				$var = array("{{nom_c}}", "{{lien}}");

				$replace   = array($nom_s, $lien_s);

				$message_employeur = str_replace($var, $replace, $new_msg);

				

			//=====Lecture et mise en forme de la pièce jointe.

			$fichier=file_get_contents(dirname(__FILE__) .$file_courrier2.$p_joint);

			

			$fichier=chunk_split( base64_encode($fichier) );

			//=====Ajout de la pièce jointe.

			

			$msg_pj= "Content-Type: application/msword; name=\"$p_joint\"\r\n".

			"Content-Transfer-Encoding: base64\r\n".

			"Content-Disposition: attachment; filename=\"$p_joint\"\r\n\n".

			"$fichier";

			

			//  Insertion corespondances

		$ref_filiale = $offre['ref_filiale'];	

		$d=date("Y.m.d-H.i.s");$type_email="Envoi automatique";$type_c = $reponse["objet"];

		$sql_mail= ' insert into corespondances Values ("","'. safe($obj_emp).'","'. safe($nom_s).'","'. safe($d).'","'. safe($type_email).'","'. safe($type_c).'",

            "'. safe($message_employeur).'","'. safe($ref_filiale).'") ';

		mysql_query($sql_mail);

					 

			}



             else {

			    $hd='Content-type: text/html; charset=iso-8859-1' . "\r\n";

				 

			    $from_email=$admin_email;

				 

				$obj_emp='Votre candidature est bien reçu';

				 

				$message_employeur = 'Bonjour, '.$array['prenom'].' '.$array['nom'].'<br/><br/>

				Nous vous remercions d\'avoir postuler à l\'offre : <b>'.$offre['Name'].'</b>.<br/>

				Cordialement.<br/>';

				

				$msg_pj='';

				}

				

				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= $hd;

				$headers .= 'From: '.$nom_site.' <'.$from_email.'>' . "\r\n";

				$headers .= 'Bcc: '.$admin_email.''."\r\n";

				$objet=$obj_emp;

				$message = ''.$message_employeur.''; 

				$message .=$msg_pj ;

 

			}

			else

			{

				echo  "      <h1>CANDIDATURES SPONTANEES</h1>	<h2  style=' text-transform: uppercase;'>Affecter au candidat l’offre : <b>".$offre['Name']."</b></h2>";

				echo '<h3>Une erreur est survenue réessayer plus tard</h3>';

			}

			

$reception_candidature = mysql_query("select * from offre where id_offre=$id_offre and send_candidature='true'");

			$reception = mysql_num_rows($reception_candidature);

            $infos_offre = mysql_fetch_array($reception_candidature);

			if($reception > 0)

			{

			      // on génère une frontière

  $boundary = '-----=' . md5 ( uniqid  ( rand () ) );

  

  	$selecCV=mysql_query("select * from cv  where id_cv = ".$_POST['cv']."");

$councv = mysql_num_rows($selecCV);

  $result_cv =mysql_fetch_array($selecCV);

  // on va maintenant lire le fichier et l'encoder

	   $dossier = dirname(__FILE__) . $file_cv;

  	$path = $dossier."".$result_cv['lien_cv'];

	//echo $path;

  	//$path = '../candidat/74b87337454200d4d33f80c4663dc5e5/1353987786BadrFerrassi.pdf';

	

  //$path = '../candidat/telechargement12124545/Fiche de synthèse globale VF.pdf'; // chemin vers le fichier



  

 echo '<div style="display:none;">';

  $fp = fopen ($path, 'rb');



 

 

 

  $content = fread ($fp, filesize ($path));



 

  fclose ($fp);

echo "</div>";

  $content_encode = chunk_split (base64_encode ($content));



  $cv=preg_replace("([^a-zA-Z.-\s_])", "", $result_cv['lien_cv']);

if(isset($_POST['Letter']) && $_POST['Letter'] != "")

{

			$select_model = mysql_query("select  * from lettres_motivation where id_lettre = '". $_POST['Letter']."' ");

		  

		  $lettre = mysql_fetch_array($select_model);

   $dossier = dirname(__FILE__) . $file_lm;

	$path2 = $dossier."".$lettre['lettre'];

//	echo $path2;

	  $fp2 = fopen ($path2, 'rb');

  $content2 = fread ($fp2, filesize ($path2));

  fclose ($fp2);



  $content_encode2 = chunk_split (base64_encode ($content2));

	

  $lettre_m=preg_replace("([^a-zA-Z.-\s_])", "", $lettre['lettre']);

    $lettre_titre= $lettre['titre'];

}

 if(!empty($motivation))

 $titre = ''.$bars_email_color.''.$motivation.'';

else



$titre = '<br><tr>';



  $headers = 'From: '.$nom_site.' <'.$admin_email.'>' . "\r\n";



  //$headers .= 'Bcc: '.$admin_email.''."\r\n";



  $headers .= "MIME-Version: 1.0\n";



  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";







  $message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";



  $message .= "--" . $boundary . "\n";



  $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";



  $message .= "Content-Transfer-Encoding: 8bit\n\n";



  $message .= '



Bonjour,

<p>

  Une candidature vous a &eacute;t&eacute; envoy&eacute;e par '.$array['civilite'].' '.$array['prenom'].' '.$array['nom'].' en r&eacute;ponse &agrave; votre offre d&rsquo;emploi &quot;<b>'.$offre['Name'].'</b>&quot; post&eacute;e sur  '.$nom_site.' .





</p>

    '.$titre.'';

$msg= $message;









if(isset($_POST['Letter']) && $_POST['Letter'] != "")

{

        $typemime = "application/octet-stream";

	 if(strpos($lettre_m, ".pdf") || strpos($lettre_m, ".PDF") )

	 $typemime = "application/pdf";

	 if(strpos($lettre_m, ".doc") || strpos($lettre_m, ".docx") || strpos($lettre_m, ".DOC") || strpos($lettre_m, ".DOCX") || strpos($lettre_m, ".rtf") || strpos($lettre_m, ".RTF")  )

	 $typemime = "application/msword";



  $message .= "\n";



  $message .= "--" . $boundary . "\n";



  $message .= "Content-Type: ".$typemime."; name=\"LM ".$lettre_m."\"\n";



  $message .= "Content-Transfer-Encoding: base64\n"; 

    $message .= "Content-Disposition: attachment; filename=\"Lettre de Motivation\n\n";

  $message .= $content_encode2 . "\n";



  $message .= "\n\n";



 } 



  

  

  

  

  

  

    $message .= "\n";



  $message .= "--" . $boundary . "\n";



  $message .= "Content-Type: application/octet-stream; name=\"CV ".$cv."\"\n";



  $message .= "Content-Transfer-Encoding: base64\n"; 



  $message .= "Content-Disposition: attachment; filename=\"CV ".$cv."\n\n";



  $message .= $content_encode . "\n";



  $message .= "\n\n";

  

  



  

  

  

  

  

  

  



  $message .= "--" . $boundary . "--\n";





  $objet='Nouvelle Candidature pour le poste de '.$offre['Name'];

 

  

  

  

			}

		}

	 }

	 else

	 {

	 	if(isset($id_offre) || $id_offre != "")

		{ 		



		$select_offre = mysql_query("SELECT * from offre where id_offre = '$id_offre'");

		$exist = mysql_num_rows($select_offre);

		if($exist)

		{

			$offre = mysql_fetch_array($select_offre);

			//$sql__r="select * from  candidats inner join experience_pro ON candidats.candidats_id = experience_pro.candidats_id   inner join cv ON candidats.candidats_id = cv.candidats_id where candidats.candidats_id = '".$id_candidat."' And cv.actif=1 ";

			$sql__r="select * from  candidats  inner join cv ON candidats.candidats_id = cv.candidats_id where candidats.candidats_id = '".$id_candidat."' And cv.actif=1 ";

			//echo $sql__r;

			$select = mysql_query($sql__r);

			$nbr = mysql_num_rows($select);

			if($nbr)

			{

	  			$select_candidature = mysql_query("select * from candidature where candidats_id = '".$id_candidat."' and id_offre = '$id_offre'");

				$count = mysql_num_rows($select_candidature);

				if($count)

				{

				echo  "      <h1>CANDIDATURES SPONTANEES</h1>	<h2  style=' text-transform: uppercase;'>Affecter au candidat l’offre : <b>".$offre['Name']."</b></h2>";

					 echo '<meta http-equiv="refresh" content="10;URL='.$_SESSION['page_courant '].'">';

					

					echo'<span >Vous avez déjà affecté au candidat cette offre. Vous allez être redirigé dans quelques secondes à la page des candidatures spontanée </span><br /><br /><a href="'.$_SESSION['page_courant '].'" class="espace_candidat" style="color:white">Ne pas attendre</a>';

				}

				else

				{				

		

		?>

          <h1>CANDIDATURES SPONTANEES</h1>	<h2  style="text-transform: uppercase;">Affecter au candidat l’offre : <b><?php echo $offre['Name']; ?></b></h2>

        <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post">

          <table width="100%" border="0" cellpadding="3">

            <tr>

              <td colspan="4">

									<div style=" float: right; padding: 10px 5px 0px 0px;">

									 <a href="<?php echo $_SESSION['page_courant ']; ?>" style=" border-bottom: none; ">

											<img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

									</a>

									</div>

				<div class="subscription" style="margin: 10px 0pt;">

                  <h1>Récapitulatif de l'offre </h1>

                </div></td>

            </tr>

			</table>

			  <table width="100%" border="0" cellpadding="3">

            <tr>

              <td width="25%"><b>Date de publication</b></td>

              <td width="25%"><b>Intitulé du poste</b></td>

              <td width="25%"><b>Lieu d'emploi</b></td>

            </tr>

	

     



			

			

			

			

            <tr>

              <td><?php echo date("d-m-Y",strtotime($offre['date_insertion'])); ?></td>

         

              <td><?php echo $offre['Name']; ?></td>

              <td><?php 

		  $select_lieu = mysql_query("select localisation from prm_localisation where id_localisation = '".$offre['id_localisation']."' ");

		  $lieu = mysql_fetch_array($select_lieu);

		  echo $lieu['localisation'];

		  ?>

              </td>

            </tr>

			</table>

			 <table width="100%" border="0" cellpadding="3">

            <tr>

              <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

                  <h1>Votre motivation pour le poste </h1>

                </div></td>

            </tr>

			

  	    <tr> 

		

    <td width="30%" valign="top" >Choisissez un cv	</td>

	

    <td><select  id="cv" name="cv"  style="width:200px;">

	<?php  

		$select_cv_principale= mysql_query("select * from cv where candidats_id = '". $id_candidat."' AND actif=1 AND principal=1");

		  

		  $cv_principale = mysql_fetch_array($select_cv_principale);

		    $succes = mysql_num_rows($select_cv_principale);

			if($succes)

			$cv1 = $cv_principale['id_cv'];

			else

			$cv1= "";

?>

<?php 

		 

		   	$select_model=mysql_query("select * from cv  where candidats_id='".$id_candidat."'  AND actif=1");

		  

		  while($cv2 = mysql_fetch_array($select_model))

		  {

		   if($cv1 == $cv2['id_cv'] )  $selected =  "selected";

		   else $selected =  "";

		   

		 echo "<option value='".$cv2['id_cv']."'     ".$selected."     >".$cv2['titre_cv']."</option>";

		 

		 }

		  ?>

</td>

  </tr>

  

			    <tr> 

<!--

    <td valign="top" >Choisissez une lettre de motivation 		<input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" /></td>



    <td><select  id="Letter" name="Letter" style="width:200px;" >

	<?php  

	$select_lettre_principale= mysql_query("select * from lettres_motivation where candidats_id = '". $id_candidat."' AND actif=1 AND principal=1");

		  

		  $lettre_principale = mysql_fetch_array($select_lettre_principale);

		    $succes = mysql_num_rows($select_lettre_principale);

			if($succes)

			$letter1 = $lettre_principale['id_lettre'];

			else

			$letter1= "";

		echo  $lettre_principale['id_lettre'];

			?>

<option value="" <?php if($letter1== "")  echo "selected"; ?>></option>

<?php 

		  $select_model = mysql_query("select * from lettres_motivation where candidats_id = '". $id_candidat."' AND actif=1 ");

		  

		  while($lettre = mysql_fetch_array($select_model))

		  {

		   if($letter1 == $lettre['id_lettre'] )  $selected =  "selected";

		   else $selected =  "";

		   

		 echo "<option value='".$lettre['id_lettre']."'     ".$selected."     >".$lettre['titre']."</option>";

		 

		 }

		  ?>

</td>

-->

  </tr>

            <tr>

              <td  valign="top" ><label>Message </label></td>

           <td >

                <textarea name="motivation" id="editor2" > Candidatures affecte par le responsable de back office 

				</textarea>

                <script type="text/javascript">

				CKEDITOR.replace( 'editor2',

													{

													width : "500px",

													height : "200px"

													});

		  </script>

              </td>

            </tr>

			





  

  	  



            <tr>

              <td colspan="4"><div class="ligneBleu"></div>

                

              </td>

            </tr>

            <tr>

                <td></td>

                <td>

                    <input class="espace_candidat" name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" />

                <input class="espace_candidat" name="id_candidat" type="hidden" value="<?php echo $id_candidat; ?>" />

                <input class="espace_candidat" name="send" type="submit" value="Confirmer l’affectation" />

                </td>

            </tr>

          </table>

        </form>

        <?php

	  		} 

	  	}

		else // profil non complet

	  	{

		$_SESSION["url"] = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; 

				echo  "      <h1>CANDIDATURES SPONTANEES</h1>	<h2  style=' text-transform: uppercase;'>Affecter au candidat l’offre : <b>".$offre['Name']."</b></h2>";

		 echo '<meta http-equiv="refresh" content="2;URL='.$urladmin.'">';

		echo'<span>Vous n\'avez pas la possibilité de répondre à cette . Vous allez être redirigé dans quelques secondes</span><br /><br /><a href="'.$_SESSION['page_courant '].'" class="btn-rechercher" style="color:white">Ne pas attendre</a>';

	  	}

	   }

	   else // l'id de l'offre est vide ou ne correspond à aucune offre

	   {

				echo  "      <h1>CANDIDATURES SPONTANEES</h1>	 ";

	  	echo "<h3>Erreur ! Aucune offre ne correspond à votre sélection!</h3>";	 

	   }		

	  }

	  else // variable id_offre inexistante

	   {

				echo  "      <h1>CANDIDATURES SPONTANEES</h1>	 ";

	  	echo "<h3>Erreur ! Aucune offre ne correspond à votre sélection!</h3>";	  

	   }

	 }

}

	  ?>

	  

	  

      </div> 

	  <!-- END  div class='texte'  -->

	 <?php

	/////////////////////////////////////////////////////////////////////

	}

	/////////////////////////////////////////////////////////////////////

	?>

    