<?php
/**
 * StatusController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Event;
use App\Session;
use Modules\Candidatures\Models\Status;

class StatusController
{



  public function saveStatus($data)
  {
    var_dump($data['status']['id'], $ce_id, $co_id);exit;
  	$db = getDB();
  	$candidature = $db->findOne('candidature', 'id_candidature', $data['status']['id_candidature']);
  	if( !isset($candidature->id_candidature) ) return;

  	// Update candidature status
  	$db->update('candidature', 'id_candidature', $candidature->id_candidature, [
  		'status' => $data['status']['id']
  	]);

  	// Get status by id
  	$prm_statut = $db->findOne('prm_statut_candidature', 'id_prm_statut_c', $data['status']['id']);

  	// Save history
    if (isset($data['status']['motif_rejet_other']) && !empty($data['status']['motif_rejet_other'])) {
      $data['status']['motif_rejet'] = $data['status']['motif_rejet_other'];
    }
    unset($data['status']['motif_rejet_other']);
    
  	$id_historique = $db->create('historique', [
  		'id_candidature' => $candidature->id_candidature,
      'status' => $prm_statut->statut,
      'date_modification' => date("Y-m-d H:i:s"),
      'utilisateur' => (isBackend()) ? get_admin('email') : get_candidat('email', 'na'),
      'commentaire' => (isset($data['status']['comments'])) ? $data['status']['comments'] : null,
      'motif_rejet' => (isset($data['status']['motif_rejet'])) ? $data['status']['motif_rejet'] : null,
      'lieu' => (isset($data['status']['lieu'])) ? $data['status']['lieu'] : null
    ]);

  	// Save agenda record
    $id_agend = 0;
    $agenda = $db->findOne('agenda', 'id_candidature', $candidature->id_candidature);

    // update agenda
    if (isBackend()) {

    } else {

    }


    // TODO - check the logic

    $ce_id = Status::getIdByRef(Status::STATUS_CONVOQUES_ECRIT_REF);
    $co_id = Status::getIdByRef(Status::STATUS_CONVOQUES_ORAL_REF);
    if (
      isLogged('candidat') || 
      (isBackend() && in_array($data['status']['id'], [$ce_id, $co_id]))
    ) {
    	$date = $data['status']['date'].' '.$data['status']['time'].':00';
    	$agendaData = array(
    		'candidats_id' => $candidature->candidats_id,
        'id_candidature' => $candidature->id_candidature,
        'action' => $prm_statut->statut,
        'obs' => (isset($data['status']['comments'])) ? $data['status']['comments'] : null,
        'lieu' => (isset($data['status']['lieu'])) ? $data['status']['lieu'] : null,
        'start' => $date,
        'end' => $date,
        'confirmation_statu' => (isset($data['status']['agenda']['confirmation_statu'])) ? $data['status']['agenda']['confirmation_statu'] : 0,
      );
    	if( isset($agenda->id_agend) ) {
    		$db->update('agenda', 'id_agend', $agenda->id_agend, $agendaData);
        $id_agend = $agenda->id_agend;
    	} else {
    		$id_agend = $db->create('agenda', $agendaData);
    	}
    }

    // Fire event after saving new sattus
    $data['candidature'] = $candidature;
    $data['agenda'] = $agenda;
    $data['id_historique'] = $id_historique;
    Event::trigger('change_status_form_submit', $data);

    return [
      'id_candidat' => $candidature->candidats_id,
      'id_agend' => $id_agend,
      'candidature' => $candidature, 
      'id_historique' => $id_historique
    ];
  }

  
} // END Class