<?php
/**
 * EventController
 *
 * @author mchanchaf
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
			if(isset($data['status']['mail']) && $data['status']['mail']['sender'] != '') {
				$message = $data['status']['mail']['message'];
				$data['status']['mail']['message'] = Mailer::renderMessage($message, [
					'lien_confirmation' => '<a href="'. site_url('module/candidatures/confirm/calendar/'.$saveStatus['id_agend']) .'"> <b>Confirmer</b></a>'
				]);
				$sendEmail = (new AjaxController())->sendEmail($data['status']['mail']);
				if( $sendEmail['response'] == 'success' ) {
					Session::setFlash('success', 'Une convocation a été envoyé au candidat.');
				} else {
					Session::setFlash('error', $sendEmail['message']);
				}
			}
		} else {
			// Fire event after saving new sattus
		    $data['candidature'] = new \stdClass;
		    $data['agenda'] = new \stdClass;
		    $data['id_historique'] = 0;
		    Event::trigger('change_status_form_submit', $data);
		}

		// share candidature
		if( isset($data['share']['candidatures']) ) (new ShareController())->share($data['share']);

		// change candidature offre
		if( isset($data['change_offre']['id']) ) {
			getDB()->update('candidature', 'id_candidature', $data['change_offre']['id_candidature'], [
				'id_offre' => $data['change_offre']['id']
			]);
			Session::setFlash('success', 'L\'offre de candidature a été enregistré.');
		}
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