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
			foreach ($data['status']['receivers'] as $key => $receiver) {
				$parts = explode('|', $receiver);
				$data['status']['id_candidature'] = $parts[0];
				$saveStatus = (new StatusController())->saveStatus($data);
				if ($key == 0 && isset($saveStatus['candidature']->id_candidature)) {
					Session::setFlash('success', trans("Le statut a été bien changé."));
				}

				// Send convocation email
				if(isset($data['status']['mail']) && $data['status']['mail']['sender'] != '') {
					if ($key == 0) Session::setFlash('success', trans("Une convocation a été envoyée au(x) candidat(s)."));
						
					$message = $data['status']['mail']['message'];
					$variables = Mailer::getVariables($parts[0], null, $saveStatus['candidature']->id_candidature);
					$variables['lien_confirmation'] = '<a href="'. site_url('candidature/confirm/'. md5($saveStatus['id_agend'])) .'"> <b>'. trans("Confirmer") .'</b></a>';
					$data['status']['mail']['message'] = Mailer::renderMessage($message, $variables);
					$data['status']['mail']['receiver'] = $receiver;
					$send = (new AjaxController())->sendEmail($data['status']['mail']);
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
		if( isset($data['share']['candidatures']) ) {
			$share = (new ShareController())->share($data['share']);
		}

		// change candidature offre
		if( isset($data['change_offre']['id']) ) {
			getDB()->update('candidature', 'id_candidature', $data['change_offre']['id_candidature'], [
				'id_offre' => $data['change_offre']['id']
			]);
			Session::setFlash('success', trans("L'offre de candidature a été enregistrée."));
		}
	}


	public function updateNoteEcrit($data)
	{
		if( isset($data['note_ecrit']) && is_valid_int($data['id_candidature']) ) {
			getDB()->update('candidature', 'id_candidature', $data['id_candidature'], [
				'note_ecrit' => $data['note_ecrit']
			]);
			Session::setFlash('success', trans("La note a été mise à jour."));
		}
	}



  
} // END Class