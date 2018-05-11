<?php
/**
 * Messages functions
 *
 * @author mchanchaf
 * @since 03/10/2017
 */
use App\Models\Candidat;

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
	$candidat = (isset($GLOBALS['etalent']->candidat)) ? $GLOBALS['etalent']->candidat : new \stdClass;
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
 * Get file url
 *
 * @param string $file_path
 * @param string $file_name
 * @param array  $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_file_url($file_path, $file_name = null, $variables = []) {
	if (isLogged('candidat') && !isset($variables['candidat_id'])) {
		$variables['candidat_id'] = get_candidat_id();
	}

	$file_path = preg_replace_callback('#{([^}]+)}#', function($m) use ($file_path, $variables){
		if(isset($variables[$m[1]])){
			return $variables[$m[1]];
		}else{
			return $m[0];
		}
	}, $file_path);

	return site_url($file_path . $file_name);
}


/**
 * Get file base
 *
 * @param string $file_path
 * @param string $file_name
 * @param array  $variables
 *
 * @return string $base_url
 *
 * @author Mhamed Chanchaf
 */
function get_file_base($file_path, $file_name = null, $variables = []) {
	if (isLogged('candidat') && !isset($variables['candidat_id'])) {
		$variables['candidat_id'] = get_candidat_id();
	}

	$file_path = preg_replace_callback('#{([^}]+)}#', function($m) use ($file_path, $variables){
		if(isset($variables[$m[1]])){
			return $variables[$m[1]];
		}else{
			return $m[0];
		}
	}, $file_path);

	return site_base($file_path . $file_name);
}


/**
 * Get candidat photo url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_photo_url($file_name = null, $variables = []) {
	$url = get_file_base(Candidat::$photoPath, $file_name, $variables);
	if (file_exists($url)) {
		$url = get_file_url(Candidat::$photoPath, $file_name, $variables);
	} else {
		$url = site_url('public/assets/static/candidat/no-photo.png');
	}
	return $url;
}


/**
 * Get candidat photo base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_photo_base($file_name = null, $variables = []) {
	$url = get_file_base(Candidat::$photoPath, $file_name, $variables);
	if (!file_exists($url)) {
		$url = site_base('public/assets/static/candidat/no-photo.png');
	}
	return $url;
}


/**
 * Get candidat Resume url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_resume_url($file_name = null, $variables = []) {
	return get_file_url(Candidat::$resumePath, $file_name, $variables);
}


/**
 * Get candidat Resume base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $base
 *
 * @author Mhamed Chanchaf
 */
function get_resume_base($file_name = null, $variables = []) {
	return get_file_base(Candidat::$resumePath, $file_name, $variables);
}


/**
 * Get candidat Motivation Letter url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_motivation_letter_url($file_name = null, $variables = []) {
	return get_file_url(Candidat::$motivationPath, $file_name, $variables);
}


/**
 * Get candidat Motivation Letter base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $base
 *
 * @author Mhamed Chanchaf
 */
function get_motivation_letter_base($file_name = null, $variables = []) {
	return get_file_base(Candidat::$motivationPath, $file_name, $variables);
}


/**
 * Get candidat Copie Diplome Letter url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_copie_diplome_url($file_name = null, $variables = []) {
	return get_file_url(Candidat::$copieDiplomePath, $file_name, $variables);
}


/**
 * Get candidat Copie Diplome Letter base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $base
 *
 * @author Mhamed Chanchaf
 */
function get_copie_diplome_base($file_name = null, $variables = []) {
	return get_file_base(Candidat::$copieDiplomePath, $file_name, $variables);
}


/**
 * Get candidat Copie Attestation Letter url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_copie_attestation_url($file_name = null, $variables = []) {
	return get_file_url(Candidat::$copieAttestationPath, $file_name, $variables);
}


/**
 * Get candidat Copie Attestation Letter base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $base
 *
 * @author Mhamed Chanchaf
 */
function get_copie_attestation_base($file_name = null, $variables = []) {
	return get_file_base(Candidat::$copieAttestationPath, $file_name, $variables);
}


/**
 * Get candidat Bulletin Paie Letter url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_bulletin_paie_url($file_name = null, $variables = []) {
	return get_file_url(Candidat::$bulletinPaiePath, $file_name, $variables);
}


/**
 * Get candidat Bulletin Paie Letter base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $base
 *
 * @author Mhamed Chanchaf
 */
function get_bulletin_paie_base($file_name = null, $variables = []) {
	return get_file_base(Candidat::$bulletinPaiePath, $file_name, $variables);
}


/**
 * Get candidat Permis Conduire Letter url
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $url
 *
 * @author Mhamed Chanchaf
 */
function get_permis_conduire_url($file_name = null, $variables = []) {
	return get_file_url(Candidat::$permisConduirePath, $file_name, $variables);
}


/**
 * Get candidat Permis Conduire Letter base
 *
 * @param string $file_name
 * @param array $variables
 *
 * @return string $base
 *
 * @author Mhamed Chanchaf
 */
function get_permis_conduire_base($file_name = null, $variables = []) {
	return get_file_base(Candidat::$permisConduirePath, $file_name, $variables);
}