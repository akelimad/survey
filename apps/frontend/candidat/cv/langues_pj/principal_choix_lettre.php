<?php 
session_start();
require_once dirname(__FILE__) . "/../../../../../config/config.php";
mysql_connect($serveur,$user,$passwd);
mysql_select_db($bdd);
		
$candidat_id=$_SESSION['abb_id_candidat'];		

if(isset($_POST['id_lettre']))
{
	$id_cv=$_POST['id_lettre'];
	$chaine="";
	if(mysql_query("UPDATE lettres_motivation set principal='0' where candidats_id='".safe($candidat_id)."'") 
		and mysql_query("UPDATE lettres_motivation set principal='1' where id_lettre='".safe($id_cv)."'"))
	{
		
		////////////////////////////////////////
		$requet = mysql_query("SELECT id_lettre from lettres_motivation where actif='1' and candidats_id='".$candidat_id."'");
		if ($requet) 
		{
			
			while ($resutl = mysql_fetch_assoc($requet)) 
			{
				$chaine=$chaine.",".$resutl['id_lettre'];
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