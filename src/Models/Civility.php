<?php
/**
 * Civility
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Civility {


  /**
   * Get Civility name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $c = getDB()->findOne('prm_civilite', 'id_civi', $id);
    return (isset($c->civilite)) ? $c->civilite : null;
  }

}