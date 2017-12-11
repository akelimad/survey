<?php
/**
 * Ajax
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 03/10/2017
 */


/**
 * Tell if a page is being called via Ajax
 *
 * @return bool
 */
function is_ajax() {
	return ( 
		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
	);
}
