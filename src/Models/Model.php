<?php
/**
 * Model
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models; 


class Model
{

  public static $db;

  public function __construct()
  {
    self::$db = getDB();
  }


  /**
   * Get Item by id
   *
   * @param int $id 
   * @return array $item 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByID($id) {
    if (!isset(static::$table) || !isset(static::$primaryKey)) {
      throw new \Exception("Model must have a table and primary key methods.", 1);
    }
    return getDB()->findOne(static::$table, static::$primaryKey, $id);
  }


  /**
   * Get name by ID
   *
   * @param int $id
   *
   * @return string $name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id, $default = null) 
  {
    if (!isset(static::$table) || !isset(static::$primaryKey) || !isset(static::$NameField)) {
      throw new \Exception("Model must have a table and primary key methods.", 1);
    }

    $NameField = static::$NameField;
    $result = getDB()->findOne(static::$table, static::$primaryKey, $id);

    if (isset($result->$NameField)) {
      return $result->$NameField;
    }

    return $default;
  }


  /**
   * Find All rows
   *
   * @param bool $with_empty
   *
   * @return array $items 
   * 
   * @author Mhamed Chanchaf
   */
  public static function findAll($with_empty = true)
  {
    if (!isset(static::$table) || !isset(static::$primaryKey) || !isset(static::$NameField)) {
      throw new \Exception("Model must have a table and primary key methods.", 1);
    }

    $table = static::$table;
    $primaryKey = static::$primaryKey;
    $NameField  = static::$NameField;

    $items = getDB()->prepare("SELECT *, {$primaryKey} as value, {$NameField} as text FROM {$table} ORDER BY {$primaryKey} ASC");

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


  /**
   * Find by columns
   *
   * @param array $columns
   * @param bool $with_empty
   *
   * @return array $items 
   * 
   * @author Mhamed Chanchaf
   */
  public static function findby($columns = [], $with_empty = true)
  {
    $attributes = $wheres = [];
    if (!empty($columns)) : foreach ($columns as $name => $value) :
      $attributes[] = $value;
      $wheres[] = $name .'=?';
    endforeach; endif;

    $where = (!empty($wheres)) ? ' WHERE '. implode(' AND ', $wheres) : '';

    $table = static::$table;
    $primaryKey = static::$primaryKey;
    $NameField  = static::$NameField;
    $items = getDB()->prepare("SELECT *, {$primaryKey} as value, {$NameField} as text FROM {$table} {$where} ORDER BY {$primaryKey} ASC", $attributes);

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

  
} // END Class