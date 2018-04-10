<?php
/**
 * OfferController
 * 
 * @author mchanchaf
 *
 * @package app.offer.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Controllers;

use App\Mail\Mailer;

class OfferController extends \App\Controllers\Controller
{


  public function actionShare()
  {
    $db = getDB();
    $data = $_POST;
    $parts = explode('|', $data['receiver']);
    $data['receiver'] = $parts[1];
    $exists = $db->prepare("SELECT COUNT(*) as nbr FROM role_offre WHERE id_role=? AND id_offre=?", [$parts[0], $data['id_offer']], true);

    if($exists->nbr == 0) {
      $db->create('role_offre', ['id_role' => $parts[0], 'id_offre' => $data['id_offer']]);
      echo $this->shareEmail($data);
    } else {
      echo json_encode(['status' => 'info', 'message' => trans("Cette offre est déjà partagée avec ce partenaire.")]);
    }
  }


  private function shareEmail($data)
  {
    global $email_e;

    $data['message'] .= "<br><br><p>". trans("Vos identifiants de connexion sur notre site web:") ." {{site}}<br>". trans("Votre email:") ." {{email}}<br>". trans("Mot de passe: votre mot de passe actuel") ."<br>" . trans("Ces identifiants vous permettront de consulté des offres ciblé.") ."</p>";

    $login_url = site_url('backend/login');
    $message = Mailer::renderMessage($data['message'], [
      'site' => '<a href="'. $login_url .'">'. $login_url .'</a>',
      'email' => $data['receiver']
    ]);

    $sendEmail = Mailer::send($data['receiver'], $data['subject'], $message, [
      'titre' => trans("Partager un offre avec un partenaire"),
      'Bcc' => [$email_e]
    ]);
  
    if( $sendEmail['response'] == 'success' ) {
      return json_encode(['status' => 'success', 'message' => trans("Le partage de l'offre est effectué.")]);
    } else {
      return json_encode(['status' => 'danger', 'message' => trans("L'email n'a pas pu envoyer.")]);
    }
  }


} // END Class