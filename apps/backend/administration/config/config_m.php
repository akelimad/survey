







      <div class='texte'  style="width:720px">



	  <br/><h1>Configuration des variables config</h1>



						  <div class="subscription" style="margin: 10px 0pt;">



                                 <h1>Configuration des variables de site config</h1>



                          </div>

<?php 



    $id                 = $reponse['id_prm_config'];

    $nom_serveur         = (isset($_POST['nom_serveur']))?$_POST['nom_serveur']:$reponse['nom_serveur'];

    $nom_user         = (isset($_POST['nom_user']))?$_POST['nom_user']:$reponse['nom_user'];

	$password         = (isset($_POST['password']))?$_POST['password']:$reponse['password'];

	$nom_bdd         = (isset($_POST['nom_bdd']))?$_POST['nom_bdd']:$reponse['nom_bdd'];

	$lien_google_d        = (isset($_POST['lien_google_d']))?$_POST['lien_google_d']:$reponse['lien_google_d'];

	$app_id_fb       = (!empty($_POST['app_id_fb']))?$_POST['app_id_fb']:$reponse['app_id_fb'];

	$app_secret_fb   = (!empty($_POST['app_secret_fb']))?$_POST['app_secret_fb']:$reponse['app_secret_fb'];

	$site_e   = (!empty($_POST['site_e']))?$_POST['site_e']:$reponse['site_e'];

    $email_e           = (!empty($_POST['email_e']))?$_POST['email_e']:$reponse['email_e'];

    $variable_r           = (!empty($_POST['variable_r']))?$_POST['variable_r']:$reponse['variable_r'];











	



	



if(isset($_POST['send']) and $_POST['send']!="")



{



$sql_up="UPDATE prm_config set nom_serveur='".safe($nom_serveur)."',nom_user='".safe($nom_user)."',password='".safe($password)."',nom_bdd='".safe($nom_bdd)."',lien_google_d='".safe($lien_google_d)."',app_id_fb='".safe($app_id_fb)."',app_secret_fb='".safe($app_secret_fb)."',

site_e='".safe($site_e)."',email_e='".safe($email_e)."'

,variable_r='".safe($variable_r)."' where id_prm_config='".safe($id)."' ";



 //echo $sql_up;



$update = mysql_query($sql_up);



	if(!$update){



	echo '<div class="alert alert-error"  >

     Une erreur s\'est produite lors de la mise &agrave; jour de cette configuration  </div>';



	$maj=0;



	}else{



	echo '<div class="alert alert-succes">

    Cette configuration a bien &eacute;t&eacute; mise &agrave; jour  </div>';



	$sql = "SELECT * from prm_config ";



	$select = mysql_query($sql);



	$reponse = mysql_fetch_assoc($select);



	}



echo '<meta http-equiv="refresh" content="0; url=./">';



}















     ?>  



	 



	  <form action="./" method="post"  enctype="multipart/form-data" name="form1"> 



<table>

<tr> 

<td colspan="3" valign="top" >Nom serveur </td>

<td colspan="9" >

<input required name="nom_serveur" disabled

maxlength="50" style="width: 500px;" value="<?php echo $s___0; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >Nom utilisateur </td>

<td colspan="9" >

<input required name="nom_user" disabled

maxlength="50" style="width: 500px;" value="<?php echo $u___0; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >Password </td>

<td colspan="9" >

<input  name="password" disabled

maxlength="50" style="width: 500px;" value="<?php echo $p___0; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >Nom base de données </td>

<td colspan="9" >

<input required name="nom_bdd" disabled

maxlength="50" style="width: 500px;" value="<?php echo $b___0; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >lien google docs </td>

<td colspan="9" >

<input required name="lien_google_d" 

maxlength="50" style="width: 500px;" value="<?php echo $lien_google_d; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >id facebook </td>

<td colspan="9" >

<input required name="app_id_fb" 

maxlength="50" style="width: 500px;" value="<?php echo $app_id_fb; ?>">

</td>

</tr>

		  

<tr> 

<td colspan="3" valign="top" >App secret facebook </td>

<td colspan="9" >

<input required name="app_secret_fb" 

maxlength="50" style="width: 500px;" value="<?php echo $app_secret_fb; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >Site Etalent </td>

<td colspan="9" >

<input required name="site_e" 

maxlength="50" style="width: 500px;" value="<?php echo $site_e; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >Email Etalent </td>

<td colspan="9" >

<input required name="email_e" 

maxlength="50" style="width: 500px;" value="<?php echo $email_e; ?>">

</td>

</tr>



<tr> 

<td colspan="3" valign="top" >Variable site </td>

<td colspan="9" >

<input  name="variable_r" 

maxlength="50" style="width: 500px;" value="<?php echo $variable_r; ?>">

</td>

</tr>









            <tr>







              <td colspan="8"><div class="ligneBleu"></div>







                <input name="send" class="espace_candidat" type="submit" value="Enregistrer les modifications" />







              </td>







            </tr>







          </table>



		







       </form> 











      </div>



 