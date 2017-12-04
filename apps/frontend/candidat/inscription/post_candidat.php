 <?php

function no_special_character_v2($chaine){  



    	$chaine=trim($chaine);



    	$chaine= strtr($chaine,"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ","aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");



    	$chaine = preg_replace('/([^.a-z0-9]+)/i', '-', $chaine);



    	return $chaine;



		}

function testDate($debut, $fin) {

   if (empty($debut) || empty($fin)) {

       $d_conct = '';

       $fin_conct = '';

   } else {

       $ddebut = explode("/", $debut);

       $dfin = explode("/", $fin);

       $d_conct = $ddebut[2] . $ddebut[1] . $ddebut[0];

       $fin_conct = $dfin[2] . $dfin[1] . $dfin[0];

   }

   if ($d_conct <= $fin_conct)

       return 1;

   else

       return 0;

        }

//if (!isset($_SESSION['abb_id_candidat']) AND $_SESSION['abb_id_candidat']!=0) $_SESSION['abb_id_candidat']=0;



		//////////////////////////////////////////////////////////////////////////////////////////////////////	 

		////////////////////////////////Récupération des données du formulaires///////////////////////////////	 

		//////////////////////////////////////////////////////////////////////////////////////////////////////		



		$titre = isset($_POST['titre'])? trim($_POST['titre']) : "";

		$titre_req = $titre;		

		

		$civilite = isset($_POST['civilite'])? trim($_POST['civilite']) : "";

		$civilite_req   =  $civilite;	



 		$nom      = isset($_POST['nom'])	 ? trim($_POST['nom'])      : "";

		$nom_req    = $nom;



 		$prenom   = isset($_POST['prenom'])  ? trim($_POST['prenom'])   : "";

		$prenom_req    = $prenom;



 		$adresse  = isset($_POST['adresse']) ? trim($_POST['adresse'])  : ""; 

		$adresse_req    = $adresse;



 		$code 	  = isset($_POST['code'])    ? trim($_POST['code'])     : "";

		$code_req    = $code;



 		$ville 	  = isset($_POST['ville'])   ? trim($_POST['ville'])    : "";

		$ville_req    = $ville;



 		$pays     = isset($_POST['pays'])    ? $_POST['pays']          	: "";

		$pays_req    = $pays;



 		$date     = isset($_POST['date'])    ? trim($_POST['date'])     : "";

		$date_req    = $date;



		$nationalite = isset($_POST['nationalite'])   ? trim($_POST['nationalite']) : "";

		$nationalite_req    = $nationalite;

		

		

		$tel1_Code     = isset($_POST['tel1_Code'])    ? trim($_POST['tel1_Code'])                 : "";

		$tel1     = isset($_POST['tel1'])    ? trim($_POST['tel1'])                 : "";

		$tel1_req    = ($tel1!='') ? $tel1_Code." ".$tel1 : "" ;

		

		

		$tel2_Code     = isset($_POST['tel2_Code'])    ? trim($_POST['tel2_Code'])                 : "";

		$tel2	  = isset($_POST['tel2'])    ? trim($_POST['tel2'])                 : "";

		$tel2_req    = ($tel2!='') ? $tel2_Code." ".$tel2 : "" ;



 		$email1   = isset($_POST['email1'])  ? trim($_POST['email1'])               : "";

		$email1_req    = $email1;



 		$mdp1     = isset($_POST['mdp1'])    ? trim($_POST['mdp1'])                 : "";

		$mdp1_req    = $mdp1;



		$mdp2     = isset($_POST['mdp2'])    ? trim($_POST['mdp2'])                 : "";

		$mdp1_req   = $mdp2;		



		$situation= isset($_POST['situation'])? $_POST['situation']					: "";

		$situation_req    = $situation;



		$exp      = isset($_POST['exp'])      ? $_POST['exp']           			: "";

		$exp_req    = $exp;



		$formation= isset($_POST['formation'])? $_POST['formation'] 				: "";

		$formation_req    = $formation;



		$type_formation= isset($_POST['type_formation']) ? $_POST['type_formation'] : "";	

		$type_formation_req   = $type_formation;



		$domaine  = isset($_POST['domaine'])    ? $_POST['domaine']      			: "";

		$domaine_req    = $domaine;



		$salaire  = isset($_POST['salaire'])    ? $_POST['salaire']      		: "";

		$salaire_req    = $salaire;



		$fonction  = isset($_POST['fonction'])    ? $_POST['fonction']      	: "";

		$fonction_req    = $fonction;

 



		$salons = isset($_POST['salons'])	? $_POST['salons']   					: "";



		$send_conditions = isset($_POST['send_conditions']) ? $_POST['send_conditions'] : "false";



		



		$dispo  = isset($_POST['dispo'])        ? $_POST['dispo']      	: "";



		$mobilite  = isset($_POST['mobilite'])  ? $_POST['mobilite']   	: "";

		

		$niveau    = isset($_POST['niveau'])    ? $_POST['niveau']     	: "";



		$taux      = isset($_POST['taux'])      ? $_POST['taux']      	: "";

		

		$arabic  = isset($_POST['ar'])     ? $_POST['ar']      	: "";

		$french  = isset($_POST['fr'])     ? $_POST['fr']      	: "";

		$english  = isset($_POST['en'])    ? $_POST['en']      	: "";



		$autre  = isset($_POST['autre'])    ?  $_POST['autre'] 	: "";	

		// htmlentities ( htmlspecialchars($_POST['autre'] , ENT_QUOTES), ENT_QUOTES)      	

		$autre_n  = isset($_POST['autre_n'])    ? $_POST['autre_n']      	: "";

		$autre1  = isset($_POST['autre1'])    ? $_POST['autre1']  	: "";

		// htmlentities ( htmlspecialchars($_POST['autre1'] , ENT_QUOTES), ENT_QUOTES)       	

		$autre1_n  = isset($_POST['autre1_n'])    ? $_POST['autre1_n']      	: "";

		$autre2  = isset($_POST['autre2'])    ?  $_POST['autre2'] 	: "";

		// htmlentities ( htmlspecialchars($_POST['autre2'] , ENT_QUOTES), ENT_QUOTES)      	   	

		$autre2_n  = isset($_POST['autre2_n'])    ? $_POST['autre2_n']      	: "";

		

$pname       = isset($_FILES['photo'])     ? $_FILES['photo']['name']       : "";

$ptmp = isset($_FILES['photo']) ? $_FILES['photo']['tmp_name'] : "";

$ptype = isset($_FILES['photo']) ? $_FILES['photo']['type'] : "";

		

$cvname       = isset($_FILES['cv'])     ? $_FILES['cv']['name']       : "";

$cvtmp = isset($_FILES['cv']) ? $_FILES['cv']['tmp_name'] : "";

$cvtype = isset($_FILES['cv']) ? $_FILES['cv']['type'] : "";

		

$lmname       = isset($_FILES['lm'])     ? $_FILES['lm']['name']       : "";

$lmtmp = isset($_FILES['lm']) ? $_FILES['lm']['tmp_name'] : "";

$lmtype = isset($_FILES['lm']) ? $_FILES['lm']['type'] : "";





//pour formation				 



//$dd_formation = isset($_POST['date_debut_formation']) ? trim($_POST['date_debut_formation']) : "";

$mois_debut_formation = isset($_POST['mois_debut_formation']) ? trim($_POST['mois_debut_formation']) : "";

$anne_debut_formation = isset($_POST['anne_debut_formation']) ? trim($_POST['anne_debut_formation']) : "";

$dd_formation =  ($mois_debut_formation!='' and $anne_debut_formation!='' ) ? $mois_debut_formation."/".$anne_debut_formation : "";

//$dd_formation = htmlspecialchars($dd_formation, ENT_QUOTES);

//$df_formation = isset($_POST['date_fin_formation']) ? trim($_POST['date_fin_formation']) : "";

$mois_fin_formation = isset($_POST['mois_fin_formation']) ? trim($_POST['mois_fin_formation']) : "";

$anne_fin_formation = isset($_POST['anne_fin_formation']) ? trim($_POST['anne_fin_formation']) : "";

$df_formation =  ($mois_fin_formation!='' and $anne_fin_formation!='' ) ? $mois_fin_formation."/".$anne_fin_formation : "";

//$df_formation = htmlspecialchars($df_formation, ENT_QUOTES);

$etablissement = isset($_POST['etablissement']) ? $_POST['etablissement'] : "";

$nom_etablissement = isset($_POST['nom_etablissement']) ?  $_POST['nom_etablissement'] : "";

//$nom_etablissement = isset($_POST['nom_etablissement']) ? htmlentities ( htmlspecialchars( $_POST['nom_etablissement'],ENT_QUOTES), ENT_QUOTES) : "";

$nivformation = isset($_POST['nivformation']) ? $_POST['nivformation'] : "";

//$diplome = isset($_POST['diplome']) ? htmlentities(htmlspecialchars(trim($_POST['diplome']),ENT_QUOTES), ENT_QUOTES) : "";

$diplome = isset($_POST['diplome']) ?  trim($_POST['diplome']) : "";

$desc_form = isset($_POST['description_formation']) ?  $_POST['description_formation'] : "";

/*

$diplome = htmlspecialchars($diplome, ENT_QUOTES);

$desc_form = isset($_POST['description_formation']) ? htmlspecialchars( $_POST['description_formation'] ,ENT_QUOTES) : "";

//*/

 



 

//pour experience

//$dd_exp = isset($_POST['date_debut']) ? trim($_POST['date_debut']) : "";

$mois_debut_experience = isset($_POST['mois_debut_experience']) ? trim($_POST['mois_debut_experience']) : "";

$annee_debut_experience = isset($_POST['annee_debut_experience']) ? trim($_POST['annee_debut_experience']) : "";

$dd_exp =  ($mois_debut_experience!='' and $annee_debut_experience!='' ) ? "01/".$mois_debut_experience."/".$annee_debut_experience : "";

//$dd_exp = htmlspecialchars($dd_exp, ENT_QUOTES);

//$df_exp = isset($_POST['date_fin']) ? trim($_POST['date_fin']) : "";

$mois_fin_experience = isset($_POST['mois_fin_experience']) ? trim($_POST['mois_fin_experience']) : "";

$anne_fin_experience = isset($_POST['anne_fin_experience']) ? trim($_POST['anne_fin_experience']) : "";

$df_exp =  ($mois_fin_experience!='' and $anne_fin_experience!='' ) ? "01/".$mois_fin_experience."/".$anne_fin_experience : "";

//$df_exp = htmlspecialchars($df_exp, ENT_QUOTES);

$today= isset($_POST['todayexp']) ? trim($_POST['todayexp']) : "";

if($today == 'oui'){$df_exp='';}



$entreprise = isset($_POST['entreprise']) ? trim($_POST['entreprise']) : "";

//$entreprise = htmlspecialchars($entreprise, ENT_QUOTES );// htmlentities ( htmlspecialchars($entreprise, ENT_QUOTES), ENT_QUOTES);

$poste = isset($_POST['poste']) ? trim($_POST['poste']) : "";

//$poste =  htmlspecialchars($poste, ENT_QUOTES );// htmlentities ( htmlspecialchars($poste, ENT_QUOTES), ENT_QUOTES);

$secteur = isset($_POST['sector']) ? $_POST['sector'] : "";

$fonction_exp = isset($_POST['fonction_exp']) ? $_POST['fonction_exp'] : "";

$type_poste = isset($_POST['type_poste']) ? $_POST['type_poste'] : "";

$ville_exp = isset($_POST['ville_exp']) ? trim($_POST['ville_exp']) : "";

//$ville_exp = htmlspecialchars($ville_exp, ENT_QUOTES);

$pays_exp = isset($_POST['pays_exp']) ? $_POST['pays_exp'] : "";

$salair_pecu = isset($_POST['salair_pecu']) ? $_POST['salair_pecu'] : "";

$desc_exp = isset($_POST['description_poste']) ? $_POST['description_poste'] : "";

/*

$desc_exp = isset($_POST['description_poste']) ? htmlspecialchars($_POST['description_poste'], ENT_QUOTES) : "";

//*/



 

	



		



		



$today= isset($_POST['today']) ? trim($_POST['today']) : "";

if($today == 'oui'){$df_formation='';}



 

		



		



		$domaine_expertise=isset($_POST['domaine_expertise']) ? $_POST['domaine_expertise'] : "";



	    /***********pour l'enregistrement dans la base de données***********/

 



		



		$description_expertise=isset($_POST['description_expertise']) ? $_POST['description_expertise'] : "";



		 /***********pour l'enregistrement dans la base de données***********/

 



		



		$domaine_projet=isset($_POST['domaine_projet']) ? $_POST['domaine_projet'] : "";

	 



		



		$description_projet=isset($_POST['description_projet']) ? $_POST['description_projet'] : "";

 



				



		$valid = "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#";	



 		$phone = "#^\d{10,14}$#";



		



		//////////////////////////////////////////////////////////////////////////////////////////////////////	



		/////////////////////////////////Validation de la conformité des données//////////////////////////////	



		//////////////////////////////////////////////////////////////////////////////////////////////////////







		$messages=array(); 

		

 



	

if (!empty($anne_debut_formation) and !empty($anne_fin_formation) and ($anne_debut_formation > $anne_fin_formation) ){

  array_push($messages, "<li style='color:#FF0000'>L'année de la date de début de formation est supérieure à la date fin</li>");

  }

elseif (!empty($anne_debut_formation) and !empty($anne_fin_formation) and !empty($mois_debut_formation) and !empty($mois_fin_formation) and ($mois_debut_formation > $mois_fin_formation and $anne_debut_formation == $anne_fin_formation)){

  array_push($messages, "<li style='color:#FF0000'>Le mois de la date de début de formation  est supérieure à la date fin</li>");

  }

  

  

  

if  (!empty($annee_debut_experience) and !empty($anne_fin_experience) and ($annee_debut_experience > $anne_fin_experience) ) {

  array_push($messages, "<li style='color:#FF0000'>L'année de la date de début de l'experience est supérieure à la date fin</li>");

  }

elseif (!empty($annee_debut_experience) and !empty($anne_fin_experience) and !empty($mois_debut_experience) and !empty($mois_fin_experience) and ($mois_debut_experience > $mois_fin_experience and $annee_debut_experience == $anne_fin_experience)) {

  array_push($messages, "<li style='color:#FF0000'>Le mois de la date de début de l'experience  est supérieure à la date fin</li>");

  }

  

   

		



			$age=16;



		$datejour = date('Y-m-d');











if ( preg_match ( '`^\d{1,2}/\d{1,2}/\d{4}$`' , $date ) )



{



	$date1 = explode('/',$date);



		if(isset($date1[2]) and isset($date1[1]) and isset($date1[0]))



		{



		$date2 = $date1[2].'-'.$date1[1].'-'.$date1[0];



		$nbrdays = (strtotime($datejour)-strtotime($date2) )/(60*60*24);



		}



		else



		$nbrdays = (strtotime($datejour)-strtotime($datejour) )/(60*60*24);



	}	







		



?>