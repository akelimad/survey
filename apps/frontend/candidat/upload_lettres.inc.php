<?php

session_start();



require_once('../config/config.php');

mysql_connect($serveur,$user,$passwd);

mysql_select_db($bdd);





if(isset($_FILES['upload']) and !empty($_FILES['upload'])){

$dossier = '74b87337454200d4d33f80c4663dc5e6/';

$taille_maxi_ko=400;

$taille_maxi = $taille_maxi_ko*1024;

$extensions = array('.pdf', '.doc', '.docx');



$k=0;



for ($i=0;$i<$_POST['nbr_file'];$i++){

	

	if($_FILES['upload']['name'][$i])

	{



		$fichier= basename($_FILES['upload']['name'][$i]);



		$taille = filesize($_FILES['upload']['tmp_name'][$i]);



		$extension = strrchr($_FILES['upload']['name'][$i], '.'); 





//Début des vérifications de sécurité...

		$j=1;



			if(!in_array($extension,$extensions)) //Si l'extension n'est pas dans le tableau

			{

				$erreur[$k][0]="La lettre ".$fichier." n'est pas upload&eacute;e à cause des probl&egrave;mrd suivants";

				$erreur[$k][$j] = 'Vous devez uploader un fichier de type doc, docx ou pdf';

				$j++;

			}

			

			if($taille>$taille_maxi)

			{

			 $erreur[$k][0]="Le CV ".$fichier." n'est pas upload&eacute; car :";

			 $erreur[$k][$j] = 'La taille de la lettre d&eacute;passe les :'.$taille_maxi_ko." Ko" ;

			 $j++;

			}

	

			if(!isset($erreur[$k])) //S'il n'y a pas d'erreur, on upload

			{

			 //On formate le nom du fichier ici...

			 $fich = strtr($fichier, 

				  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 

				  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

			 $fich = preg_replace('/([^.a-z0-9]+)/i', '-', $fich);

			 

				// pour récupérer le nom de fichier possible

				$max_requet=mysql_query("SELECT max(id_lettre) as maximum from lettres_motivation ");

				$max_result=mysql_fetch_assoc($max_requet);

				$max_result=$max_result['maximum'];

				$max_result=$max_result+1;

				

				$id_candidat=$_SESSION["idc_id_candidat"];

				//

				$fich=$id_candidat.'-'.$max_result.'-'.$fich;

				if(move_uploaded_file($_FILES['upload']['tmp_name'][$i], $dossier . $fich)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...

				 {

				  $candidats_id=$_SESSION['idc_id_candidat'];

				  if(mysql_query("INSERT into lettres_motivation  values('','".safe($candidats_id)."','".safe($fich)."', '".safe($fichier)."','1','0')") 

				  	or die(mysql_error()))

				  {

				  

				  $msg[$k]="La lettre  ".$fichier." est upload&eacute; avec succ&egrave;s";

				  }

				  else{

				  $erreur[$k][0]="Le CV ".$fichier." n'est pas upload&eacute; car :";

				  $erreur[$k][$j] = "une erreur s'est produite lor de l'enregistrement, de votre lettre" ;

				  $j++;

				  }

				 }

			 

				else //Sinon (la fonction renvoie FALSE).

				{

				  $erreur[$k][0]="Le ".$fichier." n'est pas upload&eacute; car";

				  $erreur[$k][$j]='Echec de l\'upload !';

				}

			 

			}

			

	  }

	  

	  $k++;

   }

    

	$_SESSION['erreur_lettre']=isset($erreur) ? $erreur : ""; 

	$_SESSION['msg_lettre']=isset($msg) ? $msg : "";  

	

	header("location:fiche_profil.php");

}

?>