<?php
/**
 * RouteController
 *
 * @author amali
 *
 * @package modules.language.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Message\Controllers;

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
    $canViewMessages = (isLogged('admin') || isLogged('candidat'));
    $messageTableRoute = (isBackend()) ? 'backend/message/table' : 'message/table';

    Route::add(
      $messageTableRoute,
      'Modules\Message\Controllers\MessageTableController@getTable',
      true,
      $canViewMessages
    );

    Route::add(
      'message/candidature/([0-9]+)/messages', 
      'Modules\Message\Controllers\MessageController@messages', 
      false, 
      $canViewMessages
    );

    Route::add(
      'backend/message/candidature/([0-9]+)/messages', 
      'Modules\Message\Controllers\MessageController@messages', 
      false, 
      $canViewMessages
    );

    Route::add(
      'message/candidature/message/store',
      'Modules\Message\Controllers\MessageController@store',
      true,
      $canViewMessages
    );

    Route::add(
      'message/candidature/message/notification',
      'Modules\Message\Controllers\MessageController@notification',
      true,
      $canViewMessages
    );

    Route::add(
      'message/candidature/message/seen',
      'Modules\Message\Controllers\MessageController@seen',
      true,
      $canViewMessages
    );

    Route::add(
      'cron-job/candidature/messages',
      'Modules\Message\Controllers\MessageSeenCronController@run',
      false,
      $canViewMessages
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