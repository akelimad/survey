<?php 

session_start(); 

if (!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "") {



header("Location: ../");



} 



else {  

  require_once dirname(__FILE__) . "/../../../../config/config.php";



  

  if(isset($_SESSION['secteur']))

  {

	$display_secteur = '';

	$sect = '';

	if(isset($_SESSION['secteur']))

		$secteur = $_SESSION['secteur']	;

	for ($i=0; $i<count($secteur); $i++)

	{

		$select_secteur = mysql_query("SELECT id_sect,FR FROM prm_sectors WHERE id_sect = '".safe($secteur[$i])."'");

		$sec = mysql_fetch_array($select_secteur);

		if(!empty($sec['FR']))

		{

			$sect .= $sec['id_sect'].' - ';	

			$display_secteur .= $sec['FR'].' , ';

		}

	}

	$display_secteur = rtrim($display_secteur,' , ');

	$sect = rtrim($sect,' - ');

	echo $display_secteur;

	

	$_POST['secteur']= $sect;

  }

  if(isset($_SESSION['localisation']))

  {



	$display_local = '';

	$local_array = '';

	if(isset($_SESSION['localisation']))

		$localisation = $_SESSION['localisation'];

	for ($i=0; $i<count($localisation); $i++)

	{

		$select_local = mysql_query("SELECT id_localisation,localisation from prm_localisation where id_localisation = '".safe($localisation[$i])."'");

		$local = mysql_fetch_array($select_local);

		if(!empty($local['localisation']))

		{

			$local_array .= $local['id_localisation'].' - ';

			$display_local .= $local['localisation'].' , ';

		}

	}

	$display_local = rtrim($display_local,' , ');

	$local_array = rtrim($local_array,' - ');

	echo $display_local;

	

	$_POST['localisation']= $local_array;

  }

  if(isset($_SESSION['exp']))

  {

	$display_exp = '';

	$exp_array = '';

	if(isset($_SESSION['exp']))

		$exp = $_SESSION['exp'];

	for ($i=0; $i<count($exp); $i++)

	{

		$select_exp = mysql_query("SELECT id_expe,intitule from prm_experience where id_expe = '".safe($exp[$i])."'");

		$experience = mysql_fetch_array($select_exp);

		if(!empty($experience['intitule']))

		{

			$exp_array .=  $experience['id_expe'].' - ';

			$display_exp .=  $experience['intitule'].' , ';

		}	

	}

	$display_exp = rtrim($display_exp,' , ');

	$exp_array = rtrim($exp_array,' - ');

	echo $display_exp;

	

	$_POST['exp']= $exp_array;

 

  }

  if(isset($_SESSION['poste']))

  {



	$display_poste = '';

	$post_array = ''; 

	if(isset($_SESSION['poste']))

		$poste = $_SESSION['poste'];

	for ($i=0; $i<count($poste); $i++)

	{

		$select_post = mysql_query("SELECT id_tpost,designation from prm_type_poste where id_tpost = '".safe($poste[$i])."'");

		$postarray = mysql_fetch_array($select_post);

		 if(!empty($postarray['designation']))

		 {

		 	$post_array .=  $postarray['id_tpost'].' - ';

			$display_poste .=  $postarray['designation'].' , ';

		 }

	}

	$display_poste = rtrim($display_poste,' , ');

	$post_array = rtrim($post_array,' - ');

	echo $display_poste;

    $_POST['poste']= $post_array;

  }

  if(isset($_SESSION['motcle']))

  {



	$display_mots = '';

	if(isset($_SESSION['motcle']))

		$mots = explode(" ",$_SESSION['motcle']);

	for ($i=0; $i<count($mots); $i++)

	{

		$display_mots .= $mots[$i].' , ';

	}

	$display_mots = rtrim($display_mots,' , ');

	echo $display_mots;

	$_POST['motcle']= $display_mots;

  }

  $requete = isset($_GET['requete']) ? $_GET['requete'] : "";

  

  ?>

  <?php

 if(isset($_GET['titre']))

  {

  	$secteur 		= isset($_POST['secteur']) 		 ? $_POST['secteur'] 	 	: "" ; 

	$localisation	= isset($_POST['localisation'])  ? $_POST['localisation'] 	: "" ;

	$exp 			= isset($_POST['exp']) 			 ? $_POST['exp'] 		 	: "" ;

	$poste 			= isset($_POST['poste']) 		 ? $_POST['poste'] 		 	: "" ;

	$motcle 		= isset($_POST['motcle']) 		 ? $_POST['motcle'] 		: "" ;

	$id_candidat	= isset($_SESSION['abb_id_candidat'])? $_SESSION['abb_id_candidat']	: "" ;

	$titre 			= isset($_GET['titre'])		     ? $_GET['titre']			: "" ;			

	$requete 		= isset($_GET['requete']) 		 ? $_GET['requete'] 		: "" ;

	$date = date("d/m/Y");

	mysql_query("INSERT INTO alert VALUES ('','".safe($id_candidat)."','".safe($date)."','".safe($titre)."','".safe($secteur)."',
        '".safe($localisation)."','".safe($exp)."','".safe($poste)."','".safe($motcle)."','".safe($requete)."','true')");

	$insert = mysql_affected_rows();

    if($insert > 0)

	{

	echo '<span style="color:green;" >Votre alerte est enregistr&eacute;e avec succ&egrave;s.</span>';
	echo '<meta http-equiv="refresh" content="0;URL='.$site.'candidat/compte/">';	

	}

	else

	echo '<span style="color:red;" >une erreur est survenue lors de l\'enregistrement de cette alerte</span>';

  }

  else

  echo '<span style="color:red;" >une erreur est survenue lors de l\'enregistrement de cette alerte</span>';





  

  }

?>