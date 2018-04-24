<?php
/**
 * ShareController
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

class ShareController
{


  public function share($data)
  {
    if( $data['candidatures'] == '' || empty(json_decode($data['candidatures'], true)) ) {
      Session::setFlash('warning', trans("Cette offre ne contient aucun candidat."));
      return;
    }

    global $email_e;
    $candidatures = json_decode($data['candidatures'], true);
    $randPassword = $this->genPassword(8);

    $data['message'] .= "<br><br><p>". trans("Vos identifiants de connexion sur notre site web:") ." {{site}}<br>". trans("Votre email:") ." {{email}}<br>". trans("Mot de passe:") ." {{mot_passe}}<br>". trans("Ces identifiants vous permettront de consulter des candidatures ciblées.") ."</p>";

    $login_url = site_url('backend/login');
    $data['message'] = Mailer::renderMessage($data['message'], [
      'site' => '<a href="'. $login_url .'">'. $login_url .'</a>',
      'email' => $data['receiver'],
      'mot_passe' => $randPassword
    ]);
    $data['type_email'] = trans("Compte pour voir candidature");

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
          'id_type_role' => 2, 
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

        $authorized = (is_array($data['authorized_actions'])) ? $data['authorized_actions'] : [];
        $id_share = $db->create('role_candidatures_share', [
          'authorized_actions' => json_encode($authorized),
          'created_by' => read_session('id_type_role', 0),
          'created_at' => date('Y-m-d H:i:s')
        ]);

        // attach canddiatures
        foreach ($candidatures as $key => $id_candidature) {
          $count = $db->prepare("
            SELECT COUNT(*) AS nbr FROM role_candidature 
            WHERE id_role=? AND id_candidature=?
          ", [$id_role, $id_candidature], true);

          if( $count->nbr == 0 ) {
            $db->create('role_candidature', [
              'id_share' => $id_share,
              'id_role' => $id_role,
              'id_candidature' => $id_candidature
            ]);
          }
        }

        Session::setFlash('success', trans("Les candidatures ont été partagé."));
      } else {
        Session::setFlash('error', trans("Une erreur est survenu lors de la création d'un compte temporaire."));
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