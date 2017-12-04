 

	<div class='texte'>

	  <h1>METTRE EN VEILLE MON COMPTE</h1>

	   <div class="subscription" style="margin: 10px 0pt;">



	          <h1>Vous souhaitez Mettre en veille votre compte ?</h1>



       </div>	 

<?php







     if(isset($_POST['envoi']))



  {



  



  $affected = 0;



  $id_candidat = $_SESSION['abb_id_candidat'];



  // changer le statut du candidat



  mysql_query("UPDATE  `candidats` SET  `status` = '0' WHERE `candidats_id` = '".safe($id_candidat)."'");



  $affected = mysql_affected_rows($con);

 $req12 = mysql_query("SELECT * FROM candidats where candidats_id = '".safe($id_candidat)."' ");

$array= mysql_fetch_array($req12);



    



 if($affected > 0){



 //supprimer les candidatures



  mysql_query("DELETE from `candidature` WHERE `id_candidat` = '".safe($id_candidat)."'");



 //supprimer les cv attribues



  mysql_query("DELETE from `cvs_attribues` WHERE `id_candidat` = '".safe($id_candidat)."'");

  

 //supprimer les candidature_spontanee



  mysql_query("DELETE from `candidature_spontanee` WHERE `id_candidat` = '".safe($id_candidat)."'");

  

 //supprimer les candidature_stage



  mysql_query("DELETE from `candidature_stage` WHERE `id_candidat` = '".safe($id_candidat)."'");



 //Afficher le message de confirmation 







include('./veuille_dossier_m_email_1.php'); 



$messages_succ=array();

array_push($messages_succ,"<li style='color:#468847'>Votre compte candidat a bien été mis en veille </li>");

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



       <table width="100%" border="0" >







  <tr>



    <td >Lorsque vous mettez en veille votre compte, votre profil et toutes les informations qui y sont associées ne seront plus visibles sur le site. 

 <br/><br/>Souhaitez-vous vraiment mettre en veille votre compte ?<br/><br/></td>



    </tr>



    



  <tr>



   



       <td ><input class="espace_candidat" name="envoi" type="submit" value="Mettre en veille mon compte"  /> 



	    <input class="espace_candidat" name="annuler" type="submit" value="Annuler"  /> 



     </td>



  </tr>



</table>



</form>

</div>

 