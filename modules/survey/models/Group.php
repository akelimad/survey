<?php
/**
 * Group
 *
 * @author mchanchaf
 *
 * @package modules.Survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Models;

use App\Controllers\Controller;

class Group {

    public static function All()
    {
      return getDB()->read('survey_groups');
    }

  public static function find($gid)
  {
    return getDB()->findOne('survey_groups', 'id', $gid);
  }

  public static function findBySurvey($sid)
  {
    return getDB()->findByColumn('survey_groups', 'survey_id', $sid);
  }

} // End Class