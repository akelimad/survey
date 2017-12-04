<?php

$conf_admin_email='etalent.analytics@gmail.com'; 

if(isset($_GET['message']) && isset($_GET['email']) && isset($_GET['envoi']))
{
	if($_GET['envoi'] == 1)
	{
		$headers = "From: ".$_GET['email']."\n"; 
      	$headers .= "Content-Type: text/html; charset=iso-8859-1\n".$headers;
		if(mail($conf_admin_email,"Question ou commentaire",stripslashes($_GET['message']),$headers))
		{
			echo '<font>Email envoy&eacute; avec succ&egrave;s</font>';
		}
		else
			echo '<font color="#FF0000">Une erreur est survenue</font>';
	}
	else
	{
		$headers = "From: ".$_GET['email']."\n"; 
      	$headers .= "Content-Type: text/html; charset=iso-8859-1\n".$headers;
		if(mail($conf_admin_email,"Nous signaler une erreur",stripslashes($_GET['message']),$headers))
		{
			echo '<font color="#000000">Email envoy&eacute; avec succ&egrave;s</font>';
		}
		else
			echo '<font color="#FF0000">Une erreur est survenue</font>';
	}
}
?>