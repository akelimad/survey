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
use Modules\Survey\Models\Group;
use Modules\Survey\Models\Survey;
use App\Ajax;

class GroupController extends Controller
{
  public $data = [];

  public function index($data)
  {
    $survey = Survey::find($data['params'][1]);
    $this->data['survey'] = $survey;
    $this->data['sid'] = $data['params'][1];
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("<a href='backend/survey/index'>Questionnaires</a>"),
      isset($survey->name) ? $survey->name : trans("Introuvable"),
      trans("Groupes")
    ];
    return get_page('admin/group/index', $this->data, __FILE__);
  }

  public function form($data)
  {
    $group = new \stdClass;
    $title = trans("Créer un groupe");
    if (intval($data['gid']) > 0) {
      $group = Group::find($data['gid']);
      if (!isset($group->id)) return;
      $title = trans("Modifier le groupe : ".$group->name);
    }
    $data['group'] = $group;
    return Ajax::renderAjaxView($title, 'admin/group/form', $data, __FILE__);
  }

  public function store($data)
  {
    if(Survey::unsafe($data['name'])){
      return $this->jsonResponse('error', trans("Le champs nom est invalide, veuillez ne saisir que des caractères.")); 
    }
    if (!isset($data['name']) || !isset($data['description'])) return false;
    $db = getDB();
    if (intval($data['gid']) > 0) {
      $group = Group::find($data['gid']);
      if (isset($group->id)) {
        $db->update('survey_groups', 'id', $group->id, [
          'name' => $data['name'], 
          'description' => $data['description'],
        ]);
      } else {
        return $this->jsonResponse('error', trans("Impossible de mettre à jour le groupe."));
      }
    } else {
      $db->create('survey_groups', [
        'name' => $data['name'],
        'description' => $data['description'],
        'survey_id' => $data['params'][1],
      ]);
    }
    return $this->jsonResponse('success', trans("Les données ont été sauvegardées avec succès !"));
  }

  public function delete($data)
  {
    $db = getDB();
    $delete = $db->delete('survey_groups', 'id', $data['gid']);
    $questions = $db->delete('survey_questions', 'group_id', $data['gid']);
    if($delete){
      return $this->jsonResponse('success', trans("Le groupe a été supprimé."));
    } else {
      return $this->jsonResponse('error', trans("Une erreur est survenue . réessayez plus tard !"));
    }
  }

} // END Class