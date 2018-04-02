                     <div class="texte" style="width:720px">



                        <br/><h1>GESTION DES FILIALES</h1>



						  	

						  	<?php if(isset($_POST['edit'])) { ?> 	

						  <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Modifier une filiale </h1>

                          </div>

                          	<?php }else{ ?>

                          	<?php if($_SESSION['ref_filiale_role'] == '0') {?> 

                          	 <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Ajouter une filiale </h1>

                          </div>

                          <?php } ?>

                          <?php } ?>

 <?php



			$id_filiale		= isset($_POST['id_filiale']) 			? $_POST['id_filiale']			: "";

 			$ref_filiale    		= isset($_POST['ref_filiale'])  			? $_POST['ref_filiale']    		 	: "";

			$nom    		= isset($_POST['nom'])  			? $_POST['nom']    		 	: "";

			$desc		= isset($_POST['desc'])  			?  $_POST['desc'] 			: "";

			

  



			

 ?>

 

<?php        



if(isset($_POST['valider']))

{



$messages = array();

if(isset($_POST['nom']) and !empty($_POST['nom']))



$nom = $_POST['nom'];

else

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  Vous n'avez pas entré le nom</li></ul></div>");



$desc=$_POST['desc'];

if(isset($_POST['nom']) and !empty($_POST['nom'])  )

{





$sql_test= "select * from per_filiale where nom_filiale='".$nom."' or ref_filiale = '".$ref_filiale."' ";

$requete_test= mysql_query($sql_test);

if($result_test = mysql_fetch_array($requete_test) AND  $id_filiale == '')

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  cette filiale existe déja dans la base de données</li></ul></div>");

else

{



$date= date("Y-m-d");

$nom = $_POST['nom'];





if($id_filiale != '')	{

	$saveFiliale = getDB()->update('per_filiale', 'id_filiale', $id_filiale, [
		'nom_filiale' => $nom,
		'description' => $desc,
		'logo_f' => '',
		'date_modification' => $date
	]);

}

else	{

	$saveFiliale = getDB()->create('per_filiale', [
		'ref_filiale' => $ref_filiale,
		'nom_filiale' => $nom,
		'description' => $desc,
		'logo_f' => '',
		'date_creation' => $date,
		'date_modification' => $date
	]);

}

if($saveFiliale > 0)	{

array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'> Entrée ajouté avec succes</li></ul></div>");

			$ref_filiale		= ""; 	$nom    		= ""; $desc			= ""; 

}

else

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  erreur lors de l'enregistrement</li></ul></div>");





}

redirect('backend/administration/filiales/');

} 



foreach($messages as $message)

{

echo $message.'<br/>'; 

}



 



}









?>

 

<style type="text/css" >

#addrole tr td{width:50%;height:20px;}

input{width:200px;}

select{width:204px;}

.btn{width:80px;}

.erreur{color:red;}

.success{color:green;}

</style>	





 <form   method="post" action="" id="form_standard">

 

				 <input type="hidden" name="id_filiale" value="<?php echo $id_filiale; ?>" />

											

						<table  width="100%" id="addrole" >

				<?php if(isset($_POST['edit'])) { ?>

				

						<tr>

						

						<td>

					

					<b>	Réf :</b>

						</td>

						<td> 

						

						<?php echo $ref_filiale; ?>

						</td>

						</tr>

						

					<?php } else {?>

					<?php if($_SESSION['ref_filiale_role'] == '0') {?> 

					<tr>

						

						<td>

					

					<b>	Réf :</b>

						</td>

						<td> 

						<input type="text" name="ref_filiale" title="Veuillez entrez le référence" 

						maxlength="80" value="<?php echo $ref_filiale; ?>"  required/>

						</td>

						</tr>

						<?php } ?>

						<?php  } ?>

						<?php if(isset($_POST['edit'])) { ?>

						<tr>

					

						<td>

					<b>	Nom:</b>

						</td>

						<td> 

						<input type="text" name="nom" title="Veuillez entrez le nom"

						maxlength="80" value="<?php echo $nom; ?>" required/>

						</td>

						

						</tr>

						<tr>

						

						<td>

					<b>	Description:</b>

						</td>

						<td> 

						<input type="text" name="desc" title="Veuillez entrez la déscription"

						rows="4" value="<?php echo $desc; ?>"  required/>

						<!--<textarea  name="desc" rows="4" cols="50"  style="  width: 198px;" <?php if($desc != ""){echo $desc;} ?>/>

							<?php

							if(isset($_POST['desc'])){

                                                $var = array("\'");

                                                $replace   = array("'");

                                                $new_mss = str_replace($var, $replace, $_POST['desc']);

                                            echo $new_mss;

                                }?>

						</textarea>-->

						</td>

						

						</tr>

				<?php } else {?>

					<?php if($_SESSION['ref_filiale_role'] == '0') {?> 

					<tr>

					

						<td>

					<b>	Nom:</b>

						</td>

						<td> 

						<input type="text" name="nom" maxlength="80" title="Veuillez entrez le nom" value="<?php echo $nom; ?>" required/>

						</td>

						

						</tr>

						<tr>

						

						<td>

					<b>	Description:</b>

						</td>

						<td> 

						<input type="text" name="desc" 

						rows="4" value="<?php echo $desc; ?>"  title="Veuillez entrez la déscription" required/>

						<!--<textarea  name="desc" rows="4" cols="50"  style="  width: 198px;" <?php if($desc != ""){echo $desc;} ?>/>

							<?php

							if(isset($_POST['desc'])){

                                                $var = array("\'");

                                                $replace   = array("'");

                                                $new_mss = str_replace($var, $replace, $_POST['desc']);

                                            echo $new_mss;

                                }?>

						</textarea>-->

						</td>

						

						</tr>

					<?php } ?>

						<?php  } ?>	

						

						

						</table>

						<table width="100%">

						

							<th width="50%"></th>

							<th width="50%"></th>

						

						<tbody>

						<tr>

						<td>

						

						

						</td>

						

						<td>

						<?php if(isset($_POST['edit'])) { ?> 

						<input class="espace_candidat" type="submit"  style="width:90px" 

						name="valider" value="Modifier" />



						<?php } else {?>

						<?php if($_SESSION['ref_filiale_role'] == '0') {?>

						<input class="espace_candidat" type="submit"  style="width:90px" 

						name="valider" value="Ajouter" />

						<?php } ?>

						<?php } ?>



						

						</td>

						

						</tr></tbody></table>



						<div class="ligneBleu"></div>

</form>



</div>





  <?php



  include ( "./filiale_m_table.php"); 

  

?>