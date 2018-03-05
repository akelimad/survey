<?php
/**
 * Global functions
 *
 * @author mchanchaf
 * @since 03/10/2017
 */


/**
 * Tell if form was submited
 *
 * @return bool
 */
function form_submited() {
	return ($_SERVER['REQUEST_METHOD'] == 'POST');
}
