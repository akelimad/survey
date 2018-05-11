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

class Currency extends Model {

  public static $table = 'prm_currencies';
  public static $primaryKey = 'id';
  public static $NameField = 'iso_code';

}