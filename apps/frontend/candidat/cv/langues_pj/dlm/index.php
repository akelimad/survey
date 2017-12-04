<?php 
session_start();
require(dirname(__FILE__)."/../../../../../../config/config.php");
		mysql_connect($serveur,$user,$passwd);
		mysql_select_db($bdd);
if(isset($_GET["cv"]))
{
$id_candidat=$_SESSION["abb_id_candidat"];

$chmm=$_GET["cv"];
$detail_fichier=explode('-',$chmm);
$id_candidat_cv=$detail_fichier['0'];
 		
	$fichier=dirname(__FILE__).$file_lm4.$chmm;
	$fp = fopen($fichier,"r" );
	if(filesize($fichier) > 0)
	{
	$buff = fread($fp,filesize($fichier));
	}
	header("Content-Type: application/x-octet-stream\n" ); 
	header( "Content-Disposition: attachment;filename*=UTF-8'en'$chmm" ); 
	header('Pragma: no-cache'); 
	header('Expires: 0'); 
	echo $buff; 
	fclose($fp);
 
}
?>