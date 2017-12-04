<?php

session_start();
  ob_start();
    require_once dirname(__FILE__) .  "/../../../config/config.php";

	mysql_connect($serveur,$user,$passwd);

	mysql_select_db($bdd);

	$compte_desactive = false;

	

	



	

			  if (isset($_POST['fermer']))

		 {

		        session_destroy ( );



    session_start();

		 }

	

	

	

//	$_SESSION['fb_id'] = 65775;

		if(!empty($_SESSION['fb_id']))

	{

		 if (isset($_POST['oui_fb']))

		 {

		 $displayerror = false;    

		$login_candidat = 	$_SESSION['login_candidat_desactive'] ;



		$nom = $_SESSION['nom_desactive'];

		$id_candidat=$_SESSION['id_candidat_desactive'];

		$last_connexion = date('Y-m-d');		



		mysql_query("UPDATE candidats SET last_connexion = '".$last_connexion."' , status=1 
			WHERE candidats_id =".$_SESSION['fb_id']." ");		

		$requet = mysql_query("SELECT * from candidats WHERE candidats_id =".$id_candidat." "); 

		$reponse = mysql_fetch_array($requet);	 

		$prenom = ucfirst($reponse['prenom']);

		$nom = strtoupper($reponse['nom']); 







		//echo "<script> alert('".$_SESSION['abb_login_candidat']."'); </script>";

			//echo "<script> alert('".$_SESSION['abb_nom']."'); </script>";

				//echo "<script> alert('".$_SESSION['abb_id_candidat']."'); </script>";

				

       session_destroy ( );



    session_start();

		

	$_SESSION['abb_login_candidat'] = $login_candidat ;

		$_SESSION['abb_nom'] = $prenom.'&nbsp;'.$nom;

	

		$_SESSION['abb_id_candidat'] =$id_candidat;



				header("Location: ".$urlcandidat."/compte/") ;	

	

			

			   

	



			}	

				



		  if (isset($_POST['non_fb']))

		 {

		 		$login_candidat = 	$_SESSION['login_candidat_desactive'] ;

		$nom = $_SESSION['nom_desactive'];

		$id_candidat=$_SESSION['id_candidat_desactive'];

		 unset($_SESSION['login_candidat_desactive']) ;



unset($_SESSION['nom_desactive']);

unset($_SESSION['id_candidat_desactive']); 



unset($_SESSION['fb_id']);



  session_destroy ( );

	   

		session_start();



		

		 		header("Location: ./inscription") ;

		 }



	}

	

	

	

	 if (isset($_POST['oui']) || isset($_POST['non'])) // Si les variables existent

	{

		 if (isset($_POST['oui']))

		 {

		 //echo "<script> alert('hhh'); </script>";

		 $displayerror = false;    

		$_SESSION['abb_login_candidat'] = 	$_SESSION['login_candidat_desactive'] ;



		$_SESSION['abb_nom'] = $_SESSION['nom_desactive'];

		$_SESSION['abb_id_candidat'] =$_SESSION['id_candidat_desactive'];

		$last_connexion = date('Y-m-d');

		mysql_query("UPDATE candidats SET last_connexion = '".$last_connexion."' , status=1 
			WHERE candidats_id = '".$_SESSION['abb_id_candidat']."' ");

			if(isset($_SESSION["url"]) && $_SESSION["url"] != "")
			{
				if( $_SESSION["url"] == "etuderh.php"){
				header("Location: ".$_SESSION["url"]) ;	
				}else{
				header("Location: ../entrepreneur/".$_SESSION["url"]) ;	
				}
			}
			else{
				header("Location: ".$urlcandidat."/compte/") ;
			}
				

				

		 }

		  if (isset($_POST['non']))

		 {

		 		header("Location: ./inscription/") ;

		 }

unset($_SESSION['login_candidat_desactive']) ;



unset($_SESSION['nom_desactive']);

unset($_SESSION['id_candidat_desactive']); 

	}

	
	
if(isset($_SESSION["abb_login_candidat"]) AND $_SESSION["abb_login_candidat"] != "") 
{	
	header("Location: ".$urlcandidat."/compte/"); 
}




	  
 	  

    if (isset($_POST['login']) && isset($_POST['pass'])) // Si les variables existent

	{

    $login = $_POST['login'];
    /*
    $login = htmlspecialchars($_POST['login']);

    $login =addslashes($login);
	*/

    $pass = $_POST['pass'];
/*
    $pass = htmlspecialchars($_POST['pass']);

    $pass=addslashes($pass);
*/
    $pass = md5($pass);

  	

	$requet = mysql_query("select * from candidats WHERE  email = '".safe($login)."' AND mdp = '".safe($pass)."' AND status=1"); 

	$reponse = mysql_fetch_array($requet);	 

  		if(is_array($reponse))

  		{ 

  		$displayerror = false;    

		$_SESSION['abb_login_candidat'] = $login ;

		$prenom = ucfirst($reponse['prenom']);

		$nom = strtoupper($reponse['nom']); 

		$_SESSION['abb_nom'] = $prenom.'&nbsp;'.$nom;

		$_SESSION['abb_id_candidat'] = $reponse['candidats_id'];

		$last_connexion = date('Y-m-d');

		mysql_query("UPDATE candidats SET last_connexion = '".$last_connexion."' 
			WHERE candidats_id = '".$reponse['candidats_id']."'");
		

			if(isset($_SESSION["url"]) && $_SESSION["url"] != "")

			{

			if( $_SESSION["url"] == "etuderh.php")

				header("Location: ".$_SESSION["url"]) ;	

				elseif(strpos($_SESSION["url"],'/postuler/')!=false)

				header("Location: ".$_SESSION["url"]) ;	

				else

				header("Location: ../entrepreneur/".$_SESSION["url"]) ;	

				}
			else
				if($_SESSION['c_sp']!=''){header("Location: ".$urloffre."/candidature_spontannee/") ;}
			else
				if($_SESSION['c_st']!=''){header("Location: ".$urloffre."/candidature_stage/") ;}
			else
				header("Location: ".$urlcandidat."/compte/") ;
  		}

  		else

  		{

			$requet = mysql_query("select * from candidats WHERE  email = '".safe($login)."' AND mdp = '".safe($pass)."' AND status=0"); 

	$reponse = mysql_fetch_array($requet);	 

  		if(is_array($reponse))

		{

			$prenom = ucfirst($reponse['prenom']);

		$nom = strtoupper($reponse['nom']); 

		$_SESSION['login_candidat_desactive'] = $login ;

		$_SESSION['nom_desactive'] = $prenom.'&nbsp;'.$nom;

		$_SESSION['id_candidat_desactive'] = $reponse['candidats_id'];

		$compte_desactive = true;

		}

   			$displayerror = true;

  		}

	}

	else // Les variables n'existent pas encore

	{



	if(!empty($_SESSION['fb_id']))

	{



		$requet = mysql_query("select * from candidats WHERE  candidats_id= ".$_SESSION['fb_id']." AND status=0"); 

	$reponse = mysql_fetch_array($requet);	



  		if(is_array($reponse))

		{



		$_SESSION['login_candidat_desactive'] = $_SESSION['fb_login'] ;

		$_SESSION['nom_desactive'] = $_SESSION['fb_nom'];

		$_SESSION['id_candidat_desactive'] =$_SESSION['fb_id'];

		$compte_desactive_fb = true;

		}

   			$displayerror = true;





	

	}

    	$login = "";

    	$pass = "";

	}


$nom_page_site = "ESPACE CANDIDAT" ;

$ariane="Accueil > Candidat";	

ob_end_flush();



	

	
?>