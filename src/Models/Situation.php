<?php
/**
 * Situation
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Situation {


  /**
   * Get Situation name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $situ = getDB()->findOne('prm_situation', 'id_situ', $id);
    return (isset($situ->situation)) ? $situ->situation : null;
  }

}