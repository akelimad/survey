<?php
session_start();
	  	require(dirname(__FILE__).'/../../config/config.php');
if( isset($_GET['exp']) && isset($_GET['dest']) && isset($_GET['attach']))
{
		$msg = $_GET['message'];
		$expediteur = $_GET['exp'];
		$destinataire = $_GET['dest'];
		$filename = $_GET['attach'];
			$filename2 = $_GET['attach2'];
		$subject = 'Votre avis sur ce candidat';
		$my_path = $_SERVER['DOCUMENT_ROOT']."/".$rep_path."apps/upload/cv/";
	
		$path = dirname(__FILE__)."/../../apps/upload/cv/".$filename."";
		$path2 = $_SERVER['DOCUMENT_ROOT']."/".$rep_path."apps/upload/lmotivation/".$filename2."";
		//$my_path = "http://192.168.1.15/dernierversionCIM/candidat/74b87337454200d4d33f80c4663dc5e5/";
		$replyto = $expediteur;
		//echo  $my_path."           ".$message;
		
		
		
			      // on génère une frontière
  $boundary = '-----=' . md5 ( uniqid  ( rand () ) );
  


  



$fichier=$path;
if (file_exists($fichier)) {

}
else{

$repertoire=dirname(__FILE__)."/../../apps/upload/cv/";
    $le_repertoire = opendir($repertoire) or die("Erreur le repertoire $repertoire existe pas");
    while($file = @readdir($le_repertoire))
    {
$file1=preg_replace("/[0-9]/", "", $file);
$fichier1 = preg_replace("/[0-9]/", "", $filename);
        // enlever les traitements inutile
if( $file1== $fichier1 )
{
$fichier=dirname(__FILE__)."/../../apps/upload/cv/".$file;
$path=$fichier;
}

/*
echo "blok  file1 :  ".$file1."<br>";
echo "fichier1  :  ".$fichier1."<br>";
echo "file :  ".$file."<br>";
echo "fichier :   ".$fichier."<br>  fin block <br>";
*/
    }

    closedir($le_repertoire);

}


  

  //$path = '../candidat/telechargement12124545/Fiche de synthèse globale VF.pdf'; // chemin vers le fichier

  $fp = fopen ($path, 'rb');

  $content = fread ($fp, filesize ($path));

  fclose ($fp);

  $content_encode = chunk_split (base64_encode ($content));


  

 

  $headers = 'From: '.$expediteur.'' . "\r\n";
    $headers .= "Reply-To: ".$replyto."\r\n";
 // $headers .= 'Bcc: '.$admin_email.'."\r\n";

  $headers .= "MIME-Version: 1.0\n";

  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";



  $message  = "Ceci est un message au format MIME 1.0 multipart/mixed.\n\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: text/html; charset=\"utf-8\"\n";

  $message .= "Content-Transfer-Encoding: 8bit\n\n";
		
	$msg1=	" <table><tr><td style='font-family: Arial;font-size:11px;'><p style='padding:0px 18px 0px 10px;' >Bonjour,<br/>
Le CV joint vous a été envoyé par un de vos collègues sur le site ".$nom_site."
Vous pouvez telecharge ce CV.
<br/><br/>
 </p>
".$signature_email."</td></tr></table>";
		$message .= $msg1."\r\n\r\n";


	
  
    $message .= "\n";

  $message .= "--" . $boundary . "\n";

  $message .= "Content-Type: application/octet-stream; name=\"CV ".$filename."\"\n";

  $message .= "Content-Transfer-Encoding: base64\n";

  // mettez inline au lieu de attachment

  // pour que l'image s'affiche dans l'email

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

  // mettez inline au lieu de attachment

  // pour que l'image s'affiche dans l'email

  $message .= "Content-Disposition: attachment; filename=\"LM ".$lettre_titre." \n\n";
  
  $message .= $content_encode2 . "\n";

  $message .= "\n\n";
  
  }
  
  
  
  
  

  $message .= "--" . $boundary . "--\n";


  //$objet='Nouvelle Candidature pour le poste de '.$offre['Name'];
if ( mail ($destinataire, $subject, $message, $headers)) {

			//  Insertion corespondances			
		$d=date("Y.m.d-H.i.s"); $type_email="Envoi manuel"; $type_c="Candidature transféré";
		$sql_mail= ' insert into corespondances Values ("","'.safe($subject).'","'.safe($_SESSION["abb_admin"]).'","'.safe($d).'","'.safe($type_email).'","'.safe($type_c).'","'.safe($msg1).'") ';
			mysql_query($sql_mail);
						
        echo  '<font color="#277405">Email envoy&eacute; avec succ&egrave;s </font>'; 
		}
    else 
        echo  '<font color="#FF0000">Une erreur est survenue</font>';

}
else
 echo  '<font color="#FF0000">les champs "Votre email" et "Email du destinataire" sont obligatoires</font>';
?>