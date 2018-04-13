<?php
/**
 * SurveyController
 *
 * @author mchanchaf
 *
 * @package modules.survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Controllers;

use App\Controllers\Controller;
use Modules\Survey\Models\Survey;
use App\Ajax;

class SurveyController extends Controller
{
  private $data = [];

  public function index()
  {
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("Questionnaires"),
      trans("Liste des questionnaires")
    ];
    return get_page('admin/survey/index', $this->data, __FILE__);
  }

  public function form($data)
  {
    $survey = new \stdClass;
    $title = trans("Créer un questionnaire");
    if (intval($data['id']) > 0) {
      $survey = getDB()->prepare("SELECT * FROM surveys WHERE id=?", [
        $data['id'] ,
      ], true);
      if (!isset($survey->id)) return;
      $title = trans("Modifier un questionnaire");
    }
    $data['survey'] = $survey;
    return Ajax::renderAjaxView($title, 'admin/survey/form', $data, __FILE__);
  }

  public function store($data)
  {
    $created_by = Survey::getAdminId();
    if (!isset($data['name']) || !isset($data['description'])) return false;

    $db = getDB();

    if (intval($data['id']) > 0) {
      $survey = $db->prepare("SELECT id FROM surveys WHERE id=? ", [$data['id']], true);
      if (isset($survey->id)) {
        $db->update('surveys', 'id', $survey->id, [
          'name' => $data['name'], 
          'description' => $data['description'],
          'updated_at' => date('Y-m-d H:i:s')
        ]);
      } else {
        return $this->jsonResponse('error', trans("Impossible de mettre à jour le questionnaire."));
      }
    } else {
      $db->create('surveys', [
        'name' => $data['name'],
        'description' => $data['description'],
        'created_by' => $created_by ,
        'created_at' => date('Y-m-d H:i:s')
      ]);
    }
    return $this->jsonResponse('success', trans("Les données ont été sauvegardées avec succès !"));
  }

  public function delete($data)
  {
    $db = getDB();
    $delete = $db->delete('surveys', 'id', $data['id']);
    if($delete){
      return $this->jsonResponse('success', trans("Le questionnaire a été supprimé."));
    } else {
      return $this->jsonResponse('error', trans("Une erreur est survenue . réessayez plus tard !"));
    }
  }

  



} // END Class