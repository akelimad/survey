<?php
/**
 * EventController
 *
 * @author mchanchaf
 *
 * @package modules.message.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Message\Controllers;

use App\Event;
use App\View;
use App\Session;
use App\Mail\Mailer;

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
		$table->setAction('cand_messages', [
	    'label' => trans("Messagerie"),
	    'patern' => '/backend/message/candidature/{id_candidature}/messages',
	    'icon' => 'fa fa-comments-o',
	    'sort_order' => 7,
	    'bulk_action' => false,
	    'attributes' => [
	      'class' => 'btn btn-default btn-xs',
	    ],
	    'permission' => 'can_view_action'
	  ]);
	}


} // END Class