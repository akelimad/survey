                    <div class="texte">

<?php  

 

if(isset($_POST['Ajouter']) and $_POST['Ajouter'])

{



$messagesDossier = array();

if(isset($_POST['titre_compagne']) and !empty($_POST['titre_compagne']))

$titre_compagne  =  $_POST['titre_compagne'];

else

array_push($messagesDossier,"<span class='erreur'> Vous n'avez pas entré le libelle dossier </span>");







if(isset($_POST['titre_compagne']) and !empty($_POST['titre_compagne']))

{



$titre_compagne  =  $_POST['titre_compagne'];

$filiale  =   $_SESSION['ref_filiale_role'];

$sql= " insert into campagne_recrutement Values ('','". safe($titre_compagne)."' ,'". safe($filiale)."'  ) ";

 

if(mysql_query($sql))

array_push($messagesDossier,"<span class='success'> entrée ajouté avec succes</span>");

else

array_push($messagesDossier,"<span class='erreur'> erreur lors de l'enregistrement</span>");



}



foreach($messagesDossier as $message)

echo $message.'<br/>';



}







if(isset($_POST['Modifier']) and $_POST['Modifier'])

{



$messagesDossier = array();

if(isset($_POST['titre_compagne']) and !empty($_POST['titre_compagne']))

$titre_compagne  =  $_POST['titre_compagne'];

else

array_push($messagesDossier,"<span class='erreur'> Vous n'avez pas entré le libelle dossier </span>");









if(isset($_POST['titre_compagne']) and !empty($_POST['titre_compagne']) )

{



$id  =  $_POST['id'];

$titre_compagne  =  $_POST['titre_compagne'];



$sql= " UPDATE campagne_recrutement SET  titre_compagne='".safe($titre_compagne)."'  WHERE id_compagne='".safe($id)."' ";

if(mysql_query($sql))

array_push($messagesDossier,"<span class='success'> entrée ajouté avec succes</span>");

else

array_push($messagesDossier,"<span class='erreur'> erreur lors de l'enregistrement</span>");



}





}



?>





                        <br/><h1>GESTION DES CAMPAGNES DE RECRUTEMENT</h1>

                          

                          <div class="subscription" style="margin: 10px 0pt;">

                                 <h1><?php echo $action; ?> un campagne de recrutement </h1>

                          </div>

                        

                        <form   method="post" action="./">

                        <input type="hidden" name="id" value="<?php echo $id; ?>" >

                        <table  width="100%" id="addrole" >

                        <tr>



                            <td  width="20%">

                                <b> Nom de campagne :</b><font style="color:red;">*</font> 

                            </td>

                            <td  width="60%"> 

                                <input type="text" name="titre_compagne"  value="<?php  if(  isset($_GET['action']) AND $_GET['action']=="modifier" ) echo $titre_compagne; ?>"  style="width: 400px;" maxlength="50" title="veuillez entrez le nom de compagne" required/>

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

                                 <h1>Gestion des campagnes recrutement </h1>

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



                                        if (mysql_query("delete from campagne_recrutement  where id_compagne='$id'")) {



                                          mysql_query("delete from campagne_offres  where id_compagne='$id'");

										  //  $_SESSION['msg'] = "L'agent ou le responsable de communication est supprimé avec succès";

                                            

                                        } else {



                                            $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";

                                            

                                        }

                                        

                             echo '<script type="text/javascript">window.location="./";</script>';

                             

                                }





                             

                            }



$sql1 = " select * from campagne_recrutement ".$q_ref_fili." " ;

$select1 = mysql_query($sql1);

$nbrs = mysql_num_rows($select1);

$nbItems = $nbrs;

$itemsParPage = 5;

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

                            









$sql = " select * from campagne_recrutement ".$q_ref_fili." LIMIT " . $limitstart . ", " . $itemsParPage ."" ;

$select = mysql_query($sql);



include("./campagne_recrutement_m_table.php");

?>





                        </div>

                </div></div>