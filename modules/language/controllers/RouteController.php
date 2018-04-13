<?php
/**
 * RouteController
 *
 * @author mchanchaf
 *
 * @package modules.language.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Language\Controllers;

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
      'backend/language/strings',
      'Modules\Language\Controllers\LanguageController@strings'
    );

    Route::add(
      'backend/language/scan',
      'Modules\Language\Controllers\LanguageController@scan',
      true
    );

    Route::add(
      'backend/language/strings/store',
      'Modules\Language\Controllers\LanguageController@store',
      true
    );

    Route::add(
      'backend/language/strings/table',
      'Modules\Language\Controllers\StringTableController@getTable',
      true
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