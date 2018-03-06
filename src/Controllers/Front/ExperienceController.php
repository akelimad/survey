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

class ExperienceController extends Controller
{

  public function index()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon CV', 'Experiences'];
    return get_page('front/candidat/cv/experiences/index', $this->data);
  }

  public function getForm($data)
  {
    $experience = new \stdClass;
    $title = 'Créer une experience';
    if (intval($data['id']) > 0) {
      $experience = getDB()->prepare("SELECT * FROM experience_pro WHERE candidats_id=? AND id_exp=?", [
        get_candidat_id(),
        $data['id']
      ], true);
      if (!isset($experience->id_exp)) return;
      $title = 'Modifier l\'experience';
    }
    $data['exp'] = $experience;
    $data['villes'] = getDB()->read('prm_villes');
    $data['pays'] = getDB()->read('prm_pays');
    $data['sectors'] = getDB()->read('prm_sectors');
    return Ajax::renderAjaxView($title, 'front/candidat/cv/experiences/form', $data);
  }


  public function store($data) {
    Validator::set_field_names([
      'id_sect' => 'Secteur d\'activité',
      'id_fonc' => 'Fonction',
      'id_tpost' => 'Type de contrat',
      'id_pays' => 'Pays',
      'date_debut' => 'Date de début',
      'date_fin' => 'Date de fin',
      'poste' => 'Intitulé du poste',
      'entreprise' => 'Entreprise',
      'ville' => 'Ville',
      'description' => 'Description du poste',
      'salair_pecu' => 'Dernier salaire perçu'
    ]);

    $is_valid = Validator::is_valid($data, [
      'id_sect' => 'numeric',
      'id_fonc' => 'numeric',
      'id_tpost' => 'numeric',
      'id_pays' => 'numeric',
      'date_debut' => 'date',
      'date_fin' => 'date',
      'poste' => 'eta_alpha_numeric|max_len,255',
      'entreprise' => 'eta_alpha_numeric|max_len,255',
      'ville' => 'alpha',
      'description' => 'eta_alpha_numeric',
      'salair_pecu' => 'numeric'
    ]);
    
    if(is_array($is_valid)) {
      return $this->jsonResponse('error', $is_valid);
    }

    // Check if file posted
    if ($_FILES['copie_attestation']['size'] > 0) {
      $upload = Media::upload($_FILES['copie_attestation'], [
        'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
        'uploadDir' => 'apps/upload/frontend/candidat/copie_attestation/'
      ]);
      if(isset($upload['files'][0]) && $upload['files'][0] != '') {
        $data['copie_attestation'] = $upload['files'][0];
      } else {
        return $this->jsonResponse('error', $upload['errors'][0]);
      }
    }
    $id_exp = $data['id'];
    unset($data['id']);
    $data['date_debut'] = english_to_french_date($data['date_debut']);
    if ($data['date_fin'] != '') {
      $data['date_fin'] = english_to_french_date($data['date_fin']);
    }
    if (intval($id_exp) > 0) {
      if (getDB()->update('experience_pro', 'id_exp', $id_exp, $data, false)) {
        return $this->jsonResponse('success', 'L\'experience a été bien mis à jour.');
      }
    } else {
      $data['candidats_id'] = get_candidat_id();
      if (getDB()->create('experience_pro', $data, false)) {
        $action = (str_replace(site_url(), '', $_SERVER['HTTP_REFERER']) == 'candidat/cv') ? 'reload' : 'refresh';
        return $this->jsonResponse('success', 'L\'experience a été bien créer.', ['action' => $action]);
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
      return $this->jsonResponse('error', 'Impossible de supprimer l\'experience.');
    }

    if ($experience->copie_attestation != '') {
      unlinkFile(site_base('apps/upload/frontend/candidat/copie_attestation/'.$experience->copie_attestation));
    }
    getDB()->delete('experience_pro', 'id_exp', $data['id']);
    return $this->jsonResponse('success', 'L\'experience a été bien supprimé.');
  }

  public function deleteCertificate($data)
  {
    $experience = getDB()->prepare("SELECT * FROM experience_pro WHERE candidats_id=? AND id_exp=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($experience->id_exp)) {
      return $this->jsonResponse('error', 'Impossible de supprimer la copie de l’attestation.');
    }

    if ($experience->copie_attestation != '') {
      unlinkFile(site_base('apps/upload/frontend/candidat/copie_attestation/'.$experience->copie_attestation));
    }

    getDB()->update('experience_pro', 'id_exp', $data['id'], ['copie_attestation' => null]);

    return $this->jsonResponse('success', 'La copie de l’attestation a été bien supprimé.');
  }

	
} // END Class