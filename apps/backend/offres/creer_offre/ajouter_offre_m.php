

<div id='soumettre' style="padding-left: 0px; ">
				  <?php				  
				  /*echo $_SESSION['ref_filiale_role'];*/
				  
				  $passed = true;
				  $now = date("Y-m-d");
								
                  $intitule = isset($_POST['intitule']) ? trim($_POST['intitule']) : "";
                  //$intitule   =  htmlspecialchars($intitule, ENT_QUOTES) ;
                  $secteur = isset($_POST['secteur']) ? $_POST['secteur'] : "";
                  $details = isset($_POST['details']) ? trim($_POST['details']) : "";
                  $profils = isset($_POST['profils']) ? trim($_POST['profils']) : "";
                  $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
                  $contact_email = isset($_POST['contact_email']) ? trim($_POST['contact_email']) : ""; 

//debut photo

$photo_offre = isset($_POST['photo_offre']) ? trim($_POST['photo_offre']) : "";
$photo_offre_name  = isset($_FILES['photo_offre'])     ? $_FILES['photo_offre']['name']       : "";
$photo_offre_tmp = isset($_FILES['photo_offre']) ? $_FILES['photo_offre']['tmp_name'] : "";
$photo_offre_type = isset($_FILES['photo_offre']) ? $_FILES['photo_offre']['type'] : "";

$ext_p = pathinfo($photo_offre_name, PATHINFO_EXTENSION);
if($ext_p != ''){
  $photo_offre_name = rand()."_offre_".date("Y_m_d").'.'.$ext_p;
}

$folder_photo_offre = dirname(__FILE__).$file_offres2;

$photo_offre_f = $folder_photo_offre . $photo_offre_name;

if($photo_offre_tmp != '' && $photo_offre_f != '') {
  copy($photo_offre_tmp, SITE_BASE .'/apps/upload/backend/offres/' . $photo_offre_name);
}

//fin photo

                  $email = $rep_roles["email"];//isset($_POST['email']) ? trim($_POST['email']) : "";
                  $lieu = isset($_POST['lieu']) ? $_POST['lieu'] : "";
                  $fonction = isset($_POST['fonction']) ? $_POST['fonction'] : "";
                  $formation = isset($_POST['formation']) ? $_POST['formation'] : "";
                  $exp = isset($_POST['exp']) ? $_POST['exp'] : "";
                  $poste = isset($_POST['poste']) ? $_POST['poste'] : "";
                  $mobilite = isset($_POST['mobilite']) ? $_POST['mobilite'] : "non";
                  $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : "";
                  $taux = isset($_POST['taux']) ? $_POST['taux'] : "";
                  $date_expiration = isset($_POST['date_expiration']) ? $_POST['date_expiration'] : "";
                  $ref = isset($_POST['ref']) ? $_POST['ref'] : "";
                  $send_candidature = isset($_POST['send_candidature']) ? $_POST['send_candidature'] : "false";
                  $anonymat = true;
                  $valid = "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#";
                  $phone = "#^\d{10,14}$#";
                       
                 ?>

													
													
													
                  <br/><h1>CREER UNE OFFRE</h1>
     
      <?php
          $messages=array();
		if (isset($_POST['envoi']) AND ($intitule == '' || $fonction == '' || $details == '' || $profils == '' || (!empty($tel) && (!preg_match($phone, $tel))) || ($send_candidature == 'true' && empty($email)) || (!empty($email) && !(preg_match($valid, $email)))  || empty($exp) || $poste == '' || ($mobilite == 'oui' && empty($niveau)) || ($mobilite == 'oui' && empty($taux)))) {
      //*
		//echo " <h3>Informations incomplètes</h3><p>Un (ou plusieurs) champ(s) obligatoire(s) n'a(ont) pas été correctement rempli(s).</p><ul>";
      $msgs ="<div class='alert alert-error'><ul>";
      if ($intitule == '')
        $msgs ="<li style='color:#FF0000'>Veuillez remplir l'intitulé du poste</li>";
      if ($secteur == '')
         $msgs .= "<li style='color:#FF0000'>Vous n'avez pas précisé le secteur</li>";
      if ($fonction == '')
          $msgs .="<li style='color:#FF0000'>Veuillez remplir votre Fonction / Département</li>";
      if ($details == '')
          $msgs .= "<li style='color:#FF0000'>Veuillez remplir la mission et responsabilités</li>";
      if ($profils == '')
          $msgs .= "<li style='color:#FF0000'>Veuillez préciser les profils recherchés</li>";         
      if ($formation == '') 
          $msgs .= "<li style='color:#FF0000'>Veuillez remplir le niveau d'formation </li>";  
      if (empty($exp))
          $msgs .= "<li style='color:#FF0000'>Veuillez remplir le niveau d'expérience</li>";
      if ($poste == '')
          $msgs .= "<li style='color:#FF0000'>Veuillez remplir le type de contrat </li>";
      if (($mobilite == 'oui' && empty($niveau)))
          $msgs .= "<li style='color:#FF0000'>Veuillez remplir le niveau de mobilité géographique </li>";
      if (($mobilite == 'oui' && empty($taux)))
          $msgs .= "<li style='color:#FF0000'>Veuillez remplir le taux de mobilité géographique </li>";
		
		$msgs .= "</ul></div>";
    array_push($messages,$msgs);

if(isset($messages) and !empty($messages))  {
        foreach($messages as $messages) 
        ?><?php    
          {     echo $messages;    } 
           ?><?php
      }    
         } 
      ?> 


<?php	   
                        
              if (isset($_POST['envoi']) AND !($intitule == '' || $fonction == '' || $details == '' || $profils == '' || (!empty($tel) && (!preg_match($phone, $tel))) || ($send_candidature == 'true' && empty($email)) || (!empty($email) && !(preg_match($valid, $email)))  || empty($exp) || $poste == '' || ($mobilite == 'oui' && empty($niveau)) || ($mobilite == 'oui' && empty($taux)))){
     
                           
			$date_insertion = date("Y-m-d"); 
					if($date_expiration!='') { 
									$date_expiration = str_replace('/', '-', $date_expiration);
									$date_expiration = date('Y-m-d', strtotime($date_expiration));
												$now = date("Y-m-d");    
												if($date_expiration < $now) { $date_expiration = date("Y-m-d", strtotime('+'.$date_expiration_off.' DAY'));	}
					}
					else {	$date_expiration = date("Y-m-d", strtotime('+'.$date_expiration_off.' DAY'));		}
			$select_ordre = mysql_query("select MAX(ordre) AS max from offre");
			$rep_ordre = mysql_fetch_array($select_ordre);
			$ordre = $rep_ordre['max'] + 1;
			 $details =str_replace("'", "\'", $details);
			  $profils =str_replace("'", "\'", $profils);
									 
      // Prepare attachements
      $formData = array(
          'avis_concours' => '',
          'decisions_recrutement' => '',
          'candidats_convoques' => '',
          'resultats_concours' => ''
      );

      $uploadFiles = [
          'avis_concours' => [
              'errorMessage' => "Impossible d'envoyer l'avis de concours",
              'name' => '',
              'extensions' => ['doc', 'docx', 'pdf']
          ],
          'decisions_recrutement' => [
              'errorMessage' => "Impossible d'envoyer la décisions de recrutement",
              'name' => '',
              'extensions' => ['doc', 'docx', 'pdf']
          ],
          'candidats_convoques' => [
              'errorMessage' => "Impossible d'envoyer la liste des candidats convoqués",
              'name' => '',
              'extensions' => ['doc', 'docx', 'pdf']
          ],
          'resultats_concours' => [
              'errorMessage' => "Impossible d'envoyer le résultat du concour",
              'name' => '',
              'extensions' => ['doc', 'docx', 'pdf']
          ],
      ];

      // upload formation attachement
      foreach ($uploadFiles as $key => $file) {
          if( isset($_FILES[$key]) && intval($_FILES[$key]['size']) > 0 ) {
              $upload = \App\Media::upload($_FILES[$key], [
                  'uploadDir' => 'apps/upload/frontend/offre/'. $key .'/',
                  'extensions' => $file['extensions'],
                  'maxSize' => (isset($file['maxSize'])) ? $file['maxSize'] : 0.300
              ]);
              if( isset($upload['files'][0]) ) {
                  $formData[$key] = $uploadFiles[$key]['name'] = $upload['files'][0];
              } else {
                  $errorMessage = $uploadFiles[$key]['errorMessage'];
                  if( isset($upload['errors'][0][0]) ) $errorMessage .= ': ('. $upload['errors'][0][0] .')';
                  array_push($messages,"<li style='color:#FF0000'>". $errorMessage ."</li>");
              }
          }
      }                
                     
      $insertion = getDB()->create('offre', [
          'reference' => $ref, 
          'Name' => $intitule, 
          'id_sect' => $secteur,
          'Details' => $details, 
          'Profil' => $profils, 
          'Contact' => $contact_email, 
          'Photo_offre' => $photo_offre_name, 
          'id_entreprise' => 1, 
          'Email' => $email, 
          'date_insertion' => $date_insertion, 
          'date_expiration' => $date_expiration, 
          'id_expe' => $exp, 
          'id_localisation' => $lieu, 
          'id_tpost' => $poste, 
          'mobilite' => $mobilite, 
          'niveau_mobilite' => $niveau, 
          'taux_mobilite' => $taux, 
          'vue' => 0, 
          'candidature' => 0,
          'status' => 'Archivée', 
          'anonymat' => $anonymat, 
          'send_candidature' => true, 
          'ordre' => $ordre, 
          'id_fonc' => $fonction, 
          'id_nfor' => $formation, 
          'ref_filiale' => $_SESSION['ref_filiale_role'],
          'avis_concours' => $formData['avis_concours'],
          'decisions_recrutement' => $formData['decisions_recrutement'],
          'candidats_convoques' => $formData['candidats_convoques'],
          'resultats_concours' => $formData['resultats_concours']
      ]);

      // Fire after offre form submit event
      if( $insertion > 0 ) {
          \App\Event::trigger('offre_form_submit', ['id_offre' => $insertion, 'data' => $_POST]);
      }

      // Fire initial status
      if( $insertion > 0 && method_exists('\Modules\Workflows\Models\Workflow', 'addInitialStatus') ) {
          \Modules\Workflows\Models\Workflow::addInitialStatus($_SESSION['id_role'], $insertion);
      }


			// INSERT INTO offre     -04122014-> changer  En cours  par   Archivée
			/*$sql_a="INSERT INTO `offre` (`id_offre`, `reference`, `Name`, `id_sect`, `Details`, `Profil`, `Contact`, `Photo_offre`, `id_entreprise`, `Email`, `date_insertion`, `date_expiration`, `id_expe`, `id_localisation`, `id_tpost`, `mobilite`, `niveau_mobilite`, `taux_mobilite`, `vue`, `candidature`, `status`, `anonymat`, `send_candidature`, `ordre`, `id_fonc`, `id_nfor`, `ref_filiale`) 
      VALUES  ('','".safe($ref)."','".safe($intitule)."','".safe($secteur)."','".safe($details)."','".safe($profils)."','".safe($contact_email)."',
        '".safe($photo_offre_name)."','1','".safe($email)."','".safe($date_insertion)."','".safe($date_expiration)."','".safe($exp)."','".safe($lieu)."','".safe($poste)."',
        '".safe($mobilite)."','".safe($niveau)."','".safe($taux)."','0','0','Archivée','".safe($anonymat)."','".safe($send_candidature)."','".safe($ordre)."','".safe($fonction)."','".safe($formation)."',
        '".safe($_SESSION['ref_filiale_role'])."')";
 
				$insertion = mysql_query($sql_a);*/
				
				include('./ajouter_offre_m_session_offre.php');
				
                                            $max_requet = mysql_query("select max(id_offre) as maximum from offre ");
                                            $max_result = mysql_fetch_assoc($max_requet);
                                            $max_result = $max_result['maximum'];
				
				
				
				// INSERT INTO his_off_rol                       
				$date_his_role = date("Y-m-d H:i:s");
				
				$data = mysql_query("SELECT id_offre FROM  offre  ");
				while($info = mysql_fetch_array( $data )){
				$lastID = $info['id_offre'];
				}                       
				mysql_query("INSERT INTO his_off_rol VALUES ('','".$rep_roles["id_role"]."','".$lastID."','','creation','$date_his_role')");    
				
				
/*=====================================================================================================================================================*/				


                         $req_exp = mysql_query("SELECT * FROM prm_ecoles"); 
                         while ($ecol = mysql_fetch_array($req_exp)) { 
                             $ecol_id = $ecol['id_ecole'];
							 
						 if($_POST[$ecol_id."_e"]!='0') {
							 //echo '<br>$_POST['.$ecol_id.'_e]'.$_POST[$ecol_id."_e"].'<br>'; 
							 mysql_query("INSERT INTO offre_necole VALUES ('".$max_result."','".$ecol_id."','".$_POST[$ecol_id."_e"]."')");    
				
							 }
							 }
							 
							  $req_exp = mysql_query("SELECT * FROM prm_filieres");
						 $i=0;
                         while ($fonc = mysql_fetch_array($req_exp)) {
                             $fonc_id = $fonc['id_fili'];
							 
						 if($_POST[$fonc_id."_f"]!='0') {
							 //echo '<br>$_POST['.$fonc_id.'_f]'.$_POST[$fonc_id."_f"].'<br>';  
							 mysql_query("INSERT INTO offre_nfiliere VALUES ('".$max_result."','".$fonc_id."','".$_POST[$fonc_id."_f"]."')");  
							 
							 }
							 }

/*=====================================================================================================================================================*/				
				
				
				
				$last_id = mysql_query("SELECT max(id_offre) as ids from offre");
        $resutid= mysql_fetch_array($last_id) ;
          $cresutid=$resutid['ids'];
					$count = mysql_affected_rows();
					if ($count >= 0) { // si l'offre est ajouté
						$messages_succ=array();
            $msgss ="<div class='alert alert-success'><ul>";
            $msgss .= '<ul><li style="color:#468847">Votre offre a été ajoutée avec succès</li></ul>';
            $msgss .= '</ul></div>';
            array_push($messages_succ,$msgss);
            if(isset($messages_succ) and !empty($messages_succ))  {
              foreach($messages_succ as $messages_succ) 
            ?><?php    
                {     echo $messages_succ;    } 
                  ?><?php
              }/*
            ?>
            <meta http-equiv="refresh" content="3; url=../consulter_offre/?offre=<?php echo $cresutid; ?>">
						 <?php
					*/}
					else // si l'offre n est pas ajouté à la bd
						echo "  <br> <p>Une erreur est survenue lors de l'insertion</p>";
					//echo '<ul><li><p>Pour publier de nouvelles offres, cliquez <a href="soumettre.php">ici</a></p></li></ul>';
					$intitule = "";  $secteur = "";   $details = "";   $profils = "";    $nom = "";  $contact_email = "";   $photo_offre = "";   $email = "";  $lieu = "";  $fonction = "";   $formation = "";
					$exp = "";  $poste = "";  $mobilite = "non";  $niveau = "";  $taux = "";  $date_expiration = "";  $ref = "";  $send_candidature = "false";  $anonymat = true;
					$valid = "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#";       $phone = "#^\d{10,14}$#";
					}
                     
                     
?>		  
												
     <form method="post" id="form_standard" action="<?php echo($_SERVER['REQUEST_URI']); ?>" 
     enctype="multipart/form-data" name="form1" class="form-contact">
         <table width="678" cellpadding="0" border="0">
             <tr>
                 <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">
                         <h1>Description du poste </h1>
                     </div></td>
             </tr>
         <tr>
                 <td width="169">    <!-- R&eacute;f&eacute;rence de l'offre --> </td>
         <?php
		 $id__s= (isset($_SESSION['id'])  ) ? $_SESSION['id'] : "" ;
         $nom_select = mysql_query("SELECT nom_entreprise from entreprise where id_entreprise = '" .  $id__s . "'");
         $array = mysql_fetch_array($nom_select);
         function mysql_next_id() {
             $result = mysql_query('SHOW TABLE STATUS LIKE "offre"');
             $rows = mysql_fetch_assoc($result);
             return $rows['Auto_increment'];
         }
         $last_id = mysql_query("SELECT max(id_offre) as ids from offre");
        $resutid= mysql_fetch_array($last_id) ;
          $cresutid=$resutid['ids'];
          $refaa = $cresutid + 1;
                 //echo $refaa;
         ?>

                 <td width="503"><input type="hidden" name="ref" 
                 value="<?php echo $refaa; ?>" readonly="readonly"  style="width:504px"/></td>
             </tr>
             <tr>
                 <td width="169">    <!-- R&eacute;f&eacute;rence de l'offre --></td>
         <?php
/*
    $r_id = "";   $r_titre = "";    $r_email = "";    $r_pj = "";   $r_obj = "";    $r_msg = "";  

  $id_offr_s=(isset($_POST['id_offr_s'])) ? $_POST['id_offr_s'] : '' ;
   
if($id_offr_s!='') {   
//============================================================================================================================== 
$option_tmail='';$v='';
$req_01 = mysql_query( "SELECT offre.*,
prm_sectors.id_sect as sect,prm_sectors.FR,
prm_fonctions.fonction,prm_fonctions.id_fonc as fonct,
prm_niv_formation.formation,prm_niv_formation.id_nfor as forma,
prm_experience.intitule,prm_experience.id_expe as experi,
prm_type_poste.designation,prm_type_poste.id_tpost as typoste,
prm_localisation.localisation,prm_localisation.id_localisation as locali 
FROM  offre
inner join  prm_sectors on prm_sectors.id_sect = offre.id_sect
inner join  prm_fonctions on prm_fonctions.id_fonc = offre.id_fonc
inner join  prm_niv_formation on prm_niv_formation.id_nfor = offre.id_nfor
inner join  prm_experience on prm_experience.id_expe = offre.id_expe
inner join  prm_type_poste on prm_type_poste.id_tpost = offre.id_tpost
inner join  prm_localisation on prm_localisation.id_localisation = offre.id_localisation 
where id_offre=".$id_offr_s." ");       
$r01 = mysql_fetch_array( $req_01 );       
//$r_id = $r01['id_email'];
$r_name = $r01['Name'];
$secteur= $r01['sect'];$fonction = $r01['fonct'];
$formation = $r01['forma'];$exp = $r01['experi'];
$poste = $r01['typoste'];$lieu = $r01['locali'];
/*
$r_sector = $r01['FR'];$r_id_sector =$r01['sectors.id_sect'];
$r_fonction = $r01['fonction'];$r_id_fonction = $r01['fonctions.id_fonc'];
$r_formation= $r01['formation'];$r_id_formation= $r01['niv_formation.id_nfor'];
$r_experience = $r01['intitule']; $r_id_experience = $r01['experience.id_expe']; 
$r_type_poste= $r01['designation'];$r_id_type_poste= $r01['type_poste.id_tpost'];
$r_localisation = $r01['localisation'];$r_id_localisation = $r01['localisation.id_localisation'];  * /
$r_details = $r01['Details']; $r_profil= $r01['Profil'];
$r_date_expiration= $r01['date_expiration'];

//==============================================================================================================================
}

//*/

?>
                
             </tr>
             <tr>
             <td width="169">Nomenclature d'un emploi </td>
             <td width="503">
<form  action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" method="POST"> 
<?php include('./ajouter_offre_m_form.php'); ?>
</form>
                          
                    </div>
                        </div>
                    </div>