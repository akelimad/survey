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

class MotivationLetter {


	/**
   * Get CV by id
   *
   * @param int $id_lettre 
   * @return array $data 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByID($id_lettre) {
    return getDB()->findOne('lettres_motivation', 'id_lettre', $id_lettre);
  }


  /**
   * Get candidat LMs
   *
   * @param int $candidat_id 
   * @return array $cvs 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByCandidatId($candidat_id = null) {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    return getDB()->findByColumn('lettres_motivation', 'candidats_id', $candidat_id);
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