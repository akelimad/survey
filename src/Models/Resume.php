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

class Resume extends Model {

  public static $table = 'cv';
  public static $primaryKey = 'id_cv';
  public static $NameField = 'titre_cv';


  /**
   * Get candidat CVs
   *
   * @param int $candidat_id 
   * @return array $cvs 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByCandidatId($candidat_id = null, $one = false) {
    if (is_null($candidat_id)) $candidat_id = get_candidat_id();
    $args = ($one) ? ['limit' => 1] : [];
    return getDB()->findByColumn('cv', 'candidats_id', $candidat_id, $args);
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