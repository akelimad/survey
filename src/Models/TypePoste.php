<?php
/**
 * TypePoste
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class TypePoste extends Model {

  public static $table = 'prm_type_poste';
  public static $primaryKey = 'id_tpost';
  public static $NameField = 'designation';

}