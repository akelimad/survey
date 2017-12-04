<?php 
session_start();
require_once dirname(__FILE__) . "/../../../../../config/config.php";
mysql_connect($serveur,$user,$passwd);
mysql_select_db($bdd);
		
$candidat_id=$_SESSION['abb_id_candidat'];		

if(isset($_POST['id_cv']))
{
	$id_cv=$_POST['id_cv'];
	$chaine="";
	if(mysql_query("UPDATE cv set principal='0' where candidats_id='".safe($candidat_id)."'") and mysql_query("UPDATE cv set principal='1' where id_cv='".safe($id_cv)."'"))
	{
		
		////////////////////////////////////////
		$requet = mysql_query("SELECT id_cv from cv where actif='1' and candidats_id='".safe($candidat_id)."' ");
		if ($requet) 
		{
			
			while ($resutl = mysql_fetch_assoc($requet)) 
			{
				$chaine=$chaine.",".$resutl['id_cv'];
			}
			 	
		 //echo json_encode($resultat);
		}
		echo $chaine;
		////////////////////////////////////////
	} 
	else 
	{
		echo 'ko';
	}
}
?>