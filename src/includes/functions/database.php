<?php
/**
 * Database
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 03/10/2017
 */


/**
 * Get Database Instance
 *
 * @return instance $db
 */
function getDb() {
	return \App\Database::getInstance();
}