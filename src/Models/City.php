<?php
/**
 * City
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class City {


  /**
   * Get City name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $v = getDB()->findOne('prm_villes', 'id_ville', $id);
    return (isset($v->ville)) ? $v->ville : null;
  }

}