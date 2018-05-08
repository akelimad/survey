<?php
/**
 * RouteController
 *
 * @author imad
 *
 * @package modules.survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Controllers;

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
    Route::add('backend/survey/index', 'Modules\Survey\Controllers\SurveyController@index');
    Route::add('backend/survey/table', 'Modules\Survey\Controllers\SurveyTableController@getAll');
    Route::add('backend/survey/form', 'Modules\Survey\Controllers\SurveyController@form');
    Route::add('backend/survey/store', 'Modules\Survey\Controllers\SurveyController@store');
    Route::add('backend/survey/([0-9]+)/show', 'Modules\Survey\Controllers\SurveyController@show');
    Route::add('backend/survey/([0-9]+)/delete', 'Modules\Survey\Controllers\SurveyController@delete');
    Route::add('survey/([0-9]+)', 'Modules\Survey\Controllers\SurveyController@quiz');
    Route::add('survey/([0-9]+)/storeAnswers', 'Modules\Survey\Controllers\SurveyController@storeAnswers');
    Route::add('survey/([0-9]+)/result', 'Modules\Survey\Controllers\SurveyController@quizzResult');

    Route::add('backend/survey/([0-9]+)/group/index', 'Modules\Survey\Controllers\GroupController@index');
    Route::add('backend/survey/([0-9]+)/group/table', 'Modules\Survey\Controllers\GroupTableController@getAll');
    Route::add('backend/survey/([0-9]+)/group/form', 'Modules\Survey\Controllers\GroupController@form');
    Route::add('backend/survey/([0-9]+)/group/store', 'Modules\Survey\Controllers\GroupController@store');
    Route::add('backend/survey/([0-9]+)/group/([0-9]+)/delete', 'Modules\Survey\Controllers\GroupController@delete');

    Route::add('backend/survey/([0-9]+)/group/([0-9]+)/question/index', 'Modules\Survey\Controllers\QuestionController@index');
    Route::add('backend/survey/([0-9]+)/group/([0-9]+)/question/table', 'Modules\Survey\Controllers\QuestionTableController@getAll');
    Route::add('backend/survey/([0-9]+)/group/([0-9]+)/question/form', 'Modules\Survey\Controllers\QuestionController@form');
    Route::add('backend/survey/([0-9]+)/group/([0-9]+)/question/store', 'Modules\Survey\Controllers\QuestionController@store');
    Route::add(
      'backend/survey/([0-9]+)/group/([0-9]+)/question/([0-9]+)/delete', 
      'Modules\Survey\Controllers\QuestionController@delete');
    Route::add(
      'backend/survey/group/question/answer/([0-9]+)', 
      'Modules\Survey\Controllers\QuestionController@deleteAnswer');
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