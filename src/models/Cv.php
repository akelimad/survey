<?php
/**
 * Cv
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models; 

class Cv {


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