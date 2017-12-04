<?php
    
session_start();
if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../../login/"); 
}  


    require_once dirname(__FILE__) . "/../../../../config/config.php";
 
    $sql = mysql_query("select * from dossier ");
    
        ////////////////////////////////Récupération des données du formulaires///////////////////////////////  

        $id                   = (isset($_GET['id']))                                ?   $_GET['id']                     :    "";

        $nom_dossier          = (isset($_GET['nom_dossier']))                       ?   $_GET['nom_dossier']            :    "";
        
        $action               = (isset($_GET['action']) and $_GET['action']!="" )   ?    "Modifier"                     :    "Ajouter";


 $_SESSION['link_bak_a']=2;
 $_SESSION['link_bak_b']=26;            
 
  $nom_page_site ="CANDIDATS || DOSSIER"  ;
  
     $ariane="Candidats > Dossier  ";       
     
?>