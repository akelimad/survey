<?php 


// Turn off magic_quotes_runtime
if (get_magic_quotes_runtime())
    set_magic_quotes_runtime(0);

// Strip slashes from GET/POST/COOKIE (if magic_quotes_gpc is enabled)
if (get_magic_quotes_gpc())
{
    function stripslashes_array($array)
    {
        return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
    }

    $_GET = stripslashes_array($_GET);
    $_POST = stripslashes_array($_POST);
    $_COOKIE = stripslashes_array($_COOKIE);
}

session_start();


if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");	 } 

	require_once dirname(__FILE__) . "/../../../../config/config.php";
 
		require(  dirname(__FILE__) .$incurl2.'/mime_type_lib.php' );
		
		

			$id_offre = isset($_POST['offre'])  ? $_POST['offre'] : $_POST['id_offre'] ;
			$id_candidat = isset($_POST['id_candidature'])  ? $_POST['id_candidature'] : $_POST['id_candidat'];
			
			

	

 $_SESSION['link_bak_a']=4;
 //$_SESSION['link_bak_b']=43;
  

			$menu_type = isset($_POST['menu_type'])  ? $_POST['menu_type'] : $_POST['menu_type'] ;
			if(!empty($menu_type)){
				 $_SESSION['link_bak_a']=1;
				 $_SESSION['link_bak_b']=13; 
			}
			
     
  $nom_page_site ="CANDIDATURES"  ;
 
    
$ariane=" Candidatures > Candidatures ";	
 		
?> 
