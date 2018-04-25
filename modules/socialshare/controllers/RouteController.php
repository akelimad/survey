<?php
/**
 * RouteController
 *
 * @author saleh
 *
 * @package modules.socialshare.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Socialshare\Controllers;

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
    Route::add(
      'backend/socialshare/linkedin/gestion', 
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@view'
    );

    Route::add(
      'backend/socialshare/linkedin/addconfig', 
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@addconfig'
    );

    Route::add(
      'socialshare/linkedin/share/company', 
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@share'
    );

    Route::add(
      'socialshare/linkedin/share/company/getcode',
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@getcode'
    );

    Route::add(
      'backend/socialshare/linkedin/app/delete',
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@deleteApp'
    );

    Route::add(
      'socialshare/linkedin/table',
      'Modules\Socialshare\Controllers\LinkedinTableController@getTable'
    );

    Route::add(
      'backend/socialshare/publish/status/set',
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@setPublishStatus'
    );

    Route::add(
      'backend/socialshare/settings',
      'Modules\Socialshare\Controllers\AutoShareLinkedinController@settings'
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