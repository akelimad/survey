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
<div class="titleBar"><div class="title">Transférer cette candidature </div><a href="<?php echo $_SESSION['page_courant '] ; ?>"><div class="close" style="cursor: pointer;">close</div></a></div>
<div id="contenu" class="content" style="width: 360px;height: 40px;">


<?php 
		
if( isset($_POST['email2']) && $_POST['email2'] != '' )
{
		$expediteur = $_POST['email1'];
		$destinataire = $_POST['email2'];
		$subject = $_POST['sujet'];
		$msg = $_POST['message'];
		$filename = (isset($_POST['cv'])) ? $_POST['cv'] : '';
		$filename2 = (isset($_POST['lm'])) ? $_POST['lm'] : ''; 
		//$subject = 'Votre avis sur ce candidat'; 
	
		$path = dirname(__FILE__).$file_cv3.$filename."";
		$path2 = dirname(__FILE__).$file_lm3.$filename2.""; 

    $filenamePJ = (isset($_POST['pj'])) ? $_POST['pj'] : '';
    $pathPJ = dirname(__FILE__).$file_courrier3.$filenamePJ."";

		$replyto = $expediteur; 
		
		
		
			      // on génère une frontière
  $boundary = '-----=' . md5 ( uniqid  ( rand () ) );
  


  



$fichier=$path;
if (file_exists($fichier)) {

}
else{

$repertoire=dirname(__FILE__).$file_cv3;
    $le_repertoire = opendir($repertoire) or die("Erreur le repertoire $repertoire existe pas");
    while($file = @readdir($le_repertoire))
    {
$file1=preg_replace("/[0-9]/", "", $file);
$fichier1 = preg_replace("/[0-9]/", "", $filename);
        // enlever les traitements inutile
if( $file1== $fichier1 )
{
$fichier=dirname(__FILE__).$file_cv3.$file;
$path=$fichier;
}
 
    }

    closedir($le_repertoire);

}

 

  $fp = fopen ($path, 'rb');

  $content = fread ($fp, filesize ($path));

  fclose ($fp);

  $content_encode = chunk_split (base64_encode ($content));


  
////////////////////////////////////////////////////////////////////////////

 

  $headers = 'From: '.$expediteur.'' . "\r\n";
  $headers .= "Reply-To: ".$replyto."\r\n";
 // $headers .= 'Bcc: '.$admin_email.'."\r\n";

  $headers .= "MIME-Version: 1.0\n";

  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";



  $message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: text/html; charset=\"utf-8\"\n";

  $message .= "Content-Transfer-Encoding: 8bit\n\n";
		
	$msg1=	"".$msg."";
	
  $message .= $msg1."\r\n\r\n";
 
  $message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: application/octet-stream; name=\"CV ".$filename."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n"; 

  $message .= "Content-Disposition: attachment; filename=\"CV ".$filename."\n\n";

  $message .= $content_encode . "\n";

  $message .= "\n\n";
  
  

  
  //lettre de motivation
if(!empty($filename2))
{

//	echo $path2;
	  $fp2 = fopen ($path2, 'rb');
  $content2 = fread ($fp2, filesize ($path2));
  fclose ($fp2);

  $content_encode2 = chunk_split (base64_encode ($content2));
	
  $lettre_m=preg_replace("([^a-zA-Z.-\s_])", "", $filename2);
    $lettre_titre= $filename2;
  $extension = substr(strrchr($lettre_titre, "."), 1);
   $lettre_titre=  substr($lettre_titre, 0,strlen($lettre_titre)-strlen($extension)-1);
  $typemime = "application/octet-stream";
	 if(strpos($lettre_m, ".pdf"))
	 $typemime = "application/pdf";
	 if(strpos($lettre_m, ".doc"))
	 $typemime = "application/msword";
    $message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: ".$typemime."; name=\"LM ".$lettre_titre."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n"; 

  $message .= "Content-Disposition: attachment; filename=\"LM ".$lettre_titre." \n\n";
  
  $message .= $content_encode2 . "\n";

  $message .= "\n\n";
  
  }
  
  if(!empty($filenamePJ))
{

//  echo $path2;
    $fpPJ = fopen ($pathPJ, 'rb');
  $contentPJ = fread ($fpPJ, filesize ($pathPJ));
  fclose ($fpPJ);

  $content_encode_PJ = chunk_split (base64_encode ($contentPJ));
  
  $D_PJ=preg_replace("([^a-zA-Z.-\s_])", "", $filenamePJ);
  $PJ_titre= $filenamePJ;
  $extension = substr(strrchr($PJ_titre, "."), 1);
   $PJ_titre=  substr($PJ_titre, 0,strlen($PJ_titre)-strlen($extension)-1);
  $typemime = "application/octet-stream";
  if(strpos($D_PJ, ".pdf"))
  {
    $typemime = "application/pdf";
  }
  if(strpos($D_PJ, ".doc")){
    $typemime = "application/msword";
  }

  
  $message .= "\n";
  
  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: ".$typemime."; name=\"PJ ".$PJ_titre.".".$extension."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n"; 

  $message .= "Content-Disposition: attachment; filename=\"PJ ".$PJ_titre.".".$extension." \n\n";
  
  $message .= $content_encode_PJ . "\n";

  $message .= "\n\n";
  
  }
  
  
  
  

  $message .= "--" . $boundary . "--\n";


  //$objet='Nouvelle Candidature pour le poste de '.$offre['Name'];
if ( mail ($destinataire,$subject,$message,$headers)) {

			//  Insertion corespondances			
		$d=date("Y.m.d-H.i.s"); $type_email="Envoi manuel"; $type_c="Candidature transféré";
		$sql_mail= 'INSERT into corespondances Values ("","'.safe($subject).'","'.safe($_SESSION["abb_admin"]).'",
      "'.safe($d).'","'.safe($type_email).'","'.safe($type_c).'","'.safe($msg1).'","") ';
			mysql_query($sql_mail);
						
        echo  '<font color="#277405">Email envoy&eacute; avec succ&egrave;s </font>'; 
			
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant '] .'" />   ';
		 
		}
    else 
        echo  '<font color="#FF0000">Une erreur est survenue</font>';

}
else	{
 echo  '<font color="#FF0000">les champs "Votre email" et "Email du destinataire" sont obligatoires</font>';
 
		echo '  <meta http-equiv="refresh" content="1;'.$_SESSION['page_courant_t'] .'" />   ';
		}
?> 



</div>
</div>
</div>


</body>
</html>