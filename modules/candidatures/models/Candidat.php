<?php
/**
 * Candidat
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Models; 

class Candidat {


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
		return (isset($salaire->name)) ? $salaire->name : '---';
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
   * Get candidat pertinance
   *
   * @param int $id_candidat
   * @param int $id_offre
   *
   * @return string $pertinance
   */
	public static function getPertinance($id_candidat, $id_offre)
	{
		return getDB()->prepare("SELECT * FROM pertinence_oc where candidats_id=? AND id_offre=?", [$id_candidat, $id_offre], true);
	}

	



} // End model