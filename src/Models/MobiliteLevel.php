<?php
/**
 * MobiliteLevel
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class MobiliteLevel extends Model {

  public static $table = 'prm_mobi_niv';
  public static $primaryKey = 'id_mobi_niv';
  public static $NameField = 'niveau';

}