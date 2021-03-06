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
use App\Mail\Mailer;
use Modules\Candidatures\Models\Status;
use App\Controllers\Controller;

class ConfirmController extends Controller
{


  public function confirm($data)
  {
    // test if already confirmed
    $md5 = $data['params'][1];
    $agenda = getDB()->prepare("SELECT * FROM agenda WHERE md5(id_agend)=?", [$md5], true);

    if (isset($agenda->id_agend)) {
      if( $agenda->confirmation_statu == 1 ) {
        $type = 'info';
        $message = trans("La convocation a été déjà confirmée.");
      } else {
        // get current candidature status
        $statusConvoquesEcritId = Status::getIdByRef(Status::STATUS_CONVOQUES_ECRIT_REF);
        $statusConfirmesEcritId = Status::getIdByRef(Status::STATUS_CONFIRMES_ECRIT_REF);
        $statusConfirmesOralId  = Status::getIdByRef(Status::STATUS_CONFIRMES_ORAL_REF);
        $candidature = getDB()->findOne('candidature', 'id_candidature', $agenda->id_candidature);
        $data['status']['id_candidature'] = $agenda->id_candidature;
        $data['status']['id'] = ($candidature->status == $statusConvoquesEcritId) ? $statusConfirmesEcritId : $statusConfirmesOralId;
        $data['status']['comments'] = '';
        $data['status']['date'] = date("Y-m-d");
        $data['status']['time'] = date("H:m");
        $data['status']['agenda']['confirmation_statu'] = 1;

        $confirm = (new StatusController())->saveStatus($data);

        // Send convocation
        if (get_setting('candidature.send_convocation_ticket', 0) == 1) {
          $this->sendConvocation($confirm['id_candidat'], $confirm['id_agend'], $candidature->status);
        }

        $type = 'success';
        $message = trans("La convocation a bien été confirmée, merci.");
      }
    } else {
      $type = 'danger';
      $message = trans("Impossible de trouver cette convocation.");
    }

    return get_page('front/pages/confirm-convocation', [
      'type' => $type,
      'message' => $message,
      'breadcrumbs' => [trans("Candidature"), trans("Confirmation")],
      'layout' => 'front'
    ], __FILE__);
  }


  public function invitation($data)
  {
    $md5 = $data['params'][1];
    $data = getDB()->prepare("SELECT a.id_agend, a.start, a.lieu, a.confirmation_statu, c.nom, c.prenom, c.email, c.tel1 FROM agenda a JOIN candidats c ON c.candidats_id=a.candidats_id WHERE md5(a.id_agend)=?", [$md5], true);
    if (isset($data->id_agend) && $data->confirmation_statu == 1) {
      ini_set('memory_limit','512M');

      ob_start();
      echo get_view('front/confirm/invitation', compact('data'), __FILE__);
      $html = ob_get_clean();

      return $this->htmlToPDF($html);

    } else {
      die(trans("Impossible de trouver cette invitation!"));
    }
  }


  private function sendConvocation($id_candidat, $id_agend, $status_id)
  {
    // Get email template
    $template = getDB()->findOne('root_email_auto', 'ref', 'convocation');
    if(!isset($template->id_email)) return;

    $agenda = getDB()->prepare("SELECT * FROM agenda WHERE id_agend=?", [$id_agend], true);
    if(!isset($agenda->id_agend)) return;

    $variables = Mailer::getVariables($id_candidat);
    $cEmail = $variables['email_candidat'];
    $cName = $variables['nom'] .' '. $variables['prenom'];
    
    $lien = site_url("candidature/invitation/". md5($id_agend));
    $variables['invitation_link'] = '<a href="'. $lien .'">'. $lien .'</a>';
    $variables['start_date'] = eta_date($agenda->start, '%A %d %B', true) .' '. eta_date($agenda->start, 'H:i');
    $variables['location'] = (!empty($agenda->lieu)) ? $agenda->lieu : '';

    $subject = Mailer::renderMessage($template->objet, $variables);
    $message = Mailer::renderMessage($template->message, $variables);

    return Mailer::send($cEmail, $subject, $message, [
      'titre' => $template->titre,
      'coresp_nom' => $cName .' ('. $cEmail .')',
      'type_email' => 'Envoi automatique'
    ]);
  }


  
} // END Class