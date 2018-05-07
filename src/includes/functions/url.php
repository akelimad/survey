<?php
/**
 * URL
 *
 * @author mchanchaf
 * @since 03/10/2017
 */
use App\Controllers\Controller;

/**
 * Get site url
 *
 * @param string $path
 *
 * @return string $url
 */
function site_url($path='') {
  if($path == '/') $path = '';
	return SITE_URL . $path;
}


/*
 * Check if home page
 *
 */
function is_home(){
	return SITE_URL == get_current_url();
}

/**
 * Get site base
 *
 * @param string $path
 *
 * @return string $url
 */
function site_base($path='') {
	return SITE_BASE .'/'. $path;
}


/**
 * Get current url
 *
 * @return $url string
 */
function get_current_url($path=''){
	$scheme = (isset($_SERVER['REQUEST_SCHEME'])) ? $_SERVER['REQUEST_SCHEME'] : 'http';
	return $scheme .'://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']  . $path;
}

/**
 * Get param
 *
 * @param string $param
 * 
 * @return string $value
 */
function get_url_params($param = null, $url = null, $default = null){
  return Controller::getUrlParms($param, $url, $default);
}