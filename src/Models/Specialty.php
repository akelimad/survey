<?php
/**
 * Specialty
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Specialty {


  /**
   * Get Specialty name by ID
   *
   * @param bool $with_empty 
   * @return array $items 
   * 
   * @author Mhamed Chanchaf
   */
  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id as value, name as text FROM prm_specialties ORDER BY sort_order ASC");
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }


  /**
   * Get Specialty name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $result = getDB()->findOne('prm_specialties', 'id', $id);
    return (isset($result->name)) ? $result->name : null;
  }

}