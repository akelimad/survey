<?php
/**
 * AuthController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Models\Candidat;
use App\Ajax;
use App\Media;
use App\Mail\Mailer;
use App\Form;
use App\Models\Sector;
use App\Models\City;
use App\Models\Country;
use App\Models\FormationLevel;

class AuthController extends CandidatController
{

	public function auth($candidat)
	{
    getDB()->update('candidats', 'candidats_id', $candidat->candidats_id, ['last_connexion' => date("Y-m-d H:i:s")]);

		$fullname = trim(ucfirst($candidat->prenom) .' '. strtoupper($candidat->nom));

    create_session('abb_login_candidat', $candidat->email);
    create_session('abb_nom', $fullname);
    create_session('abb_id_candidat', $candidat->candidats_id);

		$redirect = ($_SERVER['HTTP_REFERER'] == site_url()) ? site_url('candidat/compte/') : $_SERVER['HTTP_REFERER'];
		return $this->jsonResponse('success', '', ['redirect' => $redirect]);
	}


	public function login()
	{
		$candidat = getDB()->prepare("SELECT * FROM candidats WHERE email=? AND mdp=?", [
			$_POST['email'],
			md5($_POST['password'])
		], true);

		// check if account exist
		if(!isset($candidat->candidats_id)) {
			return $this->jsonResponse('error', trans("Email et/ou votre mot de passe est incorrect !"));
		}

		switch ($candidat->status) {
			case '0':
			return $this->jsonResponse(
				'confirm_activation', 
				trans("Votre compte a été désactivé, voulez-vous le réactiver ?"), [
					"candidat_id" => $candidat->candidats_id
				]);
			break;
			case '1':
				return $this->auth($candidat);
			break;
			case '2':
				return $this->jsonResponse(
				'resent_email', 
				trans("Vous n'avez pas encore activer votre compte, <strong>voulez vous reenvoyer un email d'activation ?</strong>"), [
					'candidat_id' => $candidat->candidats_id
				]);
			break;
		}
	}


	public function logout()
	{
		erase_session('abb_login_candidat');
    erase_session('abb_nom');
    erase_session('abb_id_candidat');
    return redirect('/');
	}


	public function loginModal()
	{
		return Ajax::renderAjaxView('', 'front/candidat/login-form');
	}


  public function reActivate($data) {
    $candidat = getDB()->prepare("SELECT * FROM `candidats` WHERE `candidats_id`=?", [$data['cid']], true);
    if(isset($candidat->candidats_id)) {
      $updateStatus = getDB()->update('candidats', 'candidats_id', $data['cid'], ['status' => 1, 'nl_emploi' => 1]);
      if( $updateStatus ) {
        return $this->auth($candidat);
      }
    }
  }


	public function resentEmail($data)
	{
		$candidat = getDB()->findOne('candidats', 'candidats_id', $data['cid']);
    if(isset($candidat->candidats_id)) {
			$fullname = Candidat::getDisplayName($candidat);
			$this->sendVerificationEmail($candidat->candidats_id);
				
			return $this->jsonResponse('success', [trans("Un e-mail vous a été envoyé avec des instructions détaillées sur la façon de l'activer.")]);
    }
	}


	public function resetPassword($data)
	{
		if(isset($data['email']) && !empty($data['email'])) {
			$candidat = getDB()->findOne('candidats', 'email', $data['email']);
			if(isset($candidat->candidats_id)) {
				switch ($candidat->status) {
					case '0':
						$data['status'] = 'confirm_activation';
						$data['message'] = trans("Votre compte a été désactivé, voulez-vous le réactiver ?");
						$data['candidat_id'] = $candidat->candidats_id;
					break;
					case '1':
						$password = $candidat->nl_partenaire;
            if( $password == '' ) {
                $password = uniqid();
                getDB()->update('candidats', 'email', $data['email'], [
                    'mdp' => md5($password),
                    'nl_partenaire' => $password
                ]);
            }
            $send = $this->resetPasswordEmail($candidat, $password);
            $data['status'] = $send['response'];
            if($send['response'] == 'success') {
            	$data['message'] = trans("Un nouveau mot de passe vient de vous être envoyé à l'adresse indiqué. Verifier votre boite email d'ici quelque minutes.");
				    } else {
				      $data['message'] = $send['message'];
				    }
					break;
					case '2':
						$data['status'] = 'resent_email';
						$data['message'] = trans("Vous n'avez pas encore activer votre compte, <strong>voulez vous reenvoyer un email d'activation ?</strong>");
						$data['candidat_id'] = $candidat->candidats_id;
					break;
				}
			} else {
				$data['status'] = 'error';
				$data['message'] = trans("Ce compte n'existe pas.");
			}
			unset($data['email']);
		}
		return Ajax::renderAjaxView(trans("Réinitialiser le mot de passe"), 'front/candidat/reset-password', $data);
	}


  public function resetPasswordEmail($candidat, $password) {
		// Get email template
		$template = getDB()->findOne('root_email_auto', 'ref', 'h');
		if(!isset($template->id_email)) return;

		$variables = Mailer::getVariables($candidat);
		$variables['mot_passe'] = $password;

		$subject = Mailer::renderMessage($template->objet, $variables);
		$message = Mailer::renderMessage($template->message, $variables);

		return Mailer::send($candidat->email, $subject, $message, [
			'titre' => $template->titre,
			'type_email' => 'Envoi automatique'
		]);
  }


	public function register()
	{
		if(isLogged('candidat')) redirect('/');

		$this->data['villes'] = City::findAll(false);
    $this->data['pays'] = Country::findAll(false);
    $this->data['sectors'] = Sector::findAll(false);
    $this->data['niv_formation'] = FormationLevel::findAll(false);

		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Inscrivez-vous")];
		return get_page('front/candidat/register', $this->data);
	}


	public function store($params)
	{
		// Verify google recaptcha
		if (!$this->validateRecaptcha($params)) {
			return $this->jsonResponse('error', trans("Merci de cocher la case 'Je ne suis pas un robot'"));
		}

		// Validate candidat informations
		$params['candidat']['date_n'] = \eta_date($params['candidat']['date_n'], 'Y-m-d');
		$validateCandidat = $this->validate($params['candidat'], $this->getCandidatRulesAndNames());
		if (is_array($validateCandidat)) {
			return $this->jsonResponse('error', $validateCandidat);
		}

		// Check unique email
		if(Candidat::exists($params['candidat']['email'])) {
			return $this->jsonResponse('error', trans("Cette email est déja utilisé avec une autre compte."));
		}

		// Check password strength
		if( $params['candidat']['mdp'] != $params['candidat']['mdp_confirm'] ) {
			return $this->jsonResponse('error', trans("Les deux mot de passe ne sont pas identique."));
		} elseif (!Candidat::isStrongPassword($params['candidat']['mdp'])) {
			return $this->jsonResponse('error', trans("Le mot de passe doit contenir les chiffres et des lettres."));
		}

		// Validate candidat formations
		$validateFormations = $this->validateFormations($params['formations']);
		if (is_array($validateFormations) && !empty($validateFormations)) {
			return $this->jsonResponse('error', $validateFormations);
		}

		// Validate candidat experiences
		$validateExperiences = $this->validateExperiences($params['experiences']);
		if (is_array($validateExperiences) && !empty($validateExperiences)) {
			return $this->jsonResponse('error', $validateExperiences);
		}

		// Validate and upload attachements
		$upload = $this->uploadFiles();
		if(isset($upload['errors']) && !empty($upload['errors'])) {
			return $this->jsonResponse('error', $upload['errors']);
		}

		// Create candidat
		$id_candidat = $this->createCandidat($params['candidat'], $upload);

		if ($id_candidat < 1) {
			Media::deleteUploadedFiles($upload);
			return $this->jsonResponse('error', trans("Une erreur est survenue lors de création de compte."));
		}

		// Create formations
		if (get_setting('register_show_last_formation', 1) == 1) {
			$this->createFormations($id_candidat, $params['formations'], $upload);
		}

		// Create experiences
		if(get_setting('register_show_last_experience', 1) == 1) {
			$this->createExperiences($id_candidat, $params['experiences'], $upload);
		}

		// Send verrification email to candidat
		$this->sendVerificationEmail($id_candidat);

		// Show success message
		return $this->jsonResponse('success', [
			trans("Votre compte a été créé avec succès."), 
			trans("Un e-mail vous a été envoyé avec des instructions détaillées sur la façon de l'activer.")
		], ['dismissible' => false]);
	}


	public function terms()
	{
		return Ajax::renderAjaxView(trans("LES CONDITIONS D'UTILISATION ET LES RÈGLES DE CONFIDENTIALITÉ."), "front/candidat/terms");
	}


} // END Class