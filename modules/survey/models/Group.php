<?php
/**
 * Groupe
 *
 * @author mchanchaf
 *
 * @package modules.Survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Groupe\Models;

use App\Controllers\Controller;

class Group {

  public static function findAll()
  {
    return getDB()->read('groups');
  }




} // End Class