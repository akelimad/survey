<?php
/**
 * CandidatureController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Event;
use App\Ajax;
use App\Controllers\Controller;
use Modules\Candidatures\Models\Candidatures;

class CandidatureController extends Controller
{

  private $data = [];


  public function actionIndex($id=null)
  {
    if( form_submited() ) {
      Event::trigger('candidature_form_submit', $_POST);
      redirect($_SERVER['HTTP_REFERER']);
    }

    $this->addAssets();
    $tableCtrl = new TableController();
    $this->data['table'] = $tableCtrl->getTable($id);
    $this->data['params'] = $tableCtrl->params;
    $this->data['template'] = 'two-columns-left';
    $this->data['breadcrumbs'] = [trans("Candidatures"), trans("Nouvelles candidatures")];

    $this->data['table_actions'] = array_map(function($action) {
      return $action['label'];
    }, $this->data['table']->getActions());

    return get_page('admin/candidature/index', $this->data, __FILE__);
  }


  public function actionList($id)
  {   
    return $this->actionIndex($id);
  }


  public function actionStatus()
  {
    $this->addAssets();
    $this->data['template'] = 'two-columns-left';
    $this->data['breadcrumbs'] = [trans("Candidatures"), trans("Etat des candidatures")];
    return get_page('admin/candidature/status', $this->data, __FILE__);  
  }

  public function spontanees()
  {
    return $this->actionIndex('spontanees');
  }

  public function stage()
  {
    return $this->actionIndex('stage');
  }

  // TODO - Make this action work
  public function actionHistorique()
  {
    echo '<h1>En construction...</h1>';    
  }


  /**
   * Show change status
   * 
   * @author M'hamed Chanchaf
   */
  public function changeSatatus($data)
  {
    if (isset($data['status']['id'])) {
      // Check if convocation email contain lien_confirmation var
      if(
        isset($data['status']['mail']['message']) && 
        !empty($data['status']['mail']['message']) &&
        !preg_match('/{{lien_confirmation}}/im', $data['status']['mail']['message'])
      ) {
        return $this->jsonResponse('error', trans("Le message doit contenir la variable <code style='display: inline-block;'>{{lien_confirmation}}</code>"));
      }

      Event::trigger('candidature_form_submit', $data);

      return $this->jsonResponse('reload');

    } elseif (!empty($data['candidatures'])) {
      $candidats = getDB()->prepare("SELECT c.*, cand.id_candidature as candidature_id FROM candidature cand JOIN candidats c ON c.candidats_id=cand.candidats_id WHERE cand.id_candidature IN(". implode(',', $data['candidatures']) .")");

      // Get candidature
      if (count($data['candidatures']) == 1) {
        $candidature = getDB()->prepare("
          SELECT cand.id_candidature AS cid, cand.id_offre, concat(c.nom, ' ', c.prenom) AS displayName, c.email AS candidat_email
          FROM candidats c 
          JOIN candidature AS cand ON cand.candidats_id=c.candidats_id 
          WHERE cand.id_candidature=?
          ", [$data['candidatures'][0]], true);
      } else {
        $candidature = new \stdClass;
      }

      return Ajax::renderAjaxView(
        trans("Formulaire d'édition de statut de la candidature"), 
        'admin/candidature/popup/change-status', [
          'cIds' => $data['candidatures'],
          'candidature' => $candidature,
          'candidats' => $candidats,
          'statut_id' => $data['id_statut']
      ], __FILE__);
    }
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
      'version' => ETA_ASSETS_VERSION
    ]);
    
    \App\Assets::addJS('cand-table', [
      'src' => module_url(__FILE__, 'assets/js/candidatures.js'), 
      'admin' => true,
      'version' => ETA_ASSETS_VERSION
    ]);
  }
  



} // END Class