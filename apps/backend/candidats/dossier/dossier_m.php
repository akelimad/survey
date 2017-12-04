                    <div class="texte">

<?php  

 

if(isset($_POST['Ajouter']) and $_POST['Ajouter'])

{



$messagesDossier = array();

if(isset($_POST['nom_dossier']) and !empty($_POST['nom_dossier']))

$nom_dossier  =  $_POST['nom_dossier'];

else

array_push($messagesDossier,"<div class='alert alert-error'>

Vous n'avez pas entré le libelle dossier </div>");







if(isset($_POST['nom_dossier']) and !empty($_POST['nom_dossier']))

{

$nom_dossier  =  $_POST['nom_dossier'];





$sql= " INSERT into dossier (nom_dossier) Values ('". safe($nom_dossier)."'  ) ";

 

if(mysql_query($sql))

array_push($messagesDossier,"<div class='alert alert-success'>  entrée ajouté avec succes</div>");

else

array_push($messagesDossier,"<div class='alert alert-error'> erreur lors de l'enregistrement</div>");



}



foreach($messagesDossier as $message)

echo $message.'<br/>';



}







if(isset($_POST['Modifier']) and $_POST['Modifier'])

{



$messagesDossier = array();

if(isset($_POST['nom_dossier']) and !empty($_POST['nom_dossier']))

$nom_dossier  =  $_POST['nom_dossier'];

else

array_push($messagesDossier,"<div class='alert alert-error'>

 Vous n'avez pas entré le libelle dossier </div>");









if(isset($_POST['nom_dossier']) and !empty($_POST['nom_dossier']) )

{



$id  =  $_POST['id'];

$nom_dossier  =  $_POST['nom_dossier'];



$sql= " UPDATE dossier SET  nom_dossier='".safe($nom_dossier)."'  WHERE id_dossier='".safe($id)."' ";

if(mysql_query($sql))

array_push($messagesDossier,"<div class='alert alert-success'> entrée ajouté avec succes</div>");

else

array_push($messagesDossier,"<div class='alert alert-error'> erreur lors de l'enregistrement</div>");



}





}



?>





                        <br/><h1>GESTION DES DOSSIERS </h1>

                          <div class="subscription" style="margin: 10px 0pt;">

                                 <h1><?php echo $action ?> un dossier </h1>

                          </div>

                        <form   method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

                        <input type="hidden" name="id" value="<?php echo $id; ?>" >

                        <table  width="100%" id="addrole" >

                        <tr>



                            <td  width="20%">

                                <b> Nom dossier:</b><font style="color:red;">*</font> 

                            </td>

                            <td  width="60%"> 

                                <input type="text" name="nom_dossier"  value="<?php echo $nom_dossier; ?>"  style="width: 400px;" maxlength="50" title="veuillez entre le nom de dossier" required/>

                            </td>

                            <td  width="20%">       

                            <input type="submit" class="espace_candidat"

                             name="<?php echo $action ?>" value="<?php echo $action ?>" />

                            </td>

                        </tr>

                        

                        

                        </table>

</form>

<div class="ligneBleu"></div>



                <p style="color:#CC0000"> P.S: les champs marqués par (*) sont obligatoires<br/>



                    </div>



<div class="texte">







                        <!--<h1>LISTES DES COMPTES</h1>-->

                          <div class="subscription" style="margin: 10px 0pt;">

                                 <h1>Gestion des Dossiers </h1>

                          </div>



                        







<?php







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



                                        if (mysql_query("delete from dossier  where id_dossier='$id'")) {



                                         mysql_query("delete from dossier_candidat  where id_dossier='$id'");

										 //  $_SESSION['msg'] = "L'agent ou le responsable de communication est supprimé avec succès";

                                            

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

                                            

                                        }

                                        

                             echo '<script type="text/javascript">window.location="./";</script>';

                             

                                }





                             

                            }

                            

                            









$sql = " select * from dossier ";

$select1 = mysql_query($sql);

$dfs = mysql_num_rows($select1);

$nbItems = $dfs;

if(isset($_POST["t_p_g"]) and $_POST["t_p_g"]!='')  $_SESSION["i_t_p_g"]=$_POST["t_p_g"];

$itemsParPage = (isset($_SESSION["i_t_p_g"]) and $_SESSION["i_t_p_g"]!='') ?  intval ($_SESSION["i_t_p_g"]) : 10 ;





$nbPages = ceil ( $nbItems / $itemsParPage );

if (! isset ( $_GET ['idPage'] ))

$pageCourante = 1;        

elseif (is_numeric ( $_GET ['idPage'] ) && $_GET ['idPage'] <= $nbPages)

$pageCourante = $_GET ['idPage'];

else

$pageCourante = 1;

// Calcul de la clause LIMIT

$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

// 

$sql.=" LIMIT " . $limitstart . "," . $itemsParPage . " "; 



$select = mysql_query($sql);



include("./dossier_m_table.php");

?>





                        </div>

                </div></div>