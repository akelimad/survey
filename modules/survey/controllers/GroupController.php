<?php
/**
 * SurveyController
 *
 * @author mchanchaf
 *
 * @package modules.survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Controllers;

use App\Controllers\Controller;
use Modules\Survey\Models\Group;
use App\Ajax;

class GroupController extends Controller
{
  private $data = [];

  public function index()
  {
    $this->data['sid'] = $_GET['sid'];
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [
      trans("Groupes"),
      trans("Liste des groupes")
    ];
    return get_page('admin/group/index', $this->data, __FILE__);
  }

  public function form($data)
  {
    $group = new \stdClass;
    $title = trans("Créer un groupe");
    if (intval($data['id']) > 0) {
      $group = getDB()->prepare("SELECT * FROM groups WHERE id=?", [
        $data['id'] ,
      ], true);
      if (!isset($group->id)) return;
      $title = trans("Modifier le groupe");
    }
    $data['survey'] = $group;
    return Ajax::renderAjaxView($title, 'admin/group/form', $data, __FILE__);
  }

  public function store($data)
  {
    if (!isset($data['name']) || !isset($data['description'])) return false;

    $db = getDB();

    if (intval($data['id']) > 0) {
      $group = $db->prepare("SELECT id FROM surveys WHERE id=? ", [$data['id']], true);
      if (isset($group->id)) {
        $db->update('surveys', 'id', $group->id, [
          'name' => $data['name'], 
          'description' => $data['description'],
          'updated_at' => date('Y-m-d H:i:s')
        ]);
      } else {
        return $this->jsonResponse('error', trans("Impossible de mettre à jour le groupe."));
      }
    } else {
      $db->create('surveys', [
        'name' => $data['name'],
        'description' => $data['description'],
        'created_by' => 0 ,
        'created_at' => date('Y-m-d H:i:s')
      ]);
    }
    return $this->jsonResponse('success', trans("Les données ont été sauvegardées avec succès !"));
  }

} // END Class