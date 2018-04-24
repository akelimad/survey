<?php
/**
 * Localisation
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Localisation {


  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT id_localisation, localisation, id_localisation as value, localisation as text FROM prm_localisation");
    if ($with_empty) $items = ['' => ''] + $items;
    return $items;
  }


  /**
   * Get localisation by ID
   *
   * @param int $localisation_id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($localisation_id) 
  {
    $l = getDB()->findOne('prm_localisation', 'id_localisation', $localisation_id);
    return (isset($l->localisation)) ? $l->localisation : null;
  }

}