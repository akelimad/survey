<?php
// Fire ajax actions
\Modules\Candidatures\Controllers\AjaxController::getInstance();


// Fire module events
\Modules\Candidatures\Controllers\EventController::getInstance();


function can_view_action($row) {
  if (read_session('id_type_role') == 1)
    return true;

  if ($row->table_action['name'] == 'fiche_evaluation' && (!isset($_GET['id']) || $_GET['id'] != 45))
    return false;

  $permissions = getDB()->prepare("SELECT s.authorized_actions AS actions FROM role_candidature rc JOIN role_candidatures_share s ON s.id_share=rc.id_share WHERE rc.id_candidature=? AND rc.id_role=?", [$row->id_candidature, read_session('id_role')], true);

  if (!isset($permissions->actions) || empty($permissions->actions))
    return false;

  $actions = json_decode($permissions->actions, true) ?: [];

  if (!in_array($row->table_action['name'], $actions))
    return false;

  return true;
}