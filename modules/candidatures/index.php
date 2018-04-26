<?php
use App\Route;

// Add module routes
\Modules\Candidatures\Controllers\RouteController::getInstance();

// Fire ajax actions
\Modules\Candidatures\Controllers\AjaxController::getInstance();

// Fire module events
\Modules\Candidatures\Controllers\EventController::getInstance();


function can_view_action($row) {
  $action = $row->table_action['name'];

  if (
    preg_match('/(spontanees|stage)$/', Route::getRoute()) &&
    !in_array($action, ['assign_to_offer', 'send_cv_mail', 'send_mail'])
  ) {
    return false;
  }

  if ($action == 'fiche_evaluation' && (!isset($_GET['id']) || $_GET['id'] != 45))
    return false;

  if (read_session('id_type_role') == 1)
    return true;

  $permissions = getDB()->prepare("SELECT s.authorized_actions AS actions FROM role_candidature rc JOIN role_candidatures_share s ON s.id_share=rc.id_share WHERE rc.id_candidature=? AND rc.id_role=?", [$row->id_candidature, read_session('id_role')], true);

  if (!isset($permissions->actions) || empty($permissions->actions))
    return false;

  $actions = json_decode($permissions->actions, true) ?: [];

  if (!in_array($action, $actions))
    return false;

  return true;
}