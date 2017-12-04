<?php
    
session_start();
 
if(!isset($_SESSION['compte_v'])|| $_SESSION["compte_v"] == "") {  header("Location: ../../compte/");	 }     


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

$offre_candidatures = (isset($_SESSION['offre_candidatures_0'])) ? $_SESSION['offre_candidatures_0'] : '' ;		
 /*//////////////////////////////////////////////////////////////////////////////////////*/

 $_SESSION['link_bak_a']=4;
 $_SESSION['link_bak_b']=46; 
    
  $nom_page_site ="ETAT DES CANDIDATURES"  ;
 
   
     $ariane="Candidatures > Etat des candidatures  "; 
?>