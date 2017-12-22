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
use App\Session;
use App\Mail\Mailer;

class EventController
{

	private static $_instance = null;


	public function __construct()
	{
		Event::add('candidature_form_submit', [$this, 'formSubmit']);
		Event::add('candidature_form_submit', [$this, 'updateNoteEcrit']);
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
			// Send convocation email
			if( isset($data['status']['mail']) ) {
				$message = $data['status']['mail']['message'];
				$data['status']['mail']['message'] = Mailer::renderMessage($message, [
					// 'lien_confirmation' => '<a href="'. site_url('confirmation/?i='.$saveStatus['id_agend']) .'"> <b>Confirmer</b></a>'
					'lien_confirmation' => '<a href="'. site_url('module/candidatures/confirm/calendar/'.$saveStatus['id_agend']) .'"> <b>Confirmer</b></a>'
				]);
				$sendEmail = (new AjaxController())->sendEmail($data['status']['mail']);
				if( $sendEmail['response'] == 'success' ) {
					Session::setFlash('success', 'Une convocation a été envoyé au candidat.');
				} else {
					Session::setFlash('error', $sendEmail['message']);
				}
			}
		}

		// share candidature
		if( isset($data['share']['candidatures']) ) (new ShareController())->share($data['share']);
	}


	public function updateNoteEcrit($data)
	{
		if( isset($data['note_ecrit']) && is_valid_int($data['id_candidature']) ) {
			getDB()->update('candidature', 'id_candidature', $data['id_candidature'], [
				'note_ecrit' => $data['note_ecrit']
			]);
			Session::setFlash('success', 'La note a été mise à jour.');
		}
	}



  
} // END Class