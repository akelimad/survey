<?php
/**
 * File
 *
 * @author mchanchaf
 * @since 03/10/2017
 */

/**
 * Get filesize
 *
 * @return string $path
 */
function get_filesize($path){
	return filesize($path) / 1024;
}

/**
 * Unlink file
 *
 * @return string $path
 */
function unlinkFile($path) {
	if( is_file($path) && file_exists($path) && is_readable($path) ) {
		if (unlink($path)) {
			return true;
		}
	}
	return false;
}