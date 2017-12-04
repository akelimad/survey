 

	<div class='texte'>

	

	

	

<?php

	$page = './'; //$_SERVER['REQUEST_URI'];



$show ='<meta http-equiv="refresh" content="0;URL='.$page.'">'; 

 $last_connexion = date('Y-m-d');

    if (isset($_GET['sp']) && $_GET['sp'] == "delete") {

        //$select_photo = mysql_query("select photo from candidats where candidats_id = " . $_SESSION['abb_id_candidat'] . "");

        $supprimer = mysql_fetch_array($select_photo);$photo_sup=$file_photos3 . $retour ['photo'];

		//echo $photo_sup;

		 		

				@unlink(dirname(__FILE__) .  $photo_sup);

	 

		 mysql_query("UPDATE candidats SET photo='' WHERE candidats_id = ".safe($_SESSION['abb_id_candidat'])." ");

      mysql_query("UPDATE candidats SET last_connexion = '$last_connexion' WHERE candidats_id =  ".safe($_SESSION['abb_id_candidat'])." ");

		 echo $show; 

    }

	



$ar = isset($_POST['ar']) ? $_POST['ar'] : "";

$fr = isset($_POST['fr']) ? $_POST['fr'] : "";

$en = isset($_POST['en']) ? $_POST['en'] : "";

$autre = isset($_POST['autre']) ? trim($_POST['autre']) : "";

//$autre = htmlspecialchars($autre, ENT_QUOTES);

$autre_n = isset($_POST['autre_n']) ? $_POST['autre_n'] : "";

$autre1 = isset($_POST['autre1']) ? trim($_POST['autre1']) : "";

//$autre1 = htmlspecialchars($autre1, ENT_QUOTES);

$autre1_n = isset($_POST['autre1_n']) ? $_POST['autre1_n'] : "";

$autre2 = isset($_POST['autre2']) ? trim($_POST['autre2']) : "";

//$autre2 = htmlspecialchars($autre2, ENT_QUOTES);

$autre2_n = isset($_POST['autre2_n']) ? $_POST['autre2_n'] : "";



$pname       = isset($_FILES['photo'])     ? $_FILES['photo']['name']       : "";

$ptmp = isset($_FILES['photo']) ? $_FILES['photo']['tmp_name'] : "";

$ptype = isset($_FILES['photo']) ? $_FILES['photo']['type'] : "";

 									



$date_valid = "/^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/";

$phone = "#^\d{10,14}$#";

	    $allowed_images = array("image/gif", "image/png", "image/jpeg", "image/jpg");

        $allowed_types = array("type", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");

 

		

 

		

	function no_special_character_v2($chaine){  



      $chaine=trim($chaine);



      $chaine= strtr($chaine,"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ","aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");



      $chaine = preg_replace('/([^.a-z0-9]+)/i', '-', $chaine);



      return $chaine;



    }

    	





$_SESSION['erreurlettre']=true;

$_SESSION['erreurcv']=true;

		

if ( isset($_POST['envoi'])) {











        if (isset($_FILES['upload']) and !empty($_FILES['upload'])) {

   $dossier = dirname(__FILE__) . $file_lm3;

   $taille_maxi_ko = 400;

   $taille_maxi = $taille_maxi_ko * 1024;

   $extensions = array('.pdf', '.doc', '.docx', '.rtf','.PDF', '.DOC', '.DOCX', '.RTF'  );



   $k = 0;



   for ($i = 0; $i < sizeof($_FILES['upload']); $i++) {



       if (!empty($_FILES['upload']['name'][$i])) {



  $fichier = basename($_FILES['upload']['name'][$i]);



  $taille = filesize($_FILES['upload']['tmp_name'][$i]);



  $extension = strrchr($_FILES['upload']['name'][$i], '.');





//Début des vérifications de sécurité...

  $j = 1;



  if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau

      $erreur[$k][0] = "<li style='color:#FF0000'>La lettre <strong style='color:blue'>" . $fichier . "</strong> n'est pas téléchargé à cause des probl&egrave;mes suivants: </li>";

      $erreur[$k][$j] = '* Vous devez télécharger un fichier de type doc,rtf,docx ou pdf<br/>';

      $j++;

											$_SESSION['erreurlettre']=false;

  }



  if ($taille > $taille_maxi) {

      $erreur[$k][0] = " <li style='color:#FF0000'>La lettre <strong style='color:blue'>" . $fichier . "</strong> n'est pas télécharg&eacute; car : </li>";

      $erreur[$k][$j] = '* La taille de la lettre d&eacute;passe les :' . $taille_maxi_ko . " Ko <br/>";

      $j++;

											$_SESSION['erreurlettre']=false;

  }



  if ($_SESSION['erreurlettre']) { //S'il n'y a pas d'erreur, on upload

      //On formate le nom du fichier ici...

      $fich = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

      $fich = preg_replace('/([^.a-z0-9]+)/i', '-', $fich);



      // pour récupérer le nom de fichier possible

      $max_requet = mysql_query("select max(id_lettre) as maximum from lettres_motivation ");

      $max_result = mysql_fetch_assoc($max_requet);

      $max_result = $max_result['maximum'];

      $max_result = $max_result + 1;   

											$id_candidat = $_SESSION["abb_id_candidat"];

   $selectc = mysql_query("SELECT * from candidats where candidats_id=".safe($id_candidat)." ");

    $c_result = mysql_fetch_assoc($selectc);

      //

      //$fich = $id_candidat . '-' . $max_result . '-' . $fich;

											

											

		  $nomformate=no_special_character_v2($c_result['nom']);

		  $prenomformate=no_special_character_v2($c_result['prenom']);

 $nomformate=str_replace(' ','',$nomformate);

		  $prenomformate=str_replace(' ','',$prenomformate);

		//////////



		//copie du cv





		$ext = pathinfo($fich, PATHINFO_EXTENSION);



		$fich = rand()."LM".$prenomformate.$nomformate.'.'.$ext;

											

											

											

											

      if (move_uploaded_file($_FILES['upload']['tmp_name'][$i], $dossier . $fich)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné...

 $candidats_id = $_SESSION['abb_id_candidat'];

 if (mysql_query("INSERT into lettres_motivation  values('','".safe($candidats_id)."','".safe($fich)."', '".safe($fich)."','1','0')") or die(mysql_error())) {



     $msg[$k] = "La lettre  <strong style='color:blue'>" . $fichier . "</strong> est télécharg&eacute; avec succ&egrave;s";

 } else {

     $erreur[$k][0] = "<li style='color:#FF0000'>La lettre <strong style='color:blue'>" . $fichier . "</strong> n'est pas télécharg&eacute; car :</li>";

     $erreur[$k][$j] = "* une erreur s'est produite lor de l'enregistrement, de votre lettre<br>";

     $j++;

													$_SESSION['erreurlettre']=false;

 }

      } else { //Sinon (la fonction renvoie FALSE).

 $erreur[$k][0] = "<li style='color:#FF0000'>Le <strong style='color:blue'>" . $fichier . "</strong> n'est pas télécharg&eacute; car: </li>";

 $erreur[$k][$j] = '* Echec de téléchargement ! <br>';

												$_SESSION['erreurlettre']=false;

      }

  }

       }



									

									

									

									

       $k++;

   }



   $_SESSION['erreur_lettre'] = isset($erreur) ? $erreur : "";

   $_SESSION['msg_lettre'] = isset($msg) ? $msg : "";

        }



							

							

							

        if (isset($_FILES['upload1']) and !empty($_FILES['upload1'])) {

   $dossier = dirname(__FILE__) . $file_cv3;

   $taille_maxi_ko = 400;

   $taille_maxi = $taille_maxi_ko * 1024;

   $extensions = array('.pdf', '.doc', '.docx','.rtf','.PDF','.DOC','.DOCX','.RTF');

 $cv_erreur = array();

   $k = 0;



   for ($i = 0; $i < sizeof($_FILES['upload1']); $i++) {



       if (!empty($_FILES['upload1']['name'][$i])) {



  $fichier = basename($_FILES['upload1']['name'][$i]);



  $taille = filesize($_FILES['upload1']['tmp_name'][$i]);



  $extension = strrchr($_FILES['upload1']['name'][$i], '.');

     



//Début des vérifications de sécurité...

  $j = 1;



  if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau

      $cv_erreur[$k][0] = "<li style='color:#FF0000'>Le CV <strong style='color:blue'>" . $fichier . "</strong> n'est pas téléchargé à cause des problèmes suivants:</li>";

      $cv_erreur[$k][$j] = '* Vous devez télécharger un fichier de type doc,docx,rtf ou pdf <br>';

      $j++;

												$_SESSION['erreurcv']=false;

  }



  if ($taille > $taille_maxi) {

      $cv_erreur[$k][0] = "<li style='color:#FF0000'>Le CV <strong style='color:blue'>" . $fichier . "</strong> n'est pas téléchargé car :</li>";

      $cv_erreur[$k][$j] = '* La taille du CV d&eacute;passe les :' . $taille_maxi_ko . " Ko <br>";

      $j++;

											$_SESSION['erreurcv']=false;

  }



  if ($_SESSION['erreurcv']) { //S'il n'y a pas d'erreur1, on upload

      //On formate le nom du fichier ici...

      $fich = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

      $fich = preg_replace('/([^.a-z0-9]+)/i', '-', $fich);



      // pour récupérer le nom de fichier possible

      $max_requet = mysql_query("SELECT max(id_cv) as maximum from cv ");

      $max_result = mysql_fetch_assoc($max_requet);

      $max_result = $max_result['maximum'];

      $max_result = $max_result + 1;



      $id_candidat = $_SESSION["abb_id_candidat"];

      //

      $fich = $id_candidat . '-' . $max_result . '-' . $fich;

																$id_candidat = $_SESSION["abb_id_candidat"];

   $selectc = mysql_query("SELECT * from candidats where candidats_id=".$id_candidat." ");

    $c_result = mysql_fetch_assoc($selectc);

      //

	  

											

											

		$nomformate=no_special_character_v2($c_result['nom']);

		$prenomformate=no_special_character_v2($c_result['prenom']);

        $nomformate=str_replace(' ','',$nomformate);

	    $prenomformate=str_replace(' ','',$prenomformate);

		//////////



		//copie du cv





		$ext = pathinfo($fich, PATHINFO_EXTENSION);



		$fich = rand()."CV".$prenomformate.$nomformate.'.'.$ext;

      if (move_uploaded_file($_FILES['upload1']['tmp_name'][$i], $dossier . $fich)) { //Si la fonction renvoie TRUE, c'est que ça a fonctionné...

 $candidats_id = $_SESSION['abb_id_candidat'];

 $isprincipalexist = mysql_query("SELECT * from cv WHERE  	candidats_id = '".$candidats_id."' AND principal = 1 AND actif = 1");

												$isprincipal= mysql_fetch_array($isprincipalexist);

 if($isprincipal ){ $principal = 0;}else{$principal = 1;}

 if (mysql_query("insert into cv values('','$candidats_id','$fich','$fich','$principal','1')")) {

	$CVdateMAJ=date("Y-m-d")." ".date("H:i:s");	

		$up_date = mysql_query("UPDATE candidats SET CVdateMAJ='$CVdateMAJ' WHERE candidats_id = $candidats_id");

     $msg[$k] = "Le CV <strong style='color:blue'>" . $fichier . "</strong> est upload&eacute; avec succ&egrave;s";

 } else {

     $cv_erreur[$k][0] = "<li style='color:#FF0000'>Le CV <strong style='color:blue'>" . $fichier . "</strong> n'est pas téléchargé car :</li>";

     $cv_erreur[$k][$j] = "* une erreur s'est produite lor de l'enregistrement, de votre CV <br>";

     $j++;

														$_SESSION['erreurcv']=false;

 }

      } else { //Sinon (la fonction renvoie FALSE).

 $cv_erreur[$k][0] = "Le <strong style='color:blue'>" . $fichier . "</strong> n'est pas téléchargé car";

 $cv_erreur[$k][$j] = '* Echec de téléchargement !<br>';

												$_SESSION['erreurcv']=false;

      }

  }

       }



       $k++;

   }

  $_SESSION['erreur'] =array();

   $_SESSION['erreur'] = isset($cv_erreur) ? $cv_erreur : "";

   $_SESSION['msg'] = isset($msg) ? $msg : "";

        }



							

							

							$IsCvExist = mysql_query("SELECT * from cv WHERE candidats_id = '".safe($_SESSION['abb_id_candidat'])."' AND actif = 1");

							$haveCV = mysql_num_rows($IsCvExist);

												

		







}









if (  isset($_POST['envoi'])) {





	

	// if ( (!empty($ar)) OR (!empty($fr))  OR (!empty($en))  OR (!empty($autre))  OR (!empty($autre1))  OR (!empty($autre2))    )  {	

	

		if(empty($autre)  OR  empty($autre_n) )   {$autre='';$autre_n='';}		

		if(empty($autre1) OR  empty($autre1_n))   {$autre1='';$autre1_n='';}		

		if(empty($autre2) OR  empty($autre2_n))   {$autre2='';$autre2_n='';}	

		

      $id_candidat = $_SESSION['abb_id_candidat'];  



         $last_connexion = date('Y-m-d');                  

                           

      $modifier_candidat = mysql_query("UPDATE candidats SET arabic='".safe($ar)."', french='".safe($fr)."', english='".safe($en)."',

      autre='".safe($autre)."', autre_n='".safe($autre_n)."', autre1='".safe($autre1)."', autre1_n='".safe($autre1_n)."',

      autre2='".safe($autre2)."',autre2_n='".safe($autre2_n)."',  last_connexion = '".safe($last_connexion)."' WHERE candidats_id = '".safe($id_candidat)."' ");

      

    // }

    //copie du photo                       

		$id_candidat = $_SESSION["abb_id_candidat"];

    $selecti = mysql_query("SELECT * from candidats where candidats_id=".safe($id_candidat)." ");

    $i_result = mysql_fetch_assoc($selecti);

      //

	  

											

											

		$nomformate=no_special_character_v2($i_result['nom']);

		$prenomformate=no_special_character_v2($i_result['prenom']);      

                    if(isset($_FILES['photo']['name']) and $_FILES['photo']['name']!="")

                       {

						$extensions_img = array('.gif', '.jpeg', '.jpg','.GIF', '.JPEG', '.JPG'  );

						$extension_photo = strrchr($_FILES['photo']['name'], '.');

                       $ext_p = pathinfo($pname , PATHINFO_EXTENSION);  

                       $pname = $id_candidat.$prenomformate.$nomformate.'.'.$ext_p;

                       

						if (in_array($extension_photo, $extensions_img)) { 

						  $folder_p = dirname(__FILE__).$file_photos3;

						   $photo = $folder_p . $pname;

						   copy($ptmp, $photo);

									

							$insertion2 = mysql_query("UPDATE candidats SET photo='".safe($pname)."' WHERE candidats_id = ".safe($id_candidat)." ");

							}

						}

 



echo $show;

}





?>	

	

	

	

	

	

	  <h1>LANGUES ET PIECES JOINTS</h1>

	  

	   

	   

	   <ul>

    <?php

	

		if ((!empty($ptmp) && !in_array($ptype, $allowed_images))) {     

      unset($_SESSION['pname']);

      echo "<li style='color:#FF0000'>Erreur dans le format du photo</li>";

  }

	if (!	$_SESSION['erreurlettre'] ) {	 $i=0;

			 while($i<5) {			 $j=0;

		 while($j<5) {

			 if (!empty($_SESSION['erreur_lettre'] [$i][$j]) ) 

			 echo "".$_SESSION['erreur_lettre'] [$i][$j]." ";  $j++;

			 }

			 $i++;

			 }      

  }

	

		if (!	$_SESSION['erreurcv'] ) {	 $i=0;

			 while($i<5) {	 $j=0;

		 while($j<5) {			

			    if (!empty($_SESSION['erreur'][$i][$j]) ) 

					echo "".$_SESSION['erreur'][$i][$j]." ";

					  $j++;

			 }

			 $i++;

			 }      

  }  

	  	   

	

  ?>

  </ul>



	   

	   

	   

	   

<form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post" id="form_standard" enctype="multipart/form-data">

      <table border="0">

    

	

	                             

<tr>

    <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

   <h1>langues </h1>

        </div></td>

</tr>

<tr>

<td colspan="4">

<table width="100%">

        <tr>

          <td>

    <ul>

    <li style="list-style-type: none;" class='even'><label>Arabe </label> </li>

    <li style="list-style-type: none;" class='odd'>    <select  id="ar" name="ar" style="width:120px">

       <option value=""></option>

       <option value="Maîtrisé" <?php if ($count){    if ($retour['arabic'] == 'Maîtrisé') echo 'selected';     } ?>>Maîtrisé</option>

       <option value="Courant" <?php if ($count) {    if ($retour['arabic'] == 'Courant') echo 'selected';      } ?>>Courant</option>

       <option value="Basique" <?php if ($count) {    if ($retour['arabic'] == 'Basique') echo 'selected';      } ?>>Basique</option>

       <option value="Néant" <?php if ($count)   {    if ($retour['arabic'] == 'Néant') echo 'selected';        } ?>>Néant</option>

        </select></li>

    </ul>

    </td>

    <td>

    <ul>



    <li style="list-style-type: none;" class='even'><label>Fran&ccedil;ais </label> </li>

    <li style="list-style-type: none;" class='odd'>   <select  id="fr" name="fr" style="width:120px">

       <option value=""></option>

       <option value="Maîtrisé" <?php if ($count){    if ($retour['french'] == 'Maîtrisé') echo 'selected';     } ?>>Maîtrisé</option>

       <option value="Courant" <?php if ($count) {    if ($retour['french'] == 'Courant') echo 'selected';      } ?>>Courant</option>

       <option value="Basique" <?php if ($count) {    if ($retour['french'] == 'Basique') echo 'selected';      } ?>>Basique</option>

       <option value="Néant" <?php if ($count)   {    if ($retour['french'] == 'Néant') echo 'selected';        } ?>>Néant</option>

        </select></li>



    </ul>

    </td>

    <td>

    <ul>



    <li style="list-style-type: none;" class='even'><label>Anglais </label> </li>

    <li style="list-style-type: none;" class='odd'>   <select  id="en" name="en" style="width:120px">

       <option value=""></option>

       <option value="Maîtrisé" <?php if ($count){    if ($retour['english'] == 'Maîtrisé') echo 'selected';      } ?>>Maîtrisé</option>

       <option value="Courant" <?php if ($count) {    if ($retour['english'] == 'Courant') echo 'selected';     } ?>>Courant</option>

       <option value="Basique" <?php if ($count) {    if ($retour['english'] == 'Basique') echo 'selected';     } ?>>Basique</option>

       <option value="Néant" <?php if ($count)   {    if ($retour['english'] == 'Néant') echo 'selected';       } ?>>Néant</option>

        </select></li>



    </ul>

       </td>

        </tr>

      </table>                         







   <table>

     <tr>

       <td>   

    <ul>

    <li style="list-style-type: none;" class='even'><label>Autres 1 : </label> <input id="autre00" name="autre" type="text" value="<?php if ($count) echo $retour['autre']; ?>" style="width: 100px;" pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  />

        <a  href="#"  class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

        <em><span></span>  Veuillez entrer une langue avant de préciser le niveau de maîtrise </em> </a></li>

    <li style="list-style-type: none;" class='odd'><select id="autre_n00" name="autre_n" style="width:120px">

       <option value=""></option>

       <option value="Maîtrisé" <?php if ($count){    if ($retour['autre_n'] == 'Maîtrisé') echo 'selected';      } ?>>Maîtrisé</option>

       <option value="Courant" <?php if ($count) {    if ($retour['autre_n'] == 'Courant') echo 'selected';     } ?>>Courant</option>

       <option value="Basique" <?php if ($count) {    if ($retour['autre_n'] == 'Basique') echo 'selected';     } ?>>Basique</option>

       <option value="Néant" <?php if ($count)   {    if ($retour['autre_n'] == 'Néant') echo 'selected';       } ?>>Néant</option>

        </select></li>



    </ul>

    </td>

    <td>

      <ul>



      <li style="list-style-type: none;" class='even'><label>Autres 2 : </label> <input id="autre01" name="autre1" type="text" value="<?php if ($count) echo $retour['autre1']; ?>" style="width: 100px;" pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  />

        <a  href="#"  class="tooltip" align="center"><i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

        <em><span></span>  Veuillez entrer une langue avant de préciser le niveau de maîtrise </em> </a></li>

      <li style="list-style-type: none;" class='odd'><select id="autre1_n01" name="autre1_n" style="width:120px">

         <option value=""></option>

       <option value="Maîtrisé" <?php if ($count){    if ($retour['autre1_n'] == 'Maîtrisé') echo 'selected';     } ?>>Maîtrisé</option>

       <option value="Courant" <?php if ($count) {    if ($retour['autre1_n'] == 'Courant') echo 'selected';      } ?>>Courant</option>

       <option value="Basique" <?php if ($count) {    if ($retour['autre1_n'] == 'Basique') echo 'selected';      } ?>>Basique</option>

       <option value="Néant" <?php if ($count)   {    if ($retour['autre1_n'] == 'Néant') echo 'selected';      } ?>>Néant</option>

          </select></li>

      </ul>

    </td>

    <td>   

      <ul>

      <li style="list-style-type: none;" class='even'><label>Autres 3 : </label> <input id="autre02" name="autre2" type="text" value="<?php if ($count) echo $retour['autre2']; ?>" style="width: 100px;" pattern="[a-zA-Z0-9ÀÁÂÄàáâäÒÓÔÖòóôöÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ' ]+"  />

        <a  href="#"  class="tooltip" align="center">    <i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>

        <em><span></span>  Veuillez entrer une langue avant de préciser le niveau de maîtrise </em> </a></li>

      <li style="list-style-type: none;" class='odd'><select id="autre2_n02" name="autre2_n" style="width:120px">

         <option value=""></option>

       <option value="Maîtrisé" <?php if ($count){    if ($retour['autre2_n'] == 'Maîtrisé') echo 'selected';     } ?>>Maîtrisé</option>

       <option value="Courant" <?php if ($count) {    if ($retour['autre2_n'] == 'Courant') echo 'selected';      } ?>>Courant</option>

       <option value="Basique" <?php if ($count) {    if ($retour['autre2_n'] == 'Basique') echo 'selected';      } ?>>Basique</option>

       <option value="Néant" <?php if ($count)   {    if ($retour['autre2_n'] == 'Néant') echo 'selected';      } ?>>Néant</option>

          </select></li>

      </ul>

      </td>



      </tr>

   </table>

 

      </td>

      </tr>                             

        







		





  

    

<tr>

     <td colspan="4"><div class="subscription" style="margin: 10px 0pt;">

  <h1>Joindre la photo</h1>

</div></td>

 </tr>



 <tr>

     <td><?php

if ($count && !empty($retour['photo'])) {

    echo '<img src="'.$url_photo_candidat.$retour['photo'].'" width="40" height="50" />';

    $_SESSION['pname'] = $retour['photo'];

}

else

    echo '<label>Photo</label><br /><input type="file" name="photo" accept=".gif,.jpeg,.jpg,.png" />';

        ?>

    </td>

    <td colspan="2"><?php

if ($count && !empty($retour['photo']))

    echo '<i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i>

  <a href="./?sp=delete" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer la photo ?\'));">Supprimer ma photo</a>';

else

    echo '<span class="Style1">Format accepté: .gif ou .jpeg ou .png (Taille max 512Ko)</span>';

?>

    </td>

     <td></td>

 </tr>







 <tr>

     <td colspan="4"><div id="lettre_cvs" class="subscription" style="margin: 10px 0pt;">

<h1>Telecharger les CVs et les lettres de motivation</h1>

       </div></td>

   </tr>

          <tr>  

          <td style="vertical-align:top;">

          <label>CVs </label> <font style="color:red;">*</font> 

        <a  href="#"  class="tooltip" align="center">    <i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  Vous pouvez joindre  jusqu'à 5 CVs Word ou PDF, la taille de chaque cv ne doit pas dépassé 400 ko</em>



 </a><br/> 

      <?php 

      $id_cnadidat=$_SESSION['abb_id_candidat'];

      $requet=mysql_query("SELECT * from cv where actif='1' and candidats_id='".safe($id_cnadidat)."' ");

      $cvnbr=mysql_num_rows($requet);

      if($requet)

      {?>



      <table class='cvs'>

             

      <?php 

   $i=1;

        while($resutl=mysql_fetch_assoc($requet))

        {

        $id_cv=$resutl['id_cv'];

        $lien_cv=$resutl['lien_cv'];  

      ?>

   <tr>

   <td  class="cvlettre" id="sup_cv0_<?php echo $id_cv; ?>" >

      <?php 

      

      echo '<a href="./dcv/?cv='.$lien_cv.'"><i class="fa fa-download fa-lg" ></i></a>';

      

      $principal=$resutl['principal'];

      if($principal!=true)

        { 

          echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel="'.$id_cv.'" class="supprimer_cv" id="cv_'.$id_cv.'" >

          <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a>';

          echo '<input name="principal" type="radio" value="'.$id_cv.'" class="radio_principal" title="Rendre principal"/>';

           

        }

      else

        {

		// echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel="'.$id_cv.'" class="supprimer_cv" id="cv_'.$id_cv.'" ><img src="'.$imgurl.'/icons/delete.png" alt="Supprimer" title="Supprimer "/></a>';

		 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

          echo '<input name="principal" type="radio" value="'.$id_cv.'" checked class="radio_principal" title="Rendre principal"/>';

          

        } 

   ?>

   </td>

      

   <td id="sup_cv_<?php echo $id_cv; ?>"><?php echo "CV".$i.": " ;?></td>

   <td id="sup_cv1_<?php echo $id_cv; ?>"><?php if(strlen($resutl['titre_cv'])>15) echo substr($resutl['titre_cv'],0,15).".." ; else echo $resutl['titre_cv'];?></td>

    

   </tr>

   <?php  

        $i++;   

        }

      $cvnbr2=5-$cvnbr;

            echo '<input type="hidden" name="cvnbr_file"  value="'.$cvnbr2.'" />' ; 

      for ($i=$cvnbr;$i<5;$i++)

        {

        //  echo '<input name="cv'.$i.'" type="file" />';

             // echo  '<input type="file" name="upload1[]" size="30" class="cvs"><br>';

        }

        

            

        if($cvnbr<= 4)

{

$cvnbr2 = $cvnbr+2 ;

               echo  '<input type="file" name="upload1[]" size="30" class="cvs" accept=".doc,.docx,.pdf" /><br>';



echo '<span  id="leschampscv_'.$cvnbr2.'"><a class="cvchamp" href="javascript:create_champcv('.$cvnbr2.')">Ajouter un CV</a></span>';

  

        }

        ?>

        

        

        </table>

        <td>

      <?php

   }



  ?>

  

  

  

  

  

  <?php 

      $id_cnadidat=$_SESSION['abb_id_candidat'];



      $requet=   mysql_query("SELECT * from lettres_motivation where candidats_id = '".safe($id_cnadidat)."'  AND actif=1");

      $nbr=mysql_num_rows($requet);

      if($requet)

      {?>

      <td style="vertical-align:top;">

<label>Lettre de motivation</label> 

        <a  href="#"  class="tooltip" align="center">    <i class="fa fa-info-circle fa-lg" style="color:<?php echo $color_bg; ?>"></i>



     <em><span></span>  Vous pouvez joindre jusqu'à 5 lettres de motivation Word ou PDF, la taille de chaque lettre ne doit pas dépassé 400 ko</em>



 </a><br /> 

      <table class='cvs'>

             

      <?php 

   $i=1;

        while($resutl=mysql_fetch_assoc($requet))

        {

        $id_cv=$resutl['id_lettre'];

        $lien_cv=$resutl['lettre']; 

      ?>

   <tr>

   <td class="cvlettre" id="sup_lettre_<?php echo $id_cv; ?>" >

      <?php 

      

      echo '<a href="./dlm/?cv='.$lien_cv.'"><i class="fa fa-download fa-lg" ></i></a>';

      

      $principal=$resutl['principal'];

      if($principal==true)

        { 

          echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel1="'.$id_cv.'" class="supprimer_lettre" id="lettre_'.$id_cv.'" >

          <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a>';



          echo '<input name="principal1" type="radio" value="'.$id_cv.'" checked class="radio_principal1" title="Rendre principale"/>';

          

        }

      else

        {

          echo '&nbsp;&nbsp;<a href="#lettre_cvs" rel1="'.$id_cv.'" class="supprimer_lettre" id="lettre_'.$id_cv.'" >

          <i class="fa fa-trash-o fa-fw fa-lg" style="color:#DB1212;"></i></a>';

            

          echo '<input name="principal1" type="radio" value="'.$id_cv.'" class="radio_principal1" title="Rendre principale"/>';

          

        } 

   ?>

   </td>

   <td id="sup_lettre0_<?php echo $id_cv; ?>" ><?php echo "Lettre".$i.": " ;?></td>

   <td id="sup_lettre1_<?php echo $id_cv; ?>" ><?php if(strlen($resutl['titre'])>15) echo substr($resutl['titre'],0,15).".." ; else echo $resutl['titre'];?></td>

   </tr>

   <?php  

        $i++;   

        }

        $nbr1=5-$nbr; 

            echo '<input type="hidden" name="nbr_file_lettre" value="'.$nbr1.'" />' ;

      for ($i=$nbr;$i<5;$i++)

        {

        //  echo '<input name="cv'.$i.'" type="file" />';

            //  echo  '<input type="file" name="upload[]" size="30" class="cvs"><br>';

        } 



if($nbr<= 5)

{

$nbr2 = $nbr+2 ;

               echo  '<input type="file" name="upload[]" size="30" class="cvs" accept=".doc,.docx,.pdf" /><br>';



echo '<span  id="leschamps_'.$nbr2.'"><a class="lettre" href="javascript:create_champ('.$nbr2.')">Ajouter une lettre</a></span>';

        

        }

      

        ?>

        </table>

        </td>

      <?php

   }



  ?>

  

  </tr>

  

      















 

  <tr>

<td colspan="4"><div class="ligneBleu"></div>

    <p style="color:#CC0000"> P.S: les champs marqués par (*) sont obligatoires<br/>

        <input name="envoi" type="submit" class="espace_candidat" value="Enregistrer" style="width:170px"/>

        <input name="" type="reset" class="espace_candidat" style="width:170px"/>

    </p></td>

  </tr>

	  

	   

      </table>

	   

</form>





	</div>

 