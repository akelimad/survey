<?php
/**
 * PageController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Helpers\Form\Validator;
use App\Mail\Mailer;

class PageController extends Controller
{


	public function terms()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Mentions légales'];
		$this->data['titre_site'] = $GLOBALS['etalent']->config['titre_site'];
		$this->data['terms_site_title'] = get_setting('front_terms_site_title', 'E-talent');
    	return get_page('front/page/terms', $this->data);
	}


	public function conditions()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Conditions générales d\'utilisation'];
		$this->data['titre_site'] = $GLOBALS['etalent']->config['titre_site'];
		$this->data['terms_site_title'] = get_setting('front_terms_site_title', 'E-talent');
    	return get_page('front/page/conditions', $this->data);
	}


	public function sitemap()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Plan du site'];
    	return get_page('front/page/sitemap', $this->data);
	}


	public function contact($data)
	{
		if (form_submited()) {
			// Verify google recaptcha
			if(!isset($data['g-recaptcha-response']) || !$this->verifyGoogleRecaptcha($data['g-recaptcha-response'])) {
				return $this->jsonResponse('error', 'Merci de cocher la case "Je ne suis pas un robot"');
			}

			// Set form fields name
			Validator::set_field_names([
				'destination' => 'Destination',
				'first_name' => 'Nom de famille',
				'last_name' => 'Prénom',
				'email' => 'Courriel',
				'subject' => 'Sujet',
				'message' => 'Message'
			]);
			// Validate form data
			$is_valid = Validator::is_valid($data, [
				'first_name' => 'required|valid_name|min_len,3|max_len,32',
				'last_name' => 'required|valid_name|min_len,3|max_len,32',
				'email' => 'required|valid_email',
				'subject' => 'required|eta_alpha_numeric|max_len,64',
				'message' => 'required|eta_alpha_numeric'
			]);

			if(is_array($is_valid)) {
				return $this->jsonResponse('error', $is_valid);
			}

			$destination = (isset($data['destination']) && !empty($data['destination'])) ? $data['destination'] : 'DIRECTION DES RESSOURCES HUMAINES';

			$message  = '<p><strong>Bonjour,</strong></p>';
			$message .= '<p>Un message vous a été envoyé à partir de formulaire de contact sur le site: '. site_url() .'</p>';
			$message .= '<table>';
			$message .= '<tbody>';
			$message .= '<tr>';
			$message .= '<th width="150" align="left">Destination</th>';
			$message .= '<td>'. $destination .'</td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<th align="left">Nom de famille</th>';
			$message .= '<td>'. $data['first_name'] .'</td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<th align="left">Prénom</th>';
			$message .= '<td>'. $data['last_name'] .'</td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<th align="left">Courriel</th>';
			$message .= '<td>'. $data['email'] .'</td>';
			$message .= '</tr>';
			$message .= '<tr>';
			$message .= '<th align="left">Sujet</th>';
			$message .= '<td>'. $data['subject'] .'</td>';
			$message .= '</tr>';
			$message .= '<th align="left">Message</th>';
			$message .= '<td>'. $data['message'] .'</td>';
			$message .= '</tr>';
			$message .= '</tbody>';
			$message .= '</table>';

			$send = Mailer::send(get_setting('email_e'), $data['subject'], $message, [
				'titre' => $data['subject'],
				'type_email' => 'Formulaire de contact'
			]);

			return $this->jsonResponse($send['response'], $send['message']);
		} else {
			$this->data['layout'] = 'front';
			$this->data['breadcrumbs'] = ['Accueil', 'Contactez nous'];
	    	return get_page('front/page/contact', $this->data);
		}
	}




	
} // END Class