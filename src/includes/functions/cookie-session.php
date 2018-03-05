<?php
/**
 * Cookie & Session
 *
 * @author mchanchaf
 * @since 03/10/2017
 */


/**
 * Create cookie
 *
 * @param string $name
 * @param string $value
 * @return bool
 */ 
function create_cookie($name, $value){
	return \App\Cookie::set($name, $value);
}

/**
 * Read cookie
 *
 * @param string $name
 * @return $cookie_value
 */ 
function read_cookie($name){
	return \App\Cookie::get($name);
}

/**
 * Erase cookie
 *
 * @param string $name
 * @return bool
 */ 
function erase_cookie($name){
	return \App\Cookie::destroy($name);
}


/**
 * Create session
 *
 * @param string $name
 * @param string $value
 * @return bool
 */ 
function create_session($name, $value){
	return \App\Session::set($name, $value);
}

/**
 * Read session
 *
 * @param string $name
 * @param string $default
 * @return $cookie_value
 */ 
function read_session($name, $default = null){
	return \App\Session::get($name);
}

/**
 * Erase session
 *
 * @param string $name
 * @return bool
 */ 
function erase_session($name){
	return \App\Session::destroy($name);
}