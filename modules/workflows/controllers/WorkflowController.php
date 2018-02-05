<?php
/**
 * WorkflowController
 *
 * @author M'hamed Chanchaf
 *
 * @package modules.workflows.controllers
 */
namespace Modules\Workflows\Controllers;

use Modules\Workflows\Models\Workflow;
use App\Controllers\Controller;

class WorkflowController extends Controller
{


  /**
   * Manage workflows
   * 
   * @author M'hamed Chanchaf
   */
  public function actionIndex()
  {
    return get_page('admin/index', [
      'breadcrumbs' => ['Workflows', 'Historique']
    ], __FILE__);
  }


  /**
   * Workflow Builder
   * 
   * @author M'hamed Chanchaf
   */
  public function actionBuilder()
  {
    $db = getDB();

    $depList = array();
    $departements = $db->prepare("SELECT dep.* FROM root_departements dep JOIN root_roles r ON r.id_departement=dep.id_departement GROUP BY dep.id_departement");

    if( !empty($departements) ) : foreach ($departements as $key => $dep) :
      if( empty($dep->name) ) continue;
      $depList[] = array(
        "Id" => intval($dep->id_departement), 
        "name" => $dep->name
      );
    endforeach; endif;
 
  	return get_view('admin/builder', [
      'depList' => json_encode($depList),
      'workflows' => $db->findByColumn('workflows', 'custom', 0)
    ], __FILE__);
  }


  /**
   * Show workflow details
   * 
   * @author M'hamed Chanchaf
   */
  public function actionDetails($id_offre)
  {
    // $id_offre = $_GET['id'];
    $id_role = $_SESSION['id_role'];
    $canChangeStatus = Workflow::canChangeStatus($id_role, $id_offre);

    if( 
      form_submited() && 
      isset($_POST['new_status']) && 
      in_array($_POST['new_status'], ['publish', 'archive', 'rejected', 'accepted']) &&
      $canChangeStatus
    ) {

      $db = getDB();
      //$count = $db->prepare("SELECT COUNT(*) AS nbr FROM workflow_history WHERE id_offre=? AND created_by=?", [$id_offre, $id_role], true);
      // if($count->nbr==0) {
        $id_history = $db->create('workflow_history', [
          'id_workflow' => Workflow::getOfferWorkflowID($id_offre), 
          'id_offre' => $id_offre, 
          'status' => $_POST['new_status'], 
          'note' => $_POST['note'], 
          'created_at' => date('Y-m-d H:i:s'), 
          'created_by' => $id_role
        ]);
        if( $id_history ) {
          if( $_POST['new_status'] == 'accepted' ) {
            Workflow::sendEmail($id_offre);
          }

          // Change offre status
          if( in_array($_POST['new_status'], ['archive', 'publish']) ) {
            $db->update('offre', 'id_offre', $id_offre, [
              'status' => ($_POST['new_status'] == 'publish') ? 'En cours' : 'Archivée'
            ]);            
          }

          set_flash_message('success', 'Le statut a été bien changé.');
        }
      // } else {
      //   set_flash_message('danger', 'Vous n\'avez pas le droit de changer le statut.');
      // }
      redirect('backend/module/workflows/workflow');
    }

    $status = Workflow::getStatus();
    unset($status['open']);
    if( Workflow::isFinalStep($id_offre) ) {
      unset($status['accepted'], $status['rejected']);
    } else {
      unset($status['archive'], $status['publish']);
    }

    $offre = Workflow::getWorkflowByID($id_offre);
    if( !isset($offre->reference) ) redirect('backend/module/workflows/workflow');
    $history = Workflow::getOffreHistory($id_offre);
    return get_page('admin/details', [
      'offre' => $offre,
      'history' => $history,
      'status' => $status,
      'canChangeStatus' => $canChangeStatus,
      'breadcrumbs' => ['Workflows', 'Détails']
    ], __FILE__);
  }


  /**
   * Manage offre wf takers
   * 
   * @author M'hamed Chanchaf
   */
  public function actionTakers($id_offre)
  {
    $db = getDB();
    $id_workflow = Workflow::getOfferWorkflowID($id_offre);
    $wf_deps = Workflow::GetWorkflowDepsTakers($id_workflow);
    $takers = Workflow::GetOffreTakers($id_offre);
    if( form_submited() ) {
      $dep_ok = true;
      foreach ($wf_deps as $id_dep => $dep) {
        if( !isset($_POST['dep_takers'][$id_dep]) || empty($_POST['dep_takers'][$id_dep]) ) {
          $dep_ok = false;
        }
      }

      if( $dep_ok ) {

        $value = json_encode($_POST['dep_takers']);
        $exists = $db->exists('workflow_takers', 'id_offre', $id_offre);
        if( $exists ) {
          $db->update('workflow_takers', 'id_offre', $id_offre, [
            'takers' => $value
          ]);
        } else {
          $db->create('workflow_takers', [
            'id_offre' => $id_offre,
            'takers' => $value
          ]);
        }

        if( empty($takers) ) {
          Workflow::sendEmail($id_offre);
        }

        set_flash_message('success', 'Les modifications ont été bien sauvegarder.');
        redirect('backend/module/workflows/workflow');

      } else {
        $takers = $_POST['dep_takers'];
        set_flash_message('danger', 'Vous devez choisir au moin un Preneurs par département.');
      }
    }

    $offre = $db->findByColumn('offre', 'id_offre', $id_offre, ['limit'=>1]);
    return get_page('admin/takers', [
      'takers' => $takers,
      'wf_deps' => $wf_deps,
      'breadcrumbs' => ["Workflows", "Preneurs de workflow pour l'offre <b>({$offre->Name})</b>"]
    ], __FILE__);
  }


  /**
   * Delete offre workflow
   * 
   * @author M'hamed Chanchaf
   */
  public function actionDelete($id_offre)
  {
    if($_SESSION['abb_admin'] == 'root') {
      $db = getDB();
      $wf = $db->prepare("SELECT wf.custom, wf.id_workflow FROM workflows AS wf JOIN workflow_history h ON h.id_workflow=wf.id_workflow WHERE h.id_offre=? GROUP BY h.id_workflow", [$id_offre], true);
      if( isset($wf->custom) && $wf->custom == 1 ) {
        getDB()->delete('workflows', 'id_workflow', $wf->id_workflow);
      }
      getDB()->delete('workflow_history', 'id_offre', $id_offre);
      getDB()->delete('workflow_takers', 'id_offre', $id_offre);
    }
    redirect('backend/module/workflows/workflow');
  }



} // END Class