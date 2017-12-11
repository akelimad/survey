<?php
/**
 * View
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 03/10/2017
 */


/**
 * Get view
 *
 * @param string $path
 * @param object $variables
 *
 * @author Mhamed Chanchaf
 */
function get_view($path, $variables=[], $file=null){
	return \App\View::get($path, $variables, $file);
}


/**
 * Get page
 *
 * @param string $path
 * @param object $variables
 *
 * @author Mhamed Chanchaf
 */
function get_page($path, $variables=[], $file=null){
	return \App\View::getPage($path, $variables, $file);
}