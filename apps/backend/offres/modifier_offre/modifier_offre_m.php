<?php $messages=array(); ?>
<div class='texte' >	
													
                  <br/><h1>MODIFIER UNE OFFRE</h1>

				<div style=" float: right; padding: 4px 5px 0px 0px;">
					<a href="<?php echo $_SESSION['page_courant ']; ?>" style=" border-bottom: none; ">
					<img src="<?php echo $imgurl; ?>/arrow_ltr.png" title="Retour"><strong style="color:#fff">Retour</strong>
				  </a>	
				</div>				
				<div class="subscription" style="margin: 10px 0pt;">
                         <h1>Description du poste </h1>
                </div>			  	
<div id='soumettre' style="padding-left: 0px; ">
				  <?php
				   
				  $passed = true;
				  $now = date("Y-m-d");
								
				  
                  $intitule = isset($_POST['intitule']) ? trim($_POST['intitule']) : "";
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
                  $mobilite = isset($_POST['mobilite']) ? $_POST['mobilite'] : $mobilite;
                  $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : $niveau;
                  $taux = isset($_POST['taux']) ? $_POST['taux'] : $taux;
                  $date_expiration = isset($_POST['date_expiration']) ? $_POST['date_expiration'] : "";
                  $ref = isset($_POST['ref']) ? $_POST['ref'] : "";
                  $send_candidature = isset($_POST['send_candidature']) ? $_POST['send_candidature'] : "false";
                  $anonymat = true;
                  $valid = "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#";
                  $phone = "#^\d{10,14}$#";
                       
                 ?>
 						
     
      <?php
		if (!isset($_POST['envoi2']) AND isset($_POST['envoi']) AND ($intitule == '' || $fonction == '' || $details == '' || $profils == '' || (!empty($tel) && (!preg_match($phone, $tel))) || ($send_candidature == 'true' && empty($email)) || (!empty($email) && !(preg_match($valid, $email)))  || empty($exp) || $poste == '' || ($mobilite == 'oui' && empty($niveau)) || ($mobilite == 'oui' && empty($taux)))) {
      //*
		//echo " <h3>Informations incomplètes</h3><p>Un (ou plusieurs) champ(s) obligatoire(s) n'a(ont) pas été correctement rempli(s).</p><ul>";
				  $msgs ="";
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
		 
		$messages=array();
				if( !empty($msgs)) {
			  $msgs ="<div class='alert alert-error'><ul>".$msgs . "<li style='color:#FF0000'>Veuillez remplir le type de contrat </li>";
				array_push($messages, $msgs);
				}
				 

if(isset($messages) and !empty($messages))  {
        foreach($messages as $message) 
        ?><?php    
          {     echo $message;    } 
           ?><?php
      } 
         } 
      ?> 
 
<?php	   
                        
              if ( isset($_POST['envoi']) AND !($intitule == '' || $fonction == '' || $details == '' || $profils == '' || (!empty($tel) && (!preg_match($phone, $tel))) || ($send_candidature == 'true' && empty($email)) || (!empty($email) && !(preg_match($valid, $email)))  || empty($exp) || $poste == '' || ($mobilite == 'oui' && empty($niveau)) || ($mobilite == 'oui' && empty($taux)))){
                        
                            
			$date_insertion = date("Y-m-d"); 
          if($date_expiration!='') { 
                  $date_expiration = str_replace('/', '-', $date_expiration);
                  $date_expiration = date('Y-m-d', strtotime($date_expiration));
                        $now = date("Y-m-d");    
                        if($date_expiration < $now) { $date_expiration = date("Y-m-d", strtotime('+'.$date_expiration_off.' DAY')); }
          }
          else {  $date_expiration = date("Y-m-d", strtotime('+'.$date_expiration_off.' DAY'));   }
      $select_ordre = mysql_query("select MAX(ordre) AS max from offre");
      $rep_ordre = mysql_fetch_array($select_ordre);
      $ordre = $rep_ordre['max'] + 1;
       $details =str_replace("'", "\'", $details);
        $profils =str_replace("'", "\'", $profils);
            

			// Update offre Set        -04122014-> changer  En cours  par   Archivée
			/*$sql_a="Update offre Set   `Name`='".safe($intitule)."', `id_sect`='".safe($secteur)."', `Details`='".safe($details)."', `Profil`='".safe($profils)."', `Contact`='".safe($contact_email)."',
      `Photo_offre`='".safe($photo_offre_name)."',
         `date_expiration`='".safe($date_expiration)."', `id_expe`='".safe($exp)."', `id_localisation`='".safe($lieu)."', `id_tpost`='".safe($poste)."', `mobilite`='".safe($mobilite)."', `niveau_mobilite`='".safe($niveau)."', `taux_mobilite`='".safe($taux)."',  `id_fonc`='".safe($fonction)."', `id_nfor`='".safe($formation)."'  Where id_offre=".$id_off_m." ";
			
			//echo $sql_a;
				// echo $sql_a;
				$insertion = mysql_query($sql_a);*/

      
        // Prepare attachements
        $offreData = getDB()->findByColumn('offre', 'id_offre', $id_off_m, ['limit' => 1]);
        
        $formData = array(
            'avis_concours' => $offreData->avis_concours,
            'decisions_recrutement' => $offreData->decisions_recrutement,
            'candidats_convoques' => $offreData->candidats_convoques,
            'resultats_concours' => $offreData->resultats_concours,
            'attachements' => json_decode($offreData->attachements, true)
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
                'errorMessage' => "Impossible d'envoyer les résultats des concour",
                'name' => '',
                'extensions' => ['doc', 'docx', 'pdf']
            ],
            'attachements' => [
                'errorMessage' => "Impossible d'envoyer les pièces joints",
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
                  if( $key == 'attachements' ) {
                    $formData[$key] = array_merge($formData[$key], $upload['files']);
                  } else {
                    if( $formData[$key] != '' ) {
                        unlinkFile(site_base('apps/upload/frontend/offre/'. $key .'/'. $formData[$key]));
                    }
                    $formData[$key] = $upload['files'][0];
                  }                  
                } else {
                    $errorMessage = $uploadFiles[$key]['errorMessage'];
                    if( isset($upload['errors'][0][0]) ) $errorMessage .= ': ('. $upload['errors'][0][0] .')';
                    array_push($messages, "<li style='color:#FF0000'>". $errorMessage ."</li>");
                }
            }
        }                
                 
        $insertion = getDB()->update('offre', 'id_offre', $id_off_m, [
            'Name' => $intitule, 
            'id_sect' => $secteur,
            'Details' => $details, 
            'Profil' => $profils, 
            'Contact' => $contact_email, 
            'Photo_offre' => $photo_offre_name, 
            'date_expiration' => $date_expiration, 
            'id_expe' => $exp, 
            'id_localisation' => $lieu, 
            'id_tpost' => $poste, 
            'mobilite' => $mobilite, 
            'niveau_mobilite' => $niveau, 
            'taux_mobilite' => $taux, 
            'id_fonc' => $fonction, 
            'id_nfor' => $formation, 
            'avis_concours' => $formData['avis_concours'],
            'decisions_recrutement' => $formData['decisions_recrutement'],
            'candidats_convoques' => $formData['candidats_convoques'],
            'resultats_concours' => $formData['resultats_concours'],
            'attachements' => json_encode($formData['attachements'])
        ]);

        // Fire after offre form submit event
        \App\Event::trigger('offre_form_submit', ['id_offre' => $id_off_m, 'data' => $_POST]);

        // Fire initial status
        if( method_exists('\modules\workflows\models\Workflow', 'addInitialStatus') ) {
          \modules\workflows\models\Workflow::addInitialStatus($_SESSION['id_role'], $id_off_m);
        }

				          
				$date_his_role = date("Y-m-d H:i:s");
				mysql_query("INSERT INTO his_off_rol VALUES ('','".$rep_roles["id_role"]."','".$id_off_m."','','modifier','$date_his_role')");    
				 
            
 
				 
/*===========================================================================================================================================================================================*/
/*===========================================================================================================================================================================================*/
/*===========================================================================================================================================================================================*/
 
				
				// INSERT INTO his_off_rol                       
				$date_his_role = date("Y-m-d H:i:s");
				
			                 $sql= "INSERT INTO his_off_rol VALUES ('','".$rep_roles["id_role"]."','".$id_off_m."','','modifier la notation','$date_his_role')"     ;
							 //echo '<br>'.$sql;
							 
							 //mysql_query($sql);    
				
				
/*=====================================================================================================================================================*/				
				$sql_e="DELETE FROM `offre_necole`  Where id_offre=".$id_off_m." ";
				//echo '<br>'.$sql;
				mysql_query($sql_e);
				$sql_f="DELETE FROM `offre_nfiliere`  Where id_offre=".$id_off_m." ";
				//echo '<br>'.$sql;
				mysql_query($sql_f);   

                         $req_exp = mysql_query("SELECT * FROM prm_ecoles"); 
                         while ($ecol = mysql_fetch_array($req_exp)) { 
                             $ecol_id = $ecol['id_ecole'];
							 
						 if($_POST[$ecol_id."_e"]!='0') {
							 //echo '<br>$_POST['.$ecol_id.'_e]'.$_POST[$ecol_id."_e"].'<br>'; 
							 $sql_o_e="INSERT INTO offre_necole VALUES ('".$id_off_m."','".$ecol_id."','".$_POST[$ecol_id."_e"]."')";
							//echo '<br>'.$sql;
							 mysql_query($sql_o_e);    
				
							 }
							 }
							 
							  $req_exp = mysql_query("SELECT * FROM prm_filieres");
						 $i=0;
                         while ($fili = mysql_fetch_array($req_exp)) {
                             $fili_id = $fili['id_fili'];
							 
						 if($_POST[$fili_id."_f"]!='0') {
							 //echo '<br>$_POST['.$fili_id.'_f]'.$_POST[$fili_id."_f"].'<br>';  
							 $sql_o_f="INSERT INTO offre_nfiliere VALUES ('".$id_off_m."','".$fili_id."','".$_POST[$fili_id."_f"]."')";
							//echo '<br>'.$sql;
							 mysql_query($sql_o_f);  
							 
							 }
							 }

/*=====================================================================================================================================================*/				
				
				
				
/*===========================================================================================================================================================================================*/
/*===========================================================================================================================================================================================*/
/*===========================================================================================================================================================================================*/
	
					$count = mysql_affected_rows();
					if ($count >= 0) { // si l'offre est ajouté
						$messages_succ=array();
            $msgss ="<div class='alert alert-success'><ul>";
            $msgss .= '<ul><li style="color:#468847">Votre offre a été modifiée avec succès</li></ul>';
            $msgss .= '</ul></div>';
            array_push($messages_succ,$msgss);
            if(isset($messages_succ) and !empty($messages_succ))  {
				/*==== ================================================================================================================================================= ====*/ 
				
						//echo "  <br> <p>a</p>";
						
						include ( "./modifier_offre_m_note_cand.php");  
						
						//echo "  <br> <p>b</p>";
				/*==== ================================================================================================================================================= ====*/
              
					/*
					 if($percent > 99)
					  foreach($messages_succ as $messages_succ)    {     echo $messages_succ;    }  
					//*/
              }
            ?>
             <meta http-equiv="refresh" content="3; url=<?php echo $_SESSION['page_courant ']; ?>"> 
						 <?php
					}					else // si l'offre n est pas ajouté à la bd
						echo "  <br> <p>Une erreur est survenue lors de la</p>";
					//echo '<ul><li><p>Pour publier de nouvelles offres, cliquez <a href="soumettre.php">ici</a></p></li></ul>';
					$intitule = "";  $secteur = "";   $details = "";   $profils = "";    $nom = "";   $contact_email = "";   $tel = "";   $email = "";  $lieu = "";  $fonction = "";   $formation = "";
					$exp = "";  $poste = "";  $mobilite = "non";  $niveau = "";  $taux = "";  $date_expiration = "";  $ref = "";  $send_candidature = "false";  $anonymat = true;
					$valid = "#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#";       $phone = "#^\d{10,14}$#";
					 
		 }
                     
                     
?>		  											
											
												
     <form method="post" action="<?php echo($_SERVER['REQUEST_URI']); ?>" 
     enctype="multipart/form-data" name="form1" class="form-contact">
         <table width="678" cellpadding="0" border="0">
             <!--
			 <tr>
                 <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">
                         <h1>Description du poste </h1>
                     </div></td>
             </tr>
			 -->
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

                 <td width="503">
					<input type="hidden" name="ref"  value="<?php echo $refaa; ?>" readonly="readonly"  style="width:504px"/>
					<input type="hidden" name="id_off_m"  value="<?php echo $id_off_m; ?>" readonly="readonly"  style="width:504px"/>
				</td>
             </tr>
             <tr>
                 <td width="169">    <!-- R&eacute;f&eacute;rence de l'offre --></td>
 
                
             </tr>
			 
			<?php /* <!--
             <tr>
             <td width="169">Nomenclature d'un emploi </td>
             <td width="503">
               <form  action="<?php echo $_SERVER['REQUEST_URI']; ?>"  method="POST"> 
<select name="tmail" id="tmail"  style="width:510px" onchange="this.form.submit()" > 
                       <option value=""></option> 
<?php  
$req_theme = mysql_query("SELECT * FROM  offre
inner join  prm_sectors on prm_sectors.id_sect = offre.id_sect
inner join  prm_fonctions on prm_fonctions.id_fonc = offre.id_fonc
inner join  prm_niv_formation on prm_niv_formation.id_nfor = offre.id_nfor
inner join  prm_experience on prm_experience.id_expe = offre.id_expe
inner join  prm_type_poste on prm_type_poste.id_tpost = offre.id_tpost
inner join  prm_localisation on prm_localisation.id_localisation = offre.id_localisation
");
while ($data = mysql_fetch_array($req_theme)) {
$sf=''; $m_id = $data['id_offre']; $obj = $data['Name']; 
if ($tmail != $m_id)
$sf = "";
else
$sf = ' selected="selected"'; 
echo "<option value=\"$m_id\" " . $sf . ">$obj</option>";}
?> 
                      </select>  
                  </form> 
				</td>
             </tr>
			 
			 
        <tr>
			<td colspan="2">
			<br><div class="ligneBleu"></div><br>
			</td>
		</tr>
		
			 -->*/ ?>
             <tr>
                 <td width="169">Intitul&eacute; du poste <span style="color:red">*</span></td>
                 <td width="503">
                 <input list="tmail" id="intitule1" type="text" name="intitule" 
                 value="<?php if(isset($r_name)) echo $r_name; else echo ""; ?>"  maxlength="80" style="width:504px" 
                 title="Intitulé du poste" required/>
                 <!--<input id="intitule1" type="text" name="intitule" value="<?php echo $r_email; ?>"  maxlength="80" style="width:504px" title="Intitulé du poste" required/>--></td>
             </tr>
            <?php \App\Event::trigger('wf_offre_form_fields'); ?>
         <tr>
             <td><!-- Secteur d’activit&eacute;<span style="color:red">*</span> --></td>
             <td>
			 <!--
			 <select name="secteur" style="width:510px"
             title="Secteur d’activité" required/>
<option value="" selected="selected"></option>
 <?php
 /*
 $req_theme = mysql_query("SELECT * FROM prm_sectors");
 while ($data = mysql_fetch_array($req_theme)) {
     $Sector_id = $data['id_sect'];
     $Sector = $data['FR'];
         if ($Sector_id == $secteur  )
              $selected = 'selected';
         else
              $selected = '';
     echo "<option value=\"$Sector_id\" " . $selected . ">$Sector</option>";
 }
 //*/
 ?>
                 </select>
				 -->
				 <input type="hidden" name="secteur" value="17">
             </td>
         </tr>            
         <tr>
             <td>Fonction / Département<span style="color:red">*</span></td>
             <td><select id="fonction1" name="fonction" style="width:510px"
             title="Fonction / Département" required/>
<option value="" selected="selected"></option>
 <?php
 $req_theme = mysql_query("SELECT * FROM prm_fonctions");
 while ($data = mysql_fetch_array($req_theme)) {
     $Sector_id = $data['id_fonc'];
     $Sector = $data['fonction'];
                             if ($Sector_id == $id_fonction  )
                                 $selected = 'selected';
                             else
                                 $selected = '';
     echo "<option value=\"$Sector_id\" " . $selected . ">$Sector</option>";
 }
 ?>
                 </select>
             </td>
         </tr>
             <tr>
                 <td>Mission et responsabilité <span style="color:red">*</span></td>
                 <td><textarea name="details" id="editor11" required/><?php  if(isset($r_details)) echo stripslashes($r_details);  else echo ""; ?></textarea>
                 <script type="text/javascript">
                 CKEDITOR.replace( 'editor11') 
                 </script>
                 
                 </td>
             </tr>
             <tr>
                 <td>Profil recherch&eacute; <span style="color:red">*</span></td>
                 <td><textarea name="profils" 
                 id="editor21"><?php   if(isset($r_profil))  echo stripslashes($r_profil);  else echo "";  ?></textarea>
                 <script type="text/javascript">
                 CKEDITOR.replace( 'editor21') 
                 </script>
                 </td>
             </tr>
         <tr>
             <td>Niveau de formation requis<span style="color:red">*</span></td>
             <td><select id="formation1" name="formation" style="width:510px"
             title="Niveau de formation requis" required/>
<option value="" selected="selected"></option>
                        <?php
                        $req_lieu = mysql_query("SELECT * FROM prm_niv_formation");
                        while ($form_req = mysql_fetch_array($req_lieu)) {
                            $lieu_id = $form_req['id_nfor'];
                            $lieu_desc = $form_req['formation'];
                             if ($lieu_id == $id_formation  )
                                 $selected = 'selected';
                             else
                                 $selected = '';
                            echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";
                        }
                        ?>
                 </select>
             </td>
         </tr>
             <tr>
                 <td>Niveau d'expérience exigé <span style="color:red">*</span></td>
                 <td><select id="exp1" name="exp" style="width:510px"
                 title="Niveau d'expérience exigé" required/>
<option value="" selected="selected"></option>
                         <?php
                         $req_exp = mysql_query("SELECT * FROM prm_experience");
                         while ($exper = mysql_fetch_array($req_exp)) {
                             $exp_id = $exper['id_expe'];
                             $exp_desc = $exper['intitule'];
                             if ($exp_id == $id_exp )
                                 $selected = 'selected';
                             else
                                 $selected = '';
                             echo "<option value=\"$exp_id\" " . $selected . ">$exp_desc</option>";
                         }
                         ?>
                     </select>
                 </td>
             </tr>
         <tr>
             <td>Type de contrat <span style="color:red">*</span></td>
             <td><select id="poste1" name="poste" style="width:510px"
             title="Niveau d'expérience exigé" required/>
<option value="" selected="selected"></option>
                         <?php
                         $req_poste = mysql_query("SELECT * FROM prm_type_poste");
                         while ($type_poste = mysql_fetch_array($req_poste)) {
                             $poste_id = $type_poste['id_tpost'];
                             $poste_desc = $type_poste['designation'];
                             if ($poste_id == $id_poste)
                                 $selected = 'selected';
                             else
                                 $selected = '';
                             echo "<option value=\"$poste_id\" " . $selected . ">$poste_desc</option>";
                         }
                         ?>
                 </select>
             </td>
         </tr>
             <tr>
                 <td>
                   <?php if($_SESSION['r_prm_region_off']==0){ ?> 
                  Région de travail
                  <?php }else{ ?>
                  Lieu de travail
                  <?php } ?>
                  </td>
                 <td><select id="lieu1" name="lieu" style="width:510px"
                 title="Lieu de travail" required/>
                        <option value="" selected="selected"></option>
                        <?php 
                         if($_SESSION['r_prm_region_off']==0){ 
                            $req_lieu = mysql_query("SELECT * FROM prm_region");
                            while ($localisation = mysql_fetch_array($req_lieu)) {
                             $lieu_id = $localisation['id_region'];
                             $lieu_desc = $localisation['nom_region'];
                             if ($lieu_id == $id_lieu)
                                 $selected = 'selected';
                             else
                                 $selected = '';
                             echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";
                         
                            }
                         }else{ 
                            $req_lieu = mysql_query("SELECT * FROM prm_villes");
                            while ($localisation = mysql_fetch_array($req_lieu)) {
                             $lieu_id = $localisation['id_vill'];
                             $lieu_desc = $localisation['ville'];
                             if ($lieu_id == $id_lieu)
                                 $selected = 'selected';
                             else
                                 $selected = '';
                             echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";
                            }
                          } ?>
                     </select>  
                      <?php /*
                         $req_lieu = mysql_query("SELECT * FROM prm_villes");
                         while ($localisation = mysql_fetch_array($req_lieu)) {
                             $lieu_id = $localisation['id_vill'];
                             $lieu_desc = $localisation['ville'];
                             if ($lieu_id == $id_lieu)
                                 $selected = 'selected';
                             else
                                 $selected = '';
                             echo "<option value=\"$lieu_id\" " . $selected . ">$lieu_desc</option>";
                         } */ ?>
                 </td>
             </tr> 
<tr>
    <td ><label>Mobilité géographique </label> </td>
                 <td>
				 
				 
				 <?php
				 
				/*    echo '<br>test -- : '.$mobilite; //*/

					$var_oui = $var_non = ''; 
				 if (isset($mobilite) AND $mobilite == 'oui') {$var_oui = 'checked';$var_non = '';} 
				 else  {$var_oui = '';$var_non = 'checked';}
				 
				 ?>
			  <input name="mobilite" title=" Votre mobilité géographique" type="radio" value="oui" 
			  onclick="document.getElementById('mobilite').style.display='inline'" style="width:20px" <?php  echo $var_oui; ?> />
			  Oui
			  <input name="mobilite" type="radio" value="non" 
			  onclick="document.getElementById('mobilite').style.display='none'" style="width:20px"  <?php  echo $var_non; ?> />
			  Non
	   
        <ul id="mobilite" style="display:<?php if ( $mobilite== 'oui') echo 'inline';else echo 'none'; ?>;list-style:none;">
   <li >Au niveau :
           <?php
		   $i=0;
            $req1_mobi = mysql_query("SELECT * FROM prm_mobi_niv");
            while ($mobi_n1 = mysql_fetch_array($req1_mobi)) {
          $mobin_id = $mobi_n1['id_mobi_niv'];          $mobi_n = $mobi_n1['niveau'];
          if ((isset($niveau) and $mobin_id == $niveau) or ( $i==0))
            $selected = 'checked';
          else
            $selected = '';
          echo '<input name="niveau" type="radio" value="'.$mobin_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_n;		  
		   $i++;
            }
            ?>    
     </li>
   <li style="list-style-type: none;"> Taux de mobilité: 
           <?php
		   $i=0;
            $req2_mobi = mysql_query("SELECT * FROM prm_mobi_taux");
            while ($mobi_t2 = mysql_fetch_array($req2_mobi)) {
          $mobit_id = $mobi_t2['id_mobi_taux'];         $mobi_t = $mobi_t2['taux'];
          if ((isset($taux) and $mobit_id == $taux) or ( $i==0))
            $selected = 'checked';
          else
            $selected = '';
          echo '<input name="taux" type="radio" value="'.$mobit_id .'" style="width: 20px;" '. $selected .' /> '.$mobi_t;
		   $i++;
            }
            
            ?>   
     
     </li>
        </ul></td>
</tr>
             
             <tr>
                 <td width="169">Date d’expiration </td>
                 <td width="503">
                 <!--<input id="date_expiration"   name="date_expiration" 
                 value="<?php echo $r_date_expiration; ?>" maxlength="80" style="width:504px" />-->
                 <input id="date_expiration"  min="<?php echo date("Y-m-d");?>"  name="date_expiration"   
                 value="<?php if(isset($r_date_expiration)) {
                   echo date("d/m/Y", strtotime($r_date_expiration)); 
                 } ?>" maxlength="10" style="width:504px" pattern="\d{1,2}/\d{1,2}/\d{4}" /></td>
             </tr>
              
			  
             
             
              <?php

	if($_SESSION['r_prm_offr_email']==0){
	 
              ?>
              
              
              <tr>
                 <td width="169">Email :</td>
                 <td width="503">
                 <input id="contact_email"  value="<?php  if(isset($r_contact)) echo stripslashes($r_contact);  else echo ""; ?>" placeholder="Email"
                 name="contact_email"  style="width:504px" type="email" /></td>
             </tr>
              
             
              <?php
	}

	if($_SESSION['r_prm_offr_up_img']==0){
	 
              ?>
              
              
              <tr>
                 <td width="169">Photo :</td>
                 <td width="503">
                 <input type="file" id="photo_offre"  name="photo_offre"  style="width:504px"  /></td>
             </tr>
			  
             
              <?php
	}
	 
              ?>
              
              
			  
        <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>
         </table>
		 <!--
		 0000000000000000000000000000000000000000000000000000000000000000000000000000000
     </form>
		 0000000000000000000000000000000000000000000000000000000000000000000000000000000
         -->                 
  </div>


  <tr>
      <td colspan="2">
          <div class="subscription" style="margin: 10px 0 5px;">
              <h1>Avis de concours</h1>
          </div>
      </td>
  </tr>
  <tr>
      <td colspan="2"><input type="file" id="avis_concours" name="avis_concours" /></td>
      <?php if(isset($r01['avis_concours']) && $r01['avis_concours'] != '') : ?>
          <a href="<?= site_url('apps/upload/frontend/offre/avis_concours/'.$r01['avis_concours']) ;?>" style="margin-top: 10px;display: block;"><i class="fa fa-download"></i>&nbsp;Télécharger (<?= $r01['avis_concours']; ?>)</a>
      <?php endif; ?>
  </tr>

  <tr>
      <td colspan="2">
          <div class="subscription" style="margin: 10px 0 5px;">
              <h1>Décisions de recrutement</h1>
          </div>
      </td>
  </tr>
  <tr>
      <td colspan="2"><input type="file" id="decisions_recrutement" name="decisions_recrutement" /></td>
      <?php if(isset($r01['decisions_recrutement']) && $r01['decisions_recrutement'] != '') : ?>
          <a href="<?= site_url('apps/upload/frontend/offre/decisions_recrutement/'.$r01['decisions_recrutement']) ;?>" style="margin-top: 10px;display: block;"><i class="fa fa-download">&nbsp;Télécharger (<?= $r01['decisions_recrutement']; ?>)</i></a>
      <?php endif; ?>
  </tr>
  </tr>

  <tr>
      <td colspan="2">
          <div class="subscription" style="margin: 10px 0 5px;">
              <h1>Liste des candidats convoqués</h1>
          </div>
      </td>
  </tr>
  <tr>
      <td colspan="2"><input type="file" id="candidats_convoques" name="candidats_convoques" /></td>
      <?php if(isset($r01['candidats_convoques']) && $r01['candidats_convoques'] != '') : ?>
          <a href="<?= site_url('apps/upload/frontend/offre/candidats_convoques/'.$r01['candidats_convoques']) ;?>" style="margin-top: 10px;display: block;"><i class="fa fa-download"></i>&nbsp;Télécharger (<?= $r01['candidats_convoques']; ?>)</a>
      <?php endif; ?>
  </tr>
  </tr>

  <tr>
      <td colspan="2">
          <div class="subscription" style="margin: 10px 0 5px;">
              <h1>Résultats des concours</h1>
          </div>
      </td>
  </tr>
  <tr>
      <td colspan="2"><input type="file" id="resultats_concours" name="resultats_concours" />
      <?php if(isset($r01['resultats_concours']) && $r01['resultats_concours'] != '') : ?>
          <a href="<?= site_url('apps/upload/frontend/offre/resultats_concours/'.$r01['resultats_concours']) ;?>" style="margin-top: 10px;display: block;"><i class="fa fa-download"></i>&nbsp;Télécharger (<?= $r01['resultats_concours']; ?>)</a>
      <?php endif; ?></td>
  </tr>

  <tr>
      <td colspan="2">
          <div class="subscription" style="margin: 10px 0 5px;">
              <h1>Pièces joints (visible seulement pour administrateurs)</h1>
          </div>
      </td>
  </tr>
  <tr>
      <td colspan="2"><input type="file" id="attachements" name="attachements[]" multiple />
      <?php if(isset($r01['attachements']) && !empty(json_decode($r01['attachements'], true))) : ?>
        <ul style="margin-top: 10px;display: block;">
          <?php foreach (json_decode($r01['attachements'], true) as $key => $attachement): ?>
            <li style="list-style: none;">
              <a href="<?= site_url('apps/upload/frontend/offre/attachements/'.$attachement) ;?>"><i class="fa fa-download"></i>&nbsp;Télécharger (<?= $attachement; ?>)</a>
            </li>
          <?php endforeach ?>
        </ul>
      <?php endif; ?><br></td>
  </tr>

  <?php \App\Event::trigger('after_offre_fields', ['id_offre' => $_POST['id']]); ?>
        

		  	
<div id='soumettre' style="padding-left: 0px; ">
				  <?php
				   
				   
				  $passed = true;
				  $now = date("Y-m-d");
								 
                  $ref = isset($_POST['ref']) ? $_POST['ref'] : "";
				  
				  //echo '<br>'.$id_off;
				  //echo '<br>'.$id_off_m;
                       
                 ?>
 						        
			
<?php  

	if($_SESSION['r_prm_note']==0){
		 
		
?>
	       <!--div class="subscription" style="margin: 10px 0pt;">
                         <h1>Notation du poste </h1>
                     </div--> 
												
											
												
												 
		 <!--
		 0000000000000000000000000000000000000000000000000000000000000000000000000000000
     <form method="post" action="#" name="form2" > 
		 0000000000000000000000000000000000000000000000000000000000000000000000000000000
		 -->
         <table width="678" cellpadding="0" border="0">
 
       
			  
            
			
<?php   //include ("./modifier_offre_m_note.php"); ?>
              
        <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>
         </table>

        <!--p><strong style="color:#CC0000">P.S: Attention, la modification de la notation va recalculer et écraser les anciennes notes de tout les candidatures de l'offre.<br/> les champs marqués par (*) sont obligatoires.</strong><br/>  <br/-->
         <p><strong style="color:#CC0000">Les champs marqués par (*) sont obligatoires.</strong><br/>  <br/>
  <?php  
 
    }
    
?>       
             <input id="envoi1" class="espace_candidat" name="envoi" type="submit" value="Enregistrer" style="width:170px"  onclick="valider();" />
             <input class="espace_candidat" name="" type="reset" style="width:170px"/>
         </p>

     </form>                 
  </div>
        

		
  </div>
           