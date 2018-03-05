<?php
/**
 * Filiere
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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