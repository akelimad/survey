<?php
/**
 * FormationLevel
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class FormationLevel extends Model {

  public static $table = 'prm_niv_formation';
  public static $primaryKey = 'id_nfor';
  public static $NameField = 'formation';

}