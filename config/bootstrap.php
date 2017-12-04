<?php
// Composer Autoloader
include_once SITE_BASE .'/vendor/autoload.php';
include_once SITE_BASE .'/config/parameters.php';
include_once SITE_BASE .'/config/database.php';

// Defines
define('DS', DIRECTORY_SEPARATOR);

// Get physical URL
$dirname = str_replace(DS, "/", SITE_BASE);
$root = $_SERVER['DOCUMENT_ROOT'];
$physical_uri = '/';
if ( preg_match("!\\$root(.*)!", $dirname, $matches) === 1 ) {
  $physical_uri  = ($matches[1]!='') ? $matches[1] : '/';
  $physical_uri  = ($physical_uri[0] !='/' ) ? '/' . $physical_uri : $physical_uri;
  $physical_uri .= (substr($physical_uri, -1) == '/' ? '' : '/');
}
define('PHYSICAL_URI', $physical_uri);
$isSecure = (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
$scheme = ($isSecure) ? 'https' : 'http';
define('SITE_URL', $scheme ."://".$_SERVER['SERVER_NAME'].PHYSICAL_URI);

// Include functions
include_once SITE_BASE .'/src/includes/functions/global.php';

// Initialise modules
\App\Module::init();