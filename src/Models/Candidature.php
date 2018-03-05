<?php
/**
 * Candidature
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Candidature {


	/**
   * Get candidature by id
   *
   * @param int $id 
   * @return array $candidature 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByID($id) {
    return getDB()->findOne('candidature', 'id_candidature', $id);
  }


  /**
   * Get candidat candidatures
   *
   * @return array $candidatures
   *
   * @author Mhamed Chanchaf
   */
  public static function findAllByCandidatId($candidat_id = null)
  {
    if (is_null($candidats_id)) $candidats_id = get_candidat_id();
    return getDB()->prepare("SELECT * FROM candidature c JOIN offre o ON c.id_offre=o.id_offre WHERE c.candidats_id=?", [$candidats_id]);
  }


  /**
   * Get candidat candidatures
   *
   * @return array $candidatures
   *
   * @author Mhamed Chanchaf
   */
  public static function getHistoryStatus($id_candidature)
  {
    return getDB()->prepare("SELECT * from historique WHERE id_candidature=? ORDER BY date_modification DESC", [$id_candidature], true);
  }


  /**
   * Get candidat candidatures spontanees
   *
   * @return array $candidatures
   *
   * @author Mhamed Chanchaf
   */
  public static function getCandidaturesSpontanees()
  {
    return getDB()->prepare("SELECT * FROM candidature_spontanee WHERE candidats_id=?", [get_candidat_id()]);
  }


  /**
   * Get candidat candidatures stage
   *
   * @return array $candidatures
   *
   * @author Mhamed Chanchaf
   */
  public static function getCandidaturesStage()
  {
    return getDB()->prepare("SELECT * FROM candidature_stage WHERE candidats_id=?", [get_candidat_id()]);
  }


}