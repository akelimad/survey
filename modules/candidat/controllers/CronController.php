<?php
/**
 * CronController
 *
 * @author mchanchaf
 *
 * @package modules.candidat.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidat\Controllers;

use App\Mail\Mailer;
use App\Models\Candidat;

class CronController
{


  public function oneYearAccountNotUpdated()
  {
    $candidats = getDB()->prepare("SELECT * FROM candidats WHERE dateMAJ >= DATE_SUB(NOW(), INTERVAL 1 YEAR)");

    if (!empty($candidats)) : foreach ($candidats as $key => $candidat) :
      $subject = "Actualisation de votre compte";
      Mailer::send($candidat->email, $subject, $this->getMessage($candidat));
    endforeach; endif;
  }


  private function getMessage($candidat)
  {
    $displayName = Candidat::getDisplayName($candidat, true);
    $message = "<p>Bonjour <strong>{$displayName}</strong>,</p>";
    $message .= "<p>Nous vous remercions pour l’intérêt que vous portez a notre entreprise.<br>";
    $message .= "Nous avons remarqué que vous n’avez pas actualisé votre compte depuis plus d’une année. <br>Dans ce sens, nous vous invitons à vous connecter et d’actualiser votre profil afin de vous contacter dans le cadre des prochains recrutements.</p>";
    $message .= "<p>Cordialement<br><strong>L’équipe RH</strong></p>";

    return $message;
  }
  

  
} // END Class