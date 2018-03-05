<?php
/**
 * Database
 *
 * @author mchanchaf
 * @since 03/10/2017
 */


/**
 * Get Database Instance
 *
 * @return instance $db
 */
function getDB() {
	return \App\Database::getInstance();
}