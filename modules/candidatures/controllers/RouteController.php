<?php
/**
 * RouteController
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

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
      'candidature/confirm/([a-f0-9]{32}$)',
      'Modules\Candidatures\Controllers\ConfirmController@confirm'
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