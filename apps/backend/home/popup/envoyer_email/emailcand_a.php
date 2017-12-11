<?php

session_start();
	  	require(dirname(__FILE__).'/../../../../../config/config.php');
		
?>

<!DOCTYPE html>
<html>
<head> 


<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>

				  
</head>
<body>

<div id="fils">
<div id="fade" style="background: rgba(0, 0, 0, 1);"></div>
<div class="popup_block" style="width: 400px;height: 100px; z-index: 999; top: 30%; left: 40%;">
<div class="titleBar"><div class="title">Envoyer E-Mail au candidat </div><a href="<?php echo $_SESSION['page_courant '] ; ?>"><div class="close" style="cursor: pointer;">close</div></a></div>
<div id="contenu" class="content" style="width: 360px;height: 40px;">


 <?php 
 
if( isset($_POST['email2']) && $_POST['email2'] != '' )
{
		$expediteur = $_POST['email1'];
		$destinataire = $_POST['email2'];
		$subject = $_POST['sujet'];
		$msg = $_POST['message'];

        $filename = (isset($_POST['pj'])) ? $_POST['pj'] : '';
        $path = dirname(__FILE__).$file_courrier3.$filename."";

		$replyto = $expediteur; 
	

			      // on génère une frontière
  $boundary = '-----=' . md5 ( uniqid  ( rand () ) );
  
 
            
 
////////////////////////////////////////////////////////////////////////////
$fichier=$path;
if (file_exists($fichier)) {

}
else{
$repertoire=dirname(__FILE__).$file_courrier3;
$le_repertoire = opendir($repertoire) or die("Erreur le repertoire $repertoire existe pas");
while($file = @readdir($le_repertoire))
{
    $file1=preg_replace("/[0-9]/", "", $file);
    $fichier1 = preg_replace("/[0-9]/", "", $filename);
            // enlever les traitements inutile
    if( $file1== $fichier1 )
    {
    $fichier=dirname(__FILE__).$file_courrier3.$file;
    $path=$fichier;
    }
}
closedir($le_repertoire);
}

$fp = fopen ($path, 'rb');
$content = fread ($fp, filesize ($path));
fclose ($fp);
$content_encode = chunk_split (base64_encode ($content));

////////////////////////////////////////////////////////////////////
  $headers = 'From: '.$expediteur.'' . "\r\n";
    $headers .= "Reply-To: ".$replyto."\r\n";
 // $headers .= 'Bcc: '.$admin_email.'."\r\n";

  $headers .= "MIME-Version: 1.0\n";

  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";



  $message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: text/html; charset=\"utf-8\"\n";

  $message .= "Content-Transfer-Encoding: 8bit\n\n";

$msg1=	" ".$msg." ";

  $message .= $msg1."\r\n\r\n";

  $message .= "\n";

if(!empty($filename))
{
  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: application/octet-stream; name=\"PJ ".$filename."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n"; 

  $message .= "Content-Disposition: attachment; filename=\"PJ ".$filename."\n\n";

  $message .= $content_encode . "\n";

  $message .= "\n\n";
}

  //$objet='Nouvelle Candidature pour le poste de '.$offre['Name'];
if ( mail ($destinataire, $subject, $message, $headers)) {

			//  Insertion corespondances			
		$d=date("Y.m.d-H.i.s"); $type_email="Envoi manuel"; $type_c="Contacte avec le candidat";
$sql_mail= ' INSERT into corespondances values ("","'.safe($subject).'","'.safe($_SESSION["abb_admin"]).'",
      "'.safe($d).'","'.safe($type_email).'","'.safe($type_c).'","'.safe($msg1).'","") ';

			mysql_query($sql_mail);
		/*			echo 	$sql_mail;*/
        echo  '<font color="#277405">Email envoy&eacute; avec succ&egrave;s </font>'; 
		
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '] .'" />   ';
		 
		}
    else 
        echo  '<font color="#FF0000">Une erreur est survenue</font>';

}
else	{
 echo  '<font color="#FF0000">les champs "Votre email" et "Email du destinataire" sont obligatoires</font>';
 
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant_c'] .'" />   ';
		}
?> 




</div>
</div>
</div>


</body>
</html>