<?php
/**
 * City
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class City extends Model {

  public static $table = 'prm_villes';
  public static $primaryKey = 'id_vill';
  public static $NameField = 'ville';

}