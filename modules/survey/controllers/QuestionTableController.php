<?php
/**
 * QuestionTableController
 *
 * @author mchanchaf
 *
 * @package modules.survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Controllers;

use App\Controllers\Controller;
use Modules\Survey\Models\Question;
use App\Form;

class QuestionTableController extends Controller
{
  public $params = [];
	public function getAll($data)
  {
    $this->params['sid'] = $data['params'][1];
    $this->params['gid'] = $data['params'][2];
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
    
    $table->addColumn('type', trans("Type"), function($row) {
      return $row->type;
    });

    $table->setAction('edit', [
      'patern' => '#',
      'attributes' => [
        'onclick' => "Question.form(&#123;'sid': ".$data["params"][1].", 'gid':".$data["params"][2].", 'qid':{id} &#125)"
      ]
    ]);

    $table->setAction('delete', [
      'patern' => '#',
      'label' => trans("Supprimer ce groupe"),
      'attributes' => [
        'class' => 'btn btn-danger btn-xs mb-0',
        'onclick' => "return chmModal.confirm('', '', '". trans("Êtes-vous sûr de vouloir supprimer cette question ?") ."', 'Question.delete', &#123;'sid': ".$data["params"][1].", 'gid':".$data["params"][2].", 'qid':{id} &#125;, {width: 335})",
      ]
    ]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
  }

  private function buildQuery($params)
  {
    $where_array = [];
    if (isset($params['q']) && !empty($params['q'])) {
      $keywords = explode(" ", mysql_real_escape_string(htmlspecialchars($params['q'])));
      $parts = array();
      for ($i = 0; $i < count($keywords); $i++) {
        $parts[] = "(q.name LIKE '%". $keywords[$i] ."%')";
      }
      $where_array[] = '('. implode(' AND ', $parts) .')';
    }
    $where = (!empty($where_array)) ? "WHERE ". implode(' AND ', $where_array) : 'where group_id = '. $this->params['gid'];
    return "SELECT * FROM survey_questions as q {$where}";
  }

	
} // END Class