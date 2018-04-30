<?php

function isAdmin() {
	$id_type_role = \App\Session::get('id_type_role');
	return (!is_null($id_type_role) && in_array(intval($id_type_role), [0, 1]));
}

/**
 * Get admin data by key
 *
 * @param $key
 * @return $value
 *
 * @author Mhamed Chanchaf
 */
function get_admin($name = null, $dafault = null) {
  $admin = (isset($GLOBALS['etalent']->admin)) ? $GLOBALS['etalent']->admin : new \stdClass;
  if( !isset($admin->id_role) ) {
    $admin = getDB()->findOne('root_roles', 'id_role', read_session('id_role'));
    if( !isset($admin->id_role) ) return $dafault;
    $GLOBALS['etalent']->admin = $admin;
  }

  if (is_null($name)) return $admin;

  return (isset($GLOBALS['etalent']->admin->$name)) ? $GLOBALS['etalent']->admin->$name : $dafault;
}

function getRealIpAddr() {
  if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) { //to check ip passed from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}