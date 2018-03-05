<?php
/**
 * TypePoste
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class TypePoste {


  /**
   * Get TypePoste name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $tpost = getDB()->findOne('prm_type_poste', 'id_tpost', $id);
    return (isset($tpost->designation)) ? $tpost->designation : null;
  }

}