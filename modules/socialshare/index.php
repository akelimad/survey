<?php
// Add module routes
\Modules\Socialshare\Controllers\RouteController::getInstance();

// Fire module events
\Modules\Socialshare\Controllers\EventController::getInstance();