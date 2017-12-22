<?php

    

session_start();

if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/"); 

}  





    require_once dirname(__FILE__) . "/../../../../config/config.php";

 

    $sql = mysql_query("select * from campagne_recrutement ");

    

        ////////////////////////////////Récupération des données du formulaires///////////////////////////////  



        $id                   = (isset($_GET['id']))                                ?   $_GET['id']                     :    "";



        $titre_compagne          = (isset($_GET['titre_compagne']))                       ?   $_GET['titre_compagne']            :    "";

        

        $action               = (isset($_GET['action']) and $_GET['action']!="" )   ?    "Modifier"                     :    "Ajouter";





////////////////////

      $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;

      $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;    



      $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;

      $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ; 

///////////////////////////







 $_SESSION['page_courant__c']=$_SERVER['REQUEST_URI'];

 



 $_SESSION['link_bak_a']=1;

 $_SESSION['link_bak_b']=16;            

 



  $nom_page_site = "OFFRES || CAMPAGNE DES RECRUTEMENT " ;

  

     $ariane="Offres  > Campagne de recrutement  ";       

     

?>