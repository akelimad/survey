                     <div class="texte" style="width:720px">







                        <br/><h1>GESTION DES PROFILS DE STAGE</h1>



 <?php



			$id_role		= isset($_POST['id_role']) 			? $_POST['id_role']			: "";

			$login 			= isset($_POST['login'])		  	? $_POST['login'] 			: "";

  



			

 ?>

 

<?php        



if(isset($_POST['valider']))

{



$messages = array();

if(isset($_POST['password']) and !empty($_POST['password']))

$mdp  =  md5($_POST['password']);

else

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> Vous n'avez pas entré un mot de passe</li></ul></div>");

if(isset($_POST['login']) and !empty($_POST['login']))

$login = $_POST['login'];

else

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  Vous n'avez pas entré un login</li></ul></div>");





if((isset($_POST['password']) and !empty($_POST['password'])) or (isset($_POST['password1']) and !empty($_POST['password1'])))

if(!isset($_POST['password']) or !isset($_POST['password1']) or $_POST['password']!=$_POST['password1'])



array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> les deux mots de passe ne sont pas identiques</li></ul></div>");



if(isset($_POST['password']) and !empty($_POST['password']) and isset($_POST['password1']) and !empty($_POST['password1']) and isset($_POST['login']) and !empty($_POST['login']) and $_POST['password']==$_POST['password1'])

{



$login =  str_replace("'","\'",$login);

$sql_test= "select * from liste_stage where login='".$login."' ";

$requete_test= mysql_query($sql_test);

if($result_test = mysql_fetch_array($requete_test) AND  $id_role == '')

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  ce login existe déja dans la base de données</li></ul></div>");

else

{



$date= date("Y-m-d");



if($id_role != '')	{

$sql= "UPDATE liste_stage SET  login = '". safe($login)."', pass = '". safe($mdp)."', date = '". safe($date)."' where id_stage = '". safe($id_role)."'";

}

else	{



}

if(mysql_query($sql))	{

array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'> Modification avec succes</li></ul></div>");

			$id_role		= ""; 		$login 			= ""; 

}

else

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  erreur lors de l'enregistrement</li></ul></div>");





}

} 



foreach($messages as $message)

{

echo $message.'<br/>'; 

}



 



}









?>

 



<?php if(isset($_POST['edit'])) {?>

						  <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Modifier le profil</h1>

                          </div>

 <form   method="post" action="" id="form_standard">

 

				 <input type="hidden" name="id_role" value="<?php echo $id_role; ?>" />

											

						<table  width="100%" id="addrole" >

						

						

						

						<td>

					<b>	Login:</b>

						</td>

						<td> 

						<input type="text" name="login" title="Veuillez entrez le login" maxlength="50" value="<?php echo $login; ?>" required/>

						</td>

						

						</tr>

						

						<tr>

						

						<td>

				<b>		Mot de passe:</b>

						</td>

						<td>

						<input type="password" name="password" title="Veuillez entrez le mot de passe" maxlength="50" value="" required/>

						</td>

						

						</tr>

						

							<tr>

						

						<td>

				<b>		Retaper le mot de passe:</b>

						</td>

						<td>

						<input type="password" name="password1" title="Veuillez retapez le mot de passe" maxlength="50" value="" required/>

						</td>

						

						</tr>

						

						

						

						

						

						</table>

						<table width="100%">

						

							<th width="50%"></th>

							<th width="50%"></th>

						

						<tbody>

						<tr>

						<td>

						

						

						</td>

						

						<td>

						

						<input class="espace_candidat" type="submit"  style="width:90px" 

						name="valider" value="Enregistrer" />

		

						

						</td>

						

						</tr></tbody></table>



<div class="ligneBleu"></div>

</form>

				<?php }?>

                    </div>





  <?php



  include ( "./stages_users_m_table.php"); 

  

?>