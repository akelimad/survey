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
use Modules\Survey\Models\Survey;
use App\Form;

class GroupTableController extends Controller
{
  public $params = [];
	public function getAll($data)
  {
    $this->params['sid'] = $data['params'][1];
    $params = $_GET;
    $survey = Survey::find($data['params'][1]);
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
      return !empty($row->description) ? $row->description : '---';
    });

    $table->setAction('edit', [
      'permission' => $survey->active == 0 ? true : false,
      'patern' => '#',
      'attributes' => [
        'onclick' => 'Group.form('.$data["params"][1].', {id})'
      ]
    ]);
    $table->setAction('delete', [
      'permission' => $survey->active == 0 ? true : false,
      'patern' => '#',
      'label' => trans("Supprimer ce groupe"),
      'attributes' => [
        'class' => 'btn btn-danger btn-xs mb-0',
        'onclick' => "return chmModal.confirm('', '', '". trans("Êtes-vous sûr de vouloir supprimer ce groupe ?") ."', 'Group.delete', &#123;'sid': ".$data["params"][1].", 'gid':{id} &#125;, {width: 335})",
      ]
    ]);

    $table->setAction('questions', [
      'patern' => site_url('backend/survey/'.$data["params"][1].'/group/{id}/question/index'), 
      'label' => trans("Liste des questions"),
      'icon' => 'fa fa-list',
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
    $where = (!empty($where_array)) ? "WHERE ". implode(' AND ', $where_array) : 'where survey_id = '. $this->params['sid'];
    return "SELECT * FROM survey_groups as g {$where}";
  }

	
} // END Class