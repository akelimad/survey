<?php



session_start();



 if(isset($_POST['annuler']))



	{



 	// header('Location: ../../compte/');   
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





		$id_candidat = $_SESSION['abb_id_candidat'];

		

		if (isset($_POST['ok']) AND isset($_POST['id']) AND ($_POST['id']!='') ) {$i_d=$_POST['id'];	$condt = "and  id_exp='$i_d' "; }else	{	$condt =''	;}

		

		$requeteexperiences = mysql_query("SELECT * from experience_pro where candidats_id ='".safe($id_candidat)."' ". $condt ." order by id_exp asc ");

        $count_experiences = mysql_num_rows($requeteexperiences);		

		

        $experience1 = mysql_fetch_array($requeteexperiences);

		$exist_exp2=false;

		$exist_exp3=false;

		$exist_exp4=false;

		$exist_exp5=false;

		$exist_exp6=false;

		$exist_exp7=false;

		$exist_exp8=false;

		$exist_exp9=false;

		$exist_exp10=false;

			if($count_experiences>=2)

			{

			$experience2=mysql_fetch_array($requeteexperiences);

			$exist_exp2=true;

			}

			if($count_experiences>=3)

			{



			$experience3=mysql_fetch_array($requeteexperiences);

			$exist_exp3=true;

			}	

			if($count_experiences>=4)

			{



			$experience4=mysql_fetch_array($requeteexperiences);

			$exist_exp4=true;

			}	

			if($count_experiences>=5)

			{



			$experience5=mysql_fetch_array($requeteexperiences);

			$exist_exp5=true;

			}	

			if($count_experiences>=6)

			{



			$experience6=mysql_fetch_array($requeteexperiences);

			$exist_exp6=true;

			}	

			if($count_experiences>=7)

			{



			$experience7=mysql_fetch_array($requeteexperiences);

			$exist_exp7=true;

			}	

			if($count_experiences>=8)

			{



			$experience8=mysql_fetch_array($requeteexperiences);

			$exist_exp8=true;

			}	

			if($count_experiences>=9)

			{



			$experience9=mysql_fetch_array($requeteexperiences);

			$exist_exp9=true;

			}	

			if($count_experiences>=10)

			{



			$experience10=mysql_fetch_array($requeteexperiences);

			$exist_exp10=true;

			}		

							

							

$llcc = $urlcandidat."/cv/"; 



$nom_page_site = "MON CV || EXPERIENCES" ;



$ariane=" <a href='$site'> Accueil </a> ><a href='$urlcandidat'> Candidat </a> ><a href='$llcc'> Mon CV </a>> Expérience ";

						



?>