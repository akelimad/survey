<?php
/**
 * Survey
 *
 * @author Imad
 *
 * @package modules.Survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Models;

use App\Controllers\Controller;

class Survey {

  public static function find($sid)
  {
    return getDB()->findOne('surveys', 'id', $sid);
  }


  /**
   * Get Survey name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $v = getDB()->findOne('surveys', 'id', $id);
    return (isset($v->name)) ? $v->name : null;
  }

  public static function findActive($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id as value, name as text FROM surveys WHERE active=?", [1]);
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }

  public static function countQuestions($sid)
  {
    $survey = getDB()->prepare("SELECT count(*) as count FROM survey_questions as q WHERE q.survey_id = ? ", [$sid], true);
    return $survey->count;
  }

  public static function get_candidat_id() {
    return read_session('abb_id_candidat', false);
  }

  public static function getAdminId()
  {
    return read_session('id_role', false);
  }

  public static function getSurveyGroups($sid)
  {
    $groups = getDB()->prepare("SELECT * FROM survey_groups as g WHERE g.survey_id = ? ", [$sid], false);
    return $groups;
  }

  public static function getGroupeQuestions($gid)
  {
    $groups = getDB()->prepare("SELECT * FROM survey_questions as q WHERE q.group_id = ? ", [$gid], false);
    return $groups;
  }

  public static function getQuestionChoices($qid)
  {
    $choices = getDB()->prepare("SELECT * FROM survey_question_answers as a WHERE a.survey_question_id = ? ", [$qid], false);
    return $choices;
  }

  public static function getQuestionAttachmnts($qid)
  {
    $images = getDB()->prepare("SELECT * FROM survey_attachements as a WHERE a.object_id = ? ", [$qid], false);
    return $images;
  }

  // Does string match this chars?
  public static function unsafe( $string ) {
    return preg_match("/[^a-zA-Z éèê'’àç:]+/i", $string);
  }

  public static function checkUserResponse($token)
  {
    $response = getDB()->prepare("SELECT * FROM survey_tokens as t WHERE t.completed = 1 AND t.token = ?", [$token], false);
    return $response;
  }

  public static function getUserResponse($token, $qid)
  {
    $question = getDB()->prepare("SELECT * FROM survey_questions as q WHERE q.id = ?", [$qid], true);
    $responses = getDB()->prepare("SELECT * FROM survey_responses as r WHERE r.token = ? AND r.survey_question_id = ? ", [$token ,$qid], false);
    if($question->type =="file"){
      $attachments = getDB()->prepare("SELECT * FROM survey_attachements as a WHERE a.object_id = ?", [$qid]);
    }
    foreach ($responses as $response) {
      $new_array[] = $response->answer;
    }
    if(isset($responses) && count($responses)>0){
      return $new_array;
    }else if(isset($responses) && count($responses) == 1){
      return $responses[0];
    }elseif($question->type =="file"){
      $imageArray = [];
      foreach ($responses as $key => $value) {
        $responseArray[$value->id] = $value->title;
      }
      return $responseArray;
    }else{
      return null;
    }
  }

  public static function calculateSurveyNote($sid, $token)
  {
    $answers = getDB()->prepare("SELECT COUNT(*) as count FROM survey_question_answers a where a.is_correct = 1 group by a.survey_question_id");

    $responses = getDB()->prepare("SELECT COUNT(*) as count FROM survey_responses r where r.survey_question_answer_id is NULL and r.answer REGEXP '^[0-9]+$' group by r.survey_question_id");
    $new_array=[];
    foreach ($answers as $key => $value) {
      $new_array[$key] = $value;
    }
    foreach ($responses as $key => $value) {
      $new_array[$key] = $value;
    }
    return $new_array;
  }


} // End Class