<?php 
 /* */
 session_start();
 
require(dirname(__FILE__) . "/../../../../config/config.php");

 if (isset($_GET["id"])) {	  $chmm=$_GET["id"];

   $fichier=dirname(__FILE__).$file_probleme2.$chmm;
   $fp = fopen($fichier,"r" ); 
   $buff = ""; 
    if(filesize($fichier) > 0){
	$buff = fread($fp,filesize($fichier));
		}
          header("Content-Type: application/x-octet-stream\n" ); header( "Content-Disposition: attachment;filename=$chmm" );
          header('Pragma: no-cache'); header('Expires: 0');  echo $buff;
          fclose($fp);  } 	

?> 