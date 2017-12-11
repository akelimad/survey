<?php
/**
 * CandidatureController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Controllers\AdminController;
use Modules\Candidatures\Models\Candidatures;

class CandidatureController extends AdminController
{

  private $data = [];



  public function actionIndex($id=null)
  {
    $this->addAssets();
    $table = new TableController();
    $this->data['status'] = Candidatures::getStatus();
    $this->data['table'] = $table->getTable();
    $this->data['params'] = $table->params;
    $this->data['template'] = 'two-columns-left';
    $this->data['breadcrumbs'] = ['Candidatures', 'Nouvelle candidatures'];
    return get_page('admin/candidature/index', $this->data, __FILE__);
  }


  public function actionList($id)
  {
    return $this->actionIndex($id);
  }


  public function actionStatus($id)
  {
    echo '<h1>En maintenance...</h1>';    
  }


  public function actionHistorique($id)
  {
    echo '<h1>En maintenance...</h1>';    
  }


  private function addAssets()
  {
    \App\Assets::addJS('tagsinput', [
      'src' => site_url('assets/vendors/tagsinput/bootstrap-tagsinput.min.js'), 
      'admin' => true
    ]);
    
    \App\Assets::addCSS('tagsinput', [
      'src' => site_url('assets/vendors/tagsinput/bootstrap-tagsinput.css'), 
      'admin' => true
    ]);

    \App\Assets::addCSS('cand-table', [
      'src' => module_url(__FILE__, 'assets/css/candidatures.css'), 
      'admin' => true,
      'front' => false,
      'version' => time()
    ]);
    
    \App\Assets::addJS('cand-table', [
      'src' => module_url(__FILE__, 'assets/js/candidatures.js'), 
      'admin' => true,
      'version' => time()
    ]);
  }
  



} // END Class