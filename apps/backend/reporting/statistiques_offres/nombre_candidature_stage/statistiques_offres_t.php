<?phpsession_start();if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {    header("Location: ../../login/"); } 			   function isLeapYear($year)                {                    return (cal_days_in_month(CAL_GREGORIAN, 2, $year) === 29) ? true : false;                }			   function compareDate($y1,$m1,$d1,$y2,$m2,$d2)			   {			     if($m1<10)				   $m1='0'.$m1;				   				 if($d1<10)				   $d1='0'.$d1;				 				 if($m2<10)				   $m2='0'.$m2;				   				 if($d2<10)				   $d2='0'.$d2;				   			     $date1 = $y1.$m1.$d1;				 $date2 = $y2.$m2.$d2;				 				 			     if($date2<$date1){				  return 1;				  }				 else{				       if($date1==$date2){						 return 0;						 }					  else					    return 2;				     }			   }			           require_once dirname(__FILE__) . "/../../../../../config/config.php";		mysql_connect($serveur,$user,$passwd);		mysql_select_db($bdd); 				/*//////////////////////////////////////////////////////////////////////////////////////*/				  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 			  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		 /*//////////////////////////////////////////////////////////////////////////////////////*/		 $_SESSION['page_courant_r']=$_SERVER['REQUEST_URI'];    $_SESSION['link_bak_a']=3; $_SESSION['link_bak_b']=31;  $c= isset($_GET['c'])? $_GET['c'] : "310"; $co= isset($_GET['co'])? $_GET['co'] : "1";           $nom_page_site = "STATISTIQUES OFFRES" ;		  $ariane=" Reporting > Statistiques offres";		 ?> 