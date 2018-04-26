<?php
/**
 * Offer
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Offer {


  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id_offre as value, Name as text FROM offre");
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }


  public static function findActive($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id_offre as value, Name as text FROM offre WHERE status=? AND DATE(date_expiration) >= CURDATE()", ['En cours']);
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }


  /**
   * Get Offer name by ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $res = getDB()->findOne('offre', 'id_offre', $id);
    return (isset($res->Name)) ? $res->Name : null;
  }

}