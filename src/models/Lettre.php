<?php
/**
 * Lettre model
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @package app.models
 * @since 27/10/2017
 */
namespace app\models; 

class Lettre {


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