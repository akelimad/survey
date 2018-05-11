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
use App\File;
use App\Mail\Mailer;
use App\Models\Candidat;
use App\Models\Resume;
use App\Models\MotivationLetter;
use App\Models\Formation;
use App\Models\Experience;

class PageController extends Controller
{


	public function terms()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = [trans("Accueil"), trans("Mentions légales")];
		$this->data['titre_site'] = $GLOBALS['etalent']->config['titre_site'];
		$this->data['terms_site_title'] = get_setting('front_terms_site_title', 'E-talent');
    	return get_page('front/page/terms', $this->data);
	}


	public function conditions()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = [trans("Accueil"), trans("Conditions générales d'utilisation")];
		$this->data['titre_site'] = $GLOBALS['etalent']->config['titre_site'];
		$this->data['terms_site_title'] = get_setting('front_terms_site_title', 'E-talent');
    	return get_page('front/page/conditions', $this->data);
	}


	public function sitemap()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = [trans("Accueil"), trans("Plan du site")];
    	return get_page('front/page/sitemap', $this->data);
	}


	public function contact($data)
	{
		if (form_submited()) {
			// Verify google recaptcha
			if(!isset($data['g-recaptcha-response']) || !$this->verifyGoogleRecaptcha($data['g-recaptcha-response'])) {
				return $this->jsonResponse('error', trans("Merci de cocher la case 'Je ne suis pas un robot'"));
			}

			// Set form fields name
			Validator::set_field_names([
				'destination' => trans("Destination"),
				'first_name' => trans("Nom de famille"),
				'last_name' => trans("Prénom"),
				'email' => trans("Courriel"),
				'subject' => trans("Sujet"),
				'message' => trans("Message")
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

			$destination = (isset($data['destination']) && !empty($data['destination'])) ? $data['destination'] : trans("DIRECTION DES RESSOURCES HUMAINES");

			$message  = '<p><strong>'. trans("Bonjour,") .'</strong></p>';
			$message .= '<p>'. trans("Un message vous a été envoyé à partir de formulaire de contact sur le site:") . site_url() .'</p>';

			$htmlTableRows = [
				trans("Destination") => $destination,
				trans("Nom de famille") => $data['first_name'],
				trans("Prénom") => $data['last_name'],
				trans("Courriel") => $data['email'],
				trans("Sujet") => $data['subject'],
				trans("Message") => $data['message']
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
			$this->data['breadcrumbs'] = [trans("Accueil"), trans("Contactez nous")];
	    	return get_page('front/page/contact', $this->data);
		}
	}


	public function bugReport($data)
	{
		if (form_submited()) {
			global $conf_admin_email_s_prob;

			// Verify google recaptcha
			if(!isset($data['g-recaptcha-response']) || !$this->verifyGoogleRecaptcha($data['g-recaptcha-response'])) {
				return $this->jsonResponse('error', trans("Merci de cocher la case 'Je ne suis pas un robot'"));
			}

			// Set form fields name
			Validator::set_field_names([
				'ticket_number' => trans("N° billet"),
				'first_name' => trans("Nom de famille"),
				'last_name' => trans("Prénom"),
				'email' => trans("Courriel"),
				'phone' => trans("Télephone"),
				'subject' => trans("Sujet"),
				'message' => trans("Message")
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
					return $this->jsonResponse('error', trans("La Pièce à joindre doit avoir les extensions suivantes") ." (.". implode(', .', $extensions) .")");
				}

				$with_attachement = true;
			}

			// Save problem to database
			$id_user = 0;
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
				return $this->jsonResponse('error', trans("Une erreur est survenu lors d'envoi de problème."));
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

			$subject = trans("Signaler un probléme sur") ." ". site_url() ." ". trans("avec le ticket:") ." ". $data['ticket_number'];

			$message   = '<p><strong>'. trans("Bonjour,") .'</strong></p>';
			$message  .= '<p>'. trans("Signaler un probléme sur") .' '. site_url() .' '. trans("avec le ticket:") .' <strong>'. $data['ticket_number'] .'</strong></p>';

			$htmlTableRows = [
				trans("Date") => date('d.m.Y h:i:s'),
				trans("Nom de famille") => $data['first_name'],
				trans("Prénom") => $data['last_name'],
				trans("Courriel") => $data['email'],
				trans("Télephone") => $data['phone'],
				trans("Sujet") => $data['subject'],
				trans("Message") => $data['message']
			];

			$message .= '<table>';
			$message .= '<tbody>';
			foreach ($htmlTableRows as $key => $value) {
				$message .= '<tr><th align="left">'. $key .'</th><td>'. $value .'</td></tr><tr>';
			}
			$message .= '</tbody>';
			$message .= '</table>';
			$message .= '<p>'. trans("Cordialement") .'</p>';

			$cc = explode(',', $conf_admin_email_s_prob);
			if (is_array($cc) && !empty($cc)) {
				$email_args['CC'] = $cc;
			}

			// Send email to admins
			$send = Mailer::send(get_setting('email_e'), $subject, $message, $email_args);
			if ($send['response'] == 'success') {
				// Send email to bug reporter
				$subject = trans("Votre requête sur") .' '. site_url() .' : '. $data['ticket_number'];
				$message   = '<p><strong>'. trans("Bonjour,") .'</strong></p>';
				$message .= '<p>'. trans("Vous avez soumet une requête sur") .' '. site_url() .' '. trans("avec le ticket:") .' <b>'. $data['ticket_number'] .'</b></p>';
				$message .= '<p>'. trans("Votre message est:") .'<br>'. $data['message'] .'</p>';
				$message .= '<p>'. trans("Cordialement") .'</p>';

				Mailer::send($data['email'], $subject, $message);

				return $this->jsonResponse('success', '');
			} else {
				return $this->jsonResponse('error', $send['message']);
			}
		} else {
			$this->data['layout'] = 'front';
			$this->data['breadcrumbs'] = [trans("Accueil"), trans("Signaler un probléme")];
			$this->data['ticket_number'] = $this->randomString(8);
	    	return get_page('front/page/bug-report', $this->data);
		}
	}
	
	public function migrateFiles()
	{
		foreach (Candidat::findAll(false) as $key => $c) {
			$variables = ['candidat_id' => $c->candidats_id];
			// copy photo
			if (!empty($c->photo)) {
				$photoPath = 'apps/upload/frontend/photo_candidats/';
				$source = site_base($photoPath . $c->photo);
				$distination = get_photo_base($c->photo, $variables);
				if (!file_exists($distination)) {
					File::copy($source, $distination);
				}
			}

			// copy permis conduire
			if (!empty($c->permis_conduire)) {
				$permisConduirePath = 'apps/upload/frontend/candidat/permis_conduire/';
				$source = site_base($permisConduirePath . $c->permis_conduire);
				$distination = get_permis_conduire_base($c->permis_conduire, $variables);
				if (!file_exists($distination)) {
					File::copy($source, $distination);
				}
			}

			// copy CVs
			$resumes = Resume::getByCandidatId($c->candidats_id);
			if (!empty($resumes)) : foreach ($resumes as $key => $resume) :
				if (empty($resume->lien_cv)) continue;
				$resumePath = 'apps/upload/frontend/cv/';
				$source = site_base($resumePath . $resume->lien_cv);
				$distination = get_resume_base($resume->lien_cv, $variables);
				if (!file_exists($distination)) {
					File::copy($source, $distination);
				}
			endforeach; endif;

			// copy motivation letter
			$motivations = MotivationLetter::getByCandidatId($c->candidats_id);
			if (!empty($motivations)) : foreach ($motivations as $key => $motivation) :
				if (empty($motivation->lettre)) continue;
				$motivationPath = 'apps/upload/frontend/lmotivation/';
				$source = site_base($motivationPath . $motivation->lettre);
				$distination = get_motivation_letter_base($motivation->lettre, $variables);
				if (!file_exists($distination)) {
					File::copy($source, $distination);
				}
			endforeach; endif;

			// copy copie_diplome
			$formations = Formation::getByCandidatId($c->candidats_id);
			if (!empty($formations)) : foreach ($formations as $key => $formation) :
				if (empty($formation->copie_diplome)) continue;
				$copieDiplomePath = 'apps/upload/frontend/candidat/copie_diplome/';
				$source = site_base($copieDiplomePath . $formation->copie_diplome);
				$distination = get_copie_diplome_base($formation->copie_diplome, $variables);
				if (!file_exists($distination)) {
					File::copy($source, $distination);
				}
			endforeach; endif;
			
			// copy copie_attestation && bulletin_paie
			$experiences = Experience::getByCandidatId($c->candidats_id);
			if (!empty($experiences)) : foreach ($experiences as $key => $experience) :
				// copie_attestation
				if (!empty($experience->copie_attestation)) {
					$copieAttestationPath = 'apps/upload/frontend/candidat/copie_attestation/';
					$source = site_base($copieAttestationPath . $experience->copie_attestation);
					$distination = get_copie_diplome_base($experience->copie_attestation, $variables);
					if (!file_exists($distination)) {
						File::copy($source, $distination);
					}
				}
				// bulletin_paie
				if (!empty($experience->bulletin_paie)) {
					$copieAttestationPath = 'apps/upload/frontend/candidat/bulletin_paie/';
					$source = site_base($copieAttestationPath . $experience->bulletin_paie);
					$distination = get_copie_diplome_base($experience->bulletin_paie, $variables);
					if (!file_exists($distination)) {
						File::copy($source, $distination);
					}
				}
			endforeach; endif;
		}
	}

	
} // END Class