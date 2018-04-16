<?php
/**
 * CronController
 *
 * @author mchanchaf
 *
 * @package modules.cronjob.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\CronJob\Controllers;

use App\Mail\Mailer;
use App\Models\Candidat;

class OneYearAccountNotUpdatedCronController
{

  private $count = 0;


  public function run()
  {
    $candidats = getDB()->prepare("
      SELECT c.candidats_id, c.nom, c.prenom, c.id_civi, c.email
      FROM candidats c
      WHERE NOT EXISTS (
        SELECT NULL
        FROM cron_jobs cj
        WHERE cj.object_name='candidat' 
        AND cj.object_id=c.candidats_id 
        AND cj.name='one-year-account-not-updated'
      )
      AND (c.dateMAJ <= DATE_SUB(NOW(), INTERVAL 1 YEAR) AND c.email != '')
      LIMIT 10
    ");

    if (!empty($candidats)) : foreach ($candidats as $key => $candidat) :
      $subject = "Actualisation de votre compte sur ". get_setting('nom_site');
      $send = Mailer::send($candidat->email, $subject, $this->getMessage($candidat));
      if ($send['response'] == 'success') {
        getDB()->create('cron_jobs', [
          'object_id' => $candidat->candidats_id,
          'object_name' => 'candidat',
          'name' => 'one-year-account-not-updated',
          'created_at' => date('Y-m-d H:i:s')
        ]);
        $this->count += 1;
      }
    endforeach; endif;

    echo $this->count;
  }


  private function getMessage($candidat)
  {
    $displayName = Candidat::getDisplayName($candidat, true);
    $message = "<p>Bonjour";
    if ($displayName != '') {
      $message .= "&nbsp;<strong>{$displayName}</strong>";
    }
    $message .= ",</p>";
    $message .= "<p>Nous vous remercions pour l’intérêt que vous portez a notre entreprise.<br>";
    $message .= "Nous avons remarqué que vous n’avez pas actualisé votre compte depuis plus d’une année. <br>Dans ce sens, nous vous invitons à vous connecter et d’actualiser votre profil afin de vous contacter dans le cadre des prochains recrutements.</p>";
    $message .= "<p>Rendez-vous sur le site: <a href=\"". site_url() ."\">". site_url() ."</a><br>";
    $message .= "<strong>Email:</strong>&nbsp;". $candidat->email ."<br>";
    $message .= "<strong>Mot de passe:</strong>&nbsp;Celui que vous avez renseigné lors de l'inscription</p>";
    $message .= "<p>Cordialement<br><strong>L’équipe RH</strong></p>";

    return $message;
  }
  

  
} // END Class