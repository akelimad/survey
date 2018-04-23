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

  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT id_nfor, formation, id_nfor as value, formation as text FROM prm_niv_formation");
    if ($with_empty) $items = ['' => ''] + $items;
    return $items;
  }


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