<?php
// Add module routes
\Modules\Message\Controllers\RouteController::getInstance();

add_js('eta-scripts', [
  'src' => module_url(__FILE__, 'modules/message/assets/js/notifications.js'), 
  'admin' => true,
  'version' => ETA_ASSETS_VERSION
]);