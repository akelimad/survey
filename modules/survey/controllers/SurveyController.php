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
use App\Mail\Mailer;
use App\Models\Candidat;

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

  private function sendSurveyInvitation($candidat, $cDisplayName, $offer_id, $candId, $survey_id)
  {
    global $email_e;
    // Get email template
    $template = getDB()->findOne('root_email_auto', 'ref', 'send_survey');
    if(!isset($template->id_email)) return;

    $variables = Mailer::getVariables($candidat, $offer_id, $candId);
    $variables['survey_name'] = Survey::getNameById($survey_id);
    $variables['survey_url'] = site_url("survey/". $survey_id ."/". md5($candidat->email.$candId));
    $subject = Mailer::renderMessage($template->objet, $variables);
    $message = Mailer::renderMessage($template->message, $variables);

    $bcc = [$email_e];
    if($email_e != $template->email) $bcc[] = $template->email;
    
    return Mailer::send($candidat->email, $subject, $message, [
      'titre' => $template->titre,
      'coresp_nom' => $cDisplayName,
      'type_email' => 'Envoi automatique',
      'Bcc' => $bcc
    ]);
  }

  public function sendSurvey($data)
  {
    if (!isset($data['candIds']) || empty($data['candIds']))
      return;

    if (isset($data['survey_id']) && is_numeric($data['survey_id'])) {
      $db = getDB();
      $errors = $success = [];
      $candIds = json_decode($data['candIds'], true) ?: [];
      if (!empty($candIds)) {
        foreach ($candIds as $key => $candId) {
          // Get candidat infos
          $candidat = $db->prepare("
            SELECT c.*, cand.id_offre as offer_id FROM candidats c 
            JOIN candidature cand ON cand.candidats_id=c.candidats_id
            WHERE cand.id_candidature=?
          ", [$candId], true);
          
          $cDisplayName = Candidat::getDisplayName($candidat, false);

          // Check if token already exist
          $sToken = $db->prepare("SELECT COUNT(*) as count FROM survey_tokens WHERE token=?", [md5($candidat->email.$candId)], true);
          if ($sToken->count != "0") {
            $errors[] = sprintf(trans("Le candidat <strong>%s</strong> a déjà reçu l'invitation pour ce questionnaire."), $cDisplayName);
            continue;
          }

          // Add canddiat to tokens table
          $db->create('survey_tokens', [
            'survey_id' => $data['survey_id'],
            'participant_id' => $candidat->candidats_id,
            'entity_id' => $candId,
            'entity_name' => 'candidature',
            'firstname' => $candidat->prenom,
            'lastname' => $candidat->nom,
            'token' => md5($candidat->email.$candId),
            'completed' => 0,
            'expired_at' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
          ]);

          // Send email
          $send = $this->sendSurveyInvitation($candidat, $cDisplayName, $candidat->offer_id, $candId, $data['survey_id']);

          if ($send['response'] == 'success') {
            $success[] = sprintf(trans("L'invitation a été envoyée au candidat <strong>%s</strong>"), $cDisplayName);
          } else {
            $errors[] = (isset($send['message'])) ? $send['message'] : trans("Impossible de trouver le message automatique");
          }
        }
      }

      // Store messages
      if (!empty($success)) set_flash_message('success', $success);
      if (!empty($errors)) set_flash_message('error', $errors);

      return $this->jsonResponse('reload');
    } else {
      return Ajax::renderAjaxView(
        trans("Envoyer un questionnaire"), 
        'admin/survey/send',
        ['candIds' => $data['candIds']],
        __FILE__
      );
    }
  }


  public function quiz($data)
  {
    $survey = Survey::find($data['params'][1]);
    $this->data['sid'] = $data['params'][1];
    $this->data['token'] = $data['params'][2];
    $this->data['data'] = $data;
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


  public function storeQuizz($data)
  {
    // dump($data);
    $db = getDB();
    if(!Survey::checkUserResponse($data['params'][2])){
      $questions = Question::All();
      foreach ($questions as $question) {
        if(in_array($question->type, ["text", "textarea", "select"] )){
          $db->create('survey_responses', [
            'survey_question_id' => $question->id,
            'answer' => $data[$question->id],
            'token'  => $data['params'][2],
          ]);
        }else if(in_array($question->type, ["checkbox", "radio"] )){
          foreach ($data[$question->id] as $key => $value) {
            $db->create('survey_responses', [
              'survey_question_id' => $question->id,
              'answer' => $value,
              'token'  => $data['params'][2],
            ]);
          }
        }else if($question->type =="file" ){
          foreach ($data[$question->id] as $key => $value) {
            $db->create('survey_responses', [
              'survey_question_id' => $question->id,
              'survey_question_answer_id' => $key,
              'answer' => $value,
              'token'  => $data['params'][2],
            ]);
          }
        }
      }
    }else{
      return $this->jsonResponse('error', trans("Vous avez déjà répondu sur ce questionnaire !"));
    }

    $db->update('survey_tokens', 'token', $data['params'][2], [
      'completed' => 1,
      'updated_at' => date('Y-m-d H:i:s'),
    ]);

    return $this->jsonResponse('success', trans("Merci pour votre réponse !"));

  }

  public function quizzResult($data)
  {
    // dump(Survey::calculateSurveyNote($data['params'][1], $data['params'][2]));
    $survey = Survey::find($data['params'][1]);
    $countQuestions = Survey::countQuestions($data['params'][1]);
    $this->data['countQuestions'] = $countQuestions;
    $this->data['sid'] = $data['params'][1];
    $this->data['token'] = $data['params'][2];
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

} // END Class