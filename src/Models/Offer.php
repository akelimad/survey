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

class Offer extends Model {

  public static $table = 'offre';
  public static $primaryKey = 'id_offre';
  public static $NameField = 'Name';

  public static function findActive($with_empty = true)
  {
    $items = getDB()->prepare("SELECT *, id_offre as value, Name as text FROM offre WHERE status=? AND DATE(date_expiration) >= CURDATE()", ['En cours']);
    if ($with_empty) {
      $items = ['' => ''] + $items;
    }
    return $items;
  }

}