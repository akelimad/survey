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
use Modules\Survey\Models\Group;
use Modules\Survey\Models\Question;
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
      $survey = Survey::find($data['id']);
      if (!isset($survey->id)) return;
      $title = trans("Modifier le questionnaire : ".$survey->name);
    }
    $data['survey'] = $survey;
    return Ajax::renderAjaxView($title, 'admin/survey/form', $data, __FILE__);
  }

  public function store($data)
  {
    if(!isset($data['format'])){
      return $this->jsonResponse('error', trans("Veuillez choisir le format !")); 
    }
    if(Survey::unsafe($data['name'])){
      return $this->jsonResponse('error', trans("Le champs nom est invalide, veuillez ne saisir que des caractères.")); 
    }
    $created_by = Survey::getAdminId();
    if (!isset($data['name']) || !isset($data['description'])) return false;
    $db = getDB();
    
    if (intval($data['id']) > 0) {
      $survey = $survey = Survey::find($data['id']);
      if (isset($survey->id)) {
        $db->update('surveys', 'id', $survey->id, [
          'name' => $data['name'], 
          'description' => $data['description'],
          'format' => $data['format'],
          'active' => $data['active'],
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
        'format' => $data['format'],
        'active' => $data['active'],
        'created_at' => date('Y-m-d H:i:s')
      ]);
    }
    return $this->jsonResponse('success', trans("Les données ont été sauvegardées avec succès !"));
  }

  public function show($data)
  {
    $survey = new \stdClass;
    $title = trans("Visualiser le questionnaire");
    $survey = Survey::find($data['params'][1]);
    return Ajax::renderAjaxView($title, 'admin/survey/show', ['survey'=>$survey], __FILE__);
  }

  public function delete($data)
  {
    $db = getDB();
    $groups = Group::findBySurvey($data['id']);
    foreach ($groups as $group) {
      $db->delete('survey_groups', 'id', $group->id);
      $questions = Question::findByGroup($group->id);
      foreach ($questions as $question) {
        $db->delete('survey_questions', 'id', $question->id);
        $answers = Question::findAnswers($question->id);
        foreach ($answers as $answer) {
          $db->delete('survey_question_answers', 'survey_question_id', $answer->survey_question_id);
        }
      }
    }
    $delete = $db->delete('surveys', 'id', $data['id']);
    if($delete){
      return $this->jsonResponse('success', trans("Le questionnaire a été supprimé."));
    } else {
      return $this->jsonResponse('error', trans("Une erreur est survenue . réessayez plus tard !"));
    }
  }

  public function quiz($data)
  {
    $survey = Survey::find($data['params'][1]);
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("Questionnaires"),
      isset($survey->name) ? $survey->name : trans("Introuvable"),
    ];
    $survey = Survey::find($data['params'][1]);
    if($survey){
      $this->data['survey'] = $survey;
    }
    return get_page('admin/survey/quiz', $this->data, __FILE__);
  }

  public function quizzResult($data)
  {
    $survey = Survey::find($data['params'][1]);
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("Questionnaire"),
      isset($survey->name) ? $survey->name : trans("Introuvable"),
      trans("Resultats")
    ];
    if($survey){
      $this->data['survey'] = $survey;
    }
    return get_page('admin/survey/quizz-result', $this->data, __FILE__);
  }

  public function draw_survey($survey_id, $participant_id)
  {
    $survey = Survey::find($survey_id);
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("Questionnaires"),
      trans($survey->name ? $survey->name : "Introuvable")
    ];
    if($survey){
      $this->data['survey'] = $survey;
    }
    return get_page('admin/survey/quiz', $this->data, __FILE__);
  }

  public function atLeastOneChecked($data){
    if($data['type'] == 'checkbox'){
      $c = 0;
      foreach ($data['answers'] as $key => $value) {
        if($data['type'] == "checkbox" and isset($value['isCorrect'])){
          $c += 1;
        }
      }
      return $c > 0 ? true : false ;      
    }else{
      if( in_array($data['type'], ['radio','select']) and !isset($data['answers'][0]['isCorrect']) ){
        return false;
      }else{
        return true;
      }
    }
  }

  public function storeAnswers($data)
  {
    $db = getDB();
    if(!Survey::checkUserResponse(Survey::get_candidat_id() ,$data['params'][1])){
      $questions = Question::All();
      foreach ($questions as $question) {
        if(in_array($question->type, ["text", "textarea", "select"] )){
          $db->create('survey_responses', [
            'survey_question_id' => $question->id,
            'answer' => $data[$question->id],
          ]);
        }else if(in_array($question->type, ["checkbox", "radio"] )){
          foreach ($data[$question->id] as $key => $value) {
            $db->create('survey_responses', [
              'survey_question_id' => $question->id,
              'answer' => $value,
            ]);
          }
        }else if($question->type =="file" ){
          foreach ($data[$question->id] as $key => $value) {
            $db->create('survey_responses', [
              'survey_question_id' => $question->id,
              'survey_question_answer_id' => $key,
              'answer' => $value,
            ]);
          }
        }
      }
    }else{
      return $this->jsonResponse('error', trans("Vous avez déjà répondu sur ce questionnaire !"));
    }

    $db->create('survey_tokens', [
      'user_id' => Survey::get_candidat_id(),
      'survey_id' => $data['params'][1],
      'sent_at' => date('Y-m-d H:i:s'),
    ]);
    return $this->jsonResponse('success', trans("Merci pour votre réponse !"));

  }

} // END Class