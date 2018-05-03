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
use App\Media;

class QuestionController extends Controller
{
  public $data = [];

  public function index($data)
  {
    $survey = Survey::find($data['params'][1]);
    $group = Group::find($data['params'][2]);
    $this->data['sid'] = $data['params'][1];
    $this->data['gid'] = $data['params'][2];
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("<a href='backend/survey/index'>Questionnaires</a>"),
      isset($survey->name) ? $survey->name : trans("Introuvable"),
      trans("<a href='backend/survey/".$survey->id."/group/index'>Groupes</a>"),
      isset($group->name) ? $group->name : trans("Introuvable"),
      trans("Questions"),
    ];
    return get_page('admin/question/index', $this->data, __FILE__);
  }

  public function form($data)
  {
    $this->data['sid'] = $data['params'][1];
    $this->data['gid'] = $data['params'][2];
    $question = new \stdClass;
    $title = trans("Créer une question");
    if (isset($data['qid']) and intval($data['qid']) > 0) {
      $question = Question::find($data['qid']);
      if (!isset($question->id)) return;
      $title = trans("Modifier la question : ".$question->name);
      $data['question'] = $question;
      if($question->type == "file"){
        $data['choices'] = Survey::getQuestionAttachmnts($data['qid']);
        $data['keywords'] = Survey::getQuestionChoices($data['qid']);
      }else{
        $data['choices'] = Survey::getQuestionChoices($data['qid']);
        $data['keywords'] = Survey::getQuestionChoices($data['qid']);
      }
    }else{
      $question->id = '';
      $data['question'] = $question;
      $data['choices'] = $question;
      $data['keywords'] = $question;
    }
    return Ajax::renderAjaxView($title, 'admin/question/form', $data, __FILE__);
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

  public function store($data)
  {
    // dump($data);
    if($this->atLeastOneChecked($data) == false){
      return $this->jsonResponse('error', trans("Veuillez choisir la bonne réponse !"));
    }
    if(Survey::unsafe($data['name'])){
      return $this->jsonResponse('error', trans("Le champs nom est invalide, veuillez ne saisir que des caractères.")); 
    }
    if (!isset($data['name']) || !isset($data['type'])) return false;
    $db = getDB();
    // dump($data['answers']);
    if (intval($data['qid']) > 0) { // update action
      $question = Question::find($data['qid']);
      if (isset($question->id)) {
        $db->update('survey_questions', 'id', $question->id, [
          'name' => $data['name'], 
        ]);
        if(isset($data['answers']) and count($data['answers'])>0){
          foreach ($data['answers'] as $key => $value) {
            $answerId = $question->type == "file" ? $data['firstKeyWordId'] : $data['firstanswerId'];
            if($key === 0){
              $id = $answerId;
              //var_dump($key." = 0  id= ".$id);
            }else{
              $id = $key;
              //var_dump($key." != 0  id= ". $id);
            }
            $answer = Question::findAnswer( $id );
            if( in_array($question->type, ['radio', 'checkbox', 'select']) and isset($value['choice']) ){
              $choice_key = $value['choice'];
            }else if($question->type =="file" and isset($value['key'])){
              $choice_key = $value['key'];
            }
            if( isset($data['answers'][0]['isCorrect']) and $id == $data['answers'][0]['isCorrect'] and in_array($question->type, ["radio", "select"]) ){
              $isCorrect = 1;
            }else if(isset($data['answers'][0]['isCorrect']) and $id != $data['answers'][0]['isCorrect'] and in_array($question->type, ["radio", "select"]) ){
              $isCorrect = 0;
            }else if($question->type=="checkbox"){
              $isCorrect = isset($value['isCorrect']) ? 1 : 0;
            }else{
              $isCorrect = 0;
            }
            if($answer){
              //var_dump("exist");
              $db->update('survey_question_answers','id', $answer->id, [
                'name' => $choice_key,
                'is_correct' => $isCorrect,
              ]);
            }else{
              //var_dump(" no exist");
              if( ($question->type == 'file' and isset($value['key'])) or (in_array($question->type, ['radio', 'checkbox', 'select']) and isset($value['choice'])) ){
                $db->create('survey_question_answers', [
                  'survey_question_id' => $question->id,
                  'name' => $choice_key,
                  'is_correct' => $isCorrect,
                ]);
              }
            }
            $attachment = Question::findAttachment($key);
            if($attachment and isset($value['attachmentLabels'])){
              $db->update('survey_attachements', 'id', $key, [
                'title' => $value['attachmentLabels']
              ]);
            }
          } //die();
        }
      } else {
        return $this->jsonResponse('error', trans("Impossible de mettre à jour la question."));
      }
    } else { // store action
      // save questions details
      // dump($data['answers']);
      $lastInsertedId = $db->create('survey_questions', [
        'name' => $data['name'],
        'type' => $data['type'],
        // 'answerBy' => $data['answerBy'],
        'group_id' => $data['params'][2],
        'survey_id' => $data['params'][1],
      ]);
      // save questions answers
      if(isset($data['answers']) and count($data['answers'])>0){
        foreach ($data['answers'] as $key => $value) {
          if($data['type'] == "checkbox" and isset($value['isCorrect'])){
            $atLeastOneChecked = true;
          }
          if( isset($data['answers'][0]['isCorrect']) and $key == $data['answers'][0]['isCorrect'] and in_array($data['type'],["radio", "select"]) ){
            $isCorrect = 1;
          }else if(isset($data['answers'][0]['isCorrect']) and $key != $data['answers'][0]['isCorrect'] ){
            $isCorrect = 0;
          }
          if($data['type']=="checkbox"){
            $isCorrect = isset($value['isCorrect']) ? 1 : 0;
          }elseif($data['type']=="file"){
            $isCorrect = 0;
          }
          if( isset($value['choice']) and !empty(trim($value['choice'])) ){
            $choice = $value['choice'];
            $db->create('survey_question_answers', [
              'survey_question_id' => $lastInsertedId,
              'name' => $choice ,
              'is_correct' => $isCorrect,
            ]);
          }
          if(array_key_exists('key', $value) and !empty($value['key']) ){
            $keyword = $value['key'];
            $db->create('survey_question_answers', [
              'survey_question_id' => $lastInsertedId,
              'name' => $keyword ,
              'is_correct' => isset($value['isCorrect']) ? 1 : 0,
            ]);
          }
        } 
      }
    }
    // upload attachement to directory
    $attachments = [];
    if ( isset($_FILES['attachments']) and $_FILES['attachments']['size'][0] > 0 ) {
      $uploadDir = 'uploads/survey/questions/'. $lastInsertedId .'/';
      $upload = Media::upload($_FILES['attachments'], [    
      'extensions' => ['jpg', 'jpeg', 'png'],        
      'uploadDir' => $uploadDir
      ]);
      if ( isset($upload['files']) ) {
        $attachments = $upload['files'];
      } else {
        foreach ($this->getDirectoryFiles( site_base($uploadDir) ) as $key => $file) {          
          File::deleteFile($file);        
        }
        return $this->jsonResponse('error', $upload['errors'][0]);      
      }
    }
    // save attachement with their names
    if($attachments and $data['attachmentLabels']){
      $fileDetails = array_combine($attachments, $data['attachmentLabels']);
      foreach ($fileDetails as $key => $value) {
        $db->create('survey_attachements', [
          'object_id' => $lastInsertedId,
          'file_name' => $key,
          'title' => $value
        ]);
      }
    }
    return $this->jsonResponse('success', trans("Les données ont été sauvegardées avec succès !"));
  }

  public function delete($data)
  {
    $db = getDB();
    $question = Question::find($data['qid']);
    $delete = $db->delete('survey_questions', 'id', $data['qid']);
    $delete_answer = $db->delete('survey_question_answers', 'survey_question_id', $data['qid']);
    if($question->type == "file" ){
      $uploadDir = 'uploads/survey/questions/'. $data['qid'].'/';      
      $this->deleteDir(site_base($uploadDir));
    }
    if($delete){
      return $this->jsonResponse('success', trans("La question a été supprimée."));
    } else {
      return $this->jsonResponse('error', trans("Une erreur est survenue . réessayez plus tard !"));
    }
  }

  public function deleteAnswer($data)
  {
    $db = getDB();
    //if row to delete is choice or keyword
    $delete_answer = $db->delete('survey_question_answers', 'id', $data['params'][1]);
    //if row to delete is attachement
    $delete_answer = $db->delete('survey_attachements', 'id', $data['params'][1]);
  }

  public static function deleteDir($dirPath) 
  {
    if (! is_dir($dirPath)) {throw new InvalidArgumentException("$dirPath must be a directory");}
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {$dirPath .= '/';}
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
      if (is_dir($file)) {self::deleteDir($file);} else {unlink($file);}
    }
    rmdir($dirPath);
  }

} // END Class