<?php 
 /* */
 session_start();
 
require(dirname(__FILE__) . "/../../../../../config/config.php");


if(isset($_GET["id_candidat"]) and $_GET["id_candidat"]!=''){
$s_sql="UPDATE candidats SET vues=vues+1 WHERE candidats_id='".$_GET["id_candidat"]."'";
$upd=mysql_query($s_sql);

if(isset($_GET["cvtheq"]) and $_GET["cvtheq"]!=''){
$s_sql="INSERT INTO `his_cvtheq_rol`( `id_role`, `id_candidat`   ) VALUES ('". $_SESSION['id_role']."','".$_GET["id_candidat"]."' )";
$upd=mysql_query($s_sql);

}
}

if (isset($_GET["cv"])) {	  $chmm=$_GET["cv"];

   $fichier=dirname(__FILE__).$file_cv3.$chmm;
   $fp = fopen($fichier,"r" ); 
   $buff = ""; 
    if(filesize($fichier) > 0){
	$buff = fread($fp,filesize($fichier));
		
		} if($upd){
       header("Content-Type: application/x-octet-stream\n" ); header( "Content-Disposition: attachment;filename=$chmm" );
          header('Pragma: no-cache'); header('Expires: 0');  echo $buff;fclose($fp); 
    }
          
        } 	
?> 