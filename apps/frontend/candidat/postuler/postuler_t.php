<?php 

        

 

 

    require_once dirname(__FILE__) . "/../../../../config/fo_conn.php";



	

    

    



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



	//ajouté le  11 juillet par badr

	require_once dirname(__FILE__) . "/../../../../config/config.php";

		mysql_connect($serveur,$user,$passwd);

		mysql_select_db($bdd);

		require(  dirname(__FILE__) .$incurl2.'/mime_type_lib.php' );

$idoffre = $_GET['id_offre'];

$select_offres = mysql_query("SELECT * from offre where id_offre = '".safe($idoffre)."'");

$offres = mysql_fetch_array($select_offres);

$ofs = $offres['Name'];



$nom_page_site = strtoupper($ofs) ;



$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> >  Répondre à l'offre  : $ofs ";

		

?> 