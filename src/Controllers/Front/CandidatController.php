<?php
/**
 * CandidatController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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
    'id_salr' => 'required|numeric',
    'id_nfor' => 'required|numeric',
    'id_tfor' => 'required|numeric',
    'id_dispo' => 'required|numeric',
    'id_expe' => 'required|numeric',
    'titre' => 'required|eta_alpha_numeric|min_len,3|max_len,255',
    'nom' => 'required|valid_name|min_len,3|max_len,32',
    'prenom' => 'required|valid_name|min_len,3|max_len,32',
    'date_n' => 'required', // |date|min_age,17
    'adresse' => 'required|eta_alpha_numeric|max_len,255',
    'code' => 'numeric|max_len,10',
    'ville' => 'required|alpha',
    'nationalite' => 'required|alpha|max_len,16',
    'cin' => 'required|alpha_numeric',
    'tel1' => 'required|phone_number',
    'tel2' => 'phone_number',
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
    'id_salr' => 'Salaire souhaité',
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
    'nationalite' => 'Nationalité',
    'cin' => 'CIN',
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
          $message = Mailer::renderMessage($template->message, [
            'nom_candidat' => Candidat::getDisplayName($candidat),
            'email_candidat' => $candidat->email,
            'mot_passe' => $candidat->nl_partenaire
          ]);
          Mailer::send($candidat->email, $template->objet, $message, [
            'titre' => $template->titre,
            'type_email' => 'Envoi automatique'
          ]);
        }
        // redirect
        redirect('candidat/compte');
      }
    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Confirmation du compte'];
      return get_page('front/candidat/account/confirm', $this->data);
    }
  }


  public function account()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon compte'];
    $progress = $this->getAccountProgress();
    $this->data['progress'] = $progress;
    $this->data['progress_color'] = $this->percent2Color($progress, 180, 100);
    
    return get_page('front/candidat/account/index', $this->data);
  }


  public function cv()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon CV'];
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

    // Candiat has photo
    if ($candidat->photo != '') $progress += 25;

    // Candidat speak at least one language
    if ($candidat->arabic != '' || $candidat->french != '' || $candidat->english != '' || $candidat->autre != '' || $candidat->autre1 != '' || $candidat->autre2 != '') $progress += 25;

    // Candidat has CV
    if (Candidat::hasCV($candidat->candidats_id)) $progress += 25;

    // Candidat has LM
    if (Candidat::hasLM($candidat->candidats_id)) $progress += 25;

    return $progress;
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

      if ($deactivate && $db->update('candidats', 'candidats_id', get_candidat_id(), ['status' => 0])) {
        // Send email
        $template = getDB()->findOne('root_email_auto', 'ref', 'o');
        if(isset($template->id_email)) {
          $message = Mailer::renderMessage($template->message, [
            'nom_candidat' => Candidat::getDisplayName()
          ]);
          Mailer::send(get_candidat('email'), $template->objet, $message, [
            'titre' => $template->titre,
            'type_email' => 'Envoi automatique'
          ]);
        }
        return $this->jsonResponse('deactivated', 'Votre compte candidat a été désactivé avec success, deconnexion en cours...');
      }
      return $this->jsonResponse('error', 'Impossible de désactiver le compte.');
    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Désactiver mon compte'];
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

      $data['date_n'] = \english_to_french_date($data['date_n']);

      getDB()->update('candidats', 'candidats_id', get_candidat_id(), $data, false);

      return $this->jsonResponse('success', 'Vos informations personnalles ont été bien mis à jour.');

    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon CV', 'Informations personnalles'];

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
        'arabic' => 'Langue Arabe',
        'french' => 'Langue Français',
        'english' => 'Langue Anglais',
        'autre' => 'Autres 1',
        'autre_n' => 'Autres 1 niveau',
        'autre1' => 'Autres 2',
        'autre1_n' => 'Autres 2 niveau',
        'autre2' => 'Autres 3',
        'autre2_n' => 'Autres 3 niveau'
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
          $db->update('candidats', 'candidats_id', get_candidat_id(), $data['candidat'], false);
          set_flash_message('success', 'Vos informations ont été bien mis à jour.');
        }
      }
      redirect('candidat/cv/langues_pj');
    } else {
      // Render page
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon CV', 'Langues et piéces joints'];
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
        'name' => 'Photo',
        'path' => 'apps/upload/frontend/photo_candidats/',
        'required' => false,
        'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
      ],
      'cv' => [
        'name' => 'CV',
        'path' => 'apps/upload/frontend/cv/',
        'required' => !Candidat::hasCV(get_candidat_id()),
        'extensions' => ['doc', 'docx', 'pdf'],
      ],
      'lm' => [
        'name' => 'Lettre de motivation',
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
        $return['errors'][] = "Le champs <strong>{$rule['name']}</strong> est obligatoire.";
        $valid = false;
      }
      $extension = pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION);
      if ($_FILES[$key]['size'] > 0) {
        if(!in_array($extension, $rule['extensions'])) {
          $return['errors'][] = "Le champ <strong>{$rule['name']}</strong> doit avoir les extensions suivantes (.". implode(', .', $rule['extensions']) .")";
        } elseif ($_FILES[$key]['size'] > $this->koToOctet($max_file_size)) {
          $return['errors'][] = "Vous avez depassé la taille maximal <strong>({$max_file_size}ko)</strong> pour le champ <strong>{$rule['name']}</strong>";
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

    getDB()->update('candidats', 'candidats_id', get_candidat_id(), ['photo' => null]);

    return $this->jsonResponse('success', 'La photo a été bien supprimé.');
  }


  public function deleteCV($data)
  {
    $cv = getDB()->prepare("SELECT * FROM cv WHERE id_cv=? AND candidats_id=?", [$data['id'], get_candidat_id()], true);
    if(isset($cv->id_cv) && getDB()->delete('cv', 'id_cv', $cv->id_cv)) {
      unlinkFile(site_base('apps/upload/frontend/cv/'. $cv->lien_cv));
      return $this->jsonResponse('success', 'Le CV a été bien supprimé.');
    }
    return $this->jsonResponse('error', 'Impossible de supprimer le CV.');
  }


  public function deleteLM($data)
  {
    $lm = getDB()->prepare("SELECT * FROM lettres_motivation WHERE id_lettre=? AND candidats_id=?", [$data['id'], get_candidat_id()], true);
    if(isset($lm->id_lettre) && getDB()->delete('lettres_motivation', 'id_lettre', $lm->id_lettre)) {
      unlinkFile(site_base('apps/upload/frontend/lmotivation/'. $lm->lettre));
      return $this->jsonResponse('success', 'La lettre de motivation a été bien supprimé.');
    }
    return $this->jsonResponse('error', 'Impossible de supprimer La lettre de motivation.');
  }


  public function setCVDefault($data)
  {
    $db = getDB();
    $db->update('cv', 'candidats_id', get_candidat_id(), ['principal' => 0]);
    $db->update('cv', 'id_cv', $data['id'], ['principal' => 1]);
    return $this->jsonResponse('success', 'Le CV a été défini comme principal.');
  }


  public function setLMDefault($data)
  {
    $db = getDB();
    $db->update('lettres_motivation', 'candidats_id', get_candidat_id(), ['principal' => 0]);
    $db->update('lettres_motivation', 'id_lettre', $data['id'], ['principal' => 1]);
    return $this->jsonResponse('success', 'Le lettre de motivation a été défini comme principal.');
  }


  public function changePassword($data)
  {
    if(is_ajax() && form_submited()) {

      // Validate passwords
      Validator::set_field_names([
        'current_password' => 'Mot de passe actuel',
        'password' => 'Nouveau mot de passe',
        'confirm_password' => 'Confirmer le nouveau mot de passe'
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
        return $this->jsonResponse('error', 'Les deux mot de passe ne sont pas identique.');
      } elseif (!Candidat::isStrongPassword($data['password'])) {
        return $this->jsonResponse('error', 'Le mot de passe doit contenir les chiffres et des lettres.');
      }

      // Check current password
      $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM candidats WHERE mdp=?", [md5($data['current_password'])], true);
      if(intval($count->nbr) == 0) {
        return $this->jsonResponse('error', 'Le mot de passe actuel est incorrect.');
      }

      // Update password
      getDB()->update('candidats', 'candidats_id', get_candidat_id(), [
        'mdp' => md5($data['password']),
        'nl_partenaire' => $data['password']
      ]);

      return $this->jsonResponse('success', 'Votre mot de passe a été bien mis à jour.');
    }
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mes identifiants'];
    return get_page('front/candidat/change-password', $this->data);
  }

	
} // END Class