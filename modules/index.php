<?php
ob_start(); ob_clean(); // Initiate the output buffer

require_once dirname(__DIR__) . "/config/config.php";

if(session_id() == '' || !isset($_SESSION)) {
  session_start();
}

$file = site_base(str_replace(PHYSICAL_URI, '', $_SERVER['REQUEST_URI']));

if( isset($_GET['module']) && file_exists(site_base('modules/'.$_GET['module'].'/index.php')) ) {

	// Check permissions
	if( isBackend() && !isLogged('admin') ) redirect( site_url('backend/login/') );

	// Call module page
	$controller  = "\Modules\\". ucfirst($_GET['module']) ."\Controllers\\". dashesToCamelCase($_GET['controller']) .'Controller';
	$action = "action". dashesToCamelCase(str_replace('.php', '', $_GET['action']));
	if ( method_exists($controller, $action) && is_callable(array($controller, $action))) {
		
		$args = array();
		if( isset($_GET['id']) ) {
			$args['id'] = $_GET['id'];
		}

		call_user_func_array(
			array(new $controller(), $action), $args
		);

	} else {
		get_view('errors/404');
	}
} else if(is_file($file)) {
	include $file;
} else {
	get_view('errors/404');
}