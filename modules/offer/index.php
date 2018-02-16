<?php
// Fire ajax actions
\Modules\Offer\Controllers\AjaxController::getInstance();


\App\Assets::addJS('offer', [
  'src' => module_url(__FILE__, 'assets/js/offer.js'), 
  'admin' => true,
  'version' => ETA_ASSETS_VERSION
]);