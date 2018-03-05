<?php
/**
 * Modules
 *
 * @author mchanchaf
 * @since 04/10/2017
 */


/**
 * Get Module directory name
 *
 * @param $file
 * @return $slug
 */
function get_module_dirname($file){
	if(!is_file($file)) return $file;
	$file = str_replace('\\', '/', $file);
	if (preg_match("!/modules/([a-z-]*)/!", $file, $match) === 1) {
		return $match[1];
	}
	return false;
}



/**
 * Get Module Base
 */
function module_base($file, $path=''){
	if( $mod_dirname = get_module_dirname($file) ) {
		return site_base('modules/'. $mod_dirname .'/'. $path);
	}
	return $path;
}


/**
 * Get Module URL
 */
function module_url($file, $path=''){
	return str_replace(site_base(), site_url(), module_base($file)) . $path;
}

/**
 * Tell if module is enabled
 */
function isModuleEnabled($name){
	return file_exists(site_base('modules/'. $name .'/index.php'));
}