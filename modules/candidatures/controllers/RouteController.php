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

    Route::add(
      'candidature/invitation/([a-f0-9]{32}$)',
      'Modules\Candidatures\Controllers\ConfirmController@invitation'
    );

    Route::add(
      'backend/candidatures/spontanees',
      'Modules\Candidatures\Controllers\CandidatureController@spontanees'
    );

    Route::add(
      'backend/candidatures/stage',
      'Modules\Candidatures\Controllers\CandidatureController@stage'
    );

    Route::add(
      'backend/candidatures/change-status',
      'Modules\Candidatures\Controllers\CandidatureController@changeSatatus'
    );

    Route::add(
      'backend/candidatures/assign-to-offer',
      'Modules\Candidatures\Controllers\AjaxController@assignToOffer'
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