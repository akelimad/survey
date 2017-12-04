<?php 
 
  

 
    require_once dirname(__FILE__) . "/../../../../config/fo_conn.php";
 

$messages=array(); 
		
  
if (isset($_GET['cpcha']) and $_GET['cpcha']==0 ){
  array_push($messages, "<ul><li style='color:#FF0000'>Le CAPTCHA est invalide</li></ul>");
  }



 
    $nom_page_site = "CONTACTEZ NOUS " ;
	
    $ariane=" <a href='$site'> Accueil </a> > Contactez nous";

?>