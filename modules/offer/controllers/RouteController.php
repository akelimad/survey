<?php
/**
 * RouteController
 *
 * @author mchanchaf
 *
 * @package modules.offer.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Controllers;

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
      'backend/offers/index',
      'Modules\Offer\Controllers\OfferController@index'
    );
    Route::add(
      ['backend/offer/create', 'backend/offer/([0-9]+)/edit'],
      'Modules\Offer\Controllers\OfferController@getForm'
    );
    Route::add(
      ['backend/offer/delete', 'backend/offer/([0-9]+)/delete'],
      'Modules\Offer\Controllers\OfferController@delete'
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