<?php
/**
 * ExperienceController
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
use App\Ajax;
use App\Media;
use App\Form;

class ExperienceController extends Controller
{

  public function index()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mon CV"), trans("Experiences")];
    return get_page('front/candidat/cv/experiences/index', $this->data);
  }

  public function getForm($data)
  {
    $experience = new \stdClass;
    $title = trans("Créer une expérience");
    if (intval($data['id']) > 0) {
      $experience = getDB()->prepare("SELECT * FROM experience_pro WHERE candidats_id=? AND id_exp=?", [
        get_candidat_id(),
        $data['id']
      ], true);
      if (!isset($experience->id_exp)) return;
      $title = trans("Modifier l'expérience");
    }
    $data['exp'] = $experience;
    $data['villes'] = getDB()->read('prm_villes');
    $data['pays'] = getDB()->read('prm_pays');
    $data['sectors'] = getDB()->read('prm_sectors');
    return Ajax::renderAjaxView($title, 'front/candidat/cv/experiences/form', $data);
  }


  public function store($data) {
    Validator::set_field_names([
      'id_sect' => trans("Secteur d'activité"),
      'id_fonc' => trans("Fonction"),
      'fonction_other' => trans("Autre Fonction"),
      'id_tpost' => trans("Type de contrat"),
      'id_pays' => trans("Pays"),
      'date_debut' => trans("Date de début"),
      'date_fin' => trans("Date de fin"),
      'poste' => trans("Intitulé du poste"),
      'entreprise' => trans("Entreprise"),
      'ville' => trans("Ville"),
      'ville_other' => trans("Autre ville"),
      'description' => trans("Description du poste"),
      'salair_pecu' => trans("Dernier salaire perçu")
    ]);

    $data['date_debut'] = eta_date($data['date_debut'], 'Y-m-d');
    if (!empty($data['date_fin'])) {
      $data['date_fin'] = eta_date($data['date_fin'], 'Y-m-d');
    }

    $is_valid = Validator::is_valid($data, [
      'id_sect' => 'numeric',
      'id_fonc' => 'numeric',
      'fonction_other' => 'eta_string',
      'id_tpost' => 'numeric',
      'id_pays' => 'numeric',
      'date_debut' => 'date',
      'date_fin' => 'date',
      'poste' => 'eta_alpha_numeric|max_len,255',
      'entreprise' => 'eta_alpha_numeric|max_len,255',
      'ville' => 'eta_string',
      'ville_other' => 'eta_string',
      'description' => 'eta_alpha_numeric',
      'salair_pecu' => 'numeric'
    ]);
    
    if(is_array($is_valid)) {
      return $this->jsonResponse('error', $is_valid);
    }

    // Check if file posted
    if (Form::getFieldOption('displayed', 'register', 'copie_attestation')) {
      if ($_FILES['copie_attestation']['size'] > 0) {
        $upload = Media::upload($_FILES['copie_attestation'], [
          'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
          'uploadDir' => get_copie_attestation_base()
        ]);
        if(isset($upload['files'][0]) && $upload['files'][0] != '') {
          $data['copie_attestation'] = $upload['files'][0];
        } else {
          return $this->jsonResponse('error', $upload['errors'][0]);
        }
      }
    }
    
    if (Form::getFieldOption('displayed', 'register', 'bulletin_paie')) {
      if ($_FILES['bulletin_paie']['size'] > 0) {
        $upload = Media::upload($_FILES['bulletin_paie'], [
          'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
          'uploadDir' => get_bulletin_paie_base()
        ]);
        if(isset($upload['files'][0]) && $upload['files'][0] != '') {
          $data['bulletin_paie'] = $upload['files'][0];
        } else {
          return $this->jsonResponse('error', $upload['errors'][0]);
        }
      }
    }
    
    if (isset($data['ville_other']) && !empty($data['ville_other'])) {
      $data['ville'] = $data['ville_other'];
    }
    unset($data['ville_other']);

    $id_exp = $data['id'];
    unset($data['id']);
    $data['date_debut'] = english_to_french_date($data['date_debut']);
    if ($data['date_fin'] != '') {
      $data['date_fin'] = english_to_french_date($data['date_fin']);
    }
    if (intval($id_exp) > 0) {
      if (getDB()->update('experience_pro', 'id_exp', $id_exp, $data, false)) {
        return $this->jsonResponse('success', trans("L’expérience a bien été mis à jour."));
      }
    } else {
      $data['candidats_id'] = get_candidat_id();
      if (getDB()->create('experience_pro', $data, false)) {
        $action = (str_replace(site_url(), '', $_SERVER['HTTP_REFERER']) == 'candidat/cv') ? 'reload' : 'refresh';
        return $this->jsonResponse('success', trans("L’expérience a bien été créée."), ['action' => $action]);
      }
    }
  }

  public function delete($data)
  {
    $experience = getDB()->prepare("SELECT * FROM experience_pro WHERE candidats_id=? AND id_exp=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($experience->id_exp)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer l'expérience."));
    }

    if ($experience->copie_attestation != '') {
      unlinkFile(get_copie_attestation_base($experience->copie_attestation));
    }

    if ($experience->bulletin_paie != '') {
      unlinkFile(get_bulletin_paie_base($experience->bulletin_paie));
    }

    getDB()->delete('experience_pro', 'id_exp', $data['id']);
    return $this->jsonResponse('success', trans("L’expérience a bien été supprimée."));
  }

  public function deleteCertificate($data)
  {
    $experience = getDB()->prepare("SELECT * FROM experience_pro WHERE candidats_id=? AND id_exp=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($experience->id_exp)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer la copie de l’attestation."));
    }

    if ($experience->copie_attestation != '') {
      unlinkFile(get_copie_attestation_base($experience->copie_attestation));
    }

    getDB()->update('experience_pro', 'id_exp', $data['id'], ['copie_attestation' => null]);

    return $this->jsonResponse('success', trans("La copie de l’attestation a bien été supprimée."));
  }

  public function deleteBulletinPaie($data)
  {
    $experience = getDB()->prepare("SELECT * FROM experience_pro WHERE candidats_id=? AND id_exp=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($experience->id_exp)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer la bulletin de paie."));
    }

    if ($experience->bulletin_paie != '') {
      unlinkFile(get_bulletin_paie_base($experience->bulletin_paie));
    }

    getDB()->update('experience_pro', 'id_exp', $data['id'], ['bulletin_paie' => null]);

    return $this->jsonResponse('success', trans("La bulletin de paie a bien été supprimée."));
  }

	
} // END Class