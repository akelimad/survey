<?php
/**
 * TypeFormation
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class TypeFormation {


  /**
   * Get Type Formation name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $tfor = getDB()->findOne('prm_type_formation', 'id_tfor', $id);
    return (isset($tfor->formation)) ? $tfor->formation : null;
  }

}