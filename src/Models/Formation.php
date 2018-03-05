<?php
/**
 * Formation
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Formation {


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
    return getDB()->findByColumn('formations', 'candidats_id', $candidat_id);
  }


  public static function getDiplomeName($diplome_id) 
  {
    $diplome = getDB()->findOne('prm_filieres', 'id_fili', $diplome_id);
    return (isset($diplome->filiere)) ? $diplome->filiere : $diplome_id;
  }


	public static function getEcoleName($ecole_id) 
	{
		$ecole = getDB()->findOne('prm_ecoles', 'id_ecole', $ecole_id);
		return (isset($ecole->nom_ecole)) ? $ecole->nom_ecole : $ecole_id;
	}


}