<?php
// Fire module events
\Modules\Fiches\Controllers\EventController::getInstance();

// Fire ajax actions
\Modules\Fiches\Controllers\AjaxController::getInstance();


\App\Assets::addJS('fiches', [
  'src' => module_url(__FILE__, 'assets/js/fiches.js'), 
  'admin' => true,
  'version' => time()
]);