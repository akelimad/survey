<?php
/**
 * StringTableController
 *
 * @author mchanchaf
 *
 * @package modules.language.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Language\Controllers;

use App\Controllers\Controller;
use Modules\Language\Models\Language;

class StringTableController extends Controller
{


	public function getTable()
	{
    $urlParms = $this->getUrlParms($_SERVER['HTTP_REFERER']);

    $defaultLang = Language::getDefaultLanguage('iso_code');
    $lang = (isset($urlParms['lang'])) ? $urlParms['lang'] : $defaultLang;

    // filter
    $where_array = [];
    if (isset($urlParms['s']) && !empty($urlParms['s'])) {
      $keywords = explode(" ", mysql_real_escape_string(htmlspecialchars($urlParms['s'])));
      $parts = array();
      for ($i = 0; $i < count($keywords); $i++) {
        $parts[] = "(s.name LIKE '%". $keywords[$i] ."%')";
      }
      $where_array[] = '('. implode(' AND ', $parts) .')';
    }

    if (isset($urlParms['status']) && !empty($urlParms['status'])) {
      if ($urlParms['status'] == 1) {

      } else {

      }
    }

    $where = (!empty($where_array)) ? ' WHERE ('. implode(' AND ', $where_array) .')' : '';

    $query = "SELECT s.id, s.name, st.value FROM language_strings as s LEFT JOIN language_string_trans as st ON (st.language_string_id=s.id AND st.language='{$lang}') {$where}";

    $table = new \App\Helpers\Table($query, 'id', [
      'actions' => false,
      'show_footer' => true,
      'show_before_table_form' => false
    ]);

    $table->setTableClass(['accountTable', 'table']);
    $table->setTableId('stringsTable');
    $table->setOrderby('id');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);
    $table->setPerpage(15);

    $table->addColumn('name', trans("Phrases"), function($row) {
      return $row->name;
    }, ['attributes' => ['width' => '50%']]);

    $table->addColumn('value', trans("Traductions"), function($row) {
      global $lang;

      $style = ($lang == 'ar') ? 'direction:rtl;text-align:right;font-family:Tahoma;font-weight: bold;' : '';

      return '<input type="text" class="trans_value" value="'. $row->value .'" data-sid="'. $row->id .'"  data-ov="'. $row->value .'" style="width:100%;outline:0;padding:2px 5px;border: 1px solid #7d7b7b;'. $style .'">';
    });

    $table->addColumn('save', '', function($row) {
      return '<button type="button" class="btn btn-success btn-xs save_trans"><i class="fa fa-save"></i></button>';
    }, ['attributes' => ['width' => '20px']]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
	}


	
} // END Class