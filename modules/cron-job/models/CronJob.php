<?php
/**
 * CronJob
 *
 * @author mchanchaf
 *
 * @package modules.cronjob.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\CronJob\Models;

use App\Controllers\Controller;

class CronJob {

  public static function log($object_id, $object_name, $name, $value = null)
  {
    return getDB()->create('cron_jobs', [
      'object_id' => $object_id,
      'object_name' => $object_name,
      'name' => $name,
      'value' => $value,
      'created_at' => date('Y-m-d H:i:s')
    ]);
  }

} // End Class