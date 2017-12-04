<?php
 

session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");	 } 

if(!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == ""){	header("Location:  ../../login/") ; }

	   
require_once dirname(__FILE__) . "/../../../../config/config.php";
        mysql_connect($serveur,$user,$passwd);
        mysql_select_db($bdd);
    
        
        $sql_roles = mysql_query("SELECT * FROM  root_roles where login = '".$_SESSION['abb_admin']."' ");
        $rep_roles = mysql_fetch_assoc($sql_roles);
 

/*//////////////////////////////////////////////////////////////////////////////////////*/		
		  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 
	
		  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;
		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		
 /*//////////////////////////////////////////////////////////////////////////////////////*/
	
 $_SESSION['link_bak_a']=4;
 $_SESSION['link_bak_b']=48;
   $_SESSION['page_courant_n']=$_SERVER['REQUEST_URI'];
   $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
 
     
  $nom_page_site ="HISTORIQUE DES NOTES"  ;
 
   
$ariane=" Candidature > Historique des notes "; 
?>