<?php
/**
 * Salary
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Salary extends Model {

  public static $table = 'prm_salaires';
  public static $primaryKey = 'id_salr';
  public static $NameField = 'salaire';

}