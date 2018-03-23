<?php
/**
 * PageController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Helpers\Form\Validator;
use App\Media;
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

			$htmlTableRows = [
				'Destination' => $destination,
				'Nom de famille' => $data['first_name'],
				'Prénom' => $data['last_name'],
				'Courriel' => $data['email'],
				'Sujet' => $data['subject'],
				'Message' => $data['message']
			];

			$message .= '<table>';
			$message .= '<tbody>';
			foreach ($htmlTableRows as $key => $value) {
				$message .= '<tr><th align="left">'. $key .'</th><td>'. $value .'</td></tr><tr>';
			}
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


	public function bugReport($data)
	{
		if (form_submited()) {
			global $conf_admin_email_s_prob;

			// Verify google recaptcha
			if(!isset($data['g-recaptcha-response']) || !$this->verifyGoogleRecaptcha($data['g-recaptcha-response'])) {
				return $this->jsonResponse('error', 'Merci de cocher la case "Je ne suis pas un robot"');
			}

			// Set form fields name
			Validator::set_field_names([
				'ticket_number' => 'N ° billet',
				'first_name' => 'Nom de famille',
				'last_name' => 'Prénom',
				'email' => 'Courriel',
				'phone' => 'Télephone',
				'subject' => 'Sujet',
				'message' => 'Message'
			]);
			// Validate form data
			$is_valid = Validator::is_valid($data, [
				'ticket_number' => 'required',
				'first_name' => 'required|valid_name|min_len,3|max_len,32',
				'last_name' => 'required|valid_name|min_len,3|max_len,32',
				'email' => 'required|valid_email',
				'phone' => 'required|phone_number',
				'subject' => 'required|eta_alpha_numeric|max_len,64',
				'message' => 'required|eta_alpha_numeric'
			]);

			if(is_array($is_valid)) {
				return $this->jsonResponse('error', $is_valid);
			}

			$email_args = [
				'titre' => $data['subject'],
				'type_email' => 'Signaler un probléme'
			];

			// Check if attachement exists
			$with_attachement = false;
			if (isset($_FILES['attachement']) && $_FILES['attachement']['size'] > 0) {
				$extensions = ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'];
				$extension = pathinfo($_FILES['attachement']['name'], PATHINFO_EXTENSION);

				if(!in_array(strtolower($extension), $extensions)) {
					return $this->jsonResponse('error', "La Pièce à joindre doit avoir les extensions suivantes (.". implode(', .', $extensions) .")");
				}

				$with_attachement = true;
			}

			// Save problem to database
			$id_user = '';
			$type_user = 'Visiteur';
			if (isLogged('candidat')) {
				$id_user = get_candidat_id();
				$type_user = 'Candidat';
			} elseif (isLogged('admin')) {
				$id_user = read_session('id_role');
				$type_user = 'Responsable';
			}

			$db = getDB();

			$problem_id = $db->create('root_signale_probleme', [
				'id_user' => $id_user,
				'type_user' => $type_user,
				'ticket' => $data['ticket_number'],
				'date_prob' => date('Y-m-d H:i:s'),
				'nom' => $data['first_name'],
				'prenom' => $data['last_name'],
				'email_visi' => $data['email'],
				'telephone' => (isset($data['phone'])) ? $data['phone'] : '',
				'sujet' => $data['subject'],
				'message' => $data['message'],
				'etape' => 0
			]);

			if ($problem_id < 1) {
				return $this->jsonResponse('error', 'Une erreur est survenu lors d\'envoi de problème.');
			}

			// Upload attachement
			if ($with_attachement) {
				$uploadDir = 'uploads/bug-report/'. $problem_id .'/';
				$upload = Media::upload($_FILES['attachement'], [
					'extensions' => $extensions,
					'uploadDir' => $uploadDir
				]);
				if(isset($upload['errors'][0]) && $upload['errors'][0] != '') {
					$db->delete('root_signale_probleme', 'id_prob', $problem_id);
					return $this->jsonResponse('error', $upload['errors'][0]);
				}

				$db->create('root_signale_prob_pj', [
					'id_prob' => $problem_id,
					'titre_prob_pj' => $upload['files'][0]
				]);

				$email_args['attachements'][] = site_base($uploadDir . $upload['files'][0]);
			}

			$subject = "Signaler un probléme sur ". site_url() ." avec le ticket : ". $data['ticket_number'];

			$message   = '<p><strong>Bonjour,</strong></p>';
			$message  .= '<p>Signaler un probléme sur '. site_url() .' avec le ticket : <strong>'. $data['ticket_number'] .'</strong></p>';

			$htmlTableRows = [
				'Date' => date('d.m.Y h:i:s'),
				'Nom de famille' => $data['first_name'],
				'Prénom' => $data['last_name'],
				'Courriel' => $data['email'],
				'Télephone' => $data['phone'],
				'Sujet' => $data['subject'],
				'Message' => $data['message']
			];

			$message .= '<table>';
			$message .= '<tbody>';
			foreach ($htmlTableRows as $key => $value) {
				$message .= '<tr><th align="left">'. $key .'</th><td>'. $value .'</td></tr><tr>';
			}
			$message .= '</tbody>';
			$message .= '</table>';
			$message .= '<p>Cordialement</p>';

			$cc = explode(',', $conf_admin_email_s_prob);
			if (is_array($cc) && !empty($cc)) {
				$email_args['CC'] = $cc;
			}

			// Send email to admins
			$send = Mailer::send(get_setting('email_e'), $subject, $message, $email_args);
			if ($send['response'] == 'success') {
				// Send email to bug reporter
				$subject = 'Votre requête sur '. site_url() .' : '. $data['ticket_number'];
				$message   = '<p><strong>Bonjour,</strong></p>';
				$message .= '<p>Vous avez soumet une requête sur '. site_url() .' avec le ticket : <b>'. $data['ticket_number'] .'</b></p>';
				$message .= '<p>Votre message est :'. $data['message'] .'</p>';
				$message .= '<p>Cordialement</p>';

				Mailer::send($data['email'], $subject, $message);

				return $this->jsonResponse('success', '');
			} else {
				return $this->jsonResponse('error', $send['message']);
			}
		} else {
			$this->data['layout'] = 'front';
			$this->data['breadcrumbs'] = ['Accueil', 'Signaler un probléme'];
			$this->data['ticket_number'] = $this->randomString(8);
	    	return get_page('front/page/bug-report', $this->data);
		}
	}
	

	
} // END Class