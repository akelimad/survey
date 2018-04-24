<?php
/**
 * RouteController
 *
 * @author mchanchaf
 *
 * @package modules.cronjob.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\CronJob\Controllers;

use App\Route;

class RouteController
{

  /**
   * RouteController instance
   * @var instance $instance
   */
  private static $_instance = null;


  private function __construct()
  {
    // Register routes
    Route::add(
      'cron-job/candidat/delete-one-year-account-not-updated',
      'Modules\CronJob\Controllers\DeleteOneYearAccountNotUpdatedCronController@run'
    );
    Route::add(
      'cron-job/candidat/one-year-account-not-updated',
      'Modules\CronJob\Controllers\OneYearAccountNotUpdatedCronController@run'
    );
    Route::add(
      'cron-job/offer/published-offers-alert',
      'Modules\CronJob\Controllers\PublishedOffersAlertCronController@run'
    );
  }


  /**
   * Get instance
   *
   * @return Route $instance
   */
  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self;
    }
    return self::$_instance;
  }


} // END Class