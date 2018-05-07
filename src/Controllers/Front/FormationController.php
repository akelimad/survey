<?php
/**
 * FormationController
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

class FormationController extends Controller
{

  public function index()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Mon CV"), trans("Formations")];
    return get_page('front/candidat/cv/formations/index', $this->data);
  }

  public function getForm($data)
  {
    $formation = new \stdClass;
    $title = trans("Créer une formation");
    if (intval($data['id']) > 0) {
      $formation = getDB()->prepare("SELECT * FROM formations WHERE candidats_id=? AND id_formation=?", [
        get_candidat_id(),
        $data['id']
      ], true);
      if (!isset($formation->id_formation)) return;
      $title = trans("Modifier la formation");
    }
    $data['formation'] = $formation;
    $data['niv_formation'] = getDB()->read('prm_niv_formation');
    return Ajax::renderAjaxView($title, 'front/candidat/cv/formations/form', $data);
  }


  public function store($data) {
    Validator::set_field_names([
      'id_ecol' => trans("École ou établissement"),
      'date_debut' => trans("Date de début"),
      'date_fin' => trans("Date de fin"),
      'diplome' => trans("Diplôme"),
      'specialty_id' => trans("Spécialité"),
      'nivformation' => trans("Nombre d’année de formation"),
      'description' => trans("Description de la formation"),
      'ecole' => trans("Autre école ou établissement")
    ]);

    $data['date_debut'] = eta_date($data['date_debut'], 'Y-m-d');
    if (!empty($data['date_fin'])) {
      $data['date_fin'] = eta_date($data['date_fin'], 'Y-m-d');
    }

    $is_valid = Validator::is_valid($data, [
      'id_ecol' => 'required|numeric',
      'date_debut' => 'required|date',
      'date_fin' => 'date',
      'diplome' => 'required|numeric',
      'specialty_id' => 'required|numeric',
      'nivformation' => 'required|numeric',
      'description' => 'required|eta_alpha_numeric',
      'ecole' => 'eta_string'
    ]);
    
    if(is_array($is_valid)) {
      return $this->jsonResponse('error', $is_valid);
    }

    // Check if file posted
    if (Form::getFieldOption('displayed', 'register', 'copie_diplome')) {
      if ($_FILES['copie_diplome']['size'] > 0) {
        $upload = Media::upload($_FILES['copie_diplome'], [
          'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
          'uploadDir' => 'apps/upload/frontend/candidat/copie_diplome/'
        ]);
        if(isset($upload['files'][0]) && $upload['files'][0] != '') {
          $data['copie_diplome'] = $upload['files'][0];
        } else {
          return $this->jsonResponse('error', $upload['errors'][0]);
        }
      }
    }

    $id_formation = $data['id'];
    unset($data['id']);
    $data['date_debut'] = english_to_french_date($data['date_debut']);
    if ($data['date_fin'] != '') {
      $data['date_fin'] = english_to_french_date($data['date_fin']);
    }
    if (intval($id_formation) > 0) {
      if (getDB()->update('formations', 'id_formation', $id_formation, $data, false)) {
        return $this->jsonResponse('success', trans("La formation a été bien mis à jour."));
      }
    } else { // Create formation
      $data['candidats_id'] = get_candidat_id();
      if (getDB()->create('formations', $data, false)) {
        $action = (str_replace(site_url(), '', $_SERVER['HTTP_REFERER']) == 'candidat/cv') ? 'reload' : 'refresh';
        return $this->jsonResponse('success', trans("La formation a été bien créer."), ['action' => $action]);
      }
    }
  }

  public function delete($data)
  {
    $formation = getDB()->prepare("SELECT * FROM formations WHERE candidats_id=? AND id_formation=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($formation->id_formation)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer la formation."));
    }

    if ($formation->copie_diplome != '') {
      unlinkFile(site_base('apps/upload/frontend/candidat/copie_diplome/'.$formation->copie_diplome));
    }
    getDB()->delete('formations', 'id_formation', $data['id']);
    return $this->jsonResponse('success', trans("La formation a été bien supprimé."));
  }

  public function deleteDiplome($data)
  {
    $formation = getDB()->prepare("SELECT * FROM formations WHERE candidats_id=? AND id_formation=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($formation->id_formation)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer la copie de diplôme."));
    }

    if ($formation->copie_diplome != '') {
      unlinkFile(site_base('apps/upload/frontend/candidat/copie_diplome/'.$formation->copie_diplome));
    }

    getDB()->update('formations', 'id_formation', $data['id'], ['copie_diplome' => null]);

    return $this->jsonResponse('success', trans("La copie du diplôme a été bien supprimé."));
  }

	
} // END Class