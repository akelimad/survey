<?php 







  session_start();

if (!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "") {

    header("Location: ../");

}  



 





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





if(isset($_SESSION["url"]) && $_SESSION["url"] != "")

			{

			if( $_SESSION["url"] == "etuderh.php")

			$url_session = $_SESSION["url"] ;	

				elseif(stristr($_SESSION["url"],"postuler.php?id_offre="))

				{

				$url_session = $_SESSION["url"] ;

				}

				else

				$url_session = "../entrepreneur/".$_SESSION["url"];

				}

			else

				 $url_session = "fiche_profil.php" ;

				

				

				

			$_SESSION['erreur_lettre']="";

			$_SESSION['erreur'] = "" ;

													$_SESSION['erreurcv'] =true;

														$_SESSION['erreurlettre']=true;

function no_special_character_v2($chaine){  



    	$chaine=trim($chaine);



    	$chaine= strtr($chaine,"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ","aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");



    	$chaine = preg_replace('/([^.a-z0-9]+)/i', '-', $chaine);



    	return $chaine;



		}

		

		

//  id autre dans la table ecole

$id_autre = array("290" );































    require_once dirname(__FILE__) . "/../../../../config/config.php";





    if (isset($_GET['action']))

        $action = $_GET['action'];

    else

        $action = "";

    if (isset($_GET['sp']) && $_GET['sp'] == "delete") {

        $select_photo = mysql_query("SELECT photo from candidats where candidats_id = ".safe($_SESSION['abb_id_candidat'])." ");

        $supprimer = mysql_fetch_array($select_photo);

        unlink(dirname(__FILE__) . $file_photos . $supprimer['photo']);

		 mysql_query("UPDATE candidats SET photo='' WHERE candidats_id = ".safe($_SESSION['abb_id_candidat'])." ");

 

    }

    $sql = mysql_query("SELECT * from candidats where candidats_id = ".safe($_SESSION['abb_id_candidat']). "");

    $reponse = mysql_fetch_array($sql);

	 

$nom_page_site = "MON CV " ;



$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> >  Mon CV ";



	

?>