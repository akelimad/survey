                     <div class="texte" style="width:720px">







                        <br/><h1>GESTION DES PROFILS</h1>

						  <?php if(isset($_POST['edit'])) { ?> 

						  <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Modifier un profil </h1>

                          </div>

                          <?php }else{ ?>

                          <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Ajouter un profil </h1>

                          </div>

                          <?php }?>

 <?php



			$id_role		= isset($_POST['id_role']) 			? $_POST['id_role']			: "";
			$id_departement		= isset($_POST['id_departement']) 			? $_POST['id_departement']			: "";

 			$nom    		= isset($_POST['nom'])  			? $_POST['nom']    		 	: "";

			$email			= isset($_POST['email'])  			?  $_POST['email'] 			: "";

			$login 			= isset($_POST['login'])		  	? $_POST['login'] 			: "";

 			$ref_filiale   = isset($_POST['filiale'])  	? $_POST['filiale']    : ""; 

 			$id_type_role   = isset($_POST['role'])  	? $_POST['role']    : ""; 

 			$tel   = isset($_POST['tel'])  	? $_POST['tel']    : ""; 

 			$desc   = isset($_POST['desc'])  	? $_POST['desc']    : ""; 

  



			

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



$role=$_POST['role'];

if((isset($_POST['password']) and !empty($_POST['password'])) or (isset($_POST['password1']) and !empty($_POST['password1'])))

if(!isset($_POST['password']) or !isset($_POST['password1']) or $_POST['password']!=$_POST['password1'])



array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> les deux mots de passe ne sont pas identiques</li></ul></div>");



if(isset($_POST['password']) and !empty($_POST['password']) and isset($_POST['password1']) and !empty($_POST['password1']) and isset($_POST['login']) and !empty($_POST['login']) and $_POST['password']==$_POST['password1'])

{



$login =  str_replace("'","\'",$login);

$sql_test= "select * from root_roles where login='".$login."' ".$q_ref_fili_and." ";

$requete_test= mysql_query($sql_test);

if($result_test = mysql_fetch_array($requete_test) AND  $id_role == '')

array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>  ce login existe déja dans la base de données</li></ul></div>");

else

{



$date= date("Y-m-d");

$nom = $_POST['nom'];

$email = $_POST['email'];



if($id_role != '')	{

$sql= "UPDATE root_roles SET id_departement = '". safe($id_departement)."', id_type_role = '". safe($role)."', nom = '". safe($nom)."', email = '". safe($email)."', login = '". safe($login)."', mdp = '". safe($mdp)."', date_modification = '". safe($date)."', ref_filiale = '". safe($ref_filiale)."', tel = '". safe($tel)."', description = '". safe($desc)."' where id_role = '". safe($id_role)."'";



			if( $role == '1' )	{

			$sql_roles_tmp= "DELETE FROM roles_tmp WHERE id_role = '".$id_role."'";

			$sql_role_candidature= "DELETE FROM role_candidature WHERE id_role = '".$id_role."'";

			$sql_role_offre= "DELETE FROM role_offre WHERE id_role = '".$id_role."'";

			}



}

else	{

$sql= " insert into root_roles(id_departement, id_type_role,login,mdp,date_creation,date_modification,nom,email,ref_filiale,tel,description) Values ('".safe($id_departement)."','".safe($role)."','".safe($login)."','".safe($mdp)."','".safe($date)."','".safe($date)."','".safe($nom)."','".safe($email)."','".safe($ref_filiale)."','".safe($tel)."','".safe($desc)."') ";

}

if(mysql_query($sql))	{

array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'> Entrée ajouté avec succes</li></ul></div>");

			if( $role == '1' )	{

					mysql_query($sql_roles_tmp);

					mysql_query($sql_role_candidature);

					mysql_query($sql_role_offre);

			}

			$id_role		= ""; 	$nom    		= ""; $email			= ""; 	$login 			= ""; $id_type_role   = ""; 

			$tel   = ""; $desc   = ""; $ref_filiale ="";

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

 

<style type="text/css" >

#addrole tr td{width:50%;height:20px;}

input{width:200px;}

select{width:204px;}

.btn{width:80px;}

.erreur{color:red;}

.success{color:green;}

</style>	





 <form   method="post" action="" id="form_standard">

 

				 <input type="hidden" name="id_role" value="<?php echo $id_role; ?>" />

											

						<table  width="100%" id="addrole" >

						

						<tr>

						

						<td>

					<b>	Nom:</b>

						</td>

						<td> 

						<input type="text" title="Nom" name="nom" maxlength="80" value="<?php echo $nom; ?>" required/>

						</td>

						

						</tr>

						

						<tr>

						

						<td>

					<b>	E-mail:</b>

						</td>

						<td> 

						<input type="email" title="Email" name="email"  required  placeholder="me@example.com" value="<?php echo $email; ?>" required/>

						</td>

						

						</tr>

						

						<tr>

						

						<td>

					<b>	Login:</b>

						</td>

						<td> 

						<input type="email" title="login" name="login"  maxlength="50" value="<?php echo $login; ?>" required/>

						</td>

						

						</tr>

						

						<tr>

						

						<td>

				<b>		Mot de passe:</b>

						</td>

						<td>

						<input type="password" id="password" title="Mot de passe" 

						name="password" maxlength="50" value="" required/>

						</td>

						

						</tr>

						

							<tr>

						

						<td>

				<b>		Retaper le mot de passe:</b>

						</td>

						<td>

						<input type="password" id="password1"

						title="Retaper le mot de passe" name="password1" maxlength="50" value="" required/>

						</td>

						

						</tr>

						

						

						<tr>

						

						<td>

					<b>	Téléphone:</b>

						</td>

						<td> 

						<input type="text" name="tel" title="tel" maxlength="80" value="<?php echo $tel; ?>"  />

						</td>

						

						</tr>

						

						

						<tr>

						

						<td>

					<b>	Description:</b>

						</td>

						<td> 

						<input type="text" name="desc" title="desc" maxlength="80" value="<?php echo $desc; ?>"  />

						</td>

						

						</tr>

						

						<tr>

						

						<td>

				<b>		Type de filiale:</b>

						</td>

						<td>

						

						<select name="filiale" title="filiale" required/>

								<option value="" selected="selected"></option>

                              <?php

                              $req_theme0 = mysql_query("select * from per_filiale ".$q_ref_fili." ");

                              while ($data0 = mysql_fetch_array($req_theme0)) {

                                  $filiale_ref = $data0['ref_filiale'];

                                  $filiale_nom = $data0['nom_filiale'];

                                  if ($filiale_ref == $ref_filiale)

                                      $selected = 'selected';

                                  else

                                      $selected = '';

                                  echo "<option value=\"$filiale_ref\" " . $selected . ">$filiale_nom</option>";

                              }

                              ?>

                         </select>

						 

						</td>

						

						</tr>

						

						<tr>

						

						<td>

				<b>		Type de profil:</b>

						</td>

						<td>

						

						<select name="role" title="role" required/>

								<option value="" selected="selected"></option>

                              <?php

                              $req_theme = mysql_query("select * from root_type_role");

                              while ($data = mysql_fetch_array($req_theme)) {

                                  $role_id = $data['id_type_role'];

                                  $role_l = $data['role'];

                                  if ($role_id == $id_type_role)

                                      $selected = 'selected';

                                  else

                                      $selected = '';

                                  echo "<option value=\"$role_id\" " . $selected . ">$role_l</option>";

                              }

                              ?>

                         </select>

						 

						</td>

						

						</tr>


						<?php if(class_exists('modules\workflows\controllers\WorkflowController')) : ?>
						<tr>
							<td><b>Département</b></td>
							<td>
								<select name="id_departement" required>
									<option value=""></option>
									<?php
										$departements = getDB()->read('root_departements');
										foreach ($departements as $key => $value) :
										$selected = (isset($id_departement) && $id_departement == $value->id_departement) ? 'selected' : '';
									?>
										<option value="<?php echo $value->id_departement; ?>" <?php echo $selected; ?>><?php echo $value->name; ?></option>
									<?php endforeach; ?>
								</select>								
							</td>
						</tr>
						<?php endif; ?>

						

						

						

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

						<input class="espace_candidat" type="submit"  style="width:90px" 

						name="valider" value="Ajouter" />



						<?php } ?>



						

						</td>

						

						</tr></tbody></table><div class="ligneBleu"></div>

</form>



</div>





  <?php



  include ( "./ajout_role_m_table.php"); 

  

?>