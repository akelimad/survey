<?php
/**
 * AjaxController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.workflows.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Workflows\Controllers;

use App\Ajax;

class AjaxController extends Ajax
{


  public function __construct()
  {
    Ajax::add('save_workflow', [$this, 'saveWorkflow']);
    Ajax::add('delete_workflow', [$this, 'deleteWorkflow']);
    Ajax::add('search_users', [$this, 'searchUsers']);
  }


  public function saveWorkflow($data)
  {
    if( empty($data['name']) || empty($data['reference']) || empty($data['value']) ) return;
    $db = getDB();
    $exist = $db->findByColumn('workflows', 'reference', $data['reference'], ['limit'=>1]);
    if( isset($exist->id_workflow) ) {
      $db->update('workflows', 'reference', $data['reference'], $data);
    } else {
      $db->create('workflows', $data);
    }
  }


  public function deleteWorkflow($data)
  {
    if( empty($data['reference']) ) return;
    getDB()->delete('workflows', 'reference', $data['reference']);
  }


  public function searchUsers($data)
  {
    $keyword = strval($data['query']);
    $result = getDB()->prepare("SELECT id_role, nom FROM root_roles WHERE nom like '{$keyword}%'");
    $users = array();
    if( !empty($result) ) : foreach ($result as $key => $v) :
      $users[] = ['id_role' => $v->id_role, 'nom' => $v->nom];
    endforeach; endif;
    return $users;
  }


  
} // END Class