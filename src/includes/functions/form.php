<?php
/**
 * Global functions
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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
