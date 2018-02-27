<?php
/**
 * Messages functions
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 03/10/2017
 */

/**
 * Get logged candidat ID
 *
 * @return $candidat_id
 *
 * @author Mhamed Chanchaf
 */
function get_candidat_id() {
	return read_session('abb_id_candidat', false);
}


/**
 * Get candidat data by key
 *
 * @param $key
 * @return $value
 *
 * @author Mhamed Chanchaf
 */
function get_candidat($name = null, $dafault = null) {
	$candidat = $GLOBALS['etalent']->candidat;
	if( empty($candidat) ) {
		$candidat = getDB()->findOne('candidats', 'candidats_id', get_candidat_id());
		if (isset($candidat->candidats_id)) {
			$GLOBALS['etalent']->candidat = $candidat;
			return (isset($candidat->$name)) ? $candidat->$name : $dafault;
		}
	} else {
		return (isset($GLOBALS['etalent']->candidat->$name)) ? $GLOBALS['etalent']->candidat->$name : $dafault;
	}
}



/**
 * Get candidat pertinance
 *
 * @param int $id_candidat
 *
 * @return $pertinance
 *
 * @author Mhamed Chanchaf
 */
function get_candidat_offre_pertinence($id_candidat, $id_offre) {
	$db = getDB();
	$candidat = $db->_prepare("SELECT domaine, experience FROM candidats WHERE candidats_id=?", [$id_candidat], true);
	$offre = $db->_prepare("SELECT id_sect, id_expe FROM offre WHERE id_offre=?", [$id_offre], true);

	if( !$candidat || !$offre )
		return false;

	// Calculate pertinance
	if( $candidat->domaine != $offre->id_sect && $candidat->experience != $offre->id_expe )
	{
	  $pertinence = 0;
	} else if(
	    ( $candidat->domaine == $offre->id_sect && $candidat->experience != $offre->id_expe ) || 
	    ( $candidat->domaine != $offre->id_sect && $candidat->experience == $offre->id_expe )
	) {
	  $pertinence = 50;
	} else {
	  $pertinence = 100;
	}
	return $pertinence;
}