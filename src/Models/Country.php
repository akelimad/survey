<?php
/**
 * Country
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Country extends Model {

  public static $table = 'prm_pays';
  public static $primaryKey = 'id_pays';
  public static $NameField = 'pays';

}