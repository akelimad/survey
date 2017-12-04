<?php


session_start();

 if(isset($_POST['annuler']))

	{

 	header('Location: ../compte/');   

	}

if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")

      {	

  		header("Location: ../");

	  }

 


require_once dirname(__FILE__) . "/../../../../config/config.php";

$con=mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);

$nom_page_site = "METTRE EN VEILLE MON COMPTE" ;

$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> >  Mettre en veille mon compte ";


?>