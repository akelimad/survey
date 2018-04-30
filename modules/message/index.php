<?php
// Add module routes
\Modules\Message\Controllers\RouteController::getInstance();

add_js('notifications', [
  'src' => module_url(__FILE__, 'assets/js/notifications.js'), 
  'admin' => true,
  'version' => ETA_ASSETS_VERSION
]);