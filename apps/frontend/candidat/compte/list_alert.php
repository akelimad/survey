<?php 

session_start(); 

if (!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "") {



header("Location: index.php");



} 



else {  



  require_once dirname(__FILE__) . "/../../../../config/config.php";


 





      $select_alert = mysql_query("select * from alert where candidats_id = '".safe($_SESSION['abb_id_candidat']). "' order by id_alert desc ");             
			if($select_alert)
		  $count_alert = mysql_num_rows($select_alert);                  

		  if (isset($count_alert)) {            

		  $ii = 1;                         

		  $cc = 1;                

		  while ($alerte = mysql_fetch_array($select_alert)) {        

		  ?>



          <tr class="sectiontableentry<?php echo $ii = ($ii == 1) ? $ii++ : $ii--; ?>">



            <td width="30%" >

			

			  <form action="<?php echo $urloffre ?>/offre.php" method="post" name="recherche<?php echo $cc; ?>">



                <input name="id_alert" type="hidden" value="<?php echo $alerte['id_alert']; ?>" />



                <a href="<?php echo $urloffre ?>/offre.php?motcle=<?php  echo $alerte['titre'] ?>" title="Executer la recherche" ><img src="<?php echo $imgurl ?>/icons/view.png" /></a>



              </form>

			 

			   <a  href="#" onclick="editAlert(<?php echo $alerte['id_alert']; ?>,'<?php  $titre= str_replace("'","\'",$alerte['titre']); echo $titre; ?>')"    title="Editer cette alerte" ><img src="<?php echo $imgurl ?>/icons/edit.png" /></a>



              <form action="<?php echo $urlcandidat; ?>/moncompte.php" method="post" name="formu<?php echo $cc; ?>">



                <input name="do" type="hidden" value="delete" />



                <input name="id_alert" type="hidden" value="<?php echo $alerte['id_alert']; ?>" />



                <a href="#" onclick="if(confirm('&ecirc;tes vous sur de vouloir supprimer cette alerte?')) formu<?php echo $cc; ?>.submit();" title="Supprimer l'alerte" ><img src="<?php echo $imgurl ?>/icons/delete.png" /></a>



              </form>



              <form action="<?php echo $urlcandidat; ?>/moncompte.php" method="post" name="form<?php echo $cc; ?>">



                <input name="id_alert" type="hidden" value="<?php echo $alerte['id_alert']; ?>" />



                <input name="do" type="hidden" value="activate" />



                <input type="checkbox" name="activation" onclick="form<?php echo $cc; ?>.submit()" title="Activer l'alerte" <?php if ($alerte['activate'] == 'true') echo 'checked'; ?> value="true"/>



              </form>

			  

			  </td>



            <td width="20%" ><?php echo $alerte['date'] ?></td>



            <td><?php echo $alerte['titre']; ?></td>



           



          </tr>



          <?php          

		  $cc++;           

		  }                 

		  }                   

		  else {             

		  ?>

		  



          <tr>



            <td colspan="3"> Vous n'avez aucune alerte. <a href="#" onclick="createAlert(<?php     if(isset($_POST['requete'])) echo $_POST['requete']; else echo "'norequete'";        ?>);" >Créer une alerte e-mail</a></td>



          </tr>



          <?php            

		  }                

		  















}

?>