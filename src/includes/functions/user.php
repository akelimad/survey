<?php

function isAdmin() {
	$id_type_role = \App\Session::get('id_type_role');
	return (!is_null($id_type_role) && in_array(intval($id_type_role), [0, 1]));
}