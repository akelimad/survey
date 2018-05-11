<?php
/**
 * Role
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Role extends Model {

  public static $table = 'root_roles';
  public static $primaryKey = 'id_role';
  public static $NameField = 'nom';

  public static function findByRole($role, $with_empty = false)
  {
    $roles = (is_array($role)) ? $role : [$role];
    $items = getDB()->prepare("SELECT r.*, r.id_role as value, r.nom as text FROM root_roles r JOIN root_type_role tr ON tr.id_type_role=r.id_type_role WHERE tr.name IN('". implode("','", $roles) ."')");

    if (empty($items)) return [];

    // Add an emty row to the start
    if ($with_empty) {
      $empty = [];
      foreach ($items[0] as $key => $value) {
        $empty[$key] = null;
      }
      array_unshift($items, (object) $empty);
    }

    return $items;
  }


}