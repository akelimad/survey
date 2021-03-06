<?php
/**
 * SurveyTableController
 *
 * @author mchanchaf
 *
 * @package modules.survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Controllers;

use App\Controllers\Controller;
use Modules\Survey\Models\Survey;
use App\Form;

class SurveyTableController extends Controller
{
	public function getAll($data)
  {
    $params = $_GET;

    $table = new \App\Helpers\Table($this->buildQuery($params), 'id', [
      'bulk_actions' => false,
      'actions' => true,
      'show_footer' => true,
      'show_increment' => true,
      'show_before_table_form' => false,
      'head_actions_width' => '160'
    ]);

    $table->setTableClass(['accountTable', 'table']);
    $table->setTableId('surveysTable');
    $table->setOrderby('id');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);
    $table->setPerpage(15);
    // $table->setSortables(['name']);

    $table->addColumn('name', trans("Titre"), function($row) {
      return $row->name;
    });
    
    $table->addColumn('description', trans("Description"), function($row) {
      return !empty($row->description) ? $row->description : '---' ;
    });
    
    $table->addColumn('created_by', trans("Créé par"), function($row) {
      return $row->nom;
    });

    $table->addColumn('created_at', trans("Date de création"), function($row) {
      return eta_date($row->created_at, 'd.m.Y');
    });

    $table->addColumn('updated_at', trans("Date de modification"), function($row) {
      return !empty($row->updated_at) ? eta_date($row->updated_at, 'd.m.Y') : '---';
    });

    $table->setAction('edit', [
      'patern' => '#',
      'attributes' => [
        'onclick' => 'Survey.form({id})'
      ]
    ]);

    $table->setAction('delete', [
      'patern' => '#',
      'label' => trans("Supprimer ce questionnaire"),
      'attributes' => [
        'class' => 'btn btn-danger btn-xs mb-0',
        'onclick' => "return chmModal.confirm('', '', '". trans("Êtes-vous sûr de vouloir supprimer ce questionnaire ?") ."', 'Survey.delete', &#123;'id': {id}&#125;, {width: 335})",
      ]
    ]);

    $table->setAction('groups', [
      'patern' => site_url('backend/survey/{id}/group/index'), 
      'label' => trans("Liste des groupes"),
      'icon' => 'fa fa-list',
    ]);

    $table->setAction('show', [
      'patern' => '#',
      'label' => trans("Visualiser le questionnaire"),
      'icon' => "fa fa-eye",
      'attributes' => [
        'onclick' => 'Survey.show({id})',
        'class' => 'btn btn-info btn-xs mb-0'
      ]
    ]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
  }

  private function buildQuery($params)
  {
    $where_array = [];
    if (isset($params['s']) && !empty($params['s'])) {
      $keywords = explode(" ", mysql_real_escape_string(htmlspecialchars($params['s'])));
      $parts = array();
      for ($i = 0; $i < count($keywords); $i++) {
        $parts[] = "(s.name LIKE '%". $keywords[$i] ."%')";
      }
      $where_array[] = '('. implode(' AND ', $parts) .')';
    }

    $where = (!empty($where_array)) ? "WHERE ". implode(' AND ', $where_array) : '';
    return "SELECT s.*, r.nom FROM surveys as s INNER JOIN root_roles as r ON s.created_by = r.id_role {$where}";
  }

	
} // END Class