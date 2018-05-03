<?php
/**
 * EventController
 *
 * @author mchanchaf
 *
 * @package modules.survey.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Survey\Controllers;

use App\Event;

class EventController
{

	private static $_instance = null;


	public function __construct()
	{
		Event::add('candidatureTable_before_rendering', [$this, 'beforeTableRendering']);
	}
	

	public static function getInstance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}


	public function beforeTableRendering($table)
	{
		$table->setAction('send_servey', [
		    'label' => trans("Envoyer un questionnaire"),
		    'patern' => '#',
		    'icon' => 'fa fa-pencil-square-o',
		    'sort_order' => 7,
		    'bulk_action' => true,
		    'callback' => 'Survey.send',
		    'attributes' => [
		      'class' => 'btn btn-default btn-xs',
		    ],
		    'permission' => function ($row) {
		    	if (!can_view_action($row)) {
		    		return false;
		    	}
		    	// Other conditions
				return true;
		    }
		]);
	}


} // END Class