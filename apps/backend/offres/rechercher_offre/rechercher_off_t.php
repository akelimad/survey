<?php

session_start();
if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 
if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../../login/"); 
} 
	  
	  
  
require_once dirname(__FILE__) . "/../../../../config/config.php";
        mysql_connect($serveur,$user,$passwd);
        mysql_select_db($bdd);
        
        
        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");
        $rep_roles = mysql_fetch_assoc($sql_roles);
 



/*//////////////////////////////////////////////////////////////////////////////////////*/		
          $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
          $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;      
		  	
 /*//////////////////////////////////////////////////////////////////////////////////////*/
	
 

 $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
 

 $_SESSION['link_bak_a']=1;
 $_SESSION['link_bak_b']=14;
  
 
  $nom_page_site = "OFFRES || RECHERCHE DES OFFRES " ;
 
		  
 $ariane=" Offres > Recherche des offres ";  
?>