<?php



session_start();



if(isset($_SESSION['compte_v'])) {  header("Location: ../../compte/");  } 

if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {

    header("Location: ../../login/"); 

} 





    require_once dirname(__FILE__) . "/../../../../config/config.php";



	

 /*//////////////////////////////////////////////////////////////////////////////////////*/		 	

		  $q_ref_fili=(isset($_SESSION['query_ref_fili'])) ? $_SESSION['query_ref_fili'] : '' ;

		  $q_ref_fili_and=(isset($_SESSION['query_ref_fili_and'])) ? $_SESSION['query_ref_fili_and'] : '' ;		 

	

		  $q_offre_fili=(isset($_SESSION['query_offre_fili'])) ? $_SESSION['query_offre_fili'] : '' ;

		  $q_offre_fili_and=(isset($_SESSION['query_offre_fili_and'])) ? $_SESSION['query_offre_fili_and'] : '' ;		

 /*//////////////////////////////////////////////////////////////////////////////////////*/

		

		

//*/



 $q_offre_fili = str_replace("ref_filiale", " o.ref_filiale", $q_ref_fili);

 $q_offre_fili_and = str_replace("ref_filiale", " o.ref_filiale", $q_ref_fili_and);						



/*//////////////////////////////////////////////////////////////////////////////////////*/







	

    $sql = mysql_query("select * from offre o ".$q_ref_fili."  ");

    

    

 $_SESSION['link_bak_a']=3;

 $_SESSION['link_bak_b']=34;

 

 

$val_requet=''; $val_status=''; 



if(isset($_POST["c"]) and $_POST["c"]!=''){  $_SESSION["i_val_requet"]=$_POST["c"];}



if((isset($_POST['dd']) and $_POST['dd']!='') ) { $_SESSION["i_dd"]=$_POST['dd'] ;}



if((isset($_POST['df']) and $_POST['df']!='') ) { $_SESSION["i_df"]=$_POST['df'] ;}



if((isset($_POST['co']) and $_POST['co']!='') ) { $_SESSION["i_co"]=$_POST['co'] ;}



           

          if(isset($_POST['actualiser']))



{



$_POST['c']="";



$_POST['dd']="";



$_POST['df']="";



$_POST['co']="";



$_SESSION["i_val_requet"]="";



$_SESSION["i_val_status"]="";



 $val_requet=''; $val_status='';

 

 $_SESSION["i_dd"]="";

 $_SESSION["i_df"]="";

 $_SESSION["i_co"]="";

 

 

}

  $_SESSION['page_courant ']=$_SERVER['REQUEST_URI'];

 

 

  $nom_page_site = "REQUETEUR" ;

 

		  



$ariane=" Reporting > Requêteur ";  

?>