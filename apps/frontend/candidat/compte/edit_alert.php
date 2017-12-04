<?php
session_start();
if(!isset($_SESSION["abb_login_candidat"]) || $_SESSION["abb_login_candidat"] == "")
      {	
	  	$_SESSION["url"] = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  		header("Location: ../candidat/") ;
	  }
      else
	  {
	  	require_once dirname(__FILE__) . "/../../../../config/config.php";
		mysql_connect($serveur,$user,$passwd);
		mysql_select_db($bdd);
		
		
		$req = mysql_query("select * from alert where id_alert=".safe($_GET['id'])." ");
		$rep= mysql_fetch_assoc($req);

if(isset($_GET['id']) and isset($_GET['titre']))
{

if (get_magic_quotes_gpc())
{
  
  $title = stripslashes($_GET['titre']);
}
else
$title=$_GET['titre'];

 
if($rep['titre']==$title)
{
echo "<span style=\"color:green\">L'alerte a &eacute;t&eacute; mise &agrave; jour avec succ&egrave;s</span>";
	echo '<meta http-equiv="refresh" content="0;URL='.$site.'candidat/compte/">';	
}
else
{
mysql_query("UPDATE alert set titre='".$_GET['titre']."' where id_alert=".$_GET['id']." ");
if(mysql_affected_rows()>0){
echo "<span style=\"color:green\">L'alerte a &eacute;t&eacute; mise &agrave; jour avec succ&egraves</span>"; 
	echo '<meta http-equiv="refresh" content="0;URL='.$site.'candidat/compte/">';	
}
else
echo "<span style=\"color:red\">Une erreur est survenue lors de la mise &egrave; jour de l'alerte</span>";
}
}
}
