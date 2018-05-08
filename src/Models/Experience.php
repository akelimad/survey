<?php
/**
 * Experience
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Experience extends Model {

  public static $table = 'prm_experience';
  public static $primaryKey = 'id_expe';
  public static $NameField = 'intitule';


  /**
   * Get candidat Formations
   *
   * @param int $candidat_id 
   * @return array $fomations 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByCandidatId($candidat_id = null) {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    return getDB()->findByColumn('experience_pro', 'candidats_id', $candidat_id);
  }


}