<?php

session_start();



 if(isset($_POST['annuler']))



	{



 	header('Location: ../../compte/');   



	}



if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")



      {	


        retirect(site_url());
  		// header("Location: ../") ;



	  }



 

require_once dirname(__FILE__) . "/../../../../../config/config.php";



$con=mysql_connect($serveur,$user,$passwd);



mysql_select_db($bdd);



 

	$test = mysql_query("SELECT * from candidats where candidats_id = '".safe($_SESSION['abb_id_candidat'])."' ");

	$count = mysql_num_rows($test);

	$retour = mysql_fetch_array($test);

$id_autre = array("290" );







    if (isset($_GET['action']))

        $action = $_GET['action'];

    else

        $action = "";

    if (isset($_GET['sp']) && $_GET['sp'] == "delete") {

        $select_photo = mysql_query("SELECT photo from candidats where candidats_id = ".safe($_SESSION['abb_id_candidat'])." ");

        $supprimer = mysql_fetch_array($select_photo);

        $fichier = SITE_BASE .'/apps/upload/frontend/photo_candidats/'.$supprimer['photo'];
        unlinkFile($fichier);

         mysql_query("UPDATE candidats SET photo='' WHERE candidats_id = ".safe($_SESSION['abb_id_candidat'])." ");

    }

    $sql = mysql_query("SELECT * from candidats where candidats_id = ".safe($_SESSION['abb_id_candidat'] )." ");

    $reponse = mysql_fetch_array($sql);



	

	$page = $_SERVER['REQUEST_URI'];



$show ='<meta http-equiv="refresh" content="0;URL='.$page.'">'; 





$llcc = $urlcandidat."/cv/";



$nom_page_site = "MON CV || LANGUES ET PIECES JOINTS" ;



$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> ><a href='$llcc'> Mon CV </a>> Langues et piéces joints ";

  



?>