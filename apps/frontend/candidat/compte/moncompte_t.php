<?php 

//traiteiement session               
session_start();

if (!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "") {
header("Location: ../");
} 
  
  
require_once dirname(__FILE__) . "/../../../../config/config.php";

   

 if (isset($_POST['id_candidature_spo'])) {

$id_candidature = $_POST['id_candidature_spo'];        mysql_query("DELETE FROM candidature_spontanee where id_candidature = '$id_candidature'");    }

 if (isset($_POST['id_candidature'])) {

$id_candidature = $_POST['id_candidature'];        mysql_query("DELETE FROM candidature where id_candidature = '$id_candidature'");    }   
 
$nom_page_site = "MON COMPTE" ;

$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> >  Mon compte ";

?> 