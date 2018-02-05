<?php

/**
 * Get setting by name
 *
 * @param string $name
 * @return string
 **/
function get_setting($name = null) {
	$settings = $GLOBALS['etalent']->settings;
	if( empty($settings) ) {
		$settings = [];
		$setting = getDB()->read('setting');
		if(!empty($setting)) : foreach ($setting as $key => $s) :
			$settings[$s->name] = $s->value;
		endforeach; endif;
		$GLOBALS['etalent'] = new \stdClass;
		$GLOBALS['etalent']->settings = $settings;
	}
	if( is_null($name) ) {
		return $settings;
	} elseif ( isset($settings[$name]) ) {
		return $settings[$name];
	}
	return $name;
}


/**
 * Create new setting
 *
 * @param string $name
 * @param string $value
 * @return bool
 **/
function create_setting($name, $value, $unique = true) {
	unset($GLOBALS['etalent']->settings);
	$db = getDB();
	if( $unique && $db->exists('setting', 'name', $name) ) {
		return $db->update('setting', 'name', $name, ['value' => $value]);
	}
	$db->create('setting', ['name' => $name, 'value' => $value]);
	return true;
}


/**
 * Delete setting
 *
 * @param string $name
 * @return bool
 **/
function delete_setting($name) {
	unset($GLOBALS['etalent']->settings);
	return getDB()->delete('setting', 'name', $name);
}