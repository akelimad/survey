<?php
/**
 * Availability
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Availability extends Model {

  public static $table = 'prm_disponibilite';
  public static $primaryKey = 'id_dispo';
  public static $NameField = 'intitule';

}