<?php
/**
 * EventController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidatures\Controllers;

use App\Event;
use App\View;

class EventController
{

	private static $_instance = null;


	public function __construct()
	{
		Event::add('candidature_form_submit', [$this, 'formSubmit']);
	}
	

	public static function getInstance()
	{
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
	}


	public function formSubmit($data)
	{
		// Save status popup data
		if( isset($data['status']['id']) ) {
			$saveStatus = (new StatusController())->saveStatus($data);
		}
	}



  
} // END Class