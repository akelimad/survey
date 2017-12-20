<?php
/**
 * ShareController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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

class ShareController
{


  public function share($data)
  {
    if( $data['candidatures'] == '' || empty(json_decode($data['candidatures'], true)) )
      return;

    global $email_e;
    $candidatures = json_decode($data['candidatures'], true);
    $randPassword = $this->genPassword(8);

    $data['message'] .= "<br><br><p>Vos identifiants de connexion sur notre site web : {{site}}<br>Votre email : {{email}}<br>Mot de passe : {{mot_passe}}<br>Ces identifiants vous permettront de consulté des candidatures ciblé.</p>";

    $login_url = site_url('backend/login');
    $data['message'] = Mailer::renderMessage($data['message'], [
      'site' => '<a href="'. $login_url .'">'. $login_url .'</a>',
      'email' => $data['receiver'],
      'mot_passe' => $randPassword
    ]);
    $data['type_email'] = 'Compte pour voir candidature';

    $sendEmail = (new AjaxController())->sendEmail($data, [
      'Bcc' => [$email_e]
    ]);
    if( $sendEmail['response'] == 'success' ) {
      // create temp admin account and attach candidatures
      $db = getDB();
      $date = date("Y-m-d");

      $admin = $db->findOne('root_roles', 'email', $data['receiver']);
      if( isset($admin->id_role) ) {
        $db->update('root_roles', 'id_role', $admin->id_role, ['mdp' => md5($randPassword)]);
        $id_role = $admin->id_role;
      } else {
        $id_role = $db->create('root_roles', [
          'id_type_role' => '2', 
          'login' => $data['receiver'], 
          'mdp' => md5($randPassword), 
          'date_creation' => $date, 
          'date_modification' => $date, 
          'nom' => strtok($data['receiver'], '@'), 
          'email' => $data['receiver'], 
          'ref_filiale' => 0
        ]);
      }

      if( $id_role > 0 ) {

        // attach canddiatures
        foreach ($candidatures as $key => $id_candidature) {
          $count = $db->prepare("
            SELECT COUNT(*) AS nbr FROM role_candidature 
            WHERE id_role=? AND id_candidature=?
          ", [$id_role, $id_candidature], true);

          if( $count->nbr == 0 ) {
            $db->create('role_candidature', [
              'id_role' => $id_role,
              'id_candidature' => $id_candidature
            ]);
          }
        }

        Session::setFlash('success', 'Les candidatures ont été partagé.');
      } else {
        Session::setFlash('error', 'Une erreur est survenu lors de la création d\'un compte temporaire.');
      }

    } else {
      Session::setFlash('error', $sendEmail['message']);
    }
  }


  /**
   * Generate random password
   *
   * @param int $length
   *
   * @return string $password
   *
   * @author Mhamed Chanchaf
   */
  public function genPassword($length=6) 
  {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }

  
} // END Class