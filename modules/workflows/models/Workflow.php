<?php
/**
 * Workflow
 *
 * @author M'hamed Chanchaf
 *
 * @package modules.workflows.models
 */
namespace Modules\Workflows\Models;

use App\Models\Model;

class Workflow extends Model
{

  private static $status = array(
    'open' => [
      'label' => 'Crée',
      'verb' => 'Creer',
      'class' => 'default',
    ],
    'accepted' => [
      'label' => 'Accepté',
      'verb' => 'Accepter',
      'class' => 'info',
    ],
    'rejected' => [
      'label' => 'Rejeté',
      'verb' => 'Rejeter',
      'class' => 'danger',
    ],
    'publish' => [
      'label' => 'Publiée',
      'verb' => 'Publier',
      'class' => 'success',
    ],
    'archive' => [
      'label' => 'Archivée',
      'verb' => 'Archiver',
      'class' => 'warning',
    ],
  );

  /**
   * Get workflow by ID
   * 
   * @param int $id_offre
   * @return array $data
   *
   * @author M'hamed Chanchaf
   */
  public static function getWorkflowByID($id_offre)
  {
    $query = "
      SELECT o.id_offre, o.reference, o.Name, o.date_insertion, o.date_expiration, o.mobilite, o.Details, h1.status AS current_status
      FROM workflow_history h1
      JOIN (SELECT id_offre, MAX(id_history) id_history FROM workflow_history GROUP BY id_offre) h2 ON h1.id_history = h2.id_history AND h1.id_offre = h2.id_offre
      LEFT JOIN offre AS o ON o.id_offre=h1.id_offre
      WHERE h1.id_offre=?
    ";
    return getDB()->prepare($query, [$id_offre], true);
  }


  /**
   * Get offre workflow ID By offre ID
   * 
   * @param int $id_offre
   * @return array $id_workflow
   *
   * @author M'hamed Chanchaf
   */
  public static function getOfferWorkflowID($id_offre)
  {
    $his = getDB()->prepare("SELECT id_workflow FROM workflow_history WHERE id_offre=?", [$id_offre], true);
    return (isset($his->id_workflow)) ? $his->id_workflow : 0;
  }  


  /**
   * Get offre history by ID
   * 
   * @param int $id_offre
   * @return array $history
   *
   * @author M'hamed Chanchaf
   */
  public static function getOffreHistory($id_offre)
  {
    $query = "
      SELECT h.created_at, h.status, h.note, r.nom AS nom_agent
      FROM workflow_history h
      LEFT JOIN root_roles AS r ON r.id_role=h.created_by
      WHERE h.id_offre=?
    ";
    return getDB()->prepare($query, [$id_offre]);
  }


  /**
   * Get workflow by ID offre
   *  
   * @param int $id_offre
   * @return array $data
   *
   * @author M'hamed Chanchaf
   */
  public static function GetWorklowByOfferID($id_offre)
  {
    return getDB()->prepare("SELECT w.* FROM workflow_history AS h LEFT JOIN workflows w ON w.id_workflow=h.id_workflow WHERE h.id_offre=?", [$id_offre], true);
  }


  /**
   * Get offre takers
   *  
   * @param int $id_offre
   * @return array $takers
   *
   * @author M'hamed Chanchaf
   */
  public static function GetOffreTakers($id_offre)
  {
    $wf = getDB()->findByColumn('workflow_takers', 'id_offre', $id_offre, ['limit'=>1]);
    return (isset($wf->takers)) ? json_decode($wf->takers, true) : [];
  }
  


  /**
   * Get workflow departements
   *  
   * @param int $id_workflow
   * @return array $deps
   *
   * @author M'hamed Chanchaf
   */
  public static function GetWorkflowDepsTakers($id_workflow)
  {
    $db = getDB();
    $deps = array();
    $wf = $db->prepare("SELECT value FROM workflows WHERE id_workflow=?", [$id_workflow], true);
    if( isset($wf->value) ) {
      $value = json_decode($wf->value);
      foreach ($value->steps as $key => $step) {
        $dep = $db->findByColumn('root_departements', 'id_departement', $step->depId, ['limit'=>1]);
        $takers = $db->findByColumn('root_roles', 'id_departement', $step->depId, [
          'columns' => array(
            'id_role', 'nom', 'email'
          )
        ]);
        $deps[$step->depId] = [
          'name' => $dep->name,
          'takers' => $takers
        ];
      }
    }
    return $deps;
  }


  /**
   * Get status
   *  
   * @return string $status
   *
   * @author M'hamed Chanchaf
   */
  public static function getStatus()
  {
    return self::$status;
  }

  /**
   * Get status label by name
   *  
   * @param int $name
   * @return string $label
   *
   * @author M'hamed Chanchaf
   */
  public static function getStatusLabelByName($name)
  {
    return (isset(self::$status[$name])) ? self::$status[$name]['label'] : $name;
  }


  /**
   * Get status class by name
   *  
   * @param int $name
   * @return string $class
   * 
   * @author M'hamed Chanchaf
   */
  public static function getStatusClassByName($name)
  {
    return (isset(self::$status[$name])) ? self::$status[$name]['class'] : 'default';
  }


  /**
   * Get current step by offre ID
   *  
   * @param int $id_offre
   * @return int $current_step
   * 
   * @author M'hamed Chanchaf
   */
  public static function getCurrentStep($id_offre)
  {
    $count = getDB()->prepare("SELECT COUNT(*) AS nbr FROM workflow_history WHERE id_offre=?", [$id_offre], true);
    return ($count->nbr - 1);
  }

  /**
   * Get current status by offre ID
   *  
   * @param int $id_offre
   * @return int $current_step
   * 
   * @author M'hamed Chanchaf
   */
  public static function getCurrentStatus($id_offre)
  {
    $his = getDB()->prepare("SELECT status FROM workflow_history WHERE id_offre=? order by created_at desc", [$id_offre], true);
    return (isset($his->status)) ? $his->status : '';
  }



  /**
   * Tell if user can change status
   *  
   * @param int $id_user
   * @param int $id_offre
   * @return bool
   *
   * @author M'hamed Chanchaf
   */
  public static function canChangeStatus($id_user, $id_offre)
  {
    $db = getDB();

    // Get workflow by offre
    $id_workflow = self::getOfferWorkflowID($id_offre);
    $wf = $db->prepare("SELECT value FROM workflows WHERE id_workflow=?", [$id_workflow], true);
    if( !isset($wf->value) || empty($wf->value) ) return false;
    $value = json_decode($wf->value);

    // Get current step
    $current_step = self::getCurrentStep($id_offre);

    // Get current step
    $current_status = self::getCurrentStatus($id_offre);

    if( isset($value->recruteurs) ) {
      return (
        isset($value->recruteurs[$current_step]) && 
        $value->recruteurs[$current_step] == $id_user &&
        in_array($current_status, ['open', 'accepted'])
      );
    } else {
      $steps = $value->steps;

      // Get offre takers
      $takers = self::GetOffreTakers($id_offre);
      
      return (
        isset($steps[$current_step]->depId) && 
        in_array($id_user, $takers[$steps[$current_step]->depId]) &&
        in_array($current_status, ['open', 'accepted'])
      );
    }
  }


  /**
   * Tell if user can change status
   *  
   * @param int $id_offre
   * @return bool
   *
   * @author M'hamed Chanchaf
   */
  public static function isFinalStep($id_offre)
  {
    $wf = self::GetWorklowByOfferID($id_offre);
    if( isset($wf->value) ) {
      $value = json_decode($wf->value);
      $count = getDB()->prepare("SELECT COUNT(*) AS nbr FROM workflow_history WHERE id_offre=?", [$id_offre], true);
      return ($count->nbr) == count($value->steps);
    }
    return false;
  }



  /**
   * Tell if offre attached to a workflow
   *  
   * @param int $id_offre
   * @return bool
   *
   * @author M'hamed Chanchaf
   */
  public static function hasWorkflow($id_offre)
  {
    $his = getDB()->prepare("SELECT COUNT(*) AS nbr FROM workflow_history WHERE id_offre=?", [$id_offre], true);
    return ($his->nbr>0);
  }


  /**
   * Send email to next agent
   *  
   * @param int $id_offre
   * @return bool
   *
   * @author M'hamed Chanchaf
   */
  public static function sendEmail($id_offre)
  {
    $db = getDB();

    // Get workflow by offre
    $id_workflow = self::getOfferWorkflowID($id_offre);
    $wf = $db->prepare("SELECT value FROM workflows WHERE id_workflow=?", [$id_workflow], true);
    if( !isset($wf->value) || empty($wf->value) ) return false;
    $value = json_decode($wf->value);

    // Get current step
    $current_step = self::getCurrentStep($id_offre);

    if(isset($value->recruteurs)) {
      if( isset($value->recruteurs[$current_step]) ) {
        self::sendEmailToTakers($id_offre, [$value->recruteurs[$current_step]], $value->validateurs); 
      }
    } else {
      $steps = $value->steps;
      // Get offre takers
      $takers = self::GetOffreTakers($id_offre);
      if( isset($steps[$current_step]->depId) ) {
        $depId = $steps[$current_step]->depId;
        if( isset($takers[$depId]) && !empty($takers[$depId]) ) {
          self::sendEmailToTakers($id_offre, $takers[$depId]);            
        }
      }
    }   
  }


  /**
   * Send email to takers
   *  
   * @param array $takers
   * @return void
   *
   * @author M'hamed Chanchaf
   */
  public static function sendEmailToTakers($id_offre, $takers, $validateurs=[])
  {
    $db = getDB();
    $takersIds = implode(',', $takers);
    $takers = $db->prepare("SELECT email FROM root_roles WHERE id_role IN({$takersIds})");
    
    $args = array();
    if( !empty($validateurs) ) {
      $validateursIds = implode(',', $validateurs);
      $validateurs = $db->prepare("SELECT email FROM root_roles WHERE id_role IN({$validateursIds})");
      foreach ($validateurs as $key => $validateur) {
        $args['CC'][] = $validateur->email;
      }
    }

    if( !empty($takers) ) {
      $subject = "L'offre #{$id_offre} attend votre approbation.";
      $message = "L'offre N° <b>#{$id_offre}</b> attend votre validation.<br>";
      $message = "Vous pouvez consulter cette offre à travers le lien suivant: ". site_url('backend/module/workflows/workflow/details/'.$id_offre);
      foreach ($takers as $key => $taker) {
        $takersEmails[] = $taker->email;
      }
      \app\Mail::send($takersEmails, $subject, $message, $args);
    }
  }
  

  /**
   * Add initial offre status
   * 
   * @param int $id_user
   * @param int $id_offre
   * @return bool
   *
   * @author M'hamed Chanchaf
   */
  public static function addInitialStatus($id_user, $id_offre)
  {
    if( !isset($_POST['wf_type']) || !in_array($_POST['wf_type'], ['default', 'custom']) )
      return false;

    $db = getDB();
    if( isset($_POST['id_wf']) && is_numeric($_POST['id_wf']) ) {
      $value = '{"recruteurs":['.$_POST['wf_recruteurs'].'], "validateurs":['.$_POST['wf_validateurs'].']}';
      return $db->update('workflows', 'id_workflow', $_POST['id_wf'], [
        'value' => $value
      ]);
    }

    $id_workflow = (isset($_POST['id_workflow'])) ? intval($_POST['id_workflow']) : 0;
    if( $id_workflow < 1 ) {
      $id_workflow = $db->create('workflows', [
        'name' => 'WF pour '. $_POST['intitule'],
        'reference' => uniqid(),
        'custom' => 1,
        'value' => '{"recruteurs":['.$_POST['wf_recruteurs'].'], "validateurs":['.$_POST['wf_validateurs'].']}'
      ]);
      if( $id_workflow < 1 ) return false;
    }
    $create = $db->create('workflow_history', [
      'id_workflow' => $id_workflow, 
      'id_offre' => $id_offre, 
      'status' => 'open', 
      'created_at' => date('Y-m-d H:i:s'), 
      'created_by' => $id_user
    ]);
    if( $create > 0 ) {
      return self::sendEmail($id_offre);
    }
    return false;
  }


  
} // END Class