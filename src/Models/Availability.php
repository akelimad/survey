<?php
/**
 * Availability
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Availability {


  /**
   * Get Availability name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $dispo = getDB()->findOne('prm_disponibilite', 'id_dispo', $id);
    return (isset($dispo->intitule)) ? $dispo->intitule : null;
  }

}