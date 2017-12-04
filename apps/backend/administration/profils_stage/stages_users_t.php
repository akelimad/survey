<?php
session_start();


if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");   } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
   header("Location: ../../login/"); 
}



require_once dirname(__FILE__) . "/../../../../config/config.php";


 

// couper une chaine 


    
 $_SESSION['link_bak_a']=6;
 $_SESSION['link_bak_b']=67;
 
          
 
  $nom_page_site ="GESTION DES PROFILS DE STAGE"  ;
  
      
$ariane=" Admin > Gestion des profils";	
?>

 