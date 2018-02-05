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

	$output = get_dynamic_assets('css') ."\n";
	$output .= get_dynamic_assets('js') ."\n";
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


function get_dynamic_assets($type = 'css') {
	$devEnv = ((strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || read_cookie('env') === 'dev'));
	$output = '';
	$assets = json_decode(file_get_contents(site_base('/public/build/assets.json')), true);
	if(isset($assets['app'][$type])) {
		foreach ($assets as $key => $asset) {
			if($devEnv && $type === 'css') continue;

			$assetsUrl = ($devEnv) ? 'http://localhost:3003/public/build/'. $key .'.'. $type : $asset[$type];
			if($type === 'js') {
				$output .= '<script src="'. $assetsUrl .'" type="text/javascript"></script>'. "\n";
			} else {
				$output .= '<link href="'. $assetsUrl .'" rel="stylesheet" type="text/css" />'. "\n";
			}

			/* if($devEnv) {
				if($type === 'css') {
					$output .= '<script src="http://localhost:3003/public/build/'. $key .'.js" type="text/javascript"></script>'. "\n";
				}
			} else {
				$assetsUrl = ($devEnv) ? 'http://localhost:3003/public/build/'. $key .'.'. $type : $asset[$type];
				if($type === 'js') {
					$output .= '<script src="'. $assetsUrl .'" type="text/javascript"></script>'. "\n";
				} else if($type === 'css' && !$devEnv) {
					$output .= '<link href="'. $assetsUrl .'" rel="stylesheet" type="text/css" />'. "\n";
				}
			} */
		}
	}
	return $output;
}

/**
 * Register global CSS and JS
 */
/* add_js('jquery', [
	'src' => SITE_URL .'assets/js/jquery/jquery-1.11.2.min.js', 
	'admin' => true,
	'in_footer' => false
]);

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

add_js('jquery-validate', [
	'src' => SITE_URL .'assets/js/jquery.validate.min.js', 
	'admin' => true
]);

add_js('scripts_valide', [
	'src' => SITE_URL .'assets/js/scripts_valide.js', 
	'admin' => true
]); */

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

/* add_css('chm-alerts', [
	'src'=> SITE_URL .'assets/css/etalent-alerts.css', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);

add_css('eta-popup', [
	'src'=> SITE_URL .'assets/css/etalent-popup.css', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]); */

add_css('eta-styles', [
	'src'=> SITE_URL .'assets/css/etalent-styles.css', 
	'admin' => true,
	'version' => ETA_ASSETS_VERSION
]);