<?php 
session_start();
	require(dirname(__FILE__).'/../../../config/config.php');
		mysql_connect($serveur,$user,$passwd);
		mysql_select_db($bdd);
if(isset($_GET["id"]))
{

$chmm=$_GET["id"];


$fichier=dirname(__FILE__).$file_courrier.$chmm;
$fp = fopen($fichier,"r" );
if(filesize($fichier) > 0){
	$buff = fread($fp,filesize($fichier));
	

	}
else
	$buff = ""; 


header("Content-Type: application/x-octet-stream\n" ); 
header( "Content-Disposition: attachment;filename=$chmm" ); 
header('Pragma: no-cache'); 
header('Expires: 0'); 

echo $buff;
fclose($fp); 

}
?>