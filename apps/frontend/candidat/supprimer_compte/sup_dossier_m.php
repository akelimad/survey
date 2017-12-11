 

	<div class='texte'>

	  <h1>SUPPRIMER MON COMPTE</h1>

	   <div class="subscription" style="margin: 10px 0pt;">



	          <h1>Vous souhaitez supprimer votre compte ?</h1>



       </div>	 





<?php







     if(isset($_POST['envoi']))



  {

$id_candidat = $_SESSION['abb_id_candidat'];

  $raison= isset($_POST['raison']) ? $_POST['raison'] : "";

$req_raison = mysql_query("INSERT INTO compte_desactiver 

  VALUES ('','".safe($id_candidat)."','".safe($raison)."',CURRENT_TIMESTAMP) ");



$req = mysql_query("SELECT * FROM candidats where candidats_id = '".safe($id_candidat)."' ");

  $affected = 0;



  

$req = mysql_query("SELECT * FROM candidats where candidats_id = '".safe($id_candidat)."' ");

$rep= mysql_fetch_array($req);

  // changer le statut du candidat



  // mysql_query("DELETE from `candidats` WHERE `candidats_id` = '".safe($id_candidat)."'");



  // $affected = mysql_affected_rows($con);



  $affected = getDB()->update('candidats', 'candidats_id', $id_candidat, ['status' => 0]);
    



 if($affected > 0){



 //supprimer les candidatures



  // mysql_query("DELETE from `candidature` WHERE `candidats_id` = '".safe($id_candidat)."'");



 //supprimer les cv attribues



  // mysql_query("DELETE from `cvs_attribues` WHERE `id_candidat` = '".safe($id_candidat)."'");



 //supprimer les candidature_spontanee



  // mysql_query("DELETE from `candidature_spontanee` WHERE `candidats_id` = '".safe($id_candidat)."'");

  

 //supprimer les candidature_stage



  // mysql_query("DELETE from `candidature_stage` WHERE `candidats_id` = '".safe($id_candidat)."'");

  

 //supprimer les dossier_candidat



  // mysql_query("DELETE from `dossier_candidat` WHERE `candidats_id` = '".safe($id_candidat)."'");

  

 //supprimer les formations



  // mysql_query("DELETE from `formations` WHERE `candidats_id` = '".safe($id_candidat)."'");

  

 //supprimer les experience_pro



  // mysql_query("DELETE from `experience_pro` WHERE `candidats_id` = '".safe($id_candidat)."'");



 //Afficher le message de confirmation

include('./sup_dossier_m_email_1.php'); 

 //echo '<br/><font color="#009933">Votre compte candidat a bien été supprimé</font>';

$messages_succ=array();

array_push($messages_succ,"<li style='color:#468847'>Votre compte candidat a bien été supprimé sur notre site. </li>");

?>

<ul>

<?php foreach ($messages_succ as $messages_succ): ?>

    <div class="alert alert-success">

    <?php echo $messages_succ; ?>

    </div>

<?php endforeach; ?>

</ul>

<?php

  echo "<meta http-equiv='refresh' content='6;../index.php' />";

session_destroy();

}



?>

<?php



 } 



?>

<form action="#self" method="post" onsubmit="return valider()" name="formSaisie" >



       <table width="100%" border="0" cellspacing="0" cellpadding="5">



  <tr>



    <td colspan="2"> 



 </td>



  </tr>

<tr>

  <td colspan="2">

<p> Pourquoi souhaiteriez-vous supprimer votre compte ? </p>

<?php 

$sql1 = "select * from prm_compte_desactiver ";

    $select1 = mysql_query($sql1);

while( $reponse1 = mysql_fetch_array($select1) ) {

?>

<p><input type="radio" name="raison" value="<?php echo $reponse1['id_prm_compte']; ?>"> 

<?php echo $reponse1['raison']; ?></p>

<?php } ?>



  </td>

</tr>

  <tr>

<td colspan="2">

<p>Lorsque vous supprimez votre compte, votre profil et toutes les informations qui y 

sont associées sont effacées du site. </p>

<p>Voulez-vous vraiment supprimer votre compte ?</p></td>

</tr>

<tr>

<td><input class="espace_candidat" name="envoi" type="submit" value="Supprimer mon compte" style="width:160px" /> 

<input class="espace_candidat" name="" type="reset" value="Annuler" style="width:100px"/></td>

</tr>



</table>



</form>







</div><!-- fin content gauche -->



 