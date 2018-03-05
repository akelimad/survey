<?php
/**
 * Fonction
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Fonction {


  /**
   * Get Fonction name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $fonc = getDB()->findOne('prm_fonctions', 'id_fonc', $id);
    return (isset($fonc->fonction)) ? $fonc->fonction : null;
  }

}