<?php
/**
 * Candidature
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Models; 

class Candidature {


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
		return getDB()->prepare("SELECT * FROM prm_statut_candidature ORDER BY order_statut ASC") ?: [];
	}

	public static function countSpontanees()
	{
		return getDB()->countAll('candidature_spontanee');
	}

	public static function countStage()
	{
		return getDB()->countAll('candidature_stage');
	}

	public static function countByStatus($status_id)
	{
		$query  = "SELECT COUNT(*) AS count FROM candidature c JOIN offre o ON o.id_offre = c.id_offre";
		if( !isAdmin() ) $query .= ' JOIN role_candidature rc ON rc.id_candidature = c.id_candidature';

		$status = ($status_id == 53) ? 'Archivée' : 'En cours';
    	$query .= " WHERE o.status='". $status ."' ";
		if($status_id != 53) $query .= " AND c.status=".$status_id;
		if( !isAdmin() ) $query .= " AND rc.id_role=".$_SESSION['id_role'];
		
		return getDB()->prepare($query, [], true)->count;
	}


	public static function countPending()
	{
		return getDB()->prepare("
			SELECT COUNT(*) AS nbr 
			FROM candidature cand
			JOIN offre o ON o.id_offre=cand.id_offre
			WHERE o.status = ? AND cand.status != ?
		", ['En cours', 0], true)->nbr;
	}

	public static function getUserStatusUrls()
	{
		if(!isLogged('admin')) return [];

		$statusUrls = [];
		$query = "SELECT s.id_prm_statut_c as id FROM prm_statut_candidature s";
		if( !isAdmin() ) {
			$query .= ' JOIN candidature c ON c.status = s.id_prm_statut_c';
			$query .= ' JOIN offre o ON o.id_offre = c.id_offre';
			$query .= ' JOIN role_candidature rc ON rc.id_candidature = c.id_candidature';
			$query .= " WHERE o.status='En cours' AND rc.id_role=".$_SESSION['id_role'] ." GROUP BY s.id_prm_statut_c";
		}
		$status = getDB()->prepare($query);
		if(!empty($status)) : foreach ($status as $key => $s) :
			$statusUrls[] = 'backend/module/candidatures/candidature/list/'. $s->id;
		endforeach; endif;

		return $statusUrls;
	}
	

}