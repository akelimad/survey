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


  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT id_tpost, designation, id_tpost as value, designation as text FROM prm_type_poste");
    if ($with_empty) $items = ['' => ''] + $items;
    return $items;
  }


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