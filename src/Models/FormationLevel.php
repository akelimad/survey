<?php
/**
 * FormationLevel
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class FormationLevel {


  /**
   * Get formation level by ID
   *
   * @param int $level_id 
   * @return string $level_name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($level_id) 
  {
    $level = getDB()->findOne('prm_niv_formation', 'id_nfor', $level_id);
    return (isset($level->formation)) ? $level->formation : null;
  }

}