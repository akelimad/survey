<?php
/**
 * Filiere
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Filiere {


  /**
   * Get Filiere name by ID
   *
   * @param bool $with_empty 
   * @return array $items 
   * 
   * @author Mhamed Chanchaf
   */
  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id_fili as value, filiere as text FROM prm_filieres");
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }


  /**
   * Get Filiere name by ID
   *
   * @param int $id 
   * @return string $level_name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $filiere = getDB()->findOne('prm_filieres', 'id_fili', $id);
    return (isset($filiere->filiere)) ? $filiere->filiere : null;
  }

}