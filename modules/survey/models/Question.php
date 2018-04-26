<?php
/**
 * Question
 *
 * @author mchanchaf
 *
 * @package modules.Survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Models;

use App\Controllers\Controller;

class Question {
    
    public static function All()
    {
        return getDB()->read('survey_questions');
    }

    public static function find($qid)
    {
        return getDB()->findOne('survey_questions', 'id', $qid);
    }
    public static function findByGroup($gid)
    {
        return getDB()->findByColumn('survey_questions', 'group_id', $gid);
    }

    public static function findAnswer($aid)
    {
        return getDB()->findOne('survey_question_answers', 'id', $aid);
    }

    public static function findAttachment($atid)
    {
        return getDB()->findOne('survey_attachements', 'id', $atid);
    }

    public static function findAnswers($qid)
    {
        return getDB()->findByColumn('survey_question_answers', 'survey_question_id', $qid);
    }



} // End Class