<?php
/**
 * Country
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Country {


  /**
   * Get Country name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $country = getDB()->findOne('prm_pays', 'id_pays', $id);
    return (isset($country->pays)) ? $country->pays : null;
  }

}