<?php
use App\Assets;


/**
 * Register a CSS stylesheet.
 *
 * @param string $unique_id
 * @param array  $params
 *
 * @return void
 */
function add_css($unique_id, $params=[]){
	return Assets::addCSS($unique_id, $params);
}

/**
 * Register a javascript.
 *
 * @param string $unique_id
 * @param array  $params
 *
 * @return void
 */
function add_js($unique_id, $params=[]){
	return Assets::addJS($unique_id, $params);
}


/**
 * Render styles.
 *
 * @return void
 */
\App\Event::add('head', function($args){
	$styles = Assets::getStyles();
	if( empty($styles) )
		return false;

	$output = "\n";
	foreach ($styles as $unique_id => $s) {
		$version = ($s['version']) ? "?v=".$s['version'] : "";
		$output .= '<link id="'. $unique_id .'" href="'. $s['src'] . $version .'" rel="stylesheet" type="text/css" media="'. $s['media'] .'" />'. "\n";
	}
	print $output;
});

/**
 * Render scripts.
 *
 * @return void
 */
\App\Event::add('footer', function($args){
	$scripts = Assets::getScripts();
	if( empty($scripts) )
		return false;

	$output = "\n";
	foreach ($scripts as $unique_id => $s) {
		$version = ($s['version']) ? "?ver=".$s['version'] : "";
		$output .= '<script id="'. $unique_id .'" src="'. $s['src'] . $version .'" type="text/javascript"></script>'. "\n";
	}
	print $output;
});


/**
 * Register global CSS and JS
 */
/* add_js('jquery', [
	'src' => SITE_URL .'assets/js/jquery/jquery-1.11.2.min.js', 
	'admin' => true,
	'in_footer' => false
]); */

//Bootstrap
add_js('bootstrap', [
	'src' => SITE_URL .'assets/vendors/bootstrap/js/bootstrap.min.js', 
	'admin' => true
]);
add_css('bootstrap', [
	'src'=> SITE_URL .'assets/vendors/bootstrap/css/bootstrap.min.css', 
	'admin' => true
]);
add_css('bootstrap-mp', [
	'src'=> SITE_URL .'assets/vendors/bootstrap/css/margin-padding.css', 
	'admin' => true
]);

add_css('font-awesome', [
	'src'=> SITE_URL .'assets/vendors/font-awesome/css/font-awesome.min.css', 
	'admin' => true
]);

// iziToast
add_js('iziToast', [
	'src' => SITE_URL .'assets/vendors/izi-toast/js/iziToast.min.js', 
	'admin' => true
]);
add_css('iziToast', [
	'src'=> SITE_URL .'assets/vendors/izi-toast/css/iziToast.min.css', 
	'admin' => true
]);

add_js('jquery-validate', [
	'src' => SITE_URL .'assets/js/jquery.validate.min.js', 
	'admin' => true
]);

add_js('scripts_valide', [
	'src' => SITE_URL .'assets/js/scripts_valide.js', 
	'admin' => true
]);

add_js('ckeditor', [
	'src' => SITE_URL .'assets/js/ckeditor/ckeditor.js', 
	'admin' => true
]);

// Etalent
add_js('eta-functions', [
	'src' => SITE_URL .'assets/js/etalent-functions.js', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_js('eta-scripts', [
	'src' => SITE_URL .'assets/js/etalent-scripts.js', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_css('style_admin', [
	'src'=> SITE_URL .'assets/css/style_admin.php', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_css('menuprincipal', [
	'src'=> SITE_URL .'assets/css/styles/menuprincipal.php', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_css('eta-alerts', [
	'src'=> SITE_URL .'assets/css/etalent-alerts.css', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_css('eta-popup', [
	'src'=> SITE_URL .'assets/css/etalent-popup.css', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_css('eta-styles', [
	'src'=> SITE_URL .'assets/css/etalent-styles.css', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);