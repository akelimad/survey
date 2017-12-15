<?php
/**
 * StatusController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Event;
use App\Session;

class StatusController
{



  public function saveStatus($data)
  {
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
  	$id_historique = $db->create('historique', [
  		'id_candidature' => $candidature->id_candidature,
      'status' => $prm_statut->statut,
      'date_modification' => date("Y-m-d H:i:s"),
      'utilisateur' => $_SESSION['abb_admin'],
      'commentaire' => $data['status']['comments'],
      'lieu' => ''
    ]);

  	// Save agenda record
  	$date = $data['status']['date'].' '.$data['status']['time'].':00';
  	$agendaData = array(
  		'candidats_id' => $candidature->candidats_id,
      'id_candidature' => $candidature->id_candidature,
      'action' => $prm_statut->statut,
      'obs' => $data['status']['comments'],
      'lieu' => '',
      'start' => $date,
      'end' => $date,
      'confirmation_statu' => '0',
    );
  	$agenda = $db->findOne('agenda', 'id_candidature', $candidature->id_candidature);
  	if( isset($agenda->id_agend) ) {
  		$db->update('agenda', 'id_agend', $agenda->id_agend, $agendaData);
  	} else {
  		$db->create('agenda', $agendaData);
  	}

    // Fire event after saving new sattus
    Event::trigger('change_status_form_submit', [
    	'candidature' => $candidature, 
    	'id_historique' => $id_historique
    ]);

    // Send email notification
    $this->sendNotif();

    // set flash bag
    Session::setFlash('success', 'Un email sera envoyé automatiquement au candidat.');    
  }


  private function sendNotif()
  {
  	// TODO - send email to candidat
  	// apps\backend\home\popup\state_email.php
  }



  
} // END Class