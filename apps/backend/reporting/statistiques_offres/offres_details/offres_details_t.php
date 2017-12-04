<?php

session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 
if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../../login/"); 
}  


    require_once dirname(__FILE__) . "/../../../../../config/config.php";

    $sql = mysql_query("select * from offre ");
    
    
/*//////////////////////////////////////////////////////////////////////////////////////*/        
          $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
          $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;      
    
          $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;
          $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;       
 /*//////////////////////////////////////////////////////////////////////////////////////*/       
    
 $_SESSION['link_bak_a']=3;
 $_SESSION['link_bak_b']=31;
           
          if(isset($_GET['actualiser']))

{

$_GET['c']="";

$_GET['dd']="";

$_GET['df']="";

$_GET['co']="";


}
  $_SESSION['page_courant_r']=$_SERVER['REQUEST_URI']; 
 
  $nom_page_site = "STATISTIQUES OFFRES" ;
  
$ariane=" Reporting > offres > statistiques ";  
?>