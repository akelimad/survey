<?php
 

session_start();

if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")

      {	

  		header("Location: ../") ;

	  }

  if(isset($_POST['annuler']))

    {

    header('Location: ../compte/');   

    }




require_once dirname(__FILE__) . "/../../../../config/config.php";

$con=mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);

$nom_page_site = "SUPPRIMER MON COMPTE" ;

$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> >  Supprimer mon compte ";

?>
 