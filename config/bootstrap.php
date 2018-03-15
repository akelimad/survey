<?php
// Composer Autoloader
$autoloader = require_once SITE_BASE .'/vendor/autoload.php';
include_once SITE_BASE .'/config/parameters.php';
include_once SITE_BASE .'/config/database.php';

// Defines
define('DS', DIRECTORY_SEPARATOR);

// Assets version
if (!defined('ETA_ASSETS_VERSION')) define('ETA_ASSETS_VERSION', false);

// Get physical URL
$dirname = str_replace(DS, "/", SITE_BASE);
$root = $_SERVER['DOCUMENT_ROOT'];
$physical_uri = '/';
if ( preg_match("!\\$root(.*)!", $dirname, $matches) === 1 ) {
  $physical_uri  = ($matches[1]!='') ? $matches[1] : '/';
  $physical_uri  = ($physical_uri[0] !='/' ) ? '/' . $physical_uri : $physical_uri;
  $physical_uri .= (substr($physical_uri, -1) == '/' ? '' : '/');
}

// Define urls
define('PHYSICAL_URI', $physical_uri);
$isSecure = (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
$scheme = ($isSecure) ? 'https' : 'http';
define('SITE_URL', $scheme ."://".$_SERVER['SERVER_NAME'].PHYSICAL_URI);

// Include functions
include_once SITE_BASE .'/src/includes/functions/global.php';

$autoloader->setPsr4('App\\Helpers\\', site_base('src/helpers'));
$autoloader->setPsr4('App\\Models\\', site_base('src/models'));
$autoloader->setPsr4('App\\Controllers\\', site_base('src/controllers'));
$autoloader->setPsr4('App\\Mail\\', site_base('src/mail'));

// TODO - Make this multilingual 
setlocale (LC_TIME, 'fr_FR.utf8','fra');

// Initialise modules
\App\Module::init();