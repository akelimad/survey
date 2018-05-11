<?php
/**
 * MobiliteRate
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class MobiliteRate extends Model {

  public static $table = 'prm_mobi_taux';
  public static $primaryKey = 'id_mobi_taux';
  public static $NameField = 'taux';

}