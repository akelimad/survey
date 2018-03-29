<?php

function isAdmin() {
	$id_type_role = \App\Session::get('id_type_role');
	return (!is_null($id_type_role) && in_array(intval($id_type_role), [0, 1]));
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