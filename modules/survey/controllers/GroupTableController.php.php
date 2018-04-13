<?php
/**
 * GroupTableController
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
use App\Form;

class GroupTableController extends Controller
{
	public function getAll($data)
  {
    $params = $_GET;

    $table = new \App\Helpers\Table($this->buildQuery($params), 'id', [
      'bulk_actions' => false,
      'actions' => true,
      'show_footer' => true,
      'show_increment' => true,
      'show_before_table_form' => false
    ]);

    $table->setTableClass(['accountTable', 'table']);
    $table->setTableId('stringsTable');
    $table->setOrderby('id');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);
    $table->setPerpage(15);

    $table->addColumn('name', trans("Titre"), function($row) {
      return $row->name;
    });
    
    $table->addColumn('description', trans("Description"), function($row) {
      return $row->description;
    });

    $table->addColumn('created_at', trans("Date de création"), function($row) {
      return eta_date($row->created_at, 'd.m.Y');
    });

    $table->addColumn('updated_at', trans("Date de modification"), function($row) {
      return eta_date($row->updated_at, 'd.m.Y');
    });

    $table->setAction('edit', [
      'patern' => '#',
      'attributes' => [
        'onclick' => 'Group.form({id})'
      ]
    ]);

    $table->setAction('delete', [
      'patern' => '#',
      'attributes' => [
        'onclick' => 'Group.delete({id})'
      ]
    ]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
  }

  private function buildQuery($params)
  {
    $where_array = [];
    if (isset($params['g']) && !empty($params['g'])) {
      $keywords = explode(" ", mysql_real_escape_string(htmlspecialchars($params['g'])));
      $parts = array();
      for ($i = 0; $i < count($keywords); $i++) {
        $parts[] = "(g.name LIKE '%". $keywords[$i] ."%')";
      }
      $where_array[] = '('. implode(' AND ', $parts) .')';
    }

    $where = (!empty($where_array)) ? "WHERE ". implode(' AND ', $where_array) : '';

    return "SELECT * FROM groups as g {$where}";
  }

	
} // END Class