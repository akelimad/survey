<?php
session_start();

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {
    header("Location: ../../");
} 
    require_once dirname(__FILE__) . "/../../../../config/config.php";
 
    $sql = mysql_query("select * from offre ");
	
		////////////////////////////////Récupération des données du formulaires///////////////////////////////	

 		$id   			  = isset($_POST['id'])	 ? $_POST['id']      : "";
		
 		$titre   			  = isset($_POST['titre'])	 ? $_POST['titre']      : "";

 		$type_cand 			  = isset($_POST['type_cand'])  ? strip_tags(stripslashes($_POST['type_cand']))   : "";
		

 		$expediteur 			  = isset($_POST['expediteur'])  ? $_POST['expediteur']   : "";

 		$objet 			  = isset($_POST['objet'])    ? $_POST['objet']     : "";

 		$message 		  = isset($_POST['message'])   ? strip_tags(stripslashes($_POST['message']))    : "";
		
        $pj            = isset($_POST['pj'])    ? $_POST['pj']     : "";
		
		 if( (isset($_POST['id']) AND $_POST['id']!="") OR (isset($_POST['action']) and $_POST['action']!="" ) ) {
		 $action ="Modifier";		 } 		 else		 {			$action ="Valider";		 }  

		
 $_SESSION['link_bak_a']=6;
 $_SESSION['link_bak_b']=62;
		
$ariane=" Admin > Courriers automatique";	
    ?>

 