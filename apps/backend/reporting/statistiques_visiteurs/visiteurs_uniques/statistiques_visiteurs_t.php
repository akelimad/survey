<?php

session_start();
if(isset($_SESSION['compte_v'])) {  header("Location: ../../../compte/");  } 
if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../../../login/"); 
} 
  

	  
        require_once dirname(__FILE__) . "/../../../../../config/config.php";     
  
		
 $_SESSION['link_bak_a']=3;
 $_SESSION['link_bak_b']=33;
  
  $nom_page_site = "STATISTIQUES VISITEURS" ;

          $ariane=" Reporting > Statistiques visiteurs";
         
?>