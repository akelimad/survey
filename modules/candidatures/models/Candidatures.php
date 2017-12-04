<?php
/**
 * Candidatures
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Models; 

class Candidatures {


	/**
	 * Get offre by ID
	 *
	 * @param int $id_offre
	 * @return object $offre
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function getOfferById($id_offre) 
	{
		return getDB()->findOne('offre', 'id_offre', $id_offre);
	}



	/**
	 * Get candidature offre name by ID
	 *
	 * @param int $id_offre
	 * @return string $offre_name
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function getOfferNameById($id_offre) 
	{
		$offre = self::getOfferById($id_offre);
		return (isset($offre->Name)) ? $offre->Name : '';
	}


	public static function getStatus()
	{
		return getDB()->prepare("SELECT * FROM prm_statut_candidature ORDER BY order_statut DESC") ?: [];
	}





}