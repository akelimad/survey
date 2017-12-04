<?php   
 
 session_start();

/* 
if (isset($_SESSION["abb_login_candidat"]) && $_SESSION["abb_login_candidat"] != "") {

				header("Location:".$site1."index.php ");

} 

//*/

 
// Turn off magic_quotes_runtime 
if (get_magic_quotes_runtime()) 
    set_magic_quotes_runtime(0); 

// Strip slashes from GET/POST/COOKIE (if magic_quotes_gpc is enabled) 
if (get_magic_quotes_gpc()){ 
		function stripslashes_array($array)    { 
			return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array); 
		} 
    $_GET = stripslashes_array($_GET); 
    $_POST = stripslashes_array($_POST); 
    $_COOKIE = stripslashes_array($_COOKIE); 
}
 
	if(isset($_POST['non'])) 	{   header("Location: ../") ; 	}


	require_once dirname(__FILE__) . "/../../../../config/config.php";

    mysql_connect($serveur,$user,$passwd);

    mysql_select_db($bdd);

	if(isset($_SESSION['url']))

	{$url=$_SESSION['url'];}

	

		$send_conditions = isset($_POST['send_conditions']) ? $_POST['send_conditions'] : "false";

		$nom_page_site = "INSCRIVEZ-VOUS" ;
		
$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> > Inscrivez-vous ";
    
	?>
	
  
 