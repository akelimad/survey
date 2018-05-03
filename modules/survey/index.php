<?php
// Add module routes
\Modules\Survey\Controllers\RouteController::getInstance();

// Fire module events
\Modules\Survey\Controllers\EventController::getInstance();