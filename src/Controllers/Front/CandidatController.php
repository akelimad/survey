<?php
/**
 * CandidatController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Helpers\Form\Validator;
use App\Models\Candidat;
use App\Models\Resume;
use App\Models\MotivationLetter;
use App\Models\Formation;
use App\Models\Experience;
use App\Media;
use App\Mail\Mailer;
use Mpdf\Mpdf;

class CandidatController extends Controller
{

  private $rules = [
    'id_civi' => 'required|numeric',
    'id_pays' => 'required|numeric',
    'id_situ' => 'required|numeric',
    'id_sect' => 'required|numeric',
    'id_fonc' => 'required|numeric',
    'fonction_other' => 'eta_string',
    'id_salr' => 'numeric',
    'id_currency' => 'numeric',
    'id_nfor' => 'required|numeric',
    'id_tfor' => 'required|numeric',
    'id_dispo' => 'required|numeric',
    'id_expe' => 'required|numeric',
    'titre' => 'required|eta_alpha_numeric|min_len,3|max_len,255',
    'nom' => 'required|valid_name|min_len,3|max_len,32',
    'prenom' => 'required|valid_name|min_len,3|max_len,32',
    'date_n' => 'required|date|min_age,15',
    'adresse' => 'required|eta_alpha_numeric|max_len,255',
    'code' => 'numeric|max_len,5',
    'ville' => 'required|eta_string',
    'ville_other' => 'required|eta_string',
    'nationalite' => 'required|eta_string|max_len,16',
    'cin' => 'alpha_numeric|max_len,8',
    'dial_code' => 'required|eta_alpha_numeric',
    'tel1' => 'required|phone_number|max_len,16',
    'tel2' => 'phone_number|max_len,16',
    'mobilite' => 'required|alpha',
    'niveau_mobilite' => 'required|numeric',
    'taux_mobilite' => 'required|numeric'
  ];


  private $field_names = [
    'id_civi' => 'Civilité',
    'id_pays' => 'Pays de résidence',
    'id_situ' => 'Situation actuelle',
    'id_sect' => 'Secteur actuel',
    'id_fonc' => 'Fonction',
    'fonction_other' => 'Autre Fonction',
    'id_salr' => 'Salaire souhaité',
    'id_currency' => 'Devise',
    'id_nfor' => 'Niveau de formation',
    'id_tfor' => 'Type de formation',
    'id_dispo' => 'Disponibilité',
    'id_expe' => 'Expérience',
    'titre' => 'Titre de votre profil',
    'nom' => 'Nom',
    'prenom' => 'Prénom',
    'date_n' => 'Date de naissance',
    'adresse' => 'Adresse',
    'code' => 'Code postal',
    'ville' => 'Ville',
    'ville_other' => 'Autre ville',
    'nationalite' => 'Nationalité',
    'cin' => 'CIN',
    'dial_code' => 'Indicatif téléphonique',
    'tel1' => 'Téléphone',
    'tel2' => 'Téléphone secondaire',
    'mobilite' => 'Mobilité géographique',
    'niveau_mobilite' => 'Niveau de mobilité',
    'taux_mobilite' => 'Taux de mobilité'
  ];


  public function confirmAccount($data)
  {
    $db = getDB();
    $candidat = $db->prepare("SELECT * FROM candidats WHERE md5(CONCAT(email, candidats_id))=? AND status=2 AND last_connexion is null", [$data['token']], true);

    if (isset($candidat->candidats_id)) {
      $update = $db->update('candidats', 'candidats_id', $candidat->candidats_id, [
        'status' => 1,
        'last_connexion' => date("Y-m-d H:i:s")
      ]);
      if ($update) {
        create_session('abb_login_candidat', $candidat->email);
        create_session('abb_nom', Candidat::getDisplayName($candidat, false));
        create_session('abb_id_candidat', $candidat->candidats_id);
        // Send welcome email
        $template = getDB()->findOne('root_email_auto', 'ref', 'b');
        if(isset($template->id_email)) {
          $variables = Mailer::getVariables($candidat);
          $subject = Mailer::renderMessage($template->objet, $variables);
          $message = Mailer::renderMessage($template->message, $variables);

          Mailer::send($candidat->email, $subject, $message, [
            'titre' => $template->titre,
            'type_email' => 'Envoi automatique'
          ]);
        }
        // redirect
        redirect('candidat/compte');
      }
    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Confirmation du compte")];
      return get_page('front/candidat/account/confirm', $this->data);
    }
  }


  public function account()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mon compte")];
    $progress = $this->getAccountProgress();
    $this->data['progress'] = $progress;
    $this->data['progress_color'] = $this->percent2Color($progress, 180, 100);
    
    return get_page('front/candidat/account/index', $this->data);
  }


  public function cv()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mon CV")];
    $progress = $this->getAccountProgress();
    $this->data['progress'] = $progress;
    $this->data['progress_color'] = $this->percent2Color($progress, 180, 100);
    $this->data['cvs'] = Resume::getByCandidatId();
    $this->data['lms'] = MotivationLetter::getByCandidatId();
    $this->data['formations'] = Formation::getByCandidatId();
    $this->data['experiences'] = Experience::getByCandidatId();
    return get_page('front/candidat/cv/index', $this->data);
  }

  public function getAccountProgress()
  {
    $progress = 0;

    $candidat = get_candidat();

    if (!isset($candidat->candidats_id)) return $progress;

    $hasPhoto = ($candidat->photo != '');
    $hasLM = Candidat::hasLM($candidat->candidats_id);
    $hasExp = Candidat::hasExperience($candidat->candidats_id);

    if (!$hasPhoto && !$hasLM && $hasExp) {
      $progress += 75;
    } else if ($hasPhoto) {
      $progress += 25;
    } else if ($hasLM) {
      $progress += 25;
    } else if ($hasExp) {
      $progress += 25;
    }

    // Candidat speak at least one language
    if ($candidat->arabic != '' || $candidat->french != '' || $candidat->english != '' || $candidat->autre != '' || $candidat->autre1 != '' || $candidat->autre2 != '') $progress += 25;

    if ($progress == 0) $progress = 25;

    return ($progress <= 100) ? $progress : 100;
  }


  public function deactivateAccount($data)
  {
    if (is_ajax() && form_submited()) {
      $db = getDB();
      $deactivate = $db->create('compte_desactiver', [
        'candidats_id' => get_candidat_id(),
        'raison' => $data['raison'],
        'date_action' => date("Y-m-d H:i:s")
      ]);

      if ($deactivate && $db->update('candidats', 'candidats_id', get_candidat_id(), ['status' => 0, 'dateMAJ' => date("Y-m-d H:i:s")])) {
        // Send email
        $template = getDB()->findOne('root_email_auto', 'ref', 'o');
        if(isset($template->id_email)) {
          $variables = Mailer::getVariables(get_candidat_id());
          $subject = Mailer::renderMessage($template->objet, $variables);
          $message = Mailer::renderMessage($template->message, $variables);
          
          Mailer::send(get_candidat('email'), $subject, $message, [
            'titre' => $template->titre,
            'type_email' => 'Envoi automatique'
          ]);
        }
        return $this->jsonResponse('deactivated', trans("Votre compte candidat a été désactivé avec success, deconnexion en cours..."));
      }
      return $this->jsonResponse('error', trans("Impossible de désactiver le compte."));
    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Désactiver mon compte")];
      return get_page('front/candidat/account/deactivate', $this->data);
    }
  }


  public function informations($data)
  {
    if (is_ajax() && form_submited()) {
      Validator::set_field_names($this->field_names);

      $is_valid = Validator::is_valid($data, $this->rules);
      
      if(is_array($is_valid)) {
        return $this->jsonResponse('error', $is_valid);
      }

      if (isset($data['ville_other']) && !empty($data['ville_other'])) {
        $data['ville'] = $data['ville_other'];
      }
      unset($data['ville_other']);

      $data['date_n'] = \eta_date($data['date_n'], 'Y-m-d');
      $data['dateMAJ'] = date("Y-m-d H:i:s");

      getDB()->update('candidats', 'candidats_id', get_candidat_id(), $data, false);

      return $this->jsonResponse('success', trans("Vos informations personnalles ont été bien mis à jour."));

    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mon CV"), trans("Informations personnalles")];

      $this->data['villes'] = getDB()->read('prm_villes');
      $this->data['pays'] = getDB()->read('prm_pays');
      $this->data['sectors'] = getDB()->read('prm_sectors');
      $this->data['niv_formation'] = getDB()->read('prm_niv_formation');

      return get_page('front/candidat/cv/informations/index', $this->data);
    }
  }


  public function languages($data)
  {
    if (form_submited()) {
      $variables = [];

      Validator::set_field_names([
        'arabic' => trans("Langue Arabe"),
        'french' => trans("Langue Français"),
        'english' => trans("Langue Anglais"),
        'autre' => trans("Autres 1"),
        'autre_n' => trans("Autres 1 niveau"),
        'autre1' => trans("Autres 2"),
        'autre1_n' => trans("Autres 2 niveau"),
        'autre2' => trans("Autres 3"),
        'autre2_n' => trans("Autres 3 niveau"),
      ]);

      $is_valid = Validator::is_valid($data['candidat'], [
        'arabic' => 'eta_string',
        'french' => 'eta_string',
        'english' => 'eta_string',
        'autre' => 'eta_string',
        'autre_n' => 'eta_string',
        'autre1' => 'eta_string',
        'autre1_n' => 'eta_string',
        'autre2' => 'eta_string',
        'autre2_n' => 'eta_string'
      ]);
      if(is_array($is_valid)) {
        set_flash_message('error', $is_valid);
      } else {
        // Upload attachements
        $upload = $this->uploadAttachements();
        if(isset($upload['errors']) && !empty($upload['errors'])) {
          set_flash_message('error', $upload['errors']);
        } else {
          $db = getDB();
          // Create CV
          if (isset($upload['files']['cv'])) {
            $db->create('cv', [
              'candidats_id' => get_candidat_id(),
              'titre_cv' => $upload['files']['cv']['title'],
              'lien_cv' => $upload['files']['cv']['name'],
              'principal' => 0,
              'actif' => 1
            ], false);
            $data['candidat']['CVdateMAJ'] = date("Y-m-d H:i:s");
          }

          // Create LM
          if(isset($upload['files']['lm'])) {
            $db->create('lettres_motivation', [
              'candidats_id' => get_candidat_id(),
              'titre' => $upload['files']['lm']['title'],
              'lettre' => $upload['files']['lm']['name'],
              'principal' => 0,
              'actif' => 1
            ], false);
          }

          // update candidat languages
          if (isset($upload['files']['photo'])) $data['candidat']['photo'] = $upload['files']['photo']['name'];
          $data['candidat']['dateMAJ'] = date("Y-m-d H:i:s");
          $db->update('candidats', 'candidats_id', get_candidat_id(), $data['candidat'], false);
          set_flash_message('success', trans("Vos informations ont été bien mis à jour."));
        }
      }
      redirect('candidat/cv/langues_pj');
    } else {
      // Render page
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mon CV"), trans("Langues et piéces joints")];
      $this->data['cvs'] = Resume::getByCandidatId();
      $this->data['lms'] = MotivationLetter::getByCandidatId();
      return get_page('front/candidat/cv/langues_pj/index', $this->data);
    }
  }


  private function uploadAttachements()
  {
    $return = [];
    $rules = [
      'photo' => [
        'name' => trans("Photo"),
        'path' => 'apps/upload/frontend/photo_candidats/',
        'required' => false,
        'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
      ],
      'cv' => [
        'name' => trans("CV"),
        'path' => 'apps/upload/frontend/cv/',
        'required' => !Candidat::hasCV(get_candidat_id()),
        'extensions' => ['doc', 'docx', 'pdf'],
      ],
      'lm' => [
        'name' => trans("Lettre de motivation"),
        'path' => 'apps/upload/frontend/lmotivation/',
        'required' => false,
        'extensions' => ['doc', 'docx', 'pdf'],
      ]
    ];

    // Store uploaded files paths to delete theme if errors
    $upload_paths = [];

    $max_file_size = get_setting('max_file_size');

    foreach ($rules as $key => $rule) {
      $valid = true;
      if($rule['required'] && $_FILES[$key]['size'] < 1) {
        $return['errors'][] = trans("Le champs") ." <strong>{$rule['name']}</strong> ". trans("est obligatoire.");
        $valid = false;
      }
      $extension = strtolower(pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION));
      if ($_FILES[$key]['size'] > 0) {
        if(!in_array($extension, $rule['extensions'])) {
          $return['errors'][] = trans("Le champ") ." <strong>{$rule['name']}</strong> ". trans("doit avoir les extensions suivantes") ." (.". implode(', .', $rule['extensions']) .")";
        } elseif ($_FILES[$key]['size'] > $this->koToOctet($max_file_size)) {
          $return['errors'][] = trans("Vous avez depassé la taille maximal") ." <strong>({$max_file_size}ko)</strong> ". trans("pour le champ") ." <strong>{$rule['name']}</strong>";
        } elseif ($valid) {
          $upload = Media::upload($_FILES[$key], [
            'extensions' => $rule['extensions'],
            'uploadDir' => $rule['path']
          ]);
          if(isset($upload['files'][0]) && $upload['files'][0] != '') {
            $return['files'][$key] = [
              'name' => $upload['files'][0], 
              'title' => str_replace('.'.$extension, '', $_FILES[$key]['name'])
            ];
            $upload_paths[] = $rule['path'] . $upload['files'][0];
          } else {
            $return['errors'][$key] = $upload['errors'][0];
          }
        }
      }
    }
    // Remove uploaded files if errors
    if (!empty($return['errors'])) {
      foreach ($upload_paths as $key => $upath) {
        unlinkFile(site_base($upath));
      }
    }
    return $return;
  }


  public function deletePhoto($data)
  {
    unlinkFile(site_base('apps/upload/frontend/photo_candidats/'. $data['photo']));
    getDB()->update('candidats', 'candidats_id', get_candidat_id(), ['photo' => null, 'dateMAJ' => date("Y-m-d H:i:s")]);

    return $this->jsonResponse('success', trans("La photo a été bien supprimé."));
  }


  public function deleteCV($data)
  {
    $cv = getDB()->prepare("SELECT * FROM cv WHERE id_cv=? AND candidats_id=?", [$data['id'], get_candidat_id()], true);
    if(isset($cv->id_cv) && getDB()->delete('cv', 'id_cv', $cv->id_cv)) {
      unlinkFile(site_base('apps/upload/frontend/cv/'. $cv->lien_cv));
      return $this->jsonResponse('success', trans("Le CV a été bien supprimé."));
    }
    return $this->jsonResponse('error', trans("Impossible de supprimer le CV."));
  }


  public function deleteLM($data)
  {
    $lm = getDB()->prepare("SELECT * FROM lettres_motivation WHERE id_lettre=? AND candidats_id=?", [$data['id'], get_candidat_id()], true);
    if(isset($lm->id_lettre) && getDB()->delete('lettres_motivation', 'id_lettre', $lm->id_lettre)) {
      unlinkFile(site_base('apps/upload/frontend/lmotivation/'. $lm->lettre));
      return $this->jsonResponse('success', trans("La lettre de motivation a été bien supprimé."));
    }
    return $this->jsonResponse('error', trans("Impossible de supprimer La lettre de motivation."));
  }


  public function setCVDefault($data)
  {
    $db = getDB();
    $db->update('cv', 'candidats_id', get_candidat_id(), ['principal' => 0]);
    $db->update('cv', 'id_cv', $data['id'], ['principal' => 1]);
    return $this->jsonResponse('success', trans("Le CV a été défini comme principal."));
  }


  public function setLMDefault($data)
  {
    $db = getDB();
    $db->update('lettres_motivation', 'candidats_id', get_candidat_id(), ['principal' => 0]);
    $db->update('lettres_motivation', 'id_lettre', $data['id'], ['principal' => 1]);
    return $this->jsonResponse('success', trans("Le lettre de motivation a été défini comme principal."));
  }


  public function changePassword($data)
  {
    if(is_ajax() && form_submited()) {

      // Validate passwords
      Validator::set_field_names([
        'current_password' => trans("Mot de passe actuel"),
        'password' => trans("Nouveau mot de passe"),
        'confirm_password' => trans("Confirmer le nouveau mot de passe")
      ]);

      $is_valid = Validator::is_valid($data, [
        'current_password' => 'required|min_len,6',
        'password' => 'required|min_len,6',
        'confirm_password' => 'required|min_len,6'
      ]);

      if(is_array($is_valid)) {
        return $this->jsonResponse('error', $is_valid);
      }

      // Check password strength
      if( $data['password'] != $data['confirm_password'] ) {
        return $this->jsonResponse('error', trans("Les deux mot de passe ne sont pas identique."));
      } elseif (!Candidat::isStrongPassword($data['password'])) {
        return $this->jsonResponse('error', trans("Le mot de passe doit contenir des chiffres et des lettres."));
      }

      // Check current password
      $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM candidats WHERE mdp=?", [md5($data['current_password'])], true);
      if(intval($count->nbr) == 0) {
        return $this->jsonResponse('error', trans("Le mot de passe actuel est incorrect."));
      }

      // Update password
      getDB()->update('candidats', 'candidats_id', get_candidat_id(), [
        'mdp' => md5($data['password']),
        'nl_partenaire' => $data['password'],
        'dateMAJ' => date("Y-m-d H:i:s")
      ]);

      return $this->jsonResponse('success', trans("Votre mot de passe a été bien mis à jour."));
    }
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mes identifiants")];
    return get_page('front/candidat/change-password', $this->data);
  }
	
} // END Class