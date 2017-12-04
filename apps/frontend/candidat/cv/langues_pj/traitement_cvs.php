<?php 
require_once dirname(__FILE__) . "/../../../../../config/config.php";
mysql_connect($serveur,$user,$passwd);
mysql_select_db($bdd);

if(isset($_POST['id_cv']))
{
	$var=$_POST['id_cv'];
	
	if(mysql_query("update cv set actif='0' where id_cv='$var'"))
	{
		echo 'ok';
	}
	else 
	{
		echo 'ko';
	}
}
else
 
	echo 'ko';
?>