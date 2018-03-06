<?php
/**
 * Resume
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models; 

class Resume {


  /**
   * Get CV by id
   *
   * @param int $id_cv 
   * @return array $data 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByID($id_cv) {
    return getDB()->findOne('cv', 'id_cv', $id_cv);
  }


  /**
   * Get candidat CVs
   *
   * @param int $candidat_id 
   * @return array $cvs 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByCandidatId($candidat_id = null) {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    return getDB()->findByColumn('cv', 'candidats_id', $candidat_id);
  }


	/**
   * Get CV Extension by id
   *
   * @param int $id_cv 
   * @return array $ext 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getExtension($id_cv) {
    $cv = self::getByID($id_cv);
    if( isset($cv->lien_cv) && $cv->lien_cv != '' ) {
      return pathinfo($cv->lien_cv, PATHINFO_EXTENSION);
    }
    return null;
  }


}