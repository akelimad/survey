<?php
/**
 * ConfirmController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\View;
use App\Event;
use App\Session;

class ConfirmController
{


  public function actionCalendar($id)
  {
    $db = getDB();

    // test if already confirmed
    $agenda = $db->findOne('agenda', 'id_agend', $id);
    if( $agenda->confirmation_statu == 1 ) {
      $type = 'info';
      $message = trans("La convocation a été déjà confirmée.");
    } else {
      // get current candidature status
      $candidature = $db->findOne('candidature', 'id_candidature', $agenda->id_candidature);
      $data['status']['id_candidature'] = $agenda->id_candidature;
      $data['status']['id'] = ($candidature->status == 32) ? 33 : 40;
      $data['status']['comments'] = '';
      $data['status']['date'] = date("Y-m-d");
      $data['status']['time'] = date("H:m");
      $data['status']['agenda']['confirmation_statu'] = 1;

      
      $confirm = (new StatusController())->saveStatus($data);
      $type = 'success';
      $message = trans("La convocation a été bien confirmé, merci.");
    }

    return get_page('front/pages/confirm-convocation', [
      'type' => $type,
      'message' => $message,
      'breadcrumbs' => [trans("Candidature"), trans("Confirmation")],
      'layout' => 'front'
    ], __FILE__);
  }





  
} // END Class