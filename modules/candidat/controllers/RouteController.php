<?php
/**
 * RouteController
 *
 * @author mchanchaf
 *
 * @package modules.candidat.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidat\Controllers;

use App\Route;

class RouteController
{

  /**
   * DB instance
   * @var instance $instance
   */
  private static $_instance = null;


  private function __construct()
  {
    // Register routes
    Route::add(
      'cron/candidat/one-year-account-not-updated',
      'Modules\Candidat\Controllers\CronController@oneYearAccountNotUpdated'
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