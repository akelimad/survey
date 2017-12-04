<?php

session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../index_.php");	 } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../index.php");
} 

require_once dirname(__FILE__) . "/../../../../config/config.php";



 


	
 

 $_SESSION['link_bak_a']=6;
 $_SESSION['link_bak_b']=61;
 
 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
       
 
  $nom_page_site ="GESTION DES PERMISSIONS"  ;
  
      

$ariane=" Admin > Gestion des permissions";	
?>

 