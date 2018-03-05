<?php
/**
 * Messages functions
 *
 * @author mchanchaf
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
	if( !isset($candidat->candidats_id) ) {
		$candidat = getDB()->findOne('candidats', 'candidats_id', get_candidat_id());
		if( !isset($candidat->candidats_id) ) return $dafault;
		$GLOBALS['etalent']->candidat = $candidat;
	}

	if (is_null($name)) return $candidat;

	return (isset($GLOBALS['etalent']->candidat->$name)) ? $GLOBALS['etalent']->candidat->$name : $dafault;
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


/**
 * Get resume url by name
 *
 * @param string $name
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_resume_url($name) {
	return site_url('uploads/candidat/resume/'. $name);
}


/**
 * Get motivation letter url by name
 *
 * @param string $name
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_motivation_letter_url($name) {
	return site_url('uploads/candidat/motivation_letter/'. $name);
}


/**
 * Get candidat photo url by name
 *
 * @param string $name
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_photo_url($name) {
	return site_url('uploads/candidat/photo/'. $name);
}