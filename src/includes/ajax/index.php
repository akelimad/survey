<?php
/** 
 * @author Mhamed Chanchaf
 */
require_once dirname(__DIR__) .'/../../config/config.php';

// Run ajax action
$data = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;
if( is_ajax() && isset($data['action']) && $data['action'] != '' ) {
	$action = $data['action'];
	unset($data['action']);
	$return = \App\Ajax::trigger($action, $data);
	die(json_encode($return));
} else {
	die(0);
}