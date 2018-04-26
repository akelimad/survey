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

  public static function getKeyWords($qid)
  {
    
  }

  // Does string match this chars?
  public static function unsafe( $string ) {
    return preg_match("/[^a-zA-Z éèàç]+/i", $string);
  }


} // End Class