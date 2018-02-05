

                            <?php

 

         

 /* /////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// */

if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["lcv_motcle"]=$_POST["motcle"];

if(isset($_POST["fonction"]) and $_POST["fonction"]!='')  $_SESSION["lcv_fonction"]=$_POST["fonction"];

if(isset($_POST["secteur"]) and $_POST["secteur"]!='')  $_SESSION["lcv_secteur"]=$_POST["secteur"];

if(isset($_POST["fraicheur"]) and $_POST["fraicheur"]!='')  $_SESSION["lcv_fraicheur"]=$_POST["fraicheur"];

if(isset($_POST["type_formation"]) and $_POST["type_formation"]!='')  $_SESSION["lcv_type_formation"]=$_POST["type_formation"];

if(isset($_POST["exp"]) and $_POST["exp"]!='')  $_SESSION["lcv_exp"]=$_POST["exp"];

if(isset($_POST["etablissement"]) and $_POST["etablissement"]!='')  $_SESSION["lcv_etablissement"]=$_POST["etablissement"];

if(isset($_POST["pays"]) and $_POST["pays"]!='')  $_SESSION["lcv_pays"]=$_POST["pays"];

if(isset($_POST["formation"]) and $_POST["formation"]!='')  $_SESSION["lcv_formation"]=$_POST["formation"];

if(isset($_POST["situation"]) and $_POST["situation"]!='')  $_SESSION["lcv_situation"]=$_POST["situation"];







        if (isset($_POST['actualiser'])) {



            $_POST['envoi'] = "";

								$_SESSION["lcv_envoi"]="";



            $_POST['motcle'] = "";

								$_SESSION["lcv_motcle"]="";



            $_POST['fonction'] = "";

								$_SESSION["lcv_fonction"]="";



            $_POST['pays'] = "";

								$_SESSION["lcv_pays"]="";



            $_POST['exp'] = "";

								$_SESSION["lcv_exp"]="";



            $_POST['secteur'] = "";

								$_SESSION["lcv_secteur"]="";



            $_POST['fraicheur'] = "";

								$_SESSION["lcv_fraicheur"]="";



            $_POST['situation'] = "";

								$_SESSION["lcv_situation"]="";



            $_POST['etablissement'] = "";

								$_SESSION["lcv_etablissement"]="";



            $_POST['type_formation'] = "";

								$_SESSION["lcv_type_formation"]="";



            $_POST['formation'] = "";

								$_SESSION["lcv_formation"]="";

        }



							/*/////////////////////////////// ??? /////////////////////////////////*/

        if (isset($_GET['send'])) {

            $candidats = isset($_GET['select']) ? $_GET['select'] : "";

           $affected = 0;

            if (isset($_GET['select'])) {

                for ($i = 0; $i < count($candidats); $i++) {

                    $id_candidat = $candidats[$i];

                    $selecCV = mysql_query("select * from cv  where candidats_id='$id_candidat'  AND principal=1 AND actif=1");

                    $councv = mysql_num_rows($selecCV);

                    $result_cv = mysql_fetch_array($selecCV);

                    if ($councv)

                        $id_cv = $result_cv['id_cv'];

                    else

                        $id_cv = 0;



                    $selectt = mysql_query("select * from archive_cvs where id_candidat='$id_candidat' ");

                    $count = mysql_num_rows($selectt);

                    if (!$count)

                        $insert = mysql_query("INSERT INTO archive_cvs VALUES ('1','".safe($id_candidat)."','".safe($id_cv)."')");

                    else

                        $insert = mysql_query("UPDATE  archive_cvs SET id_cv = $id_cv  where  id_candidat = '$id_candidat' ");

                    $affected += mysql_affected_rows();

                }

            }

          if ($affected > 0)

                echo '<h3>' . $affected . ' CV archivé(s) avec succès.</h3>';

           else

                echo '<h3>0 CV archivé.</h3>';

        }

							/*////////////////////////////////////////////////////////////////*/

        ?>

            



<div class="texte">



                            <form action="" method="post">



                                <input name="email" id="email" type="hidden" />



                            </form>

                            <br/>

                            <h1>LISTE DES CANDIDATS DU DOSSIER : <b><?php echo strtoupper ( $row["nom_dossier"] ); ?></b></h1>



<div class="subscription" style="margin: 10px 0pt;">



                                <h1>Options de filtrage des CV </h1>     

                                    <div style=" float: right; margin: -16px 10px 0px 0px;">

                                     <a href="../?a=2&b=26" style=" border-bottom: none; ">

                                            <img src="<?php echo $imgurl ?>/arrow_ltr.png" title="Retour"/><strong style="color:#fff">Retour</strong>

                                    </a>

                                    </div>



                            </div>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

                            

<input  type="hidden" name="in_d" style="width:185px" value="<?php if (!empty($in_d)) echo $in_d; ?>"/>

                               <table  width="100%">

                                    <td  width="30%">

                                        <table width="100%" border="0">

                                           <tr>

<td colspan="2" >Rechercher par mot clé<label>

<input  type="text" name="motcle" style="width:185px" value="<?php if (!empty($_SESSION["lcv_motcle"])) echo $_SESSION["lcv_motcle"]; ?>"/>

</label></td>

</tr>

<tr>

<td colspan="2">

<label>Secteur d’activité</label><br />

<select name="secteur" >

<option value="" selected="selected"></option>

            <?php

            $req_theme = mysql_query("SELECT * FROM prm_sectors");

            while ($data = mysql_fetch_array($req_theme)) {

            $Sector_id = $data['id_sect'];

            $Sector = $data['FR'];

                        ?>

<option value="<?php echo $Sector_id; ?>" <?php if (isset($_SESSION["lcv_secteur"]) and $_SESSION["lcv_secteur"] == $Sector_id) echo ' selected="selected"'; ?>>

<?php echo $Sector; ?></option>

<?php

            }

            ?>

</select>

</td>

</tr>

<tr>

<td>

<label>Années d'expérience</label><br />

<select name="exp">

<option value=""></option>

                              <?php

                              $req_exp = mysql_query("SELECT * FROM prm_experience");

                              while ($exp = mysql_fetch_array($req_exp)) {

                              $exp_id = $exp['id_expe'];

                              $exp_desc = $exp['intitule'];

                        ?>

<option value="<?php echo $exp_id; ?>" <?php if (isset($_SESSION["lcv_exp"]) and $_SESSION["lcv_exp"] == $exp_id) echo ' selected="selected"'; ?>>

<?php echo $exp_desc; ?></option>

<?php

                              }

                              ?>  

</select>

</td>

</tr>

</table>

</td>

<td  width="30%">

<table>

<tr>

<td>

<label>Niveau d'étude</label><br />

<select name="formation">

<option value="" selected="selected"></option>

   <?php

    $req_nf = mysql_query( "SELECT * FROM prm_niv_formation");

      while ( $nf = mysql_fetch_array( $req_nf ) ) {

        $nf_id = $nf['id_nfor'];

        $nf_desc = $nf['formation'];

?>

<option value="<?php echo $nf_id; ?>" <?php if (isset($_SESSION["lcv_formation"]) and $_SESSION["lcv_formation"] == $nf_id) echo ' selected="selected"'; ?>>

<?php echo $nf_desc; ?></option>

<?php

      }

  ?> 

</select> 

</td>

</tr>

<tr>

<td><label>Fraicheur du CV</label><br />

<select name="fraicheur" id="fraicheur">

<option value=""></option>

<option value="30" <?php if (isset($_SESSION["lcv_fraicheur"]) and $_SESSION["lcv_fraicheur"] == "30") echo ' selected="selected"'; ?>>1 mois</option>

<option value="90" <?php if (isset($_SESSION["lcv_fraicheur"]) and $_SESSION["lcv_fraicheur"] == "90") echo ' selected="selected"'; ?>>3 mois</option>

<option value="180" <?php if (isset($_SESSION["lcv_fraicheur"]) and $_SESSION["lcv_fraicheur"] == "180") echo ' selected="selected"'; ?>>6 mois</option>

<option value="360" <?php if (isset($_SESSION["lcv_fraicheur"]) and $_SESSION["lcv_fraicheur"] == "360") echo ' selected="selected"'; ?>>12 mois</option>

</select></td>

</tr>

<tr>

<td colspan="3">

<label>Ecole ou établissement</label><br />

<select name="etablissement" >

<option value=""></option>

            <?php 

            $select_ecole = mysql_query("SELECT * FROM prm_ecoles");

            while($ecole = mysql_fetch_array($select_ecole))

            {

                        ?>

<option value="<?php echo $ecole['id_ecole']; ?>" <?php if (isset($_SESSION["lcv_etablissement"]) and $_SESSION["lcv_etablissement"] == $ecole['id_ecole']) echo ' selected="selected"'; ?>>

<?php echo $ecole['nom_ecole']; ?></option>

<?php 

            }      

            ?>  

</select>

</td>

</tr>

</table>

</td>

   <td  width="30%">

 <table>

<tr>

<td>

 <label>Situation actuelle</label><br />

<select name="situation">

<option value=""></option>

            <?php 

            $select_sa = mysql_query("SELECT * FROM prm_situation");

            while($sa = mysql_fetch_array($select_sa))

            {

                                ?>

<option value="<?php echo $sa['id_situ']; ?>" <?php if (isset($_SESSION["lcv_situation"]) and $_SESSION["lcv_situation"] == $sa['id_situ']) echo ' selected="selected"'; ?>>

<?php echo $sa['situation']; ?></option>

<?php   

            }      

            ?>  

</select>           </td>

<td></td>

</tr>

<tr>

<td>

<label>Type de formation</label><br />

<select name="type_formation" >

<option value="" selected="selected"></option>

      <?php 

      $select_tf = mysql_query("SELECT * FROM prm_type_formation");

      while($tf = mysql_fetch_array($select_tf))

      {

                                ?>

<option value="<?php echo $tf['id_tfor']; ?>" <?php if (isset($_SESSION["lcv_type_formation"]) and $_SESSION["lcv_type_formation"] ==$tf['id_tfor']) echo ' selected="selected"'; ?>>

<?php echo $tf['formation']; ?></option>

<?php   

      }      

      ?> 

</select>

</td>

<td>

</td>

</tr>

<tr>

<td>

<label>Pays de résidence</label><br />

<select name="pays">

<option value=""></option>







       <?php

       $req_pays = mysql_query("SELECT * FROM prm_pays");







       while ($pays = mysql_fetch_array($req_pays)) {







 $pays_id = $pays['id_pays'];







 $pays_desc = $pays['pays'];





                                ?>

<option value="<?php echo $pays_id; ?>" <?php if (isset($_SESSION["lcv_pays"]) and $_SESSION["lcv_pays"] ==$pays_id) echo ' selected="selected"'; ?>>

<?php echo $pays_desc; ?></option>

<?php 

       }

       ?>

   </select>           </td>



  </tr>



  </table>

  </td>



  </table>

  <input type="submit" class="espace_candidat" name="envoi" value="Filtrer" /> 

<input type="submit" class="espace_candidat" name="actualiser" OnClick="javascript:window.location.reload()" value="Actualiser">    

</form>









      <?php

       //if (isset($_POST['envoi'])) {

           if (!empty($_SESSION["lcv_motcle"]) || !empty($_SESSION["lcv_fonction"]) || !empty($_SESSION["lcv_fraicheur"]) || !empty($_SESSION["lcv_pays"]) || !empty($_SESSION["lcv_formation"]) || !empty($_SESSION["lcv_type_formation"]) || !empty($_SESSION["lcv_exp"]) || !empty($_SESSION["lcv_secteur"]) || !empty($_SESSION["lcv_situation"]) || !empty($_SESSION["lcv_etablissement"])) {

               $result = "";

               if (!empty($_SESSION["lcv_pays"]))

                   $result .= "candidats.id_pays = '" . $_SESSION["lcv_pays"] . "'";

              if (!empty($_SESSION["lcv_motcle"])) {

                  $lemotcle = '%' . $_SESSION["lcv_motcle"] . '%';

                  if (empty($result))

                       $result .= "lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom, candidats.prenom , CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["lcv_motcle"] . "%')";

                   else

                       $result .= "And lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["lcv_motcle"] . "%')";

               }

    if (!empty($_SESSION["lcv_formation"])) { 

if (empty($result))

        $result .= " candidats.id_nfor = '" . $_SESSION["lcv_formation"] . "' ";

else

 $result .= " And candidats.id_nfor = '" . $_SESSION["lcv_formation"] . "' ";

     }



if (!empty($_SESSION["lcv_fonction"])) {



if (empty($result))

                       $result .= "candidats.id_fonc  = '" . $_SESSION["lcv_fonction"] . "'";

else

                       $result .= "And candidats.id_fonc = '" . $_SESSION["lcv_fonction"] . "'";

               }

if (!empty($_SESSION["lcv_type_formation"])) { 

                   if (empty($result))

                       $result .= "candidats.id_tfor = '" . $_SESSION["lcv_type_formation"] . "'";

                   else

                       $result .= "And candidats.id_tfor = '" . $_SESSION["lcv_type_formation"] . "'";

               }



              if (!empty($_SESSION["lcv_exp"])) {



                   if (empty($result))

                       $result .= "candidats.id_expe = '" . $_SESSION["lcv_exp"] . "'";



                   else

                       $result .= "And candidats.id_expe = '" . $_SESSION["lcv_exp"] . "'";

               }



               if (!empty($_SESSION["lcv_secteur"])) {



                   if (empty($result))

                       $result .= "candidats.id_sect = '" . addslashes($_SESSION["lcv_secteur"]) . "'";

                   else

                       $result .= "And candidats.id_sect = '" . addslashes($_SESSION["lcv_secteur"]) . "'";

               }



              if (!empty($_SESSION["lcv_situation"])) {



                  if (empty($result))

                       $result .= "candidats.id_situ = '" . $_SESSION["lcv_situation"] . "'";



                   else

                       $result .= "And candidats.id_situ = '" . $_SESSION["lcv_situation"] . "'";

               }

               if (!empty($_SESSION["lcv_etablissement"])) {

                  if (empty($result))

  $result .= " formations.id_ecol = '" . $_SESSION["lcv_etablissement"]  . "' ";

                        else

  $result .= " And formations.id_ecol = '" . $_SESSION["lcv_etablissement"]  . "' ";

               }

               if (!empty($_SESSION["lcv_fraicheur"])) {

                   if (empty($result))

                       $result .= "DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["lcv_fraicheur"] . "'";

                   else

                       $result .= "And DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["lcv_fraicheur"] . "'";

               }

			   

			  

			 $selectString= "select COUNT(*) from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id WHERE " . $result . " AND  cv.principal=1 AND cv.actif=1 ".$g_by; 

			$select = mysql_query($selectString) ; 

           }

           else{

		   $selectString="select COUNT(*) from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id WHERE  cv.principal=1 AND cv.actif=1 ".$g_by;

			$select = mysql_query($selectString) ; 

			   }

			/*   

       }

       else{

	   $selectString="select COUNT(*) from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id WHERE  cv.principal=1 AND cv.actif=1 ".$g_by;

	   $select = mysql_query($selectString) ;

		   }

		   //*/

 

//echo '<h1>'.$selectString.'</h1>';

          

       $count = mysql_num_rows($select);

       $nbItems = mysql_fetch_array($select);

      $nbItems = $nbItems[0];

       $itemsParPage = 1000;

$nbPages = $nbItems / $itemsParPage;

if (!isset($_POST['idPage'])) {

           $pageCourante = 1;

       } else {

           if (is_numeric($_POST['idPage']) && $_POST['idPage'] <= $nbPages)

               $pageCourante = $_POST['idPage'];



           else

               $pageCourante = $nbPages;

       }

        //Calcul de la clause LIMIT

        $limitstart = $pageCourante * $itemsParPage - $itemsParPage;

        

        //if (isset($_POST['envoi']) || isset($_SESSION["lcv_envoi"])) {

        $_session['formation'] = '';

        if (!empty($_SESSION["lcv_motcle"]) || !empty($_SESSION["lcv_fonction"]) || !empty($_SESSION["lcv_fraicheur"]) || !empty($_SESSION["lcv_pays"]) || !empty($_SESSION["lcv_formation"]) || !empty($_SESSION["lcv_type_formation"]) || !empty($_SESSION["lcv_exp"]) || !empty($_SESSION["lcv_secteur"]) || !empty($_SESSION["lcv_situation"]) || !empty($_SESSION["lcv_etablissement"])) {

$requete = "";

 if (!empty($_SESSION["lcv_pays"]))

        $requete .= "candidats.id_pays = '" . $_SESSION["lcv_pays"] . "'";

 if (!empty($_SESSION["lcv_motcle"])) {

if (empty($requete))

    $requete .= " lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["lcv_motcle"] . "%') ";

else

    $requete .= " And lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["lcv_motcle"] . "%') ";

               }

    if (!empty($_SESSION["lcv_formation"])) { 

if (empty($requete))

        $requete .= " candidats.id_nfor = '" . $_SESSION["lcv_formation"] . "' ";

else

 $requete .= " And candidats.id_nfor = '" . $_SESSION["lcv_formation"] . "' ";

     }

    if (!empty($_SESSION["lcv_fonction"])) {

if (empty($requete))

    $requete .= " candidats.id_fonc = '" . $_SESSION["lcv_fonction"] . "' ";

else

    $requete .= " And candidats.id_fonc = '" . $_SESSION["lcv_fonction"] . "' ";

        }

if (!empty($_SESSION["lcv_type_formation"])) { 

if (empty($requete))

    $requete .="candidats.id_tfor = '" . $_SESSION["lcv_type_formation"] . "'";

else

       $requete .= "and candidats.id_tfor = '" . $_SESSION["lcv_type_formation"] . "'";

         }

               if (!empty($_SESSION["lcv_exp"])) {



 if (empty($requete))

    $requete .= " candidats.id_expe  = '" . $_SESSION["lcv_exp"] . "' ";

else

    $requete .= " And candidats.id_expe = '" . $_SESSION["lcv_exp"] . "' ";



}

if (!empty($_SESSION["lcv_secteur"])) {

    if (empty($requete))

        $requete .= " candidats.id_sect = '" . addslashes($_SESSION["lcv_secteur"]) . "' ";

    else



$requete .= " And candidats.id_sect = '" . addslashes($_SESSION["lcv_secteur"]) . "' ";

}

if (!empty($_SESSION["lcv_situation"])) {

if (empty($requete))

    $requete .= " candidats.id_situ  = '" . $_SESSION["lcv_situation"] . "' ";

else

    $requete .= " And candidats.id_situ = '" . $_SESSION["lcv_situation"] . "' ";

               }





if (!empty($_SESSION["lcv_etablissement"])) {

if (empty($requete))

  $requete .= " formations.id_ecol = '" . $_SESSION["lcv_etablissement"]  . "' ";

                        else

  $requete .= " And formations.id_ecol = '" . $_SESSION["lcv_etablissement"]  . "' ";

}

if (!empty($_SESSION["lcv_fraicheur"])) {

if (empty($requete))

$requete .= " DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["lcv_fraicheur"] . "' ";

else

$requete .= " And DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["lcv_fraicheur"] . "' ";

}

if (!empty($in_d)) {

        $sql = mysql_query("SELECT * FROM dossier_candidat WHERE id_dossier ='".$in_d."' ");

if (empty($requete))

{                   $result = "( candidats.candidats_id IN (";

                while ($row1 = mysql_fetch_assoc($sql)) {         

                                    $result .= " ".$row1["candidats_id"]." , ";

                }           

                    $result = rtrim($result," , "); 

                    $result .=') )  ';

                    

$requete .= $result ;

}

else

{   $result = " And ( candidats.candidats_id IN (";

                while ($row1 = mysql_fetch_assoc($sql)) {         

                                    $result .= " ".$row1["candidats_id"]." , ";

                }           

                    $result = rtrim($result," , "); 

                    $result .=') )  ';

                    

$requete .= $result ;

}

}

$selectString = "select * from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id WHERE " . $requete . " AND  cv.principal=1 AND cv.actif=1 ".$g_by."  order by dateMAJ desc " ; 

}

else

{

            $sql = mysql_query("SELECT * FROM dossier_candidat WHERE id_dossier ='".$in_d."' ");

            

                

                    $result = "( candidats.candidats_id IN (";

                while ($row1 = mysql_fetch_assoc($sql)) {         

                                    $result .= " ".$row1["candidats_id"]." , ";

                }           

                    $result = rtrim($result," , "); 

                    $result .=') ) AND ';

            

            

             

            $selectString = "select * from   candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id  WHERE  ". $result ."  cv.principal=1 AND cv.actif=1  ".$g_by." order by dateMAJ desc "; // LIMIT " . $limitstart . "," . $itemsParPage . "

//$selectString = "select * from  candidats  INNER JOIN formations ON candidats.candidats_id = formations.candidats_id  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id WHERE   cv.principal=1 AND cv.actif=1  ".$g_by." order by dateMAJ desc " ;//LIMIT " . $limitstart . "," . $itemsParPage . " ";

}

/*

}

else

{ 

        

         

}       

//*/



?>

<div class="subscription" style="margin: 10px 0pt;">

<h1>CV des candidats </h1>

</div>

<?php 



include("./lister_cv_m_table.php"); 



?>                                                                                              

       </div>

       </div>