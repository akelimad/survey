<?php 
require_once dirname(__FILE__) . "/../../../../../config/config.php";
mysql_connect($serveur,$user,$passwd);
mysql_select_db($bdd);

if(isset($_POST['id_lettre']))
{
	$var=$_POST['id_lettre'];
	
	if(mysql_query("update lettres_motivation set actif='0' where id_lettre='$var'"))
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