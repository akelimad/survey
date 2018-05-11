<?php
/**
 * EventController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Helpers\FormBuilder;

class EventController
{

	private static $_instance = null;


	public function __construct()
	{
		FormBuilder::addEvent('chmFormSetting', [$this, 'chmFormSetting']);
	}
	

	public static function getInstance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}


	public function chmFormSetting($form_id)
	{
		$settings = get_setting('form.fields.'. $form_id, '{}');
    $settings = json_decode($settings, true) ?: [];
    FormBuilder::setSettings($settings);
	}


} // END Class
