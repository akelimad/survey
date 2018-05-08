<?php
/**
 * MotivationLetter
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models; 

class MotivationLetter extends Model {

  public static $table = 'lettres_motivation';
  public static $primaryKey = 'id_lettre';
  public static $NameField = 'titre';


  /**
   * Get candidat LMs
   *
   * @param int $candidat_id 
   * @return array $cvs 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByCandidatId($candidat_id = null, $one = false) {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    $args = ($one) ? ['limit' => 1] : [];
    return getDB()->findByColumn('lettres_motivation', 'candidats_id', $candidat_id, $args);
  }


  /**
   * Get Lettre Extension by id
   *
   * @param int $id_lettre 
   * @return array $ext 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getExtension($id_lettre) {
    $lm = self::getByID($id_lettre);
    if( isset($lm->id_lettre) ) {
      return pathinfo($lm->lettre, PATHINFO_EXTENSION);
    }
    return null;
  }


}