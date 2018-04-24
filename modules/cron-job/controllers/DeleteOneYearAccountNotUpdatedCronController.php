<?php
/**
 * DeleteOneYearAccountNotUpdatedCronController
 *
 * @author mchanchaf
 *
 * @package modules.cronjob.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\CronJob\Controllers;

use App\Models\Candidat;
use Modules\CronJob\Models\CronJob;

class DeleteOneYearAccountNotUpdatedCronController
{

  const CRON_NAME = 'delete-one-year-account-not-updated';
  const OBJECT_NAME = 'candidat';

  private $count = 0;

  public function run()
  {
    foreach ($this->getCandidats() as $key => $candidat) :
      Candidat::deleteAccount($candidat->id);
      // Log event
      CronJob::log(
        $candidat->id, 
        self::OBJECT_NAME, 
        self::CRON_NAME,
        $candidat->email
      );
    endforeach;

    echo $this->count;
  }

  private function getCandidats()
  {
    return getDB()->prepare("
      SELECT c.candidats_id AS id, c.email
      FROM candidats c
      WHERE NOT EXISTS (
        SELECT NULL
        FROM cron_jobs cj
        WHERE cj.object_id=c.candidats_id 
        AND cj.object_name=? 
        AND cj.name=?
      )
      AND (c.dateMAJ <= DATE_SUB(NOW(), INTERVAL 1 YEAR))
      LIMIT 10
    ", [self::OBJECT_NAME, self::CRON_NAME]) ?: [];
  }
  
} // END Class