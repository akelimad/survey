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
use Modules\CronJob\Models\CronJob;

class PublishedOffersAlertCronController
{

  const CRON_NAME = 'published-offers-alert';
  const OBJECT_NAME = 'offer';

  private $count = 0;


  public function run()
  {
    foreach ($this->getCandidats() as $key => $candidat) :
      $offers = $this->getOffers($candidat->id);
      if (empty($offers)) continue;

      $send = $this->sendEmail($candidat, $offers);

      if ($send['response'] == 'success') {
        foreach ($offers as $key => $offer) {
          CronJob::log(
            $offer->id, 
            self::OBJECT_NAME, 
            self::CRON_NAME, 
            $candidat->id
          );
        }
        $this->count += 1;
      }
    endforeach;

    echo $this->count;
  }


  private function sendEmail($candidat, $offers)
  {
    // Get email template
    $template = getDB()->findOne('root_email_auto', 'ref', 'alert_published_offers');
    if(!isset($template->id_email)) return false;

    $table .= "<table border=\"1\" width=\"600\" cellspacing=\"0\" cellpadding=\"5\">";
    foreach ($offers as $key => $offer) {
      $table .= "<tr>";
      $table .= "<td>". $offer->Name ."</td>";
      $table .= "<td width=\"40\"><a href=\"". site_url('offre/'.$offer->id) ."\">Consulter</a></td>";
      $table .= "</tr>";
    }
    $table .= "</table>";

    $variables = Mailer::getVariables($candidat->candidats_id);
    $variables['site_name'] = get_setting('nom_site');
    $variables['offers_table'] = $table;
    $variables['account_link'] = site_url('candidat/compte');
    $variables['unsubscribe_link'] = site_url('candidat/unsubscribe/'.md5($candidat->email));

    $subject = Mailer::renderMessage($template->objet, $variables);
    $message = Mailer::renderMessage($template->message, $variables);

    return Mailer::send($candidat->email, $subject, $message, [
      'titre' => $template->titre,
      'coresp_nom' => Candidat::getDisplayName($candidat, false) .' ('. $candidat->email .')',
      'type_email' => 'Envoi automatique'
    ]);
  }

  private function getCandidats()
  {
    return getDB()->prepare("
      SELECT candidats_id as id, candidats_id, nom, prenom, id_civi, email 
      FROM candidats 
      WHERE email != '' AND nl_emploi = 1 
      LIMIT 10
    ") ?: [];
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

  
} // END Class