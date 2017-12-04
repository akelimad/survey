<?php
    
session_start();


if(isset($_SESSION['compte_v'])) {  header("Location: ../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../login/"); 
}   

    require_once dirname(__FILE__) . "/../../../config/config.php";
 
    $sql = mysql_query("select * from offre ");
    

/*//////////////////////////////////////////////////////////////////////////////////////*/		
		  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;
		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 
	
		  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;
		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		
 /*//////////////////////////////////////////////////////////////////////////////////////*/
	

 $q_offre_fili = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili);
 $q_offre_fili_and = str_replace("offre.id_offre", " candidature.id_offre", $q_offre_fili_and);						

 
 $tbl____o=$o____c="";$where____and= " where ";
			 
   if( empty($_SESSION['compte_v'])) {
	  
			 $offre_candidatures = $q_offre_fili = $q_offre_fili_and ="";
			 
		if(!empty($q_ref_fili)){	 $tbl____o=" , offre "; $where____and=" and ";$o____c=" candidature.id_offre=offre.id_offre"; }
			 
			  $q_offre_fili =  $q_ref_fili ;
			  $q_offre_fili_and = $q_ref_fili_and ;
			 
	  }  
	
	
 $_SESSION['link_bak_a']=4;
 $_SESSION['link_bak_b']=46;
 
     
  $nom_page_site ="ETAT DES CANDIDATURES "  ;
 
   
     $ariane="Candidatures > Etat des candidatures  "; 
?>