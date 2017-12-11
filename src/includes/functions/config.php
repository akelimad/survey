<?php
/**
 * Config
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 03/10/2017
 */


/**
 * Get config value
 *
 * @param string $name
 * @return string
 *
 * @author Mhamed Chanchaf
 */
function get_config($name){
	$config = getDB()->findByColumn('configuration', 'name', $name, ['limit'=>1]);
	return ( isset($config->value) ) ? json_decode($config->value, true) : false;
}


/**
 * Get config value
 *
 * @param string $name
 * @param string $value
 * @return string
 *
 * @author Mhamed Chanchaf
 */
function save_config($name, $value){
	$db = getDB();
	$config = get_config($name);

	if( is_array($value) ) {
		$value = json_encode($value, JSON_UNESCAPED_UNICODE);
	}

	if( empty($config) ) {
		return $db->create('configuration', [
			'name' => $name,
			'value' => $value
		]);
	} else {
		return $db->update('configuration', 'name', $name, [
			'value' => $value
		]);
	}
}

/**
 * Delete config value
 *
 * @param string $name
 * @return boolean
 *
 * @author Mhamed Chanchaf
 */
function remove_config($name){
	return getDB()->delete('configuration', 'name', $name);
}