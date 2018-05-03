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

class Experience {

  public static function findAll($with_empty = true)
  {
    $items = getDB()->prepare("SELECT id_expe, intitule, id_expe as value, intitule as text FROM prm_experience");
    if ($with_empty) $items = ['' => ''] + $items;
    return $items;
  }


  /**
   * Get Filiere name by ID
   *
   * @param int $id 
   * @return string $level_name 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getNameById($id) 
  {
    $exp = getDB()->findOne('prm_experience', 'id_expe', $id);
    return (isset($exp->intitule)) ? $exp->intitule : null;
  }


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