<?php
/**
 * Mobilite
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Mobilite {


  /**
   * Get Mobilite level name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getLevelNameById($id) 
  {
    $mobi = getDB()->findOne('prm_mobi_niv', 'id_mobi_niv', $id);
    return (isset($mobi->niveau)) ? $mobi->niveau : null;
  }


  /**
   * Get Mobilite rate name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getRateNameById($id) 
  {
    $mobi = getDB()->findOne('prm_mobi_taux', 'id_mobi_taux', $id);
    return (isset($mobi->taux)) ? $mobi->taux : null;
  }


}