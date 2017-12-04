 <div class="texte" style="width:720px">



                         <br/><h1>COURRIERS TYPE</h1>    
                          <div class="subscription" style="margin: 10px 0pt;">
                                 <h1>Ajouter un courrier type </h1>
                          </div>



<?php        

if(isset($_POST['Modifier']) OR isset($_POST['Valider'])){

//////////////////////////////////////////////////////

$messages = array();
$p_j="";
$nomOrigine = $_FILES['monfichier']['name'];
$elementsChemin = pathinfo($nomOrigine);
$extensionFichier = (isset($elementsChemin['extension'])) ? $elementsChemin['extension'] : '';
$extensionsAutorisees = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
array_push($messages,"<span class='erreur'>Le fichier n'a pas l'extension attendue </span>");
} else {    
    // Copie dans le repertoire du script avec un nom
    // incluant l'heure a la seconde pres 
    $repertoireDestination = dirname(__FILE__) .$file_courrier2;
//  echo $repertoireDestination;
    $nomDestination = rand()."fich".date("His").".".$extensionFichier;
    $p_j=$nomDestination;
    if (copy($_FILES["monfichier"]["tmp_name"], 
                                     $repertoireDestination.$nomDestination)) {
                                     
       //         " a été déplacé vers ".$repertoireDestination.$nomDestination;
    } else {
    
    array_push($messages,"<span class='erreur'>Le fichier n'a pas été uploadé (trop gros ?) ou Le déplacement du fichier temporaire a échoué vérifiez l'existence du répertoire ".$repertoireDestination."</span>");
    }
}

////////////////////////
}

if(isset($_POST['Valider']))
{

$messages = array();
if(isset($_POST['type_cand']) and !empty($_POST['type_cand']))
$type_cand  =  $_POST['type_cand'];
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




if(isset($_POST['type_cand']) and !empty($_POST['type_cand']) and isset($_POST['expediteur']) and !empty($_POST['expediteur']) and isset($_POST['expediteur']) and !empty($_POST['expediteur']) and isset($_POST['objet']) and !empty($_POST['objet']) and isset($_POST['msg']) and !empty($_POST['msg']))
{
$type_cand  =  $_POST['type_cand'];

$expediteur  =  $_POST['expediteur'];
$objet = $_POST['objet']; 
                $var = array("'");
                $replace   = array("\'");
                $new_obj = str_replace($var, $replace, $objet);
$message = $_POST['msg']; 
                $var = array("'");
                $replace   = array("\'");
                $new_msg = str_replace($var, $replace, $message);
$sql= ' INSERT into email_type Values 
("","'.safe($type_cand).'","'.safe($expediteur).'",
  "'.safe($p_j).'","'.safe($new_obj).'","'.safe($new_msg).'") '; 
if(mysql_query($sql))
{
array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'>le message est ajoutée avec succès</li></ul></div>");
$_POST['id']="";$_POST['type_cand']="";$_POST['expediteur']="";$_POST['objet']="";$_POST['msg']="";
}
else
array_push($messages,"<div class='alert alert-error'><ul> <li style='color:#FF0000'>erreur lors de l'enregistrement</li></ul></div>");

}

foreach($messages as $message)
echo ''.$message.'  ';

      

}



if(isset($_POST['Modifier']))
{


$messages = array();
if(isset($_POST['type_cand']) and !empty($_POST['type_cand']))
$type_cand  =  $_POST['type_cand'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> Vous n'avez pas rempli le type de candidature </li></ul></div>"); 
if(isset($_POST['expediteur']) and !empty($_POST['expediteur']))
$expediteur  =  $_POST['expediteur'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> Vous n'avez pas rempli l'expéditeur </li></ul></div>");
if(isset($_POST['objet']) and !empty($_POST['objet']))
$objet = $_POST['objet'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> Vous n'avez pas rempli l'Objet</li></ul></div>");
if(isset($_POST['msg']) and !empty($_POST['msg']))
$msg = $_POST['msg'];
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> Vous n'avez pas rempli le message</li></ul></div>");




if(isset($_POST['id']) and !empty($_POST['id']) and isset($_POST['type_cand']) and !empty($_POST['type_cand']) and isset($_POST['expediteur']) and !empty($_POST['expediteur']) and isset($_POST['objet']) and !empty($_POST['objet']) and isset($_POST['msg']) and !empty($_POST['msg']))
{

$id  =  $_POST['id'];
$type_cand  =  $_POST['type_cand']; 
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
    $sql= " UPDATE email_type SET  titre='".safe($type_cand)."',email='".safe($expediteur)."',p_joint='".safe($p_j)."',objet='".safe($new_obj)."',message='".safe($new_msg)."'    WHERE id_email='".safe($id)."'";
}else{
		 $sssss="";			if($pj!='') $sssss="p_joint='', " ;
    $sql= ' UPDATE email_type SET  titre="'. safe($type_cand).'",
    email="'.safe($expediteur).'",'.$sssss.' objet="'. safe($new_obj).'",
    message="'.safe($new_msg).'" WHERE id_email="'.safe($id).'" ';
	}
    
if(mysql_query($sql))
{
array_push($messages,"<div class='alert alert-success'><ul><li style='color:#468847'>le message est modifié avec succès</li></ul></div>");
$_POST['id']="";$_POST['type_cand']="";$_POST['expediteur']="";$_POST['objet']="";$_POST['msg']="";
}
else
array_push($messages,"<div class='alert alert-error'><ul><li style='color:#FF0000'> erreur lors de l'enregistrement</li></ul></div>");

}

foreach($messages as $message)
echo ''.$message.'  <br/>';
}

?>

                          
<form   method="post" action="./" enctype="multipart/form-data">
 <?php include ("./courriers_type_m_form.php"); ?>                       
                        
</form>
                    </div>

<div class="texte" style="width:720px">
<div class="subscription" style="margin: 10px 0pt;">
    <h1>Gestion des courriers type </h1>
</div>

                        



<?php




if (isset($_SESSION['msg']) and !empty($_SESSION['msg'])) {

   echo "<span class='success'>" . $_SESSION['msg'] . "</span>";

    unset($_SESSION['msg']);
}



if (isset($_SESSION['erreur']) and !empty($_SESSION['erreur'])) {



    echo "<span>Des Erreurs ont survenus</span>";

    foreach ($_SESSION['erreur'] as $er) {

        echo "<span class='erreur'>" . $er . "</span>";
    }

    echo "<br>";



    unset($_SESSION['erreur']);
}
                            

                            if (isset($_GET['id']) && !empty($_GET['id'])) {

                              $id = $_GET['id'];

                              if ($_GET['action'] == "delete") {

                                        if (mysql_query("delete from email_type  where id_email='$id'")) {
 
                                            
                                        } else {

                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";
                                            
                                        }
                                         
                             
                                }


                             
                            }
                            
                            

 
?>
 <?php include ("./courriers_type_m_table.php"); ?>   

                        </div>

                </div></div>