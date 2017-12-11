<?php



session_start();

if (isset($_POST['reset01'])) {

// header('Location: ./');   
redirect(site_url());

}

 if(isset($_POST['annuler']))



	{



 	// header('Location: ../../compte');   
 	redirect(site_url('compte/'));



	}



if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")



      {	



  		// header("Location: ../") ;
  		redirect(site_url());



	  }

 

require_once dirname(__FILE__) . "/../../../../../config/config.php";



$con=mysql_connect($serveur,$user,$passwd);



mysql_select_db($bdd);

		

				

//  id autre dans la table ecole

$id_autre = array("290" );





		$id_candidat = $_SESSION['abb_id_candidat'];

		

		if (isset($_POST['ok']) AND isset($_POST['id']) AND ($_POST['id']!='') ) {$i_d=$_POST['id'];	$condt = "and  id_formation='$i_d' "; }else	{	$condt =''	;}

		

			$requeteformations = mysql_query("SELECT * from formations where candidats_id ='".safe($id_candidat)."' ". $condt ." order by id_formation asc ");

				$count_formations = mysql_num_rows($requeteformations);   

			

				$formation1 = mysql_fetch_array($requeteformations);

			$exist_formation2=false;

			$exist_formation3=false;

			$exist_formation4=false;

			$exist_formation5=false;

			

		if($count_formations>=2)

		{

		$formation2=mysql_fetch_array($requeteformations);

		$exist_formation2=true;

		}

		if($count_formations>=3)

		{

		$formation3=mysql_fetch_array($requeteformations);

		$exist_formation3=true;

		}

		if($count_formations>=4)

		{

		$formation4=mysql_fetch_array($requeteformations);

		$exist_formation4=true;

		}

		if($count_formations>=5)

		{

		$formation5=mysql_fetch_array($requeteformations);

		$exist_formation5=true;

		}   

										

  

$llcc = $urlcandidat."/cv/"; 



$nom_page_site = "MON CV || FORMATIONS" ;



$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> ><a href='$llcc'> Mon CV </a>> Formation ";

	



?>