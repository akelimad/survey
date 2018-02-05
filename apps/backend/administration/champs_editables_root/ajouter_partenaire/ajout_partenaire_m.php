 







                    <div class="texte" style="width:720px">







                        <br/><h1>GESTION DES PARTENAIRES</h1>	 

									<div style=" float: right; padding: 5px 5px 0px 0px;">

									 <a href="../type_partenaire/?p=ec" style=" border-bottom: none; ">

											<img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

									</a>

									</div>

						    <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Ajouter un Partenaire </h1>

							</div>

                          





<?php        



if(isset($_POST['Valider']))

{



$messages = array();

if(isset($_POST['nom_r']) and !empty($_POST['nom_r']))

$nom_r  =  $_POST['nom_r'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le nom du responsable </span>");

if(isset($_POST['tel_r']) and !empty($_POST['tel_r']))

$tel_r  =  $_POST['tel_r'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le tel du responsable</span>");

if(isset($_POST['nom']) and !empty($_POST['nom']))

$nom  =  $_POST['nom'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le nom du partenaire </span>");

if(isset($_POST['email']) and !empty($_POST['email']))

$email = $_POST['email'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli l'email</span>");

if(isset($_POST['type_p']) and !empty($_POST['type_p']))

$type_partenaire = $_POST['type_p'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas selectionn?un type de partenaire</span>");

if(isset($_POST['msg']) and !empty($_POST['msg']))

$msg = $_POST['msg'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le message</span>");









if(isset($_POST['nom_r']) and !empty($_POST['nom_r']) and isset($_POST['tel_r']) and !empty($_POST['tel_r']) and isset($_POST['nom']) and !empty($_POST['nom']) and isset($_POST['nom']) and !empty($_POST['nom']) and isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['type_p']) and !empty($_POST['type_p']) and isset($_POST['msg']) and !empty($_POST['msg']))

{

$nom_r  =  $_POST['nom_r'];

$tel_r  =  $_POST['tel_r'];

$nom  =  $_POST['nom'];

$type_partenaire = $_POST['type_p'];

$email = $_POST['email'];

$message = $_POST['msg']; 

				$var = array("'");

				$replace   = array("\'");

				$new_msg = str_replace($var, $replace, $message);

$sql= " insert into partenaire Values ('','".safe($type_partenaire)."','".safe($nom_r)."','".safe($tel_r)."','".safe($nom)."','".safe($email)."','".safe($new_msg)."') ";

if(mysql_query($sql))

array_push($messages,"<span class='success'>Modification avec succ?</span>");

else

array_push($messages,"<span class='erreur'> erreur lors de l'enregistrement</span>");



}



foreach($messages as $message)

echo $message.'<br/>';



}







if(isset($_POST['Modifier']))

{



$messages = array();

if(isset($_POST['nom_r']) and !empty($_POST['nom_r']))

$nom_r  =  $_POST['nom_r'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le nom du responsable </span>");

if(isset($_POST['tel_r']) and !empty($_POST['tel_r']))

$tel_r  =  $_POST['tel_r'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le tel du responsable</span>");

if(isset($_POST['nom']) and !empty($_POST['nom']))

$nom  =  $_POST['nom'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le nom du partenaire </span>");

if(isset($_POST['email']) and !empty($_POST['email']))

$email = $_POST['email'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli l'email</span>");

if(isset($_POST['type_p']) and !empty($_POST['type_p']))

$type_partenaire = $_POST['type_p'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas selectionn?un type de partenaire</span>");

if(isset($_POST['msg']) and !empty($_POST['msg']))

$msg = $_POST['msg'];

else

array_push($messages,"<span class='erreur'>Vous n'avez pas rempli le message</span>");









if(isset($_POST['id']) and !empty($_POST['id']) and isset($_POST['nom_r']) and !empty($_POST['nom_r']) and isset($_POST['tel_r']) and !empty($_POST['tel_r']) and isset($_POST['nom']) and !empty($_POST['nom']) and isset($_POST['email']) and !empty($_POST['email']) and isset($_POST['type_p']) and !empty($_POST['type_p']) and isset($_POST['msg']) and !empty($_POST['msg']))

{



$id  =  $_POST['id'];

$nom_r  =  $_POST['nom_r'];

$tel_r  =  $_POST['tel_r'];

$nom  =  $_POST['nom'];

$type_partenaire = $_POST['type_p'];

$email = $_POST['email'];

$message = $_POST['msg'];

 

				$var = array("'");

				$replace   = array("\'");

				$new_msg = str_replace($var, $replace, $message);

$sql= " UPDATE partenaire SET  id_tparte='".safe($type_partenaire)."',nom_r='".safe($nom_r)."',tel_r='".safe($tel_r)."',nom='".safe($nom)."',email='".safe($email)."',message='".safe($new_msg)."' WHERE id_parte='".safe($id)."' ";



if(mysql_query($sql))

array_push($messages,"<span class='success'>Modification avec succ?</span>");

else

array_push($messages,"<span class='erreur'> erreur lors de l'enregistrement</span>".$sql);



}



foreach($messages as $message)

echo $message.'<br/>';



}



?>



						  

						<form   method="post" action=""> 

						<table  width="100%" id="addrole" >

						<input type="hidden" name="id"  value="<?php if(isset($_POST['id'])){echo $_POST['id'];}?><?php if(isset($_GET['id'])){echo $_GET['id'];}?>"  />

						<tr>

							<td  width="20%">

								<b>	Nom du responsable:</b> <font style="color:red;">*</font>

							</td>

							<td  width="60%"> 

								<input type="text" name="nom_r"  value="<?php if(isset($_POST['nom_r'])){echo $_POST['nom_r'];}?><?php if(isset($_GET['nom_r'])){echo $_GET['nom_r'];}?>"  style="width: 400px;" maxlength="50" />

							</td>

						</tr>

						<tr>

							<td  width="20%">

								<b>	Tel du responsable:</b> <font style="color:red;">*</font>

							</td>

							<td  width="60%"> 

								<input type="text" name="tel_r"  value="<?php if(isset($_POST['tel_r'])){echo $_POST['tel_r'];}?><?php if(isset($_GET['tel_r'])){echo $_GET['tel_r'];}?>"  style="width: 400px;"  pattern="^(?:0|\(?\+212\)?\s?|0\s?)[1-79](?:[\.\-\s]?\d\d){4}$"/>

							</td>

						</tr>

						<tr>

							<td  width="20%">

								<b>	Nom du partenaire:</b> <font style="color:red;">*</font>

							</td>

							<td  width="60%"> 

								<input type="text" name="nom"  value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];}?><?php if(isset($_GET['nom'])){echo $_GET['nom'];}?>"  style="width: 400px;" maxlength="50" />

							</td>

						</tr>

						

						<tr>

							<td  width="20%">

								<b>	E-mail:</b> <font style="color:red;">*</font>

							</td>

							<td  width="60%"> 

								<input type="email" name="email"  value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?><?php if(isset($_GET['email'])){echo $_GET['email'];}?>"  style="width: 400px;" required  placeholder="me@example.com" maxlength="50" />

							</td>

						</tr>

						

						<tr>

							<td  width="20%">

								<b>	Type de partenaire:</b> <font style="color:red;">*</font>

							</td>

							<td  width="60%"> 

								<select name="type_p"  style="width: 404px;"  >

								  <option  ></option>

								  <?php		

								  if(isset($_POST['type_p'])){$pp=$_POST['type_p'];}

								  elseif(isset($_GET['type_partenaire'])){$pp=$_GET['type_partenaire'];}

								  else {$pp='';}

								  $req_p = mysql_query( "SELECT * FROM prm_type_partenaire");				

								  while ( $p1 = mysql_fetch_array( $req_p ) ) {					

										$p_id= $p1['id_tparte']	;	$p_desc = $p1['type_partenaire'];					

								  				?>

								 <option value="<?php echo $p_id ?>"  <?php if($pp==$p_id) echo 'selected="selected"'?> ><?php echo $p_desc ?></option>					

								  			<?php 			            

								  }		?>

								</select>

								

							</td>

						</tr>

						

						<tr>

							<td  width="20%">

								<b>		Message:</b> <font style="color:red;">*</font>

							</td>

							<td  width="60%"> 

							

								<div>

								<select id="selectHint" name="users" onchange="showUser(this.value)" style=" width: 250px;<?php if(isset($_POST['ds'])){ echo"background-color: #EBEBE4;"; } ?> " <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?>>

									<option value="">Ins?e une variable dans le message : </option>

									<option value="{{nom}}">Nom</option> 

									<option value="{{lieu}}">Lieu</option>

								</select>

								</div>

								<textarea name="msg" id="editor1"><?php if(isset($_POST['msg'])){echo $_POST['msg'];}?><?php if(isset($_GET['message'])){echo $_GET['message'];}?></textarea>

							<?php   

								echo "<script type='text/javascript'> 

								CKEDITOR.replace( 'editor1',

								{

								contentsCss : 'body{background-color:#FFFFFF ;}'

								});

								

								function showUser(str) {

								  if (str=='') {

									//document.getElementById('editor1').value+='';

										CKEDITOR.instances['editor1'].insertText('');

									return;

								  } 

								   if (str!='') {

									  //document.getElementById('editor1').value+=document.getElementById('selectHint').value;

									  //selecElement.selectedIndex = 0;

									  var add_c=document.getElementById('selectHint').value; // '253+';//

										CKEDITOR.instances['editor1'].insertText(add_c);

									  document.getElementById('selectHint').selectedIndex = 0;

									return;

								  }

								}



								</script>";

								   ?>

							</td>

						</tr>

						

						

						<tr>

						     <td colspan="2"><div class="ligneBleu"></div>



							<p style="color:#CC0000"> P.S: les champs marqu? par (*) sont obligatoires<br/>

							



							</p></td>

				

						</tr>

						<tr>

							<td  width="20%">						

							</td>

							<td  width="60%"> 

								<input type="submit" class="btn" name="<?php if(isset($_POST['id']) AND $_POST['id']!=""){echo "Modifier";} else { echo $action; } ?>" value="<?php if(isset($_POST['id'])){echo "Modifier";} else { echo $action; } ?>" />

								

								<input name="" type="reset" style="width:170px"/>

								<br>

								<br>	

							</td>

						</tr>

						</table>

</form>

                    </div>



					

					

	<?php  include ( "./ajout_partenaire_m_table.php"); ?>

	

 