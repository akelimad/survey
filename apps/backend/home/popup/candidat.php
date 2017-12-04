<?php 



session_start();



if(!isset($_SESSION["login"]) || $_SESSION["login"] == "")



      {	



  		header("Location:  ../index.php") ;



	  }



      else



	  {



	  	require(dirname(__FILE__).'/../../../config/config.php');



		mysql_connect($serveur,$user,$passwd);



		mysql_select_db($bdd);



		$id_candidature = isset($_GET['cc']) ? $_GET['cc']: "";



		$sql = mysql_query("SELECT * from candidature inner join candidats on candidature.id_candidat = candidats.candidats_id where candidature.id_candidature = ".$id_candidature."");



		$reponse = mysql_fetch_array($sql);	



		$test = mysql_query("select * from fiche_candidat where id_candidat = '".$reponse['candidats_id']."'");



		$count = mysql_num_rows($test);



		$retour = mysql_fetch_array($test);



?>







<div id="repertoire">



                <div id="fils" >



                  <div id="fade"></div>



                  <div class="popup_block"  style="width: 700px;height:500px; overflow:scroll; z-index: 999; top: 10%; left: 25%;" >



                    <div class="titleBar">



                      <div class="title">Informations sur candidat</div>



                      <a href="<?php      $pos1 = strpos($_SESSION['url44'], '?cc');  if($pos1)   $pos  = strripos($_SESSION['url44'], '?'); else $pos  = strripos($_SESSION['url44'], '&');  echo substr($_SESSION['url44'],0,$pos); ?>">



                      <div class="close" style="cursor: pointer;">close</div>



                      </a> </div>



                    <div id="content" class="content" style="margin:25px 25px;">



             <div class="texte">



<style>



td



{



  font-family: Verdana,Arial,Helvetica,sans-serif;



    font-size: 11px;



	text-align: justify;



}



</style>

<div class="texte">

<table width="100%" border="0">

  <tr>

    <td colspan="2">

<table width="100%" border="0">

  <tr>

    <td rowspan="4" width="20%" align="center"> 

	<img src="<?php echo $url_photo_candidat.'/'.$retour['photo'];?>" alt="Image not found" onError="this.onerror=null;this.src='<?php echo $url_photo_candidat; ?>default/photo.gif';" width="80" height="100"/></td>



    <td width="40%" colspan="2"><?php echo '<b>'.$reponse['civilite'].'&nbsp;'.$reponse['prenom'].'&nbsp;'.$reponse['nom']; ?></td>



    <td width="40%" align="center"><b><?php echo $retour['titre']; ?></b></td>



  </tr>



  <tr>



    <td valign="top"><img src="<?php echo $imgurl; ?>/icons/address.png" align="absmiddle"/></td>



    <?php 



	$sel_pays = mysql_query("select pays from prm_pays where id_pays = '".$reponse['pays']."'");



	$pays = mysql_fetch_array($sel_pays);



	?>



    <td valign="top"><?php echo $reponse['adresse'].'&nbsp;'.$reponse['code'].'<br/>'.$reponse['ville'].'&nbsp;'.$pays['pays']; ?></td>



    <td>&nbsp;</td>



    </tr>



  <tr>



    <td colspan="2"><img src="<?php echo $imgurl; ?>/icons/phone.png" align="absmiddle"/> <?php echo $reponse['tel1']; ?></td>



    <td>&nbsp;</td>



    </tr>



  <tr>



    <td colspan="2"><img src="<?php echo $imgurl; ?>/icons/email.png" align="absmiddle"/> <a href="mailto:<?php echo $reponse['email']; ?>"><?php echo $reponse['email']; ?></a></td>



    <td>&nbsp;</td>



    </tr>



  <tr>



  	<td align="center"><?php echo $reponse['date']; ?></td>



    <td colspan="2"></td>



    <td></td>



  </tr>



  <tr>



  	<td align="center"><?php echo $reponse['nationalite']; ?></td>



    <td colspan="2">&nbsp;</td>



    <td>&nbsp;</td>



  </tr>



</table>	</td>



  </tr>



  <tr class="subscription">



    <td colspan="2"><h1>Derni&egrave;re Formation</h1></td>



  </tr> 



  <tr> 



   <td width="25%" valign="top"><br/><?php echo $retour['date_debut_formation'].' - '.$retour['date_fin_formation']; ?></td>



   <td><br/>



   <?php 



   echo '<u>Diplôme</u> : <b>'.$retour['diplome'].'</b><br/><u>&Eacute;tablissement</u> : '.$retour['etablissement'].'<br/><u>Description</u> : '.$retour['description']; 



   ?><br/>&nbsp;



   </td>



  </tr>



  <tr class="subscription">



    <td colspan="2"><h1>Expérience la plus r&eacute;&ccedil;ente </h1></td>



  </tr>



  <tr>



  <?php 



  $sel_exp = mysql_query("select * from experience_pro where id_candidat = '".$reponse['candidats_id']."'");



  $exp = mysql_fetch_array($sel_exp);



  $select_pays = mysql_query("select pays from prm_pays where id_pays = '".$exp['pays']."'");



  $pays = mysql_fetch_array($select_pays);

  

	$exp_date_fin= (empty($resultat['date_fin'])) ? " - Aujourd'hui" : $exp['date_fin'];

  ?>



    <td width="25%" valign="top"><br/><?php echo $exp['date_debut'].' - '.$exp_date_fin; ?></td>



	<td>



	<br/>



   <?php 



   echo '<u>Poste occupé</u> : <b>'.$exp['poste'].'</b><br/><u>Société</u> : '.$exp['entreprise'].', '.$exp['ville'].' - '.$pays['pays'].'<br/><u>Description</u> : '.$exp['description']; 



   ?><br/>&nbsp;



	</td>



  </tr>



  <tr class="subscription">



    <td colspan="2"><h1>langues</h1></td>



  </tr>



  <tr>



    <td colspan="2">



	<?php 



	echo 'Arabe ('.$retour['arabic'].'),  Français ('.$retour['french'].'),  Anglais ('.$retour['english'].')'; 



	if($retour['autre'] != '')



		echo ', Autres ('.$retour['autre'].')';



	?>



	</td>



  </tr>



  <tr class="subscription">



    <td colspan="2"><h1>lettre de motivation</h1></td>



  </tr>



  <tr>



    <td colspan="2">



	<?php 



	echo stripslashes($reponse['lettre_motivation']);



	?>



	</td>



  </tr>



</table>



</div>

</div>



</div>

</div>

  </div>

</div>

<?php 



	}



?>