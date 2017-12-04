<?php

session_start();

 if(isset($_POST['annuler']))

	{

 	header('Location: ../../compte/');   

	}

if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")

      {	

  		header("Location: ../") ;

	  }
 
require_once dirname(__FILE__) . "/../../../../../config/config.php";

$con=mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);

    $sql = mysql_query("SELECT * from candidats where candidats_id = ".safe($_SESSION['abb_id_candidat'])." ");
    $reponse = mysql_fetch_array($sql);

$llcc = $urlcandidat."/cv/"; 

$nom_page_site = "MON CV || INFORMATIONS PERSONNELLES" ;

$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> ><a href='$llcc'> Mon CV </a>> Informations personnalles ";
	


?>