 


                    <div class="texte" style="width:720px">



                         <br/><h1>COURRIERS AUTOMATIQUE</h1>	
						  <div class="subscription" style="margin: 10px 0pt;">
                                 <h1>Ajouter un courrier automatique </h1>
                          </div>



<?php        

if(isset($_POST['Modifier']) OR isset($_POST['Valider'])){

$messages = array();
$p_j="";
if($_FILES['monfichier']['name']!=''){
$nomOrigine = $_FILES['monfichier']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = $elementsChemin['extension'];

$extensionsAutorisees = array("doc", "docx", "pdf");
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
array_push($messages,"<span class='erreur'>Le fichier n'a pas l'extension attendue </span>");
} else {    

    // Copie dans le repertoire du script avec un nom
    // incluant l'heure a la seconde pres 
    $repertoireDestination = dirname(__FILE__) .$file_courrier2;
//  echo $repertoireDestination;
    $nomDestination = "fichCourrier_du_".date("Y.m.d-H.i.s").".".$extensionFichier;
    $p_j=$nomDestination;
    if (copy($_FILES["monfichier"]["tmp_name"], 
                                     $repertoireDestination.$nomDestination))  {
									 
       //         " a été déplacé vers ".$repertoireDestination.$nomDestination;
    } else {
	
	array_push($messages,"<span class='erreur'>Le fichier n'a pas été uploadé (trop gros ?) ou Le déplacement du fichier temporaire a échoué vérifiez l'existence du répertoire ".$repertoireDestination."</span>");
    }
}
}
}

if(isset($_POST['Valider']))
{

$messages = array();
if(isset($_POST['ref']) and !empty($_POST['ref']))
$ref  =  $_POST['ref'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli le ref</li></ul></div>");

if(isset($_POST['titre']) and !empty($_POST['titre']))
$titre  =  $_POST['titre'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli le type de candidature</li></ul></div>");

if(isset($_POST['expediteur']) and !empty($_POST['expediteur']))
$expediteur  =  $_POST['expediteur'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli l'expéditeur </li></ul></div>");
if(isset($_POST['objet']) and !empty($_POST['objet']))
$objet = $_POST['objet'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli l'Objet</li></ul></div>");
if(isset($_POST['msg']) and !empty($_POST['msg']))
$msg = $_POST['msg'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli le message</li></ul></div>");




if(isset($_POST['titre']) and !empty($_POST['titre']) and 
    isset($_POST['ref']) and !empty($_POST['ref']) and isset($_POST['expediteur']) and !empty($_POST['expediteur']) 
    and isset($_POST['expediteur']) and !empty($_POST['expediteur']) and isset($_POST['objet']) and !empty($_POST['objet']) 
    and isset($_POST['msg']) and !empty($_POST['msg']))
{

$ref  =  $_POST['ref'];
$titre  =  $_POST['titre'];

$expediteur  =  $_POST['expediteur'];
$objet = $_POST['objet']; 
				$var = array("'");
				$replace   = array("\'");
				$new_obj = str_replace($var, $replace, $objet);
$message = $_POST['msg']; 
				$var = array("'");
				$replace   = array("\'");
				$new_msg = str_replace($var, $replace, $message);
$sql= " insert into root_email_auto Values ('','".safe($titre)."','".safe($expediteur)."','".safe($p_j)."','".safe($new_obj)."','".safe($new_msg)."','".safe($ref)."') "; 
if(mysql_query($sql))
{
array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'>insertion avec succès</li></ul></div>");
$_POST['id']="";$_POST['titre']="";$_POST['expediteur']="";$_POST['objet']="";$_POST['msg']="";$_POST['ref']="";
}
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>erreur lors de l'enregistrement</li></ul></div>");

}

foreach($messages as $message)
echo $message.'<br/>';

}



if(isset($_POST['Modifier']))
{


$messages = array();
if(isset($_POST['ref']) and !empty($_POST['ref']))
$ref  =  $_POST['ref'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli le ref</li></ul></div>");

if(isset($_POST['titre']) and !empty($_POST['titre']))
$titre  =  $_POST['titre'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli le type de candidature </li></ul></div>"); 
if(isset($_POST['expediteur']) and !empty($_POST['expediteur']))
$expediteur  =  $_POST['expediteur'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli l'expéditeur </li></ul></div>");
if(isset($_POST['objet']) and !empty($_POST['objet']))
$objet = $_POST['objet'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli l'Objet</li></ul></div>");
if(isset($_POST['msg']) and !empty($_POST['msg']))
$msg = $_POST['msg'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'>Vous n'avez pas rempli le message</li></ul></div>");




if(isset($_POST['id']) and !empty($_POST['id']) and isset($_POST['ref']) and !empty($_POST['ref']) 
    and isset($_POST['titre']) and !empty($_POST['titre']) and isset($_POST['expediteur']) and !empty($_POST['expediteur']) and isset($_POST['objet']) and !empty($_POST['objet']) and isset($_POST['msg']) and !empty($_POST['msg']))
{
$ref  =  $_POST['ref'];
$id  =  $_POST['id'];
$titre  =  $_POST['titre']; 
$expediteur  =  $_POST['expediteur'];
$objet = $_POST['objet']; 
				$var = array("'");
				$replace   = array("\'");
				$new_obj = str_replace($var, $replace, $objet);
$message = $_POST['msg']; 
				$var = array("'");
				$replace   = array("\'");
				$new_msg = str_replace($var, $replace, $message);
				
				
if($p_j!='') {               
    $sql= " UPDATE root_email_auto SET  titre='".safe($titre)."',email='".safe($expediteur)."',p_joint='".safe($p_j)."',objet='".safe($new_obj)."',message='".safe($new_msg)."',ref='".safe($ref)."' WHERE id_email='".safe($id)."' ";
}else{
		 $sssss="";			if($pj!='') $sssss="p_joint='', " ;
    $sql= " UPDATE root_email_auto SET  titre='".safe($titre)."',email='".safe($expediteur)."',".$sssss." objet='".safe($new_obj)."',message='".safe($new_msg)."',ref='".safe($ref)."' WHERE id_email='".safe($id)."' ";
	}
	
if(mysql_query($sql))
{
array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'>Modification avec succès</li></ul></div>");
$_POST['id']="";$_POST['titre']="";$_POST['expediteur']="";$_POST['objet']="";$_POST['msg']="";$_POST['ref']="";
}
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> erreur lors de l'enregistrement</li></ul></div>");

}

foreach($messages as $message)
echo $message.'<br/>';

}

?>

						  
						<form   method="post" action="" enctype="multipart/form-data" id="form_standard">
						
						<table  width="100%" id="addrole" >
                        <input type="hidden" name="id"  value="<?php if(isset($_POST['id'])){echo $_POST['id'];}?> "  />
                        
                        <tr>
                            <td>
                                <b> Réf :</b> <font style="color:red;">*</font>
                            </td>
                            <td>
                                <input type="text" name="ref"  style="width: 400px;" placeholder="Référence"
                                value="<?php if(isset($_POST['ref'])){echo $_POST['ref'];}?>"  title="Veuillez entrez le référence" required/>
                            </td>
                        </tr>
                        <tr>
                            <td  width="20%">
                                <b> Type d'email :</b> <font style="color:red;">*</font>
                            </td>
                            <td  width="60%"> 
                               <input type="text" name="titre"  value="<?php if(isset($_POST['titre'])){echo $_POST['titre'];}?>"  style="width: 400px;" maxlength="100"  <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> 
                               placeholder="Type d'email" title="Veuillez entrez le type d'email" required/>    
                            </td>
                        </tr> 
                        <tr>
                            <td><br/></td><td><br/></td>
                        </tr>
                        <tr>
                            <td  width="20%">
                                <b> Email expéditeur:</b> <font style="color:red;">*</font>
                            </td>
                            <td  width="60%">  
                                 <input type="text" name="expediteur"  
                                 value="<?php if(isset($_POST['expediteur'])){echo $_POST['expediteur'];} else echo $info_contact; ?>"  style="width: 400px;" maxlength="100"  <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> 
                                 title="Veuillez entrez l'email de l'expediteur" required/> 
                                
                            </td>
                        </tr>
                        <tr>
                            <td><br/></td><td><br/></td>
                        </tr>
                        <tr>
                            <td  width="20%">
                                <b> Objet:</b> <font style="color:red;">*</font>
                            </td>
                            <td  width="60%"> 
                                <input type="text" name="objet"  value="<?php if(isset($_POST['objet'])){echo $_POST['objet'];}?>"  style="width: 400px;" maxlength="100"  <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?> 
                                placeholder="Objet" title="Veuillez entrez l'Objet" required/><br/>
                            </td>
                        </tr>
                        <tr>
                            <td><br/></td><td><br/></td>
                        </tr>
                        <tr>
                            <td  width="20%" valign="top">
                                <b >        Message:</b> <font style="color:red;"></font>
                                
                            </td>
                            <td  width="60%"> 
                                <div>
                                <select id="selectHint" name="users" onchange="showUser(this.value)" style=" width: 250px;<?php if(isset($_POST['ds'])){ echo"background-color: #EBEBE4;"; } ?> " <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?>>
                                    <option value="">Insère une variable dans le message : </option>
                                    <option value="{{nom_candidat}}">Nom candidat</option>
                                    <option value="{{email_candidat}}">Email de candidat</option>
                                    <option value="{{mot_passe}}">Mot de passe</option>
                                    <option value="{{nom_partenaire}}">Nom partenaire</option>
                                    <option value="{{titre_offre}}">Titre de l’offre</option>
                                    <option value="{{lien_offre}}">Lien Offre</option>
                                    <option value="{{date_postulation}}">date postulation</option>
                                    <option value="{{statu_candidature}}">Statu de candidature</option>
                                    <option value="{{date_statu}}">Date statu</option> 
                                    <option value="{{lieu_statu}}">Lieu statu</option>
                                    <option value="{{lien_confirmation}}">Lien de confirmation</option>
                                    <option value="{{message}}">Message</option>
                                </select>
                                </div><br/>
                                <textarea name="msg" id="editor1" style="width: 402px;height: 200px;" <?php if(isset($_POST['ds'])){echo $_POST['ds'];}?>><?php if(isset($_POST['msg'])){
                                                $var = array("\'");
                                                $replace   = array("'");
                                                $new_mss = str_replace($var, $replace, $_POST['msg']);
                                            echo $new_mss;
                                }?> </textarea>
                            <?php if(isset($_POST['ds']) AND  $_POST['ds']=="disabled" ){   
                                    echo "<script type='text/javascript'> 
                                    CKEDITOR.replace( 'editor1',
                                {
                                contentsCss : 'body{background-color:#EBEBE4 ;}'
                                });
                                </script>"; 
                                                                
                                } else { 
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
                                 } ?> 
                            </td>
                        </tr>
                        <tr>
                            <td><br/></td><td><br/></td>
                        </tr>
                        <tr>
                            <td  width="20%">
                            <?php if(!isset($_POST['ds'])){ ?>
                                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                <b>   Transfère un fichier :</b>  
                            <?php  } ?>
                            </td>
                            <td  width="60%"> 
                            <?php if(!isset($_POST['ds'])){ ?>
                                <input type="file" name="monfichier" />
                            <?php  } ?>
                            </td>
                        </tr>
                            <?php if( isset($_POST['id']) and $_POST['id']!='' ){ ?>
                          
                        <tr>
                            <td><br/></td><td><br/></td>
                        </tr>  
                        <tr>
                            <td> <b> Supprimer pièce joint : </b> </td><td><input type="checkbox" name="pj" value="pj"> </td>
                        </tr>
                            <?php  } ?>
                        <tr>
                            <td><br/></td><td><br/></td>
                        </tr>
                        
                        <tr>
                            <td  width="20%">                       
                            </td>
                            <td  width="60%"> 
                            
                                <input type="submit" class="espace_candidat" name="<?php if(isset($_POST['id'])){echo "Modifier";} else { echo $action; } ?>" value="<?php if(isset($_POST['id'])){echo "Modifier";} else { echo $action; } ?>" />
                                
                                <input name="" class="espace_candidat" type="reset" style="width:90px"/>
                                
                                   
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="ligneBleu"></div>
                            </td>
                        </tr>
                        <tr>
                             <td colspan="2">

                            <p style="color:#CC0000"> P.S: les champs marqués par (*) sont obligatoires<br/>
                            

                            </p></td>
                
                        </tr>
                        </table>
</form>
                    </div>

				<?php   include ( "./courriers_auto_m_table.php");  ?>