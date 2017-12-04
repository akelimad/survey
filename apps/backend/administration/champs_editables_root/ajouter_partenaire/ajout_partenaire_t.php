<?php

session_start();







if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

  header("Location: ../../login/"); 

}







require_once dirname(__FILE__) . "/../../../../../config/config.php";













		////////////////////////////////R?up?ation des donn?s du formulaires///////////////////////////////	



 		$id   			  = isset($_GET['id'])	 ? $_GET['id']      : "";



 		$nom_r 			  = isset($_GET['nom_r'])  ? strip_tags(stripslashes($_GET['nom_r']))   : "";



 		$tel_r 			  = isset($_GET['tel_r'])  ? strip_tags(stripslashes($_GET['tel_r']))   : "";



 		$nom 			  = isset($_GET['nom'])  ? $_GET['nom']   : "";

		

 		$type_partenaire  = isset($_GET['type_partenaire']) ? $_GET['type_partenaire']  : ""; 	



 		$email 			  = isset($_GET['email'])    ? $_GET['email']     : "";



 		$message 		  = isset($_GET['message'])   ? strip_tags(stripslashes($_GET['message']))    : "";

		

 		$action 		  = (isset($_GET['action']) and $_GET['action']!="" )  ?  "Modifier"    :  "Valider";



		

 $_SESSION['link_bak_a']=6;

 $_SESSION['link_bak_b']=64;		



$ariane=" Admin > Champs ?itables > Gestion des partenaires ";	

?>



 