<?php
/**
 * Salary
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Salary {


  /**
   * Get Salary name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $salr = getDB()->findOne('prm_salaires', 'id_salr', $id);
    return (isset($salr->salaire)) ? $salr->salaire : null;
  }

}