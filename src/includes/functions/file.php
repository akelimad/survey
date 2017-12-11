<?php
/**
 * File
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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
	if( file_exists($path) ) {
		chown($path, 666);
		if (unlink($path)) {
			return true;
		}
	}
	return false;
}