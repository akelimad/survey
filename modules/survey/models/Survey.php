<?php
/**
 * Survey
 *
 * @author mchanchaf
 *
 * @package modules.Survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Models;

use App\Controllers\Controller;

class Survey {

  public static function findAll()
  {
    return getDB()->read('surveys');
  }

  public static function getAdminId()
  {
    return read_session('id_role', false);
  }




} // End Class