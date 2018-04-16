<?php
/**
 * PublishedOffersAlertCronController
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
use Modules\Offer\Models\Offer;

class PublishedOffersAlertCronController
{

  const CRON_NAME = 'published-offers-alert';
  const OBJECT_NAME = 'offer';

  private $count = 0;


  public function run()
  {
    $candidats = $this->getCandidats();

    if (!empty($candidats)) : foreach ($candidats as $key => $candidat) :
      $offers = $this->getOffers($candidat->id);
      if (empty($offers)) continue;

      $site_name = get_setting('nom_site');
      if (count($offers) > 1) {
        $subject = $site_name ." vient de publier de nouvelles offres";
      } else {
        $subject = $site_name ." vient de publier une nouvelle offre";
      }

      $send = Mailer::send(
        $candidat->email, 
        $subject, 
        $this->getMessage($candidat, $offers)
      );

      if ($send['response'] == 'success') {
        foreach ($offers as $key => $offer) {
          $this->createCronJob($candidat->id, $offer->id);
        }
        $this->count += 1;
      }
    endforeach; endif;

    echo $this->count;
  }


  private function getMessage($candidat, $offers)
  {
    $displayName = Candidat::getDisplayName($candidat, true);
    $message = "<p>Bonjour";
    if ($displayName != '') {
      $message .= "&nbsp;<strong>{$displayName}</strong>";
    }
    $message .= ",</p>";

    $message .= "<p>Vous trouverez ci-après des offres susceptibles de vous intéresser</p>";
    $message .= "<table border=\"1\" width=\"600\" cellspacing=\"0\" cellpadding=\"5\">";
    foreach ($offers as $key => $offer) {
      $message .= "<tr>";
      $message .= "<td>". $offer->Name ."</td>";
      $message .= "<td width=\"40\"><a href=\"". site_url('offre/'.$offer->id) ."\">Consulter</a></td>";
      $message .= "</tr>";
    }
    $message .= "</table>";

    $message .= "<p>Vous pouvez gérer vos alertes sur votre compte: ";
    $message .= "<a href=\"". site_url('candidat/compte') ."\">". site_url('candidat/compte') ."</a></p>";

    $message .= "<p>Cordialement<br><strong>L’équipe RH</strong></p>";

    $message .= "<p><b style=\"color:red;\">* Si vous ne désirez plus recevoir d'e-mail de notre part, <a href=\"". site_url('candidat/unsubscribe/'.md5($candidat->email)) ."\" style=\"color:red;text-decoration:underline;\">cliquez ici.</a></p>";

    return $message;
  }

  private function getCandidats()
  {
    return getDB()->prepare("
      SELECT candidats_id as id, candidats_id, nom, prenom, id_civi, email 
      FROM candidats 
      WHERE email != '' AND nl_emploi = 1 
      LIMIT 10
    ");
  }

  private function getOffers($candidat_id)
  {
    $alertQuery = $this->getAlertsQuery($candidat_id);
    if (empty($alertQuery)) return [];

    return getDB()->prepare("
      SELECT o.id_offre as id, o.id_offre, o.Name
      FROM offre o
      WHERE o.status=? 
      AND DATE(o.date_expiration) >= CURDATE() 
      {$alertQuery}
      AND NOT EXISTS (
        SELECT NULL
        FROM cron_jobs cj
        WHERE cj.object_id=o.id_offre 
        AND cj.object_name=?
        AND cj.name=?
        AND cj.value=?
      )
    ", [
      Offer::PUBLISHED_STATUS,
      self::OBJECT_NAME, 
      self::CRON_NAME, 
      $candidat_id
    ]);
  }

  private function getAlertsQuery($candidat_id)
  {
    $candidat_alerts = getDB()->prepare("SELECT titre FROM alert WHERE candidats_id=? AND activate=?", [$candidat_id, 1]);

    if (!empty($candidat_alerts)) {
      foreach ($candidat_alerts as $key => $alert) {
        $keywords = explode(" ", $alert->titre);
        $parts = array();
        for ($i = 0; $i < count($keywords); $i++) {
          $parts[] = "o.Name LIKE '%". $keywords[$i] ."%' OR o.Details LIKE '%". $keywords[$i] ."%' OR o.Profil LIKE '%". $keywords[$i] ."%'";
        }
        $andWhere_array[] = '('. implode(' OR ', $parts) .')';
      }
      return 'AND ('. implode(' OR ', $andWhere_array) .')';
    }
    return '';
  }

  private function createCronJob($candidat_id, $offer_id)
  {
    return getDB()->create('cron_jobs', [
      'object_id' => $offer_id,
      'object_name' => self::OBJECT_NAME,
      'name' => self::CRON_NAME,
      'value' => $candidat_id,
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

  
} // END Class