<?php
/**
 * Status
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Status extends Model {

  public static $table = 'prm_statut_candidature';
  public static $primaryKey = 'id_prm_statut_c';
  public static $NameField = 'statut';

}