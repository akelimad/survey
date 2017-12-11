 

	<div class='texte'>

	

<?php

	

$titre = isset($_POST['titre']) ? trim($_POST['titre']) : stripslashes($reponse['titre']) ;

//$titre =str_replace("'","\'",$titre)	;

//$titre = htmlspecialchars($titre, ENT_QUOTES);							

   //Pour candidats

$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : $reponse['id_civi'];

$nom = isset($_POST['nom']) ? trim($_POST['nom']) : $reponse['nom'];

//$nom = htmlspecialchars($nom, ENT_QUOTES);

$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : $reponse['prenom'];

//$prenom = htmlspecialchars($prenom, ENT_QUOTES);

$adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) :  stripslashes($reponse['adresse']);

//$adresse = htmlspecialchars($adresse, ENT_QUOTES);

$code = isset($_POST['code']) ? trim($_POST['code']) : $reponse['code'];

//$code = htmlspecialchars($code, ENT_QUOTES);

$ville = isset($_POST['ville']) ? trim($_POST['ville']) : $reponse['ville'];

//$ville = htmlspecialchars($ville, ENT_QUOTES);

$pays = isset($_POST['pays']) ? $_POST['pays'] :  $reponse['id_pays'];

$date = isset($_POST['date']) ? trim($_POST['date']) : $reponse['date_n'];

//$date = htmlspecialchars($date, ENT_QUOTES);

$nationalite = isset($_POST['nationalite']) ? trim($_POST['nationalite']) : stripslashes($reponse['nationalite']);

//$nationalite = htmlspecialchars($nationalite, ENT_QUOTES);

$tel1 = isset($_POST['tel1']) ? trim($_POST['tel1']) : $reponse['tel1'];

//$tel1 = htmlspecialchars($tel1, ENT_QUOTES);

$tel2 = isset($_POST['tel2']) ? trim($_POST['tel2']) : $reponse['tel2'];

//$tel2 = htmlspecialchars($tel2, ENT_QUOTES);

$situation = isset($_POST['situation']) ? $_POST['situation'] : $reponse['id_situ'];

$domaine = isset($_POST['domaine']) ? $_POST['domaine'] : $reponse['id_sect'];

$fonction = isset($_POST['fonction']) ? $_POST['fonction'] :  $reponse['id_fonc'];

$salaire = isset($_POST['salaire']) ? $_POST['salaire'] : $reponse['id_salr'];

$formation = isset($_POST['formation']) ? $_POST['formation'] : $reponse['id_nfor'];

$type_formation = isset($_POST['type_formation']) ? $_POST['type_formation'] : $reponse['id_tfor'];

$exp = isset($_POST['exp']) ? $_POST['exp'] : $reponse['id_expe'];

$dispo = isset($_POST['dispo']) ? $_POST['dispo'] : $reponse['id_dispo'];

$mobilite = isset($_POST['mobilite']) ? $_POST['mobilite'] : $reponse['mobilite'] ;

$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : $reponse['niveau_mobilite'];

$taux = isset($_POST['taux']) ? $_POST['taux'] : $reponse['taux_mobilite'];										



$var = array(" ");

$replace   = array("");

$tel1 = str_replace($var, $replace, $tel1); 



$date_valid = "/^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/";

$phone = "#^\d{10,14}$#";

	

		

		$age=16;

		$datejour = date('Y-m-d');

		

   

	

		 

 //date in mm/dd/yyyy format; or it can be in other formats as well

  //$birthDate = "12/17/1983";

  $birthDate = $date;

  //explode the date to get month, day and year

  $birthDate = explode("/", $birthDate);

  //get age from date or birthdate

  $age_cl = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")    ? ((date("Y") - $birthDate[2]) - 1)    : (date("Y") - $birthDate[2]));

 // echo "Age is:" . $age;



 



		if(($age_cl<16) OR ($age_cl>55) or ($birthDate[0]<1 OR $birthDate[0]>31) or ($birthDate[1]<1 OR $birthDate[1]>12) or ($birthDate[2]<1900 OR $birthDate[2]>2050)) 	

		$erreur_date =true;

		else

		$erreur_date=false;

		



 

  $messages=array();

  $msg = '';

  if (empty($titre))

      $msg .= "<ul>

    <li style='color:#FF0000'>Vous n'avez pas précisé l'intitulé de votre profil</li>";

  if (empty($nom))

     $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre nom</li>";

  if (empty($prenom))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre prénom</li>";

  if (empty($civilite))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé la civilité</li>";

  if (empty($adresse))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé adresse</li>";

 

  if (empty($ville))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé la ville</li>";

  if (empty($pays))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre pays de résidence</li>";

  if (empty($salaire))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre salaire souhaité</li>";

       

  if (empty($nationalite))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre nationalité</li>";

  if (empty($tel1))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre numéro de téléphone</li>";

  if (!empty($tel1) && !(preg_match($phone, $tel1)))

      $msg .= "<li style='color:#FF0000'>Le numéro de téléphone doit comporter seulement entre 10 et 14 chiffres,sans espaces ni tirets </li>"; 

       

  if (empty($date))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre date de naissance</li>";

  if (!empty($date) && !(preg_match($date_valid, $date)))

      $msg .= "<li style='color:#FF0000'>La date de naissance est invalide</li>";

 

  if($erreur_date)

	$msg .= "<li style='color:#FF0000' >Votre &acirc;ge doit &ecirc;tre entre 16 et 55 ans  </li>";							

  if ($exp == '')

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre situatiopn actuelle</li>";

  if ($exp == '')

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre expérience</li>";

  if ($formation == '')

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre niveau de formation</li>";

  if ($type_formation == '')

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre type de formation</li>";

  if ($domaine == '')

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre secteur de d'activité</li>";

  if (empty($dispo))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé votre disponibilité</li>";

  if ($mobilite == 'oui' && empty($niveau))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé le niveau de votre mobilité</li>";

  if ($mobilite == 'oui' && empty($taux))

      $msg .= "<li style='color:#FF0000'>Vous n'avez pas précisé le taux de votre mobilité</li></ul>";

    

 if(!empty($msg))

  $msg = '<div class="alert alert-error">'.$msg.'</div>';



	array_push($messages,$msg);

	

	

 

  

		

  $messages_succ=array();

		

if (isset($_POST['envoi'])) {

	

	if (!((empty($titre)) AND (empty($nom))  AND (empty($prenom))  AND (empty($adresse))  AND (empty($code))  AND (empty($ville))  AND (empty($pays))  AND (empty($date))  AND (empty($nationalite))  AND (empty($tel1))  AND (empty($situation))  AND (empty($domaine))  AND (empty($fonction))  AND (empty($salaire))  AND (empty($formation))  AND (empty($type_formation))  AND (empty($exp))  ) ){	

		

      $id_candidat = $_SESSION['abb_id_candidat'];  



         $last_connexion = date('Y-m-d');                  





	if( $msg == '') {

		$sql_updt='UPDATE candidats SET id_civi = "'.safe($civilite).'",titre = "'.safe($titre).'",nom = "'.safe($nom).'",

    prenom = "'.safe($prenom).'", adresse= "'.safe($adresse).'",code= "'.safe($code).'",ville= "'.safe($ville).'",

    id_pays= "'.safe($pays).'",date_n= "'.safe($date).'",nationalite = "'.safe($nationalite).'",tel1= "'.safe($tel1).'",tel2= "'.safe($tel2).'",

    id_situ= "'.safe($situation).'",id_expe= "'.safe($exp).'",id_nfor= "'.safe($formation).'",id_tfor= "'.safe($type_formation).'",

    id_sect= "'.safe($domaine).'",id_fonc= "'.safe($fonction).'", id_salr= "'.safe($salaire).'", id_dispo= "'.safe($dispo).'",

    mobilite= "'.safe($mobilite).'",niveau_mobilite= "'.safe($niveau).'", taux_mobilite= "'.safe($taux).'",last_connexion = "'.safe($last_connexion).'" 

    WHERE candidats_id = "'.safe($id_candidat).'"';

    

    $modifier_candidat = mysql_query($sql_updt);

	   array_push($messages_succ,"<li style='color:#468847'>Les informations personnelles ont été modifiées avec succés.</li>");



	  if ($modifier_candidat){

            $_SESSION['abb_nom'] = $prenom . '&nbsp;' . $nom ;

	}

	    

      //echo '<meta http-equiv="refresh" content="0;etape1.php" />';

      //header("location:etape1.php");

	  }

    

	}





}





?>	

	

	

	

	  <h1>INFORMATIONS PERSONNELLES</h1>

	   

	   

	    



<?php

if(isset($messages) and !empty($messages))  {

        foreach($messages as $m) 

        ?><?php    

          {     echo $m;    } 

           ?><?php

      } 

      

?>

<?php

if(isset($messages_succ) and !empty($messages_succ))  {

        foreach($messages_succ as $messages_succ) 

        ?><div class="alert alert-success"><ul><?php    

          {     echo $messages_succ;    } 

           ?></ul></div><?php

      } 

      

?>













<form id="form_standard" action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">

<?php include('etape1_m_form.php'); ?>

</form>







	</div>

 