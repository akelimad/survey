<div class="texte">



            <form action="contact.php" method="post">



<input name="email" id="email" type="hidden" />



            </form>

            <br/>

            <h1>TRAITEMENT DES CANDIDATURES POUR STAGE</h1>



            <?php

			

        

 /////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 

if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["cs_motcle"]=$_POST["motcle"];

if(isset($_POST["secteur"]) and $_POST["secteur"]!='')  $_SESSION["cs_secteur"]=$_POST["secteur"];

if(isset($_POST["fraicheur"]) and $_POST["fraicheur"]!='')  $_SESSION["cs_fraicheur"]=$_POST["fraicheur"];

if(isset($_POST["type_formation"]) and $_POST["type_formation"]!='')  $_SESSION["cs_type_formation"]=$_POST["type_formation"];

if(isset($_POST["exp"]) and $_POST["exp"]!='')  $_SESSION["cs_exp"]=$_POST["exp"];

if(isset($_POST["etablissement"]) and $_POST["etablissement"]!='')  $_SESSION["cs_etablissement"]=$_POST["etablissement"];

if(isset($_POST["pays"]) and $_POST["pays"]!='')  $_SESSION["cs_pays"]=$_POST["pays"];

if(isset($_POST["formation"]) and $_POST["formation"]!='')  $_SESSION["cs_formation"]=$_POST["formation"];

if(isset($_POST["situation"]) and $_POST["situation"]!='')  $_SESSION["cs_situation"]=$_POST["situation"];

if(isset($_POST["typestage"]) and $_POST["typestage"]!='')  $_SESSION["cs_typestage"]=$_POST["typestage"];

if(isset($_POST["duree_stage"]) and $_POST["duree_stage"]!='')  $_SESSION["cs_duree_stage"]=$_POST["duree_stage"];

      

	  

	       

          

          if(isset($_POST['Actualiser']))	{



				$_POST['motcle']="";

				$_SESSION["cs_motcle"]=""; 



				$_POST['fonction']="";

				$_SESSION["cs_fonction"]=""; 



				$_POST['pays']="";

				$_SESSION["cs_pays"]=""; 



				$_POST['exp']="";

				$_SESSION["cs_exp"]=""; 



				$_POST['secteur']="";

				$_SESSION["cs_secteur"]=""; 



				$_POST['fraicheur']="";

				$_SESSION["cs_fraicheur"]=""; 



				$_POST['situation']="";

				$_SESSION["cs_situation"]=""; 



				$_POST['etablissement']="";

				$_SESSION["cs_etablissement"]=""; 



				$_POST['type_formation']="";

				$_SESSION["cs_type_formation"]=""; 



				$_POST['formation']="";

				$_SESSION["cs_formation"]=""; 



				$_POST['typestage']="";

				$_SESSION["cs_typestage"]="";  



				$_POST['duree_stage']=""; 

				$_SESSION["cs_duree_stage"]="";  

 

				}







       



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

            $insert = mysql_query("INSERT INTO archive_cvs VALUES ('$id_entreprise','$id_candidat','$id_cv')");



        else

            $insert = mysql_query("UPDATE  archive_cvs SET id_cv = $id_cv  where    id_candidat = '$id_candidat' ");



        $affected += mysql_affected_rows();

    }

}







if ($affected > 0)

    echo '<h3>' . $affected . ' CV archivé(s) avec succès.</h3>';







else

    echo '<h3>0 CV archivé.</h3>';

            }

            ?>



           



























            <div class="subscription" style="margin: 10px 0pt;">



<h1>Options de filtrage DES CANDIDATURES POUR STAGE </h1>



            </div>

<?php

include("./traitement_candidature_stage_m_filtre.php");



//if (isset($_POST['envoi'])) {



if (!empty($_SESSION["cs_duree_stage"]) ||!empty($_SESSION["cs_typestage"]) ||!empty($_SESSION["cs_motcle"]) || !empty($_SESSION["cs_fonction"]) 

    || !empty($_SESSION["cs_fraicheur"]) || !empty($_SESSION["cs_pays"]) || !empty($_SESSION["cs_formation"]) ||

     !empty($_SESSION["cs_type_formation"]) || !empty($_SESSION["cs_exp"]) || !empty($_SESSION["cs_secteur"]) ||

      !empty($_SESSION["cs_situation"]) || !empty($_SESSION["cs_etablissement"])) {







$result = "";







if (!empty($_SESSION["cs_pays"]))

    $result .= "candidats.id_pays = '" . $_SESSION["cs_pays"] . "'";



if (!empty($_SESSION["cs_duree_stage"]))

{  

    if (empty($result))

    $result .= "candidature_stage.duree = '" . $_SESSION["cs_duree_stage"] . "'";

else

     $result .= " and candidature_stage.duree = '" . $_SESSION["cs_duree_stage"] . "'";



} 





if (!empty($_SESSION["cs_typestage"]))

{  

    if (empty($result))

    $result .= "candidature_stage.type = '" . $_SESSION["cs_typestage"] . "'";

else

     $result .= " and candidature_stage.type = '" . $_SESSION["cs_typestage"] . "'";



}      



if (!empty($_SESSION["cs_motcle"])) {







    $lemotcle = '%' . $_SESSION["cs_motcle"] . '%';







    if (empty($result))

        $result .= "lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description,candidats.email,

         candidats.nom,candidature_stage.objet,candidature_stage.motivations,

         candidature_stage.entite,candidature_stage.ecole, candidats.prenom ,

          CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["cs_motcle"] . "%')";







    else

        $result .= "And lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email,candidature_stage.objet,candidature_stage.motivations,candidature_stage.entite,candidature_stage.ecole, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["cs_motcle"] . "%')";

}







if (!empty($_SESSION["cs_formation"])) {





    if (empty($result))

        $result .= "candidats.id_nfor = '" . $_SESSION["cs_formation"] . "'";







    else

        $result .= "And candidats.id_nfor  = '" . $_SESSION["cs_formation"] . "'";

}















if (!empty($_SESSION["cs_fonction"])) {







    if (empty($result))

        $result .= "candidats.id_fonc = '" . $_SESSION["cs_fonction"] . "'";







    else

        $result .= "And candidats.id_fonc = '" . $_SESSION["cs_fonction"] . "'";

}







if (!empty($_SESSION["cs_type_formation"])) {



    if (empty($result))

        $result .= "candidats.id_tfor = '" .$_SESSION["cs_type_formation"]. "'";







    else

        $result .= "And candidats.id_tfor = '" . $_SESSION["cs_type_formation"] . "'";

}







if (!empty($_SESSION["cs_exp"])) {







    if (empty($result))

        $result .= "candidats.id_expe = '" . $_SESSION["cs_exp"] . "'";







    else

        $result .= "And candidats.id_expe  = '" . $_SESSION["cs_exp"] . "'";

}







if (!empty($_SESSION["cs_secteur"])) {







    if (empty($result))

        $result .= "candidats.id_sect = '" . addslashes($_SESSION["cs_secteur"]) . "'";







    else

        $result .= "And candidats.id_sect = '" . addslashes($_SESSION["cs_secteur"]) . "'";

}







if (!empty($_SESSION["cs_situation"])) {







    if (empty($result))

        $result .= "candidats.id_situ = '" . $_SESSION["cs_situation"] . "'";







    else

        $result .= "And candidats.id_situ = '" . $_SESSION["cs_situation"] . "'";

}







                    if (!empty($_SESSION["cs_etablissement"])) {







                        if (empty($result))

  $result .= " formations.id_ecol = ' ".$_SESSION["cs_etablissement"]." ' " ;







                        else

  $result .= "And formations.id_ecol = '".$_SESSION["cs_etablissement"]." '";

                    }









if (!empty($_SESSION["cs_fraicheur"])) {







    if (empty($result))

        $result .= "DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["cs_fraicheur"] . "'";







    else

        $result .= "And DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["cs_fraicheur"] . "'";

}

 



$select = mysql_query("select COUNT(*) from   candidats  

    INNER JOIN cv ON cv.candidats_id = candidats.candidats_id inner join candidature_stage 

    on candidature_stage.candidats_id = candidats.candidats_id  

     INNER JOIN formations ON candidats.candidats_id = formations.candidats_id WHERE " . $result . "   cv.principal=1 AND cv.actif=1 ".$_SESSION['list_c_0'].$g_by);

}







else

$select = mysql_query("select COUNT(*) from   candidats  

    INNER JOIN cv ON cv.candidats_id = candidats.candidats_id inner join candidature_stage 

    on candidature_stage.candidats_id = candidats.candidats_id  

     INNER JOIN formations ON candidats.candidats_id = formations.candidats_id WHERE  cv.principal=1 AND cv.actif=1 ".$_SESSION['list_c_0'].$g_by);

           

/*

		   }







            else

$select = mysql_query("select COUNT(*) from  candidats   

    INNER JOIN cv ON cv.candidats_id = candidats.candidats_id inner join candidature_stage on candidature_stage.candidats_id = candidats.candidats_id  

     INNER JOIN formations ON candidats.candidats_id = formations.candidats_id WHERE  cv.principal=1 AND cv.actif=1 ".$_SESSION['list_c_0'].$g_by);

//*/

 



            $nbItems = isset($nbItems[0]) ? $nbItems[0] : 0;







            $itemsParPage = 10000;





 



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

            ?>







            <?php

 //           if (isset($_POST['envoi'])) {







$_session['formation'] = '';















if (!empty($_SESSION["cs_duree_stage"]) || !empty($_SESSION["cs_typestage"]) ||

    !empty($_SESSION["cs_motcle"]) || !empty($_SESSION["cs_fonction"]) ||

     !empty($_SESSION["cs_fraicheur"]) || !empty($_SESSION["cs_pays"]) ||

      !empty($_SESSION["cs_formation"]) || !empty($_SESSION["cs_type_formation"]) ||

       !empty($_SESSION["cs_exp"]) || !empty($_SESSION["cs_secteur"]) ||

        !empty($_SESSION["cs_situation"]) || !empty($_SESSION["cs_etablissement"])) {







$requete = "";







if (!empty($_SESSION["cs_pays"]))

    $requete .= " candidats.id_pays = '" . $_SESSION["cs_pays"] . "' ";









 if (!empty($_SESSION["cs_duree_stage"]))

{  

    if (empty($requete))

    $requete .= " candidature_stage.duree = '" . $_SESSION["cs_duree_stage"] . "' ";

else

     $requete .= " and candidature_stage.duree = '" . $_SESSION["cs_duree_stage"] . "' ";



} 





if (!empty($_SESSION["cs_typestage"]))

{  

    if (empty($requete))

    $requete .= " candidature_stage.type = '" . $_SESSION["cs_typestage"] . "' ";

else

     $requete .= " and candidature_stage.type = '" . $_SESSION["cs_typestage"] . "' ";



}           



if (!empty($_SESSION["cs_motcle"])) {







    if (empty($requete))

        $requete .= " lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email,candidature_stage.objet,candidature_stage.motivations,candidature_stage.entite,candidature_stage.ecole, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["cs_motcle"] . "%') ";







    else

        $requete .= " And lower(concat_ws(' ',titre, formations.id_ecol,formations.diplome,formations.description, candidats.nom,candidats.email,candidature_stage.objet,candidature_stage.motivations,candidature_stage.entite,candidature_stage.ecole, candidats.prenom, CONCAT(candidats.prenom, ' ', candidats.nom))) like lower('%" . $_SESSION["cs_motcle"] . "%') ";

}







if (!empty($_SESSION["cs_formation"])) { 



    if (empty($requete))

        $requete .= " candidats.id_nfor = '" . $_SESSION["cs_formation"] . "' ";







    else

        $requete .= " And candidats.id_nfor = '" . $_SESSION["cs_formation"] . "' ";

}





 



if (!empty($_SESSION["cs_fonction"])) {







    if (empty($requete))

        $requete .= " candidats.id_fonc = '" . $_SESSION["cs_fonction"] . "' ";







    else

        $requete .= " And candidats.id_fonc = '" . $_SESSION["cs_fonction"] . "' ";

}







if (!empty($_SESSION["cs_type_formation"])) { 



    if (empty($requete))

        $requete .= " candidats.id_tfor = '" . $_SESSION["cs_type_formation"]. "' ";







    else

        $requete .= " And candidats.id_tfor = '" . $_SESSION["cs_type_formation"] . "' ";

}







if (!empty($_SESSION["cs_exp"])) {







    if (empty($requete))

        $requete .= " candidats.id_expe = '" . $_SESSION["cs_exp"] . "' ";







    else

        $requete .= " And candidats.id_expe = '" . $_SESSION["cs_exp"] . "' ";

}







if (!empty($_SESSION["cs_secteur"])) {







    if (empty($requete))

        $requete .= " candidats.id_sect = '" . addslashes($_SESSION["cs_secteur"]) . "' ";







    else

        $requete .= " And candidats.id_sect = '" . addslashes($_SESSION["cs_secteur"]) . "' ";

}







if (!empty($_SESSION["cs_situation"])) {







    if (empty($requete))

        $requete .= " candidats.id_situ = '" . $_SESSION["cs_situation"] . "' ";







    else

        $requete .= " And candidats.id_situ = '" . $_SESSION["cs_situation"] . "' ";

}





                    if (!empty($_SESSION["cs_etablissement"])) {



                        if (empty($requete))

  $requete .= " formations.id_ecol = '" . $_SESSION["cs_etablissement"]  . "' ";







                        else

  $requete .= " And formations.id_ecol = '" . $_SESSION["cs_etablissement"]  . "' ";

                    }







if (!empty($_SESSION["cs_fraicheur"])) {







    if (empty($requete))

        $requete .= " DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["cs_fraicheur"] . "' ";







    else

        $requete .= " And DATEDIFF(curdate(),dateMAJ)<'" . $_SESSION["cs_fraicheur"] . "' ";

}









      





$selectString = "select  cv.*,candidats.* ,candidature_stage.ecole,candidature_stage.duree,candidature_stage.type,candidature_stage.objet,candidature_stage.motivations from  candidats   INNER  JOIN cv ON cv.candidats_id = candidats.candidats_id inner join candidature_stage on candidature_stage.candidats_id = candidats.candidats_id 

 INNER JOIN formations ON candidats.candidats_id = formations.candidats_id WHERE " . $requete . " AND  cv.principal=1 AND cv.actif=1   ".$_SESSION['list_c_0'].$g_by." order by dateMAJ desc ";

}







else

$selectString = "select  cv.*,candidats.* ,candidature_stage.ecole,candidature_stage.duree,candidature_stage.type,candidature_stage.objet,candidature_stage.motivations  from   candidats  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id inner join candidature_stage on candidature_stage.candidats_id = candidats.candidats_id 

 INNER JOIN formations ON candidats.candidats_id = formations.candidats_id WHERE   cv.principal=1 AND cv.actif=1   ".$_SESSION['list_c_0'].$g_by." order by dateMAJ desc  ";

     

/*

	 }







            else

$selectString = "select  cv.*,candidats.* ,candidature_stage.ecole,candidature_stage.duree,candidature_stage.type,candidature_stage.objet,candidature_stage.motivations  from candidats  INNER JOIN cv ON cv.candidats_id = candidats.candidats_id inner join candidature_stage on candidature_stage.candidats_id = candidats.candidats_id  

 INNER JOIN formations ON candidats.candidats_id = formations.candidats_id WHERE   cv.principal=1 AND cv.actif=1   ".$_SESSION['list_c_0'].$g_by." order by dateMAJ desc  ";



 //*/







// echo $selectString;LIMIT " . $limitstart . "," . $itemsParPage . "LIMIT " . $limitstart . "," . $itemsParPage . "LIMIT " . $limitstart . "," . $itemsParPage . "









            $select = mysql_query($selectString);

//echo $selectString;





            $count = mysql_num_rows($select);

            ?>























            <div class="subscription" style="margin: 10px 0pt;">







<h1>CV des candidats  </h1>







            </div>



            



<?php include("./traitement_candidature_stage_m_table.php");?>



    









            