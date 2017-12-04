<?php
    session_start();
    require_once dirname(__FILE__) . "/../../../config/config.php";
	mysql_connect($serveur,$user,$passwd);
	mysql_select_db($bdd);

include_once "fb/facebook.php";
  
$facebook = new Facebook(array(
	'appId'		=> $app_id,
	'secret'	=> $app_secret,
	));
  
$user = $facebook->getUser();
 
$succed=0; 
if($user){ 
	$userInfo        =       $facebook->api("/$user");  
	$_SESSION['fb___email']  = $userInfo['email']; 
	$_SESSION['fb___nom']    = $userInfo['last_name']; 
	$_SESSION['fb___prenom'] = $userInfo['first_name'];  
	$succed=1; 
	
	$request_sql ="SELECT  candidats_id,status,nom,prenom,email  FROM `candidats` WHERE email= '".safe($_SESSION['fb___email'])."' limit 0,1 "; 
	$request = mysql_query($request_sql);
	if($result = mysql_fetch_assoc($request)) {	 
			if($result['status']=="1") {					 					
				$_SESSION['abb_id_candidat']=$result['candidats_id'];					
				$_SESSION['abb_nom'] = $result['nom'].'&nbsp;'.$result['prenom'];					
				$_SESSION['abb_login_candidat']=$result['email'];							
				$last_connexion = date('Y-m-d');					
				$sql3  =   "  UPDATE candidats SET last_connexion='$last_connexion' WHERE candidats_id='".safe($result['candidats_id'])."'  ";					
				mysql_query($sql3);	
					$succed=2;
			}
			else{ 
				$_SESSION['fb_desactive'] = 1;}
	}
	

}

 if($succed==1) { 	
 echo ' <META http-equiv="refresh" content="0;URL='.$urlcandidat.'/inscription/?succed=ok"> ';			      
 }  else { 			
 echo ' <META http-equiv="refresh" content="0;URL='.$urlcandidat.'/compte/?succed=nok"> ';			    }
 




?>