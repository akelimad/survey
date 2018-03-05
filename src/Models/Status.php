<?php
/**
 * Status
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Status {


  /**
   * Get Status name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $s = getDB()->findOne('prm_statut_candidature', 'id_prm_statut_c', $id);
    return (isset($s->statut)) ? $s->statut : null;
  }

}