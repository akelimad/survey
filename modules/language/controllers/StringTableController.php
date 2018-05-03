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
use App\Form;

class StringTableController extends Controller
{

	public function getTable($data)
	{
    $params = $_GET;
    $defaultLang = Language::getDefaultLanguage('iso_code');
    $lang = (isset($params['lang'])) ? $params['lang'] : $defaultLang;
    $params['lang'] = $lang;

    $table = new \App\Helpers\Table(Language::buildQuery($params), 'id', [
      'bulk_actions' => true,
      'show_footer' => true,
      'show_before_table_form' => false
    ]);

    $table->setTableClass(['table', 'table-striped']);
    $table->setOrderby('id');
    $table->setOrder('DESC');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $table->setPage($page);
    $table->setPerpage(15);

    $table->addColumn('name', trans("Phrases"), function($row) {
      global $lang;

      $style = ($lang == 'ar') ? 'direction:rtl;text-align:right;font-family:Tahoma;font-weight: bold;' : '';

      return Form::textarea('', null, htmlentities($row->name), [
        'rows'     => 1,
        'cols'     => 75,
        'readonly',
        'class' => '',
        'style' => 'width:100%;outline:0;padding:2px 5px;border: 1px solid #7d7b7b;'. $style
      ]);
    }, ['attributes' => ['width' => '50%']]);

    $table->addColumn('value', trans("Traductions"), function($row) {
      global $lang;

      $style = ($lang == 'ar') ? 'direction:rtl;text-align:right;font-family:Tahoma;font-weight: bold;' : '';

      return Form::textarea('lang', null, htmlentities($row->value), [
        'class'    => 'trans_value',
        'rows'     => 1,
        'cols'     => 75,
        'data-sid' => $row->id,
        'data-ov'  => $row->value,
        'style'    => 'width:100%;outline:0;padding:2px 5px;border: 1px solid #7d7b7b;'. $style
      ]);
    });

    // Add actions
    $table->removeActions(['edit', 'delete']);
    $table->setAction('save', [
      'label' => trans("Sauvegarder"),
      'bulk_label' => trans("Sauvegarder"),
      'bulk_action' => true,
      'patern' => '#',
      'icon' => 'fa fa-save',
      'callback' => 'Language.store',
      'attributes' => [
        'class' => 'btn btn-success btn-xs',
      ]
    ]);

    // Run table and get results
    $table->_run();

    return json_encode(['status' => 'success', 'content' => $table->render(false)]);
	}
	
} // END Class