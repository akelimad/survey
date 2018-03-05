<?php
/**
 * Candidat
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

class Candidat {

  
  /**
   * Get candidat display name
   *
   * @param object $candidat 
   * @return array $data 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getDisplayName($candidat = null, $with_civilite = true) {
    // Get candidat data
    if (!isset($candidat->candidats_id) && isLogged('candidat')) {
      $candidat = getDB()->findOne('candidats', 'candidats_id', read_session('abb_id_candidat'));
    }

    if (!isset($candidat->candidats_id)) return;
    
    $fullname = trim($candidat->prenom .' '. $candidat->nom);
    if($with_civilite && isset($candidat->id_civi)) {
      $civilite = getDB()->findOne('prm_civilite', 'id_civi', $candidat->id_civi);
      if (isset($civilite->civilite) && !empty($civilite->civilite)) {
        $fullname = $civilite->civilite .' '. $fullname;
      }
    }
    return $fullname;
  }


  /**
   * Tell if password is strong
   *
   * @param string $password
   *
   * @author Mhamed Chanchaf
   */
  public static function isStrongPassword($password)
  {
    $containsLetter  = preg_match('/[a-zA-Z]/', $password);
    $containsDigit   = preg_match('/\d/', $password);
    $containsAll = $containsLetter && $containsDigit;
    return $containsAll;
  }


	/**
   * Get candidat by id
   *
   * @param int $id_candidat 
   * @return array $data 
   * 
   * @author Mhamed Chanchaf
   */
  public static function getByID($id_candidat) {
      return getDB()->findByColumn('candidats', 'candidats_id', $id_candidat, ['limit'=>1]);
  }


  /**
   * Get candidat matched offers
   *
   * @param int $limit
   * @return array $offers
   *
   * @author Mhamed Chanchaf
   */
  public static function getMatchedOffers($limit = 5)
  {
    return getDB()->prepare("SELECT * FROM offre WHERE id_sect=? AND status=? AND DATE(date_expiration) >= CURDATE() ORDER BY id_offre DESC LIMIT {$limit}", [get_candidat('id_sect'), 'En cours']);
  }


  /**
   * Get candidat job alerts
   *
   * @return array $alerts
   *
   * @author Mhamed Chanchaf
   */
  public static function getAlerts()
  {
    return getDB()->prepare("SELECT * FROM alert WHERE candidats_id=?", [get_candidat_id()]);
  }


	/**
	 * Get last candidat formation
	 *
	 * @param int $id_candidat
	 * @return array $formation | false
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function getLastFormation($id_candidat) 
	{
		return getDB()->prepare("SELECT f.*, e.nom_ecole FROM `formations` AS f LEFT JOIN prm_ecoles AS e ON e.id_ecole=f.id_ecol WHERE f.candidats_id=? ORDER BY f.date_fin DESC", [$id_candidat], true);
	}


	/**
	 * Get last candidat experience
	 *
	 * @param int $id_candidat
	 * @return array $xperience | false
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function getLastExperience($id_candidat) 
	{
		return getDB()->prepare("SELECT exp.*, p.pays FROM experience_pro AS exp LEFT JOIN prm_pays AS p ON p.id_pays=exp.id_pays WHERE exp.candidats_id=? ORDER BY exp.date_fin DESC", [$id_candidat], true);
	}

	/**
   * Get pays name By ID
   *
   * @param int $id_pays
   *
   * @return string $name
   */
	public static function getPaysByID($id_pays)
	{
		$pays = getDB()->prepare("SELECT pays AS name FROM prm_pays where id_pays=?", [$id_pays], true);
		return (isset($pays->name)) ? $pays->name : '';
	}


	/**
   * Get formation level
   *
   * @param int $id_niv
   *
   * @return string $niv_formation
   */
	public static function getNivFormation($id_niv)
	{
		$niv = getDB()->prepare("SELECT formation FROM prm_niv_formation where id_nfor=?", [$id_niv], true);
		return (isset($niv->formation)) ? $niv->formation : '';
	}


	/**
   * Get sector name by ID
   *
   * @param int $id_sector
   *
   * @return string $sector_name
   */
	public static function getSectorNameByID($id_sector)
	{
		$sector = getDB()->prepare("SELECT FR FROM prm_sectors where id_sect=?", [$id_sector], true);
		return (isset($sector->FR)) ? $sector->FR : '';
	}


	/**
   * Get sector name by ID
   *
   * @param int $id_fonction
   *
   * @return string $fonction_name
   */
	public static function getFonctionNameByID($id_fonction)
	{
		$fonction = getDB()->prepare("SELECT fonction AS name FROM prm_fonctions where id_fonc=?", [$id_fonction], true);
		return (isset($fonction->name)) ? $fonction->name : '';
	}


	/**
   * Get salaire name by ID
   *
   * @param int $id_salaire
   *
   * @return string $salaire_name
   */
	public static function getSalaireNameByID($id_salaire)
	{
		$salaire = getDB()->prepare("SELECT salaire AS name FROM prm_salaires where id_salr=?", [$id_salaire], true);
		return (isset($salaire->name)) ? $salaire->name : '';
	}


	/**
   * Get experience name by ID
   *
   * @param int $id_exp
   *
   * @return string $experience_name
   */
	public static function getExperienceNameByID($id_exp)
	{
		$experience = getDB()->prepare("SELECT intitule AS name FROM prm_experience where id_expe=?", [$id_exp], true);
		return (isset($experience->name)) ? $experience->name : '';
	}

 	/**
	 * Tell if candidats has cv
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function hasCV($id_candidat) 
	{
		$candidat = getDB()->findByColumn('cv', 'candidats_id', $id_candidat, ['limit'=>1]);
		return ( isset($candidat->candidats_id) );
	}

 	/**
	 * Tell if candidats has lettre de motivation
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function hasLM($id_candidat) 
	{
		$candidat = getDB()->findByColumn('lettres_motivation', 'candidats_id', $id_candidat, ['limit'=>1]);
		return ( isset($candidat->candidats_id) );
	}


}