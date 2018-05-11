<?php
/**
 * School
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class School extends Model {

  public static $table = 'prm_ecoles';
  public static $primaryKey = 'id_ecole';
  public static $NameField = 'nom_ecole';

  /**
   * Get Country name by school ID
   *
   * @param int $id 
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getCountryNameById($id) 
  {
    $country = getDB()->prepare("SELECT p.pays FROM prm_ecoles e JOIN prm_pays p ON p.id_pays=e.id_pays WHERE e.id_ecole=?", [$id], true);
    return (isset($country->pays)) ? $country->pays : null;
  }

}