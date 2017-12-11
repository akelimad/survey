<?php
/**
 * Site informations
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 04/10/2017
 */


/**
 * Get site info
 *
 * @param  string $key
 * @return string $value
 */
function get_site($key=null){
	$site = $GLOBALS['etalent']->site;
	if( !isset($site->$key) ) {
		$site = getDB()->read('root_configuration', ['limit'=>1]);
		$GLOBALS['etalent']->site = $site;
	}
	if( is_null($key) ) {
		return $site;
	} elseif ( isset($site->$key) ) {
		return $site->$key;
	}
	return $key;
}