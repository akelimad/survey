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
use App\Helpers\Form\Validator;
use App\Models\Candidat;
use App\Ajax;
use App\Media;
use App\Mail\Mailer;
use App\Form;

class AuthController extends Controller
{

	private $rules = [
		// Candidat
		'candidat_id_civi' => ['required|numeric', 'Civilité'],
		'candidat_id_pays' => ['required|numeric', 'Pays de résidence'],
		'candidat_id_situ' => ['required|numeric', 'Situation actuelle'],
		'candidat_id_sect' => ['required|numeric', 'Secteur actuel'],
		'candidat_id_fonc' => ['required|numeric', 'Fonction'],
		'candidat_fonction_other' => ['eta_string', 'Autre Fonction'],
		'candidat_id_salr' => ['numeric', 'Salaire souhaité'],
		'candidat_id_currency' => ['numeric', 'Devise'],
		'candidat_id_nfor' => ['required|numeric', 'Niveau de formation'],
		'candidat_id_tfor' => ['required|numeric', 'Type de formation'],
		'candidat_id_dispo' => ['required|numeric', 'Disponibilité'],
		'candidat_id_expe' => ['required|numeric', 'Expérience'],
		'candidat_titre' => ['required|eta_alpha_numeric|min_len,3|max_len,255', 'Titre de votre profil'],
		'candidat_nom' => ['required|valid_name|min_len,3|max_len,32', 'Nom'],
		'candidat_prenom' => ['required|valid_name|min_len,3|max_len,32', 'Prénom'],
		'candidat_date_n' => ['required|date|min_age,15', 'Date de naissance'],
		'candidat_adresse' => ['required|eta_alpha_numeric|max_len,255', 'Adresse'],
		'candidat_code' => ['numeric|max_len,10', 'Code postal'],
		'candidat_ville' => ['required|eta_string', 'Ville'],
		'candidat_ville_other' => ['eta_string', 'Autre ville'],
		'candidat_nationalite' => ['required|eta_string|max_len,16', 'Nationalité'],
		'candidat_cin' => ['alpha_numeric|max_len,8', 'CIN'],
		'candidat_dial_code' => ['required|eta_alpha_numeric', 'Indicatif téléphonique'],
		'candidat_tel1' => ['required|phone_number|max_len,16', 'Téléphone'],
		'candidat_tel2' => ['phone_number|max_len,16', 'Téléphone secondaire'],
		'candidat_email' => ['required|valid_email', 'Email'],
		'candidat_mdp' => ['required|min_len,6', 'Mot de passe'],
		'candidat_mdp_confirm' => ['required|min_len,6', 'Confirmation de mot de passe'], // not a field
		'candidat_mobilite' => ['required|alpha', 'Mobilité géographique'],
		'candidat_niveau_mobilite' => ['required|numeric', 'Niveau de mobilité'],
		'candidat_taux_mobilite' => ['required|numeric',  'Taux de mobilité'],
		'candidat_arabic' => ['eta_string', 'Langue Arabe'],
		'candidat_french' => ['eta_string', 'Langue Français'],
		'candidat_english' => ['eta_string', 'Langue Anglais'],
		'candidat_autre' => ['eta_string', 'Autres 1'],
		'candidat_autre_n' => ['eta_string', 'Autres 1 niveau'],
		'candidat_autre1' => ['eta_string', 'Autres 2'],
		'candidat_autre1_n' => ['eta_string', 'Autres 2 niveau'],
		'candidat_autre2' => ['eta_string', 'Autres 3'],
		'candidat_autre2_n' => ['eta_string', 'Autres 3 niveau'],
		// Formation
		'formation_id_ecol' => ['required|numeric', 'École ou établissement'],
		'formation_date_debut' => ['required|date', 'Date de début'],
		'formation_date_fin' => ['date', 'Date de fin'],
		'formation_diplome' => ['required|numeric', 'Diplôme'],
		'formation_diplome_other' => ['eta_string', 'Autre diplôme'],
		'formation_description' => ['required|eta_alpha_numeric', 'Description de la formation'],
		'formation_nivformation' => ['required|numeric', 'Nombre d’année de formation'],
		'formation_ecole' => ['required|eta_string', 'Autre école ou établissement'],
		// Experience
		'experience_id_sect' => ['numeric', 'Secteur d\'activité'],
		'experience_id_fonc' => ['numeric', 'Fonction'],
		'experience_fonction_other' => ['eta_string', 'Autre Fonction'],
		'experience_id_tpost' => ['numeric', 'Type de contrat'],
		'experience_id_pays' => ['numeric', 'Pays'],
		'experience_date_debut' => ['date', 'Date de début'],
		'experience_date_fin' => ['date', 'Date de fin'],
		'experience_poste' => ['alpha_numeric|max_len,255', 'Intitulé du poste'],
		'experience_entreprise' => ['alpha_numeric|max_len,255', 'Entreprise'],
		'experience_ville' => ['alpha', 'Ville'],
		'experience_ville_other' => ['alpha', 'Autre ville'],
		'experience_description' => ['eta_alpha_numeric', 'Description du poste'],
		'experience_salair_pecu' => ['numeric', 'Dernier salaire perçu'],
	];


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
				trans("Votre compte a été désactivé, voulez vous le reactiver ?"), [
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


	/**
   * Reactivate candidat account
   *
   * @param array $data 
   * 
   * @author Mhamed Chanchaf
   */
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
			$fullname = $this->getCandidatFullname($candidat->id_civi, $candidat->nom, $candidat->prenom);
			$this->sendVerificationEmail($candidat->candidats_id, $fullname, $candidat->email);
				
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
						$data['message'] = trans("Votre compte a été désactivé, voulez vous le reactiver ?");
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


	/**
   * Send reset password email
   *
   * @param int $id_user 
   * @param string $accountType 
   * 
   * @author Mhamed Chanchaf
   */
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
		$this->data['villes'] = getDB()->read('prm_villes');
		$this->data['pays'] = getDB()->read('prm_pays');
		$this->data['sectors'] = getDB()->read('prm_sectors');
		$this->data['niv_formation'] = getDB()->read('prm_niv_formation');
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = [trans("Accueil"), trans("Candidat"), trans("Inscrivez-vous")];
		return get_page('front/candidat/register', $this->data);
	}


	public function store($params)
	{
		// Verify google recaptcha
		if(
			get_setting('google_recaptcha_enabled', false) &&
			(!isset($params['g-recaptcha-response']) || 
			!$this->verifyGoogleRecaptcha($params['g-recaptcha-response']))
		) {
			return $this->jsonResponse('error', trans("Merci de cocher la case 'Je ne suis pas un robot'"));
		}

		// Validate form data
		$data = $this->getFormData($params);
		$this->setFieldNames();
		$is_valid = Validator::is_valid($data, $this->getRules());
		
		if($is_valid !== true) {

			// Check unique email
			if($this->checkEmailExists($params['candidat']['email'])) {
				return $this->jsonResponse('error', trans("Cette email est déja utilisé avec une autre compte."));
			}

			// Check password strength
			if( $params['candidat']['mdp'] != $params['candidat']['mdp_confirm'] ) {
				return $this->jsonResponse('error', trans("Les deux mot de passe ne sont pas identique."));
			} elseif (!Candidat::isStrongPassword($params['candidat']['mdp'])) {
				return $this->jsonResponse('error', trans("Le mot de passe doit contenir les chiffres et des lettres."));
			}
			
			// Validate and upload attachements
			$upload = $this->uploadAttachements();
			if(isset($upload['errors']) && !empty($upload['errors'])) {
				return $this->jsonResponse('error', $upload['errors']);
			}

			// DB Instance
			$db = getDB();
			
			// Create candidat
			$cdata = $this->getCandidatData($params);
			$cdata['photo'] = (isset($upload['files']['photo'])) ? $upload['files']['photo']['name'] : null;
			$cdata['permis_conduire'] = (isset($upload['files']['permis_conduire'])) ? $upload['files']['permis_conduire']['name'] : null;
			$id_candidat = $db->create('candidats', $cdata, false);
			
			// Create formation
			if (get_setting('register_show_last_formation', 1) == 1) {
				$fdata = $this->getFormationData($params);
				$fdata['candidats_id'] = $id_candidat;
				$fdata['date_debut'] = date('m/Y', strtotime($fdata['date_debut']));
				$fdata['date_fin'] = date('m/Y', strtotime($fdata['date_fin']));
				$fdata['copie_diplome'] = (isset($upload['files']['copie_diplome'])) ? $upload['files']['copie_diplome']['name'] : '';
				$db->create('formations', $fdata, false);
			}
			
			// Create experience
			if(
				$params['experience']['date_debut'] != '' && 
				get_setting('register_show_last_experience', 1) == 1
			) {
				$exp_date_fin = ($params['experience']['date_debut'] != '') ? date('d/m/Y', strtotime($params['experience']['date_fin'])) : '';
				$expData = $this->getExperienceData($params);
				$expData['candidats_id'] = $id_candidat;
				$expData['date_debut'] = date('d/m/Y', strtotime($params['experience']['date_debut']));
				$expData['date_fin'] = $exp_date_fin;
				$expData['copie_attestation'] = (isset($upload['files']['copie_attestation'])) ? $upload['files']['copie_attestation']['name'] : '';
				$expData['bulletin_paie'] = (isset($upload['files']['bulletin_paie'])) ? $upload['files']['bulletin_paie']['name'] : '';
				$db->create('experience_pro', $expData, false);
			}

			// Create CV
			if(isset($upload['files']['cv']) && Form::getFieldOption('displayed', 'register', 'cv')) {
				$db->create('cv', [
					'candidats_id' => $id_candidat,
					'lien_cv' => $upload['files']['cv']['name'],
					'titre_cv' => $upload['files']['cv']['title'],
					'principal' => 1,
					'actif' => 1
				], false);
			}

			// Create LM
			if(isset($upload['files']['lm']) && Form::getFieldOption('displayed', 'register', 'lm')) {
				$db->create('lettres_motivation', [
					'candidats_id' => $id_candidat,
					'lettre' => $upload['files']['lm']['name'],
					'titre' => $upload['files']['lm']['title'],
					'principal' => 1,
					'actif' => 1
				], false);
			}

			// Send email to candidat
			$fullname = $this->getCandidatFullname($cdata['id_civi'], $cdata['nom'], $cdata['prenom']);
			$this->sendVerificationEmail($id_candidat, $fullname, $cdata['email']);
			
			return $this->jsonResponse('success', [trans("Votre compte a été créé avec succès."), trans("Un e-mail vous a été envoyé avec des instructions détaillées sur la façon de l'activer.")], ['dismissible' => false]);
		} else {
			return $this->jsonResponse('error', $is_valid);
		}
	}


	public function terms()
	{
		return Ajax::renderAjaxView(trans("LES CONDITIONS D'UTILISATION ET LES RÈGLES DE CONFIDENTIALITÉ."), "front/candidat/terms");
	}
	
	
	private function getFormData($params)
	{
		$data = [];
		foreach ($params as $key => $value) {
			if(is_array($value)) {
				$prefixed = array_combine(
					array_map(function($k) use ($key) { return $key.'_'.$k; }, array_keys($value)),
					$value
				);
				$data += $prefixed;
			} else {
				$data[$key] = $value;
			}
		}
		return $data;
	}


	private function getCandidatData($params)
	{
		$data = [
			'pupille' => null,
			'handicape' => null,
			'note_diplome' => 0,
			'nl_emploi' => 1,
			'nl_partenaire' => $params['candidat']['mdp'],
			'date_inscription' => date('Y-m-d'),
			'status' => 2,
			'last_connexion' => null,
			'vues' => 0,
			'dateMAJ' => date('Y-m-d H:i:s'),
			'CVdateMAJ' => date('Y-m-d H:i:s'),
			'can_update_account' => 1
		];
		$rules = preg_filter('/^candidat_(.*)/', '$1', array_keys($this->rules));
		foreach ($params['candidat'] as $key => $value) {
			if(in_array($key, $rules) && !in_array($key, ['mdp_confirm'])) {
				$data[$key] = $value;
			}
		}

		if (isset($data['ville_other']) && !empty($data['ville_other'])) {
			$data['ville'] = $data['ville_other'];
		}
		unset($data['ville_other']);

		$data['date_n'] = \english_to_french_date($data['date_n']);
		$data['mdp'] = md5($data['mdp']);
		return $data;
	}


	private function getCandidatFullname($id_civi, $nom, $prenom)
	{
		$fullname = trim($prenom .' '. $nom);
		$civilite = getDB()->findOne('prm_civilite', 'id_civi', $id_civi);
		if(isset($civilite->id_civi)) {
			$fullname = $civilite->civilite .' '. $fullname;
		}
		return $fullname;
	}


	private function getFormationData($params)
	{
		$data = [];
		$rules = preg_filter('/^formation_(.*)/', '$1', array_keys($this->rules));
		foreach ($params['formation'] as $key => $value) {
			if(in_array($key, $rules)) {
				$data[$key] = $value;
			}
		}
		return $data;
	}

	private function getExperienceData($params)
	{
		$data = [];
		$rules = preg_filter('/^experience_(.*)/', '$1', array_keys($this->rules));
		foreach ($params['experience'] as $key => $value) {
			if(in_array($key, $rules)) {
				$data[$key] = $value;
			}
		}
		
		if (isset($data['ville_other']) && !empty($data['ville_other'])) {
			$data['ville'] = $data['ville_other'];
		}
		unset($data['ville_other']);

		return $data;
	}
	

	private function getRules()
	{
		return array_map(function($rule) {
			return trans($rule[0]);
		}, $this->rules);
	}


	private function setFieldNames()
	{
		Validator::set_field_names(array_map(function($rule) {
			return trans($rule[1]);
		}, $this->rules));
	}


	private function uploadAttachements()
	{
		$return = [];
		$rules = [
			'photo' => [
				'name' => trans("Photo"),
				'path' => 'apps/upload/frontend/photo_candidats/',
				'required' => Form::getFieldOption('required', 'register', 'photo'),
				'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
			],
			'cv' => [
				'name' => trans("CV"),
				'path' => 'apps/upload/frontend/cv/',
				'required' => Form::getFieldOption('required', 'register', 'cv'),
				'extensions' => ['doc', 'docx', 'pdf'],
			],
			'lm' => [
				'name' => trans("Lettre de motivation"),
				'path' => 'apps/upload/frontend/lmotivation/',
				'required' => Form::getFieldOption('required', 'register', 'lm'),
				'extensions' => ['doc', 'docx', 'pdf'],
			],
			'copie_diplome' => [
				'name' => trans("Copie du diplôme"),
				'path' => 'apps/upload/frontend/candidat/copie_attestation/',
				'required' => Form::getFieldOption('required', 'register', 'copie_diplome'),
				'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
			],
			'copie_attestation' => [
				'name' => trans("Copie de l’attestation"),
				'path' => 'apps/upload/frontend/candidat/copie_attestation/',
				'required' => Form::getFieldOption('required', 'register', 'copie_attestation'),
				'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
			],
			'bulletin_paie' => [
				'name' => trans("Bulletin de paie"),
				'path' => 'apps/upload/frontend/candidat/bulletin_paie/',
				'required' => Form::getFieldOption('required', 'register', 'bulletin_paie'),
				'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
			],
			'permis_conduire' => [
				'name' => trans("Permis de conduire"),
				'path' => 'apps/upload/frontend/candidat/permis_conduire/',
				'required' => Form::getFieldOption('required', 'register', 'permis_conduire'),
				'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
			]
		];

		// Store uploaded files paths to delete theme if errors
    $upload_paths = [];
		
		$max_file_size = get_setting('max_file_size');

		foreach ($rules as $key => $rule) {
			$valid = true;
			if($rule['required'] && $_FILES[$key]['size'] < 1) {
				$return['errors'][] = trans("Le champs") ." <strong>{$rule['name']}</strong> ". trans("est obligatoire.");
				$valid = false;
			}
			$extension = strtolower(pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION));
			if ($_FILES[$key]['size'] > 0) {
				if(!in_array($extension, $rule['extensions'])) {
					$return['errors'][] = trans("Le champ") ." <strong>{$rule['name']}</strong> ". trans("doit avoir les extensions suivantes") ." (.". implode(', .', $rule['extensions']) .")";
				} elseif ($_FILES[$key]['size'] > $this->koToOctet($max_file_size)) {
          $return['errors'][] = trans("Vous avez depassé la taille maximal") ." <strong>({$max_file_size}ko)</strong> ". trans("pour le champ"). " <strong>{$rule['name']}</strong>";
        } else if($valid) {
					$upload = Media::upload($_FILES[$key], [
						'extensions' => $rule['extensions'],
						'uploadDir' => $rule['path']
					]);
					if(isset($upload['files'][0]) && $upload['files'][0] != '') {
						$return['files'][$key] = [
							'name' => $upload['files'][0], 
							'title' => str_replace('.'.$extension, '', $_FILES[$key]['name'])
						];
						$upload_paths[] = $rule['path'] . $upload['files'][0];
					} else {
						$return['errors'][$key] = $upload['errors'][0];
					}
				}
			}
		}
		// Remove uploaded files if errors
		if (!empty($return['errors'])) {
      foreach ($upload_paths as $key => $upath) {
        unlinkFile(site_base($upath));
      }
    }
		return $return;
	}


	/**
	 * Check candidat email exists
	 *
	 * @param string $email
	 *
	 * @return bool
	 *
	 * @author Mhamed Chanchaf
	 */
	private function checkEmailExists($email)
	{
		return getDB()->exists('candidats', 'email', $email);
	}

	
	private function sendVerificationEmail($id_candidat, $fullname, $email)
	{
		global $email_e;

		// Get email template
		$template = getDB()->findOne('root_email_auto', 'ref', 'r');
		if(!isset($template->id_email)) return;

		$lien = site_url("candidat/account/confirm/". md5($email.$id_candidat));
		$variables = Mailer::getVariables($id_candidat);
		$variables['lieu_statu'] =  site_url();
		$variables['lien_confirmation'] = '<a href="'. $lien .'">'. $lien .'</a>';
		$subject = Mailer::renderMessage($template->objet, $variables);
		$message = Mailer::renderMessage($template->message, $variables);

		$bcc = [$email_e];
		if($email_e != $template->email) $bcc[] = $template->email;
		
		return Mailer::send($email, $subject, $message, [
			'titre' => $template->titre,
			'coresp_nom' => $fullname,
			'type_email' => 'Envoi automatique',
			'Bcc' => $bcc
		]);
	}


} // END Class