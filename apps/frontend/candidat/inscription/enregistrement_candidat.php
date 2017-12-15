<?php
$messagesuc=array();

function no_special_character_v2($chaine){  



    	$chaine=trim($chaine);



    	$chaine= strtr($chaine,"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ","aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");



    	$chaine = preg_replace('/([^.a-z0-9]+)/i', '-', $chaine);



    	return $chaine;



		} 



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



 		$phone =  "#^\d{7,14}$#";  /*"^(?\d{4}\)?\d{7,14}$";  "^(\+0?1\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$";   "#^\d{10,14}$#";  */



		



		//////////////////////////////////////////////////////////////////////////////////////////////////////	 

		/////////////////////////////////Validation de la conformité des données//////////////////////////////	 

		//////////////////////////////////////////////////////////////////////////////////////////////////////







		// $messages=array(); 



		



		



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



{	array_push($messages,"<li style='color:#FF0000'>Format de la date de naissance non valide, veuillez saisir le bon format de la date (JJ/MM/AAAA). </li>");



		



		}































		



	if(empty($civilite)){ array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; la civilit&eacute;</li>");}



	if(empty($nom)){ array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre nom</li>");}



	if(empty($prenom)){ array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre prenom</li>");}



	if(empty($adresse)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre adresse</li>");} 



	if(empty($ville)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; la ville</li>");}



	if(empty($pays)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre pays de r&eacute;sidence</li>");}



	if(empty($date)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre date de naissance</li>");}



	if(empty($nationalite)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre nationalit&eacute;</li>");}



	if(empty($tel1)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre num&eacute;ro de t&eacute;l&eacute;phone </li>");}



	if(!preg_match($phone,$tel1)){array_push($messages,"<li style='color:#FF0000'>Le num&eacute;ro de t&eacute;l&eacute;phone doit comporter seulement entre 7 et 14 chiffres, sans espaces ni tirets </li>");}



	if(empty($email1)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre adresse email </li>");}



	if(!preg_match($valid,$email1)){array_push($messages,"<li style='color:#FF0000'>Adresse e-mail non valide</li>");}



		



	if(!empty($email1) && preg_match($valid,$email1))



	{



			



			$envoi = mysql_query("SELECT * FROM candidats WHERE email = '".safe($email1_req)."' and mdp!='' ");



	   		$count = mysql_num_rows($envoi); 



			$abonement = mysql_query("SELECT * FROM candidats WHERE email = '".safe($email1_req)."' and mdp=''");



	   		$count_abonement = mysql_num_rows($abonement);

 

			



	   		if($count) {



				



			$envoi1 = mysql_query("SELECT * FROM candidats WHERE email = '".safe($email1_req)."' and mdp!='' and status=0 ");



	   		$count1 = mysql_num_rows($envoi1);



			if($count1)



			{



				$_SESSION["desactive"]=true;	$exist = true; 



			if(!isset($_POST['activer']))



			{



	



		array_push($messages,"   <div id='repertoire'>



                <div id='fils'>



                  <div id='fade'></div>



                  <div class='popup_block'  style='width: 400px; z-index: 999; top: 30%; left: 32%;' >



                    <div class='titleBar'>



                      <div class='title'>R&eacute;activation de votre compte</div>



                      <a href='javascript:fermer()'>



                      <div class='close' style='cursor: pointer;'>close</div>



                      </a> </div>



                    <div id='content' class='content'>



                      <form name= 'F1' action='' method='post' id='formpopup'>



							  <input type='hidden' name='civilite' value='$civilite'>



							   <input type='hidden' name='nom' value='$nom'>



							    <input type='hidden' name='prenom' value='$prenom'>



								 <input type='hidden' name='adresse' value='$adresse'>



								  <input type='hidden' name='code' value='$code'>



								   <input type='hidden' name='ville' value='$ville'>



								    <input type='hidden' name='pays' value='$pays'>



									 <input type='hidden' name='date' value='$date'>



									 <input type='hidden' name='nationalite' value='$nationalite'>



									 <input type='hidden' name='tel1' value='$tel1'>



									 <input type='hidden' name='tel2' value='$tel2'>



									 <input type='hidden' name='email1' value='$email1'>



									 <input type='hidden' name='mdp1' value='$mdp1'>



									 <input type='hidden' name='mdp2' value='$mdp2'>



									 <input type='hidden' name='situation' value='$situation'>



									 <input type='hidden' name='exp' value='$exp'>



									 <input type='hidden' name='formation' value='$formation'>



									 	 <input type='hidden' name='type_formation' value='$type_formation'>



										 	 <input type='hidden' name='domaine' value='$domaine'>



											 	 <input type='hidden' name='salaire' value='$salaire'>



												 	 <!-- <input type='hidden' name='fonction' value='$fonction'> 



													 	 <input type='hidden' name='nl_emploi' value='$nl_emploi'>



														 	 <input type='hidden' name='nl_partenaire' value='$nl_partenaire'>-->



															 <input type='hidden' name='salons' value='$salons'>



															 <input type='hidden' name='domaine_expertise' value='$domaine_expertise'>



															 <input type='hidden' name='description_expertise' value='$description_expertise'>



															 <input type='hidden' name='domaine_projet' value='$domaine_projet'>



															 	 <input type='hidden' name='description_projet' value='$description_projet'>



																 <input type='hidden' name='activer' value='activer'>



                        <table border='0' cellspacing='0' cellpadding='2'>



                          <tr>



                            <th scope='row' colspan='2'><div align='left'>Vous avez d&eacute;j&agrave; un compte d&eacute;sactiv&eacute; sur le site. souhaiter vous l&#039;activer?</div></th>



                          </tr>



       <tr>



             <th scope='row'></th>



        <td><input name='oui'  value='oui'  type='submit'style='width:40px; margin-right:10px;' /><input name='envoi' value='Non, je veux cr&eacute;er un nouveau compte'  type='submit'  onclick='fermer()'/>







                    </td>      







                          </tr>







                        </table>







                      </form>







                    </div>







                  </div>







                </div>







              </div>");



			  }

 

			}



			else



			{



	$exist = true; 	array_push($messages,"   <div id='repertoire'>



                <div id='fils'>



                  <div id='fade'></div>



                  <div class='popup_block'  style='width: 430px; z-index: 999; top: 30%; left: 32%;height: 140px;' >



                    <div class='titleBar'>



                      <div class='title'>Acc&eacute;der &agrave; votre compte</div>



                      <a href='javascript:fermer()'>



                      <div class='close' style='cursor: pointer;background-image:url(../../../assets/images/close-b.jpg);background-repeat: no-repeat;'>close</div>



                      </a> </div>



                    <div id='content' class='content' style=' height: 80px; ' >



                      <form name= 'F1' action='./' method='post' id='formpopup'>



							  <input type='hidden' name='civilite' value='$civilite'>



							   <input type='hidden' name='nom' value='$nom'>



							    <input type='hidden' name='prenom' value='$prenom'>



								 <input type='hidden' name='adresse' value='$adresse'>



								  <input type='hidden' name='code' value='$code'>



								   <input type='hidden' name='ville' value='$ville'>



								    <input type='hidden' name='pays' value='$pays'>



									 <input type='hidden' name='date' value='$date'>



									 <input type='hidden' name='nationalite' value='$nationalite'>



									 <input type='hidden' name='tel1' value='$tel1'>



									 <input type='hidden' name='tel2' value='$tel2'>



									 <input type='hidden' name='email1' value='$email1'>



									 <input type='hidden' name='mdp1' value='$mdp1'>



									 <input type='hidden' name='mdp2' value='$mdp2'>



									 <input type='hidden' name='situation' value='$situation'>



									 <input type='hidden' name='exp' value='$exp'>



									 <input type='hidden' name='formation' value='$formation'>



									 	 <input type='hidden' name='type_formation' value='$type_formation'>



										 	 <input type='hidden' name='domaine' value='$domaine'>



											 	 <input type='hidden' name='salaire' value='$salaire'>



												 	 <!-- <input type='hidden' name='fonction' value='$fonction'>



													 	 <input type='hidden' name='nl_emploi' value='$nl_emploi'>



														 	 <input type='hidden' name='nl_partenaire' value='$nl_partenaire'> -->



															 <input type='hidden' name='salons' value='$salons'>



															 <input type='hidden' name='domaine_expertise' value='$domaine_expertise'>



															 <input type='hidden' name='description_expertise' value='$description_expertise'>



															 <input type='hidden' name='domaine_projet' value='$domaine_projet'>



															 	 <input type='hidden' name='description_projet' value='$description_projet'>



																 <input type='hidden' name='activer' value='activer'>



                        <table border='0' cellspacing='0' cellpadding='2'>



                          <tr>



                            <th scope='row' colspan='2'><div align='left' style='text-align:justify;padding-left:5px;'> Votre email est d&eacute;ja associ&eacute; &agrave; un compte sur le site.\n Vous pouvez cr&eacute;er un nouveau compte en utilisant un autre email ou vous connecter en utilisant le compte existant</div></th>



                         







						 </tr>



						 <tr>



						 <td height='10px;'>



						 </td>



						 </tr>



       <tr>



             <th scope='row'></th>



        <td>



		<input name='non'  value='Utiliser le compte existant'  type='submit'   />&nbsp;&nbsp;<input name='envoi'          value='Cr&eacute;er un nouveau compte'  type='submit'  onclick='fermer()'/>







                    </td>      







                          </tr>







                        </table>







                      </form>







                    </div>







                  </div>







                </div>







              </div>");



	 

			}



			};



			if ($count_abonement) {$abonne=true;}

 

		



		}



		



	if(empty($mdp1)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas renseign&eacute; le champs mot de passe</li>");}

	

	if (strlen($mdp1) < 4) { array_push($messages,"<li style='color:#FF0000'>Mot de passe trop court!</li>"); }



    if (!preg_match("#[0-9]+#", $mdp1)) { array_push($messages,"<li style='color:#FF0000'>Mot de passe doit comporter au moins un numéro!</li>");  }



    if (!preg_match("#[a-zA-Z]+#", $mdp1)) { array_push($messages,"<li style='color:#FF0000'>Mot de passe doit comporter au moins une lettre!</li>");    } 



	if(empty($mdp2)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas confirm&eacute; votre mot de passe</li>");}



	if($mdp1 != $mdp2){array_push($messages,"<li style='color:#FF0000'>Les deux mots de passe ne sont pas identiques</li>");}

	

	if(empty($situation)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre situation actuelle</li>");}



	if(empty($exp)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre exp&eacute;rience</li>");}



	if(empty($formation)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre niveau de formation</li>");}



	if(empty($type_formation)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre type de formation</li>");}



	if(empty($domaine)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre secteur d'activit&eacute;</li>");}



	 if(empty($salaire)){array_push($messages,"<li style='color:#FF0000'>Vous n'avez pas pr&eacute;cis&eacute; votre salaire souhait&eacute;</li>");}



		

 

		

	

if (!empty($anne_debut_formation) and !empty($anne_fin_formation) and ($anne_debut_formation > $anne_fin_formation) ){

  array_push($messages,"<li style='color:#FF0000'>L'année de la date de début de formation est supérieure à la date fin</li>");

  }

elseif (!empty($anne_debut_formation) and !empty($anne_fin_formation) and !empty($mois_debut_formation) and !empty($mois_fin_formation) and ($mois_debut_formation > $mois_fin_formation and $anne_debut_formation == $anne_fin_formation)){

  array_push($messages,"<li style='color:#FF0000'>Le mois de la date de début de formation  est supérieure à la date fin</li>");

  }

  

  

  

if  (!empty($annee_debut_experience) and !empty($anne_fin_experience) and ($annee_debut_experience > $anne_fin_experience) ) {

  array_push($messages, "<li style='color:#FF0000'>L'année de la date de début de l'experience est supérieure à la date fin</li>");

  }

elseif (!empty($annee_debut_experience) and !empty($anne_fin_experience) and !empty($mois_debut_experience) and !empty($mois_fin_experience) and ($mois_debut_experience > $mois_fin_experience and $annee_debut_experience == $anne_fin_experience)) {

  array_push($messages, "<li style='color:#FF0000'>Le mois de la date de début de l'experience  est supérieure à la date fin</li>");

  }

  

   

  



	if($send_conditions == 'false'){ array_push($messages,"<li style='color:#FF0000'>Il faut cocher la case -J'accepte les Conditions d'utilisation et les R&eacute;gles de confidentialit&eacute; du site.-</li>");}

	

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////



		////////////////////////////////////Dans le cas ou il y'a pas d'erreur///////////////////////////////////////



		/////////////////////////////////////////////////////////////////////////////////////////////////////////////



		



		if(empty($messages))



		{



		

 $succes3='';

		 



		 $mdp = md5($mdp1);



		 $mdp_req = $mdp;



		 $prename = ucfirst($prenom);



		 //$prename =htmlspecialchars($prename, ENT_QUOTES);



	  	 $name = strtoupper($nom);



		  //$name =htmlspecialchars($name, ENT_QUOTES);



		 $last_connexion = date('Y-m-d');



		 $date_inscription = date('Y-m-d');



		 



		 



		 



			if(isset($abonne) and $abonne)



			{

 

				$insertion = mysql_query('UPDATE candidats set  civilite="'.safe($civilite_req).'",nom="'.safe($nom_req).'",

					prenom="'.safe($prenom_req).'",adresse="'.safe($adresse_req).'",code="'.safe($code_req).'",

					ville="'.safe($ville_req).'",pays="'.safe($pays_req).'",date="'.safe($date_req).'",

					nationalite="'.safe($nationalite_req).'",tel1="'.safe($tel1_req).'",tel2="'.safe($tel2_req).'",

					mdp="'.safe($mdp_req).'",situation="'.safe($situation_req).'",experience="'.safe($exp_req).'",

					formation="'.safe($formation_req).'",type_formation="'.safe($type_formation_req).'",

					domaine="'.safe($domaine_req).'",id_fonction="'.safe($fonction_req).'",id_salaire="'.safe($salaire_req).'",

					 date_inscription="'.safe($date_inscription).'",last_connexion="'.safe($last_connexion).'" where email="'.safe($email1_req).'" ');



				$succes1 = mysql_affected_rows();



			 	$requet = mysql_query("SELECT * from candidats WHERE email = '".safe($email1_req)."' AND status=1"); 

	$reponse = mysql_fetch_array($requet);	 

  		if(is_array($reponse))

  		{     

		$_SESSION['abb_login_candidat'] = $email1_req ;

		$_SESSION['abb_nom'] = $prenom.'&nbsp;'.$nom;

		$_SESSION['abb_id_candidat'] = $reponse['candidats_id'];

  		} 

			}



			if(!isset($exist))



			{



										$max_cand_ini = mysql_query("SELECT max(candidats_id) as maximum from candidats ");

										$max_rcand_ini = mysql_fetch_assoc($max_cand_ini); 

										$id_max_ini = $max_rcand_ini ['maximum'];

										

				// cr&eacute;ation d'un nouveau candidat

 

	if($autre=='') $autre_n='';	if($autre1=='') $autre1_n='';	if($autre2=='') $autre2_n='';

			$CVdateMAJ=date("Y-m-d")." ".date("H:i:s");

			

$sql_candidat=	'INSERT INTO candidats				

(candidats_id, id_civi, titre, nom, prenom, adresse, code, ville, id_pays, date_n, nationalite, tel1, tel2, email, 

mdp, id_situ, id_expe, id_nfor, id_tfor, id_sect, id_fonc, id_salr, id_dispo  , mobilite, niveau_mobilite , taux_mobilite,arabic,french,english,autre,autre_n,autre1,autre1_n,autre2,autre2_n , nl_partenaire, date_inscription, status, last_connexion, CVdateMAJ) 

VALUES ("", "'.safe($civilite_req).'", "'.safe($titre_req).'", "'.safe($nom_req).'", "'.safe($prenom_req).'", "'.safe($adresse_req).'",

 "'.safe($code_req).'", "'.safe($ville_req).'", "'.safe($pays_req).'", "'.safe($date_req).'", "'.safe($nationalite_req).'",

  "'.safe($tel1_req).'", "'.safe($tel2_req).'","'.safe($email1_req).'", "'.safe($mdp_req).'", "'.safe($situation_req).'",

   "'.safe($exp_req).'","'.safe($formation_req).'", "'.safe($type_formation_req).'","'.safe($domaine_req).'",

   "'.safe($fonction_req).'","'.safe($salaire_req).'","'.safe($dispo).'","'.safe($mobilite).'","'.safe($niveau).'",

   "'.safe($taux).'","'.safe($arabic).'","'.safe($french).'","'.safe($english).'","'.safe($autre).'","'.safe($autre_n).'",

   "'.safe($autre1).'","'.safe($autre1_n).'","'.safe($autre2).'","'.safe($autre2_n).'",  "'.safe($mdp1).'",  "'.safe($date_inscription).'",

    "2", "'.safe($last_connexion).'", "'.safe($CVdateMAJ).'")';



$insertion = mysql_query($sql_candidat);

$succes2 = mysql_affected_rows();

$id_candidat = mysql_insert_id();

$insertion001 = mysql_query("INSERT INTO popup VALUES ('','".safe($id_candidat)."', '0'  )");



				//echo $succes2;

				

/* */

										$max_cand = mysql_query("SELECT max(candidats_id) as maximum from candidats ");

										$max_rcand = mysql_fetch_assoc($max_cand);

										$id_max = $max_rcand ['maximum'];

										//$_SESSION['abb_id_candidat']= $id_max;

										//echo $id_max ;



if($id_max_ini < $id_max )	{					



 $succes3='ok';

										

										$ext_p = pathinfo($_FILES['photo']['name'] , PATHINFO_EXTENSION);
										$nomformate = no_special_character_v2($nom);
										$prenomformate = no_special_character_v2($prenom);
										$pname = $id_max.$prenomformate.$nomformate.'.'.$ext_p;
										$extensions_img = array('gif', 'jpeg', 'jpg', 'png');
										if (in_array(strtolower($ext_p), $extensions_img)) {
										   if( copy($ptmp, SITE_BASE .'/apps/upload/frontend/photo_candidats/' . $pname) ) {
												$insertion2 = mysql_query("UPDATE candidats SET photo='".safe($pname)."' WHERE candidats_id = $id_max");
										   }
										}

										//copie du cv

										

										   $ext_cv = pathinfo($_FILES['cv']['name'] , PATHINFO_EXTENSION);

										   $cvname = rand()."CV".$prenomformate.$nomformate.'.'.$ext_cv;

										   //$_SESSION['pname'] = $pname;

										$extensions_file = array('.pdf', '.doc', '.docx', '.rtf','.PDF', '.DOC', '.DOCX', '.RTF'  );

										$extension_cv = strrchr($_FILES['cv']['name'], '.'); 

                       

										if (in_array($extension_cv, $extensions_file)) {  

											$folder_cv = dirname(__FILE__).$file_cv2;

										   $cv = $folder_cv . $cvname;

										   copy($cvtmp, $cv);

										   

								   

										if($ext_cv!="")

										$insertion3 = mysql_query("INSERT into cv values('','".safe($id_max)."','".safe($cvname)."','".safe($cvname)."','1','1')");

										}

										//copie du lm

										

										   $ext_lm = pathinfo($_FILES['lm']['name'] , PATHINFO_EXTENSION);

										   $lmname = rand()."LM".$prenomformate.$nomformate.'.'.$ext_lm;

										   //$_SESSION['pname'] = $pname;

										$extensions_file = array('.pdf', '.doc', '.docx', '.rtf','.PDF', '.DOC', '.DOCX', '.RTF'  );

										$extension_lm = strrchr($_FILES['lm']['name'], '.'); 

                       

										if (in_array($extension_lm, $extensions_file)) {  

											$folder_lm = dirname(__FILE__).$file_lm2;

										   $lm = $folder_lm . $lmname;

										   if($lmtmp != '' && $lm != '')	copy($lmtmp, $lm);

										   

								   

										if($ext_lm!="")

				$insertion4 = mysql_query("INSERT into lettres_motivation  values('','".safe($id_max)."','".safe($lmname)."', '".safe($lmname)."','1','0')");

										}

							

							

			//$diplome = addslashes($diplome);

				//	1 insertion dans la table formations		

	/*$insertion_formation1 = mysql_query('INSERT INTO formations VALUES ("","'.safe($id_max).'","'.safe($etablissement).'","'.safe($dd_formation).'",

		"'.safe($df_formation).'","'.safe($diplome).'","'.safe($desc_form).'","'.safe($nivformation).'","'.safe($nom_etablissement).'" )');*/


	// Prepare attachements
	$uploadFiles = [
	  'copie_diplome' => [
	      'errorMessage' => "Impossible d'envoyer le copie du diplôme",
	      'name' => '',
	      'extensions' => ['doc', 'docx', 'pdf', 'gif', 'jpeg', 'jpg', 'png']
	  ],
	  'copie_attestation' => [
	      'errorMessage' => "Impossible d'envoyer la copie de l’attestation de l’expérience",
	      'name' => '',
	      'extensions' => ['doc', 'docx', 'pdf', 'gif', 'jpeg', 'jpg', 'png']
	  ]
	];

	// upload attachements
	foreach ($uploadFiles as $key => $file) {
	  if( isset($_FILES[$key]) && intval($_FILES[$key]['size']) > 0 ) {
	      $upload = \App\Media::upload($_FILES[$key], [
	          'uploadDir' => 'apps/upload/frontend/candidat/'. $key .'/',
	          'extensions' => $file['extensions'],
	          'maxSize' => (isset($file['maxSize'])) ? $file['maxSize'] : 0.300
	      ]);
	      if( isset($upload['files'][0]) ) {
	          $uploadFiles[$key]['name'] = $upload['files'][0];
	      } else {
	          $errorMessage = $uploadFiles[$key]['errorMessage'];
	          if( isset($upload['errors'][0][0]) ) $errorMessage .= ': ('. $upload['errors'][0][0] .')';
	          array_push($messages,"<li style='color:#FF0000'>". $errorMessage ."</li>");
	      }
	  }
	}


	$insertion_formation1 = getDB()->create('formations', [
		'candidats_id' => $id_max,
		'id_ecol' => $etablissement,
		'date_debut' => $dd_formation,
		'date_fin' => $df_formation,
		'diplome' => $diplome,
		'description' => $desc_form,
		'nivformation' => $nivformation,
		'ecole' => $nom_etablissement,
		'copie_diplome' => $uploadFiles['copie_diplome']['name']
    ]);

				 

		  

		  

		  

		  

				// 	1	insertion dans la table experience_pro	

				if($entreprise!="" AND $ville_exp!="")

	$insertion_exp1 = mysql_query('INSERT INTO experience_pro VALUES ("","'.safe($id_max).'","'.safe($secteur).'",

		"'.safe($fonction_exp).'","'.safe($type_poste).'","'.safe($pays_exp).'",

		"'.safe($dd_exp).'","'.safe($df_exp).'","'.safe($poste).'","'.safe($entreprise).'","'.safe($ville_exp).'","'.safe($desc_exp).'","'.safe($salair_pecu).'")');

	
		$insertion_exp1 = getDB()->create('experience_pro', [
			'candidats_id' => $id_max,
			'id_sect' => $secteur,
			'id_fonc' => $fonction_exp,
			'id_tpost' => $type_poste,
			'id_pays' => $pays_exp,
			'date_debut' => $dd_exp,
			'date_fin' => $df_exp,
			'poste' => $poste,
			'entreprise' => $entreprise,
			'ville' => $ville_exp,
			'description' => $desc_exp,
			'salair_pecu' => $salair_pecu,
			'copie_attestation' => $uploadFiles['copie_attestation']['name']
		]);


				$requet = mysql_query("SELECT * from candidats WHERE email = '".safe($email1_req)."' AND status=1"); 

	$reponse = mysql_fetch_array($requet);	 

  		if(is_array($reponse))

  		{     

			$_SESSION['abb_login_candidat'] = $email1_req ;

			$_SESSION['abb_nom'] = $prenom.'&nbsp;'.$nom;

			$_SESSION['abb_id_candidat'] = $reponse['candidats_id'];

  		}	

		

	}

	

	

	

		

				//exit;



				



			}



			







			



			if((isset($succes1) and $succes1) || (isset($succes2) and $succes2)) 

			{ 

			// Récupération de candidats_id de la table candidats



			$res_id=mysql_query("SELECT candidats_id from candidats where email='".safe($email1_req)."'");



			$res_id=mysql_fetch_assoc($res_id);



			$candidats_id=$res_id['candidats_id'];



			



			



				/*

				

				if(isset($succes1) and $succes1)



				{



					$req    = mysql_query ("SELECT * from newsletter where email='$email1_req'");



					$reqrow = mysql_num_rows ($req);







					if ($reqrow == 1)



					{



					mysql_query("delete from newsletter where email='$email1_req'");



					}







				}



				//*/



				

				

				

				



				if(!empty($domaine_expertise_req))



				{



					for($i=0;$i<count($domaine_expertise_req);$i++)



					{



					$date=date('Y-m-d h:m:s');



					$dome=$domaine_expertise_req[$i];



					$dese=$description_expertise_req[$i];



		$insertion_expertise = mysql_query("INSERT INTO expertises VALUES ('','".safe($candidats_id)."','".safe($dome)."','".safe($dese)."','".safe($date)."')");



						



					}



				}



				



				if(!empty($domaine_projet_req))



				{	



					for($i=0;$i<count($domaine_projet_req);$i++)



					{



					$date=date('Y-m-d h:m:s');



					$domp=$domaine_projet_req[$i];



					$desp=$description_projet_req[$i];



	$insertion_expertise = mysql_query("INSERT INTO projets VALUES ('','".safe($candidats_id)."','".safe($domp)."','".safe($desp)."','".safe($date)."')");



					}



				}



				



				/*

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

				///////////////////////////////////// email de confirmation d'inscription ////////////////////////////////////////////// 

				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				//*/

				if( $succes3 == 'ok' )			include("./enregistrement_candidat_email_0.php");	

				/*include("./enregistrement_candidat_email_1.php");//*/

				/*

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				//*/



			



			$_SESSION['msg']="<ul><li style='color:#009933'>F&eacute;licitaion votre compte est cr&eacute;e</li><li style='color:#009933'>Vous allez recevoir un email de confirmation dans quelques instants</li></ul>";



			

/*

//*/

			/*

			$_SESSION['abb_login_candidat']=$email1;



			$_SESSION['abb_nom']=$nom." ".$prenom;



			$_SESSION['abb_id_candidat']=$candidats_id;

			//*/

			



			if(strpos($url,'postuler/')!=false)

			{

		    $url= $_SESSION["url"];	

		 	}

			else

			{



			$url= isset($_SESSION['url']) ? "candidat/".$_SESSION['url'] : "../compte/";



		 	}

			



			

			$page = $_SERVER['REQUEST_URI'];



 

/* // old redirection

array_push($messagesuc,"<ul><li style='color:#468847'>Félicitations !  Votre nouveau compte a été créé avec succès !</li>	<li style='color:#468847'>Vous allez recevoir un email de confirmation dans quelques instants</li>	<li style='color:#468847'>Vous allez être redirigé dans quelques secondes à votre tableau de bord 	<a href='../compte/' >Ne pas attendre</a></li></ul>	<meta http-equiv='refresh' content='6;URL=../compte/'>");

//*/



									$_SESSION['compte_non_confirm'] = '1';	

									$_SESSION['id_compte_non_confirm'] = $id_max;

array_push($messagesuc,"Félicitations !  Votre nouveau compte a été créé avec succès !</li>

	<meta http-equiv='refresh' content='0;URL=../../'>	");



   

		 	}



			



		}



?>