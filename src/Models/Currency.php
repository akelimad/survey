<?php
/**
 * Currency
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Currency {


  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id as value, iso_code as text FROM prm_currencies");
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }


  /**
   * Get Currency name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $res = getDB()->findOne('prm_currencies', 'id', $id);
    return (isset($res->name)) ? $res->name : null;
  }

}