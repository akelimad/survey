<?php
 
session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../../compte/");  } 
if(!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "")
      {	
  		header("Location:  ../../../login/") ;
	  } 
	  
    require_once dirname(__FILE__) . "/../../../../../config/config.php";

	
	
	
 /*//////////////////////////////////////////////////////////////////////////////////////*/		 	
		  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 
	
		  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;
		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		
 /*//////////////////////////////////////////////////////////////////////////////////////*/
		
		
//*/

 $q_offre_fili = str_replace("ref_filiale", " o.ref_filiale", $q_ref_fili);
 $q_offre_fili_and = str_replace("ref_filiale", " o.ref_filiale", $q_ref_fili_and);						

/*//////////////////////////////////////////////////////////////////////////////////////*/


		       $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];
			   
			   
 $_SESSION['link_bak_a']=3;
 $_SESSION['link_bak_b']=34;

 
 
  $nom_page_site = "REQUETEUR" ;
 
		  
 $ariane=" Reporting > <a href='../'>Requêteur</a> > Rapport entretien" ;
 
 ?>