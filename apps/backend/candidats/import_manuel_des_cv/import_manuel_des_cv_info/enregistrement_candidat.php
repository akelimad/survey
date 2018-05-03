<?php

function no_special_character_v2($chaine){  

     $chaine=trim($chaine);

     $chaine= strtr($chaine,"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ","aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");

     $chaine = preg_replace('/([^.a-z0-9]+)/i', '-', $chaine);

     return $chaine;

  }


  ////////////////////////////////////////////////////////////////////////////////////////////////////// 

  ////////////////////////////////Récupération des données du formulaires/////////////////////////////// 

  //////////////////////////////////////////////////////////////////////////////////////////////////////  

  /*
  $type_candidatur= isset($_POST['type_candidatur'])? $_POST['type_candidatur']     : "";


  $type_p1= isset($_POST['type_p1'])? $_POST['type_p1']     : "";

  $type_p2= isset($_POST['type_p2'])? $_POST['type_p2']     : "";

  $type_p3= isset($_POST['type_p3'])? $_POST['type_p3']     : "";

  $type_p4= isset($_POST['type_p4'])? $_POST['type_p4']     : ""; 

  
  
  $civilite = isset($_POST['civilite'])? trim($_POST['civilite']) : "";

   $nom      = isset($_POST['nom'])  ? trim($_POST['nom'])      : "";

   $prenom   = isset($_POST['prenom'])  ? trim($_POST['prenom'])   : "";

   $adresse  = isset($_POST['adresse']) ? trim($_POST['adresse'])  : ""; 

   $code    = isset($_POST['code'])    ? trim($_POST['code'])     : "";

   $ville    = isset($_POST['ville'])   ? trim($_POST['ville'])    : "";

   $pays     = isset($_POST['pays'])    ? $_POST['pays']           : "";

   $date     = isset($_POST['date'])    ? trim($_POST['date'])     : "";

  $nationalite = isset($_POST['nationalite'])   ? trim($_POST['nationalite']) : "";

  $tel1     = isset($_POST['tel1'])    ? trim($_POST['tel1'])                 : "";

  $tel2   = isset($_POST['tel2'])    ? trim($_POST['tel2'])                 : "";

   $email1   = isset($_POST['email1'])  ? trim($_POST['email1'])               : "";

   $mdp1     = isset($_POST['mdp1'])    ? trim($_POST['mdp1'])                 : "";

  $mdp2     = isset($_POST['mdp2'])    ? trim($_POST['mdp2'])                 : "";

  $situation= isset($_POST['situation'])? $_POST['situation']     : "";

  $exp      = isset($_POST['exp'])      ? $_POST['exp']              : "";

  $fonction_req=$formation= isset($_POST['formation'])? $_POST['formation']     : "";

  $type_formation= isset($_POST['type_formation']) ? $_POST['type_formation'] : ""; 

  $domaine  = isset($_POST['domaine'])    ? $_POST['domaine']         : "";

  $salaire  = isset($_POST['salaire'])    ? $_POST['salaire']        : "";

  $fonction  = isset($_POST['fonction'])    ? $_POST['fonction']       : "";

  $nl_emploi_req=$nl_emploi = isset($_POST['nl_emploi']) ? $_POST['nl_emploi']               : "false";

  $nl_partenaire_req=$nl_partenaire = isset($_POST['nl_partenaire']) ? $_POST['nl_partenaire']   : "false";

  $salons = isset($_POST['salons']) ? $_POST['salons']        : "";

  $send_conditions = isset($_POST['send_conditions']) ? $_POST['send_conditions'] : "false";
  
  
//////////// ---------------------------------------------------------------------- ///////////////
//pour fiche
$titre = isset($_POST['titre']) ? trim($_POST['titre']) : "";
$titre = htmlspecialchars($titre);
$pname       = isset($_FILES['photo'])     ? $_FILES['photo']['name']                : "";
$ptmp = isset($_FILES['photo']) ? $_FILES['photo']['tmp_name'] : "";
$ptype = isset($_FILES['photo']) ? $_FILES['photo']['type'] : "";
$arabic = isset($_POST['ar']) ? $_POST['ar'] : "";
$french = isset($_POST['fr']) ? $_POST['fr'] : "";
$english = isset($_POST['en']) ? $_POST['en'] : "";
$autre = isset($_POST['autre']) ? trim($_POST['autre']) : "";
$autre = htmlspecialchars($autre);
$dispo = isset($_POST['dispo']) ? $_POST['dispo'] : "";
$mobilite = isset($_POST['mobilite']) ? $_POST['mobilite'] : "non";
$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : "";
$taux = isset($_POST['taux']) ? $_POST['taux'] : "";



//pour formation
$dd_formation = isset($_POST['date_debut_formation']) ? trim($_POST['date_debut_formation']) : "";
$dd_formation = htmlspecialchars($dd_formation);

$etablissement = isset($_POST['etablissement']) ? trim($_POST['etablissement']) : "";
$nom_etablissement = isset($_POST['nom_etablissement']) ? trim($_POST['nom_etablissement']) : "";
$nivformation = isset($_POST['nivformation']) ? trim($_POST['nivformation']) : "";
$diplome = isset($_POST['diplome']) ? trim($_POST['diplome']) : "";
$diplome = htmlspecialchars($diplome);
$desc_form = isset($_POST['description_formation']) ? trim(nl2br($_POST['description_formation'])) : "";

 

 
//pour experience
$dd_exp = isset($_POST['date_debut']) ? trim($_POST['date_debut']) : "";
$dd_exp = htmlspecialchars($dd_exp);
$df_exp = isset($_POST['date_fin']) ? trim($_POST['date_fin']) : "";
$df_exp = htmlspecialchars($df_exp);
$entreprise = isset($_POST['entreprise']) ? trim($_POST['entreprise']) : "";
$entreprise = htmlspecialchars($entreprise);
$poste = isset($_POST['poste']) ? trim($_POST['poste']) : "";
$poste = htmlspecialchars($poste);
$secteur = isset($_POST['sector']) ? $_POST['sector'] : "";
$fonction_exp = isset($_POST['fonction_exp']) ? $_POST['fonction_exp'] : "";
$type_poste = isset($_POST['type_poste']) ? $_POST['type_poste'] : "";
$ville_exp = isset($_POST['ville_exp']) ? trim($_POST['ville_exp']) : "";
$ville_exp = htmlspecialchars($ville_exp);
$pays_exp = isset($_POST['pays_exp']) ? $_POST['pays_exp'] : "";
$salair_pecu = isset($_POST['salair_pecu']) ? $_POST['salair_pecu'] : "";
$desc_exp = isset($_POST['description_poste']) ? trim(nl2br($_POST['description_poste'])) : "";*/
$type_candidatur= isset($_POST['type_candidatur'])? $_POST['type_candidatur']     : "";
 

  $type_p1= isset($_POST['type_p1'])? $_POST['type_p1']     : "";

  $type_p2= isset($_POST['type_p2'])? $_POST['type_p2']     : "";

  $type_p3= isset($_POST['type_p3'])? $_POST['type_p3']     : "";

  $type_p4= isset($_POST['type_p4'])? $_POST['type_p4']     : ""; 


  //echo $type_candidatur;
  //echo $type_p1 ."<br/>";
  //echo $type_p2 ."<br/>";
  //echo $type_p3 ."<br/>";
  //echo $type_p4 ."<br/>";

$df_formation = isset($_POST['date_fin_formation']) ? trim($_POST['date_fin_formation']) : "";
$df_formation = htmlspecialchars($df_formation);
$dd_formation = isset($_POST['date_debut_formation']) ? trim($_POST['date_debut_formation']) : "";
$dd_formation = htmlspecialchars($dd_formation);

$titre = isset($_POST['titre'])? trim($_POST['titre']) : "";
  $titre_req = $titre;  
  
  $civilite = isset($_POST['civilite'])? trim($_POST['civilite']) : "";
  $civilite_req   =  $civilite; 

   $nom      = isset($_POST['nom'])  ? trim($_POST['nom'])      : "";
  $nom_req    = $nom;

   $prenom   = isset($_POST['prenom'])  ? trim($_POST['prenom'])   : "";
  $prenom_req    = $prenom;

   $adresse  = isset($_POST['adresse']) ? trim($_POST['adresse'])  : ""; 
  $adresse_req    = $adresse;

   $code    = isset($_POST['code'])    ? trim($_POST['code'])     : "";
  $code_req    = $code;

   $ville    = isset($_POST['ville'])   ? trim($_POST['ville'])    : "";
  $ville_req    = $ville;

   $pays     = isset($_POST['pays'])    ? $_POST['pays']           : "";
  $pays_req    = $pays;

   $date     = isset($_POST['date'])    ? trim($_POST['date'])     : "";
  $date_req    = $date;

  $nationalite = isset($_POST['nationalite'])   ? trim($_POST['nationalite']) : "";
  $nationalite_req    = $nationalite;
  
  
  $tel1_Code     = isset($_POST['tel1_Code'])    ? trim($_POST['tel1_Code'])                 : "";
  $tel1     = isset($_POST['tel1'])    ? trim($_POST['tel1'])                 : "";
  $tel1_req    = ($tel1!='') ? $tel1_Code." ".$tel1 : "" ;
  
  
  $tel2_Code     = isset($_POST['tel2_Code'])    ? trim($_POST['tel2_Code'])                 : "";
  $tel2   = isset($_POST['tel2'])    ? trim($_POST['tel2'])                 : "";
  $tel2_req    = ($tel2!='') ? $tel2_Code." ".$tel2 : "" ;

   $email1   = isset($_POST['email1'])  ? trim($_POST['email1'])               : "";
  $email1_req    = $email1;

   $mdp1     = isset($_POST['mdp1'])    ? trim($_POST['mdp1'])                 : "";
  $mdp1_req    = $mdp1;

  $mdp2     = isset($_POST['mdp2'])    ? trim($_POST['mdp2'])                 : "";
  $mdp1_req   = $mdp2;  

  $situation= isset($_POST['situation'])? $_POST['situation']     : "";
  $situation_req    = $situation;

  $exp      = isset($_POST['exp'])      ? $_POST['exp']              : "";
  $exp_req    = $exp;

  $formation= isset($_POST['formation'])? $_POST['formation']     : "";
  $formation_req    = $formation;

  $type_formation= isset($_POST['type_formation']) ? $_POST['type_formation'] : ""; 
  $type_formation_req   = $type_formation;

  $domaine  = isset($_POST['domaine'])    ? $_POST['domaine']         : "";
  $domaine_req    = $domaine;

  $salaire  = isset($_POST['salaire'])    ? $_POST['salaire']        : "";
  $salaire_req    = $salaire;

  $fonction  = isset($_POST['fonction'])    ? $_POST['fonction']       : "";
  $fonction_req    = $fonction;
 

  $salons = isset($_POST['salons']) ? $_POST['salons']        : "";

  $send_conditions = isset($_POST['send_conditions']) ? $_POST['send_conditions'] : "false";

  

  $dispo  = isset($_POST['dispo'])        ? $_POST['dispo']       : "";

  $mobilite  = isset($_POST['mobilite'])  ? $_POST['mobilite']    : "";
  
  $niveau    = isset($_POST['niveau'])    ? $_POST['niveau']      : "";

  $taux      = isset($_POST['taux'])      ? $_POST['taux']       : "";
  
  $arabic  = isset($_POST['ar'])     ? $_POST['ar']       : "";
  $french  = isset($_POST['fr'])     ? $_POST['fr']       : "";
  $english  = isset($_POST['en'])    ? $_POST['en']       : "";

  $autre  = isset($_POST['autre'])    ?  $_POST['autre']  : ""; 
  // htmlentities ( htmlspecialchars($_POST['autre'] , ENT_QUOTES), ENT_QUOTES)       
  $autre_n  = isset($_POST['autre_n'])    ? $_POST['autre_n']       : "";
  $autre1  = isset($_POST['autre1'])    ? $_POST['autre1']   : "";
  // htmlentities ( htmlspecialchars($_POST['autre1'] , ENT_QUOTES), ENT_QUOTES)        
  $autre1_n  = isset($_POST['autre1_n'])    ? $_POST['autre1_n']       : "";
  $autre2  = isset($_POST['autre2'])    ?  $_POST['autre2']  : "";
  // htmlentities ( htmlspecialchars($_POST['autre2'] , ENT_QUOTES), ENT_QUOTES)           
  $autre2_n  = isset($_POST['autre2_n'])    ? $_POST['autre2_n']       : "";
  
$pname       = isset($_FILES['photo'])     ? $_FILES['photo']['name']       : "";
$ptmp = isset($_FILES['photo']) ? $_FILES['photo']['tmp_name'] : "";
$ptype = isset($_FILES['photo']) ? $_FILES['photo']['type'] : "";

//$cvname       = isset($_FILES['file'])     ? $_FILES['file']['name']       : "";
//$cvtmp = isset($_FILES['file']) ? $_FILES['file']['tmp_name'] : "";
//$cvtype = isset($_FILES['file']) ? $_FILES['file']['type'] : "";


  
$lmname       = isset($_FILES['lm'])     ? $_FILES['lm']['name']       : "";
$lmtmp = isset($_FILES['lm']) ? $_FILES['lm']['tmp_name'] : "";
$lmtype = isset($_FILES['lm']) ? $_FILES['lm']['type'] : "";


//pour formation     

//$dd_formation = isset($_POST['date_debut_formation']) ? trim($_POST['date_debut_formation']) : "";
$mois_debut_formation = isset($_POST['mois_debut_formation']) ? trim($_POST['mois_debut_formation']) : "";
$anne_debut_formation = isset($_POST['anne_debut_formation']) ? trim($_POST['anne_debut_formation']) : "";
//$dd_formation =  ($mois_debut_formation!='' and $anne_debut_formation!='' ) ? $mois_debut_formation."/".$anne_debut_formation : "";
//$dd_formation = htmlspecialchars($dd_formation, ENT_QUOTES);
//$df_formation = isset($_POST['date_fin_formation']) ? trim($_POST['date_fin_formation']) : "";
$mois_fin_formation = isset($_POST['mois_fin_formation']) ? trim($_POST['mois_fin_formation']) : "";
$anne_fin_formation = isset($_POST['anne_fin_formation']) ? trim($_POST['anne_fin_formation']) : "";
//$df_formation =  ($mois_fin_formation!='' and $anne_fin_formation!='' ) ? $mois_fin_formation."/".$anne_fin_formation : "";
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
$dd_exp = isset($_POST['date_debut']) ? trim($_POST['date_debut']) : "";
$dd_exp = htmlspecialchars($dd_exp);
//$dd_exp =  ($mois_debut_experience!='' and $annee_debut_experience!='' ) ? "01/".$mois_debut_experience."/".$annee_debut_experience : "";
//$dd_exp = htmlspecialchars($dd_exp, ENT_QUOTES);
//$df_exp = isset($_POST['date_fin']) ? trim($_POST['date_fin']) : "";
$mois_fin_experience = isset($_POST['mois_fin_experience']) ? trim($_POST['mois_fin_experience']) : "";
$anne_fin_experience = isset($_POST['anne_fin_experience']) ? trim($_POST['anne_fin_experience']) : "";
//$df_exp =  ($mois_fin_experience!='' and $anne_fin_experience!='' ) ? "01/".$mois_fin_experience."/".$anne_fin_experience : "";
//$df_exp = htmlspecialchars($df_exp, ENT_QUOTES);
$df_exp = isset($_POST['date_fin']) ? trim($_POST['date_fin']) : "";
$df_exp = htmlspecialchars($df_exp);
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

   $phone =  "#^\d{7,14}$#";  /*"^(?\d{4}\)?\d{7,14}$";  "^(\+0?1\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$";   "#^\d{10,14}$#";  */

  

  //////////////////////////////////////////////////////////////////////////////////////////////////////  
  /////////////////////////////////Validation de la conformité des données//////////////////////////////  
  //////////////////////////////////////////////////////////////////////////////////////////////////////



  $messages=array(); 

  

  

   $age=16;

  $datejour = date('Y-m-d');





if ( preg_match ( '`^\d{1,2}/\d{1,2}/\d{4}$`' , $date ) )

{
 
 //date in mm/dd/yyyy format; or it can be in other formats as well
  //$birthDate = "12/17/1983";
  $birthDate = $date;
  //explode the date to get month, day and year
  $birthDate = explode("/", $birthDate);
  //get age from date or birthdate
  $age_cl = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
 // echo "Age is:" . $age;

 

  if($birthDate[0]<1 OR $birthDate[0]>31)   
   array_push($messages,"<li style='color:#FF0000'>Date de naissance et non valide</li>");
 

  if($birthDate[1]<1 OR $birthDate[1]>12)
   array_push($messages,"<li style='color:#FF0000'>Date de naissance et non valide </li>");
 
  if($birthDate[2]<1900 OR $birthDate[2]>2050)
   array_push($messages,"<li style='color:#FF0000'>Date de naissance et non valide </li>");
 

  if($age_cl<16)   
   array_push($messages,"<li style='color:#FF0000'>Votre &acirc;ge doit &ecirc;tre sup&eacute;rieur  &agrave;  16 ans pour s&acute;inscrire sur le  site </li>");

 
  if($age_cl>55)
   array_push($messages,"<li style='color:#FF0000'>Votre &acirc;ge doit &ecirc;tre inf&eacute;rieur   &agrave;  55 ans pour s&acute;inscrire sur le site </li>");

 


}

else

{ 

  

  }















  

 
      

                            //$date_valid = '`^\d{1,2}/\d{1,2}/\d{4}$`'; 


//////////// --------------------------------- validation upload file ------------------------------------- ///////////////       
$errorUpload = ""; 
if (isset($_FILES["upload1"])) {
    $allowedExts = array("doc", "docx", "pdf", "odt");
    $temp = explode(".", $_FILES["upload1"]["name"][0]);
    $extension = end($temp);
 
    if ($_FILES["upload1"]["error"][0] > 0) {
        $errorUpload .= "Error opening the file | ";
    }
    if ( $_FILES["upload1"]["type"][0] != "application/pdf" &&
            $_FILES["upload1"]["type"][0] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
            $_FILES["upload1"]["type"][0] != "application/msword" &&
            $_FILES["upload1"]["type"][0] != "application/vnd.oasis.opendocument.text") {    
        $errorUpload .= "Mime type not allowed | ";
    }
    if (!in_array($extension, $allowedExts)) {
        $errorUpload .= "Extension not allowed | ";
    }
    if ($_FILES["upload1"]["size"][0] > 102400) {
        $errorUpload .= "upload1 size shoud be less than 100 kB  ";
    }
 
 
}   
//////////// ---------------------------------------------------------------------- ///////////////  

  

  

  

  
/*
  $civilite_req   =  str_replace("'","\'",$civilite);

  $nom_req    =  str_replace("'","\'",$nom );

  $prenom_req    =  str_replace("'","\'",$prenom);

  $adresse_req    =  str_replace("'","\'",$adresse);

  $code_req    =  str_replace("'","\'",$code);

  $ville_req    =  str_replace("'","\'",$ville);

  $pays_req    =  str_replace("'","\'",$pays);

  $date_req    =  str_replace("'","\'",$date);

  $nationalite_req    =  str_replace("'","\'",$nationalite);

  $tel1_req    =  str_replace("'","\'",$tel1);

  $tel2_req    =  str_replace("'","\'",$tel2);

  $email1_req    =  str_replace("'","\'",$email1);

  $situation_req    =  str_replace("'","\'",$situation);

  $exp_req    =  str_replace("'","\'",$exp);

  $formation_req    =  str_replace("'","\'",$formation);

  $type_formation_req   =  str_replace("'","\'",$type_formation);

  $domaine_req    =  str_replace("'","\'",$domaine);

  $salaire_req    =  str_replace("'","\'",$salaire);
 
  $mdp1_req    =  str_replace("'","\'",$mdp1);

  $mdp1_req   =  str_replace("'","\'",$mdp1);*/

  
require_once dirname(__FILE__) . "/../../../../../config/config.php";
$mdp = md5($mdp1);
$mdp_req = $mdp;
$CVdateMAJ=date("Y-m-d")." ".date("H:i:s");
 $last_connexion = "0000-00-00";
 $date_inscription = date('Y-m-d');
  $prename = ucfirst($prenom_req);

		 $prename =htmlspecialchars($prename, ENT_QUOTES);

	  	 $name = strtoupper($nom_req);


  $insertion = getDB()->create('candidats', [
    'id_civi' => intval($civilite_req),
    'titre' => $titre_req,
    'nom' => $name,
    'prenom' => $prename,
    'adresse' => $adresse_req,
    'code' => $code_req,
    'ville' => intval($ville_req),
    'id_pays' => intval($pays_req),
    'date_n' => $date_req,
    'nationalite' => $nationalite_req,
    'tel1' => $tel1_req,
    'tel2' => $tel2_req,
    'email' => $email1_req, 
    'mdp' => $mdp_req,
    'id_situ' => intval($situation_req),
    'id_expe' => intval($exp_req),
    'id_nfor' => intval($formation_req),
    'id_tfor' => intval($type_formation_req),
    'id_sect' => intval($domaine_req),
    'id_fonc' => intval($fonction_req),
    'id_salr' => intval($salaire_req),
    'id_dispo' => intval($dispo),
    'mobilite' => $mobilite,
    'niveau_mobilite' => $niveau,
    'taux_mobilite' => $taux,
    'arabic' => $arabic,
    'french' => $french,
    'english' => $english,
    'autre' => $autre,
    'autre_n' => $autre_n,
    'autre1' => $autre1,
    'autre1_n' => $autre1_n,
    'autre2' => $autre2,
    'autre2_n' => $autre2_n,
    'nl_partenaire' => $mdp1,
    'date_inscription' => $date_inscription,
    'status' => 2,
    'last_connexion' => null,
    'CVdateMAJ' => $CVdateMAJ
  ]);

  /*$sql_candidat = 'INSERT INTO candidats    
(id_civi, titre, nom, prenom, adresse, code, ville, id_pays, date_n, nationalite, tel1, tel2, email, 
mdp, id_situ, id_expe, id_nfor, id_tfor, id_sect, id_fonc, id_salr, id_dispo  , mobilite, niveau_mobilite , taux_mobilite,arabic,french,english,autre,autre_n,autre1,autre1_n,autre2,autre2_n , nl_partenaire, date_inscription, status, last_connexion, CVdateMAJ) 
VALUES ("'. intval($civilite_req).'", "'.safe($titre_req).'", "'.safe($name).'", "'.safe($prename).'", "'.safe($adresse_req).'",
 "'.safe($code_req).'", "'.safe($ville_req).'", "'. intval($pays_req).'", "'.safe($date_req).'", "'.safe($nationalite_req).'",
  "'.safe($tel1_req).'", "'.safe($tel2_req).'","'.safe($email1_req).'", "'.safe($mdp_req).'", "'.safe($situation_req).'",
   "'.safe($exp_req).'","'.safe($formation_req).'", "'.safe($type_formation_req).'","'.safe($domaine_req).'",
   "'.safe($fonction_req).'","'.safe($salaire_req).'","'.safe($dispo).'","'.safe($mobilite).'","'.safe($niveau).'",
   "'.safe($taux).'","'.safe($arabic).'","'.safe($french).'","'.safe($english).'","'.safe($autre).'","'.safe($autre_n).'",
   "'.safe($autre1).'","'.safe($autre1_n).'","'.safe($autre2).'","'.safe($autre2_n).'",  "'.safe($mdp1).'",  "'.safe($date_inscription).'",
    "2", "'.safe($last_connexion).'", "'.safe($CVdateMAJ).'")';
//echo $sql_candidat."</br>";
  $insertion = mysql_query($sql_candidat);
  //echo $insertion;*/
  
                                                                                                                                                   
 $succes3='ok';
          
                       $max_cand = mysql_query("SELECT max(candidats_id) as maximum from candidats ");
          $max_rcand = mysql_fetch_assoc($max_cand);
          $id_max = $max_rcand ['maximum'];
          
         $cvname=   $_SESSION['f_name0'] ;
          
            // echo $cvname."</br>";


         $insertion_cv = getDB()->create('cv_importe', [
          'candidats_id' => intval($id_max),
          'id_role' => intval($type_candidatur),
          'mail' => $email1_req,
          'description_stage' => $type_p1,
          'description_offre' => $type_p3,
          'description_cvrecu' => $type_p4
         ]);



  /*$insertion_cv1 = 'INSERT INTO `cv_importe`(`candidats_id`, `id_role`, `mail`, `description_stage`, `description_offre`, `description_cvrecu`)  VALUES ("'.safe($id_max).'","'.safe($type_candidatur).'",
  "'.safe($email1_req).'","'.safe($type_p1).'",
  "'.safe($type_p3).'","'.safe($type_p4).'")';

echo $insertion_cv1;exit;
//echo $insertion_cv1."</br>";
$insertion_cv = mysql_query($insertion_cv1);*/




                                                                                                         $nomformate = no_special_character_v2($nom);
										$prenomformate = no_special_character_v2($prenom);

                                                                                                           $ext_cv = pathinfo($_SESSION['f_name0'] , PATHINFO_EXTENSION);
										   $cvname = rand()."CV".$prenomformate.$nomformate.'.'.$ext_cv;
										   //$_SESSION['pname'] = $pname;
										$extensions_file = array('.pdf', '.doc', '.docx', '.rtf','.PDF', '.DOC', '.DOCX', '.RTF'  );
										$extension_cv = strrchr($_SESSION['f_name0'], '.'); 
                       
										if (in_array($extension_cv, $extensions_file)) {  
											$folder_cv = dirname(__FILE__).$file_cv5;
										   $cv = $folder_cv . $cvname;
										   //echo $file_cv4."--1cvvvvv<br/>";
 										 //echo $cv."--1cv<br/>";
										 //echo $folder_cv."--1source";
   										$cvtmp=$_SESSION['f_name0'];
										   ////copy($cvtmp, $cv);
										   //echo $cvtmp."--1source";
										  // $file = 'assets/cv.pdf';
										   //$newfile = 'assets/cv-copy.pdf';

										   copy(site_base('apps/upload/backend/cv_import_uploads/'. basename($_SESSION['f_name'])), site_base('apps/upload/frontend/cv/'. $cvname));
	
								   
       
         if($ext_cv!="")
          $insertion3 = getDB()->create('cv', [
            'candidats_id' => $id_max,
            'titre_cv' => $cvname,
            'lien_cv' => $cvname,
            'principal' => 1,
            'actif' => 1
          ]);


          // $insertion3 = mysql_query("INSERT into cv values('','".safe($id_max)."','".safe($cvname)."','".safe($cvname)."','1','1')");
          
          //echo  $insertion3."</br>";
          }
            //echo $cv."cv<br/>";
										   //echo $folder_cv."source";
       
        $insertion_formation1 = getDB()->create('formations', [
          'candidats_id' => intval($id_max),
          'id_ecol' => intval($etablissement),
          'date_debut' => $dd_formation,
          'date_fin' => $df_formation,
          'diplome' => $diplome,
          'description' => $desc_form,
          'nivformation' => $nivformation,
          'ecole' => $nom_etablissement
        ]);
 
 /*$insertion_formation1 = mysql_query('INSERT INTO formations VALUES ("","'.safe($id_max).'","'.safe($etablissement).'","'.safe($dd_formation).'",
  "'.safe($df_formation).'","'.safe($diplome).'","'.safe($desc_form).'","'.safe($nivformation).'","'.safe($nom_etablissement).'" )');*/
   //echo $insertion_formation1."</br>";
    
    
    
    
    $insertion_exp1 = getDB()->create('experience_pro', [
      'candidats_id' => intval($id_max),
      'id_sect' => intval($secteur),
      'id_fonc' => intval($fonction_exp),
      'id_tpost' => intval($type_poste),
      'id_pays' => intval($pays_exp),
      'date_debut' => $dd_exp,
      'date_fin' => $df_exp,
      'poste' => $poste,
      'entreprise' => $entreprise,
      'ville' => $ville_exp,
      'description' => $desc_exp,
      'salair_pecu' => intval($salair_pecu)
    ]);
   
 /*$insertion_exp1 = mysql_query('INSERT INTO experience_pro VALUES ("","'.safe($id_max).'","'.safe($secteur).'",
  "'.safe($fonction_exp).'","'.safe($type_poste).'","'.safe($pays_exp).'",
  "'.safe($dd_exp).'","'.safe($df_exp).'","'.safe($poste).'","'.safe($entreprise).'","'.safe($ville_exp).'","'.safe($desc_exp).'","'.safe($salair_pecu).'")')*/;
//echo insertion_exp1."</br>";
     

  







 
 include("./enregistrement_candidat_email_1.php");
 
 
  
    //exit;

    

   

   



   


    //$insertion = $sql_req
    //echo $insertion;

    //$succes2 = mysql_affected_rows();
array_push($messages," <center><li style='color:#00D936;display: block;'>Candidate ".$nom." ".$prenom." a été ajoute avec succès sur la base des candidats </li> </center><br>");
     array_push($messages,'<meta http-equiv="refresh" content="4;URL=../">');

?>
<meta http-equiv="refresh" content="0;URL=../">