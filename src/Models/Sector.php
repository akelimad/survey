<?php
/**
 * Sector
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Sector {


  /**
   * Get Sector name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $sector = getDB()->findOne('prm_sectors', 'id_sect', $id);
    return (isset($sector->FR)) ? $sector->FR : null;
  }

}