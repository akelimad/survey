<?php
/**
 * RegisterController
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
use App\Ajax;
use App\Media;
use App\Mail\Mailer;

class RegisterController extends Controller
{

	private $rules = [
		// Candidat
		'candidat_id_civi' => ['required|numeric', 'Civilité'],
		'candidat_id_pays' => ['required|numeric', 'Pays de résidence'],
		'candidat_id_situ' => ['required|numeric', 'Situation actuelle'],
		'candidat_id_sect' => ['required|numeric', 'Secteur actuel'],
		'candidat_id_fonc' => ['required|numeric', 'Fonction'],
		'candidat_id_salr' => ['required|numeric', 'Salaire souhaité'],
		'candidat_id_nfor' => ['required|numeric', 'Niveau de formation'],
		'candidat_id_tfor' => ['required|numeric', 'Type de formation'],
		'candidat_id_dispo' => ['required|numeric', 'Disponibilité'],
		'candidat_id_expe' => ['required|numeric', 'Expérience'],
		'candidat_titre' => ['required|eta_alpha_numeric|min_len,3|max_len,255', 'Titre de votre profil'],
		'candidat_nom' => ['required|valid_name|min_len,3|max_len,32', 'Nom'],
		'candidat_prenom' => ['required|valid_name|min_len,3|max_len,32', 'Prénom'],
		'candidat_date_n' => ['required|date|min_age,17', 'Date de naissance'],
		'candidat_adresse' => ['required|eta_alpha_numeric|max_len,255', 'Adresse'],
		'candidat_code' => ['numeric|max_len,10', 'Code postal'],
		'candidat_ville' => ['required|alpha', 'Ville'],
		'candidat_nationalite' => ['required|alpha|max_len,16', 'Nationalité'],
		'candidat_cin' => ['required|alpha_numeric', 'CIN'],
		'candidat_tel1_deal_code' => ['eta_alpha_numeric', 'Code du pays'], // not a field
		'candidat_tel1' => ['required|phone_number', 'Téléphone'],
		'candidat_tel2_deal_code' => ['required', 'Code du pays'], // not a field
		'candidat_tel2' => ['phone_number', 'Téléphone secondaire'],
		'candidat_email' => ['required|valid_email', 'Email'],
		'candidat_mdp' => ['required|min_len,6', 'Mot de passe'],
		'candidat_mdp_confirm' => ['required|min_len,6', 'Confirmation de mot de passe'], // not a field
		'candidat_mobilite' => ['required|alpha', 'Mobilité géographique'],
		'candidat_niveau_mobilite' => ['required|alpha', 'Niveau de mobilité'],
		'candidat_taux_mobilite' => ['required|alpha',  'Taux de mobilité'],
		'candidat_arabic' => ['alpha', 'Langue Arabe'],
		'candidat_french' => ['alpha', 'Langue Français'],
		'candidat_english' => ['alpha', 'Langue Anglais'],
		'candidat_autre' => ['alpha', 'Autres 1'],
		'candidat_autre_n' => ['alpha', 'Autres 1 niveau'],
		'candidat_autre1' => ['alpha', 'Autres 2'],
		'candidat_autre1_n' => ['alpha', 'Autres 2 niveau'],
		'candidat_autre2' => ['alpha', 'Autres 3'],
		'candidat_autre2_n' => ['alpha', 'Autres 3 niveau'],
		// Formation
		'formation_id_ecol' => ['required|numeric', 'École ou établissement'],
		'formation_date_debut' => ['required|date', 'Date de début'],
		'formation_date_fin' => ['date', 'Date de fin'],
		'formation_diplome' => ['required|numeric', 'Diplôme'],
		'formation_description' => ['required|eta_alpha_numeric', 'Description de la formation'],
		'formation_nivformation' => ['required|numeric', 'Nombre d’année de formation'],
		// Experience
		'experience_id_sect' => ['numeric', 'Secteur d\'activité'],
		'experience_id_fonc' => ['numeric', 'Fonction'],
		'experience_id_tpost' => ['numeric', 'Type de contrat'],
		'experience_id_pays' => ['numeric', 'Pays'],
		'experience_date_debut' => ['date', 'Date de début'],
		'experience_date_fin' => ['date', 'Date de fin'],
		'experience_poste' => ['alpha_numeric|max_len,255', 'Intitulé du poste'],
		'experience_entreprise' => ['alpha_numeric|max_len,255', 'Entreprise'],
		'experience_ville' => ['alpha', 'Ville'],
		'experience_description' => ['eta_alpha_numeric', 'Description du poste'],
		'experience_salair_pecu' => ['numeric', 'Dernier salaire perçu'],
	];


	public function register()
	{
		$this->data['villes'] = getDB()->read('prm_villes');
		$this->data['pays'] = getDB()->read('prm_pays');
		$this->data['sectors'] = getDB()->read('prm_sectors');
		$this->data['niv_formation'] = getDB()->read('prm_niv_formation');

		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Inscrivez-vous'];

    return get_page('front/candidat/register', $this->data);
	}


	public function store($params)
	{
		// Verify google recaptcha
		if(!isset($params['g-recaptcha-response']) || !$this->verifyGoogleRecaptcha($params['g-recaptcha-response'])) {
			return $this->jsonResponse('error', 'Merci de cocher la case "Je ne suis pas un robot"');
		}

		// Validate form data
		$data = $this->getFormData($params);
		$this->setFieldNames();
		$is_valid = Validator::is_valid($data, $this->getRules());
		
		if($is_valid !== true) {

			// Check unique email
			if($this->checkEmailExists($params['candidat']['email'])) {
				return $this->jsonResponse('error', 'Cette email est déja utilisé avec une autre compte.');
			}

			// Check password strength
			if( $params['candidat']['mdp'] != $params['candidat']['mdp_confirm'] ) {
				return $this->jsonResponse('error', 'Les deux mot de passe ne sont pas identique.');
			} elseif (!$this->isStrongPassword($params['candidat']['mdp'])) {
				return $this->jsonResponse('error', 'Le mot de passe doit contenir les chiffres et des lettres.');
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
			$cdata['photo'] = (isset($upload['files']['photo'])) ? $upload['files']['photo'] : '';
			$id_candidat = $db->create('candidats', $cdata, false);
			
			// Create formation
			$fdata = $this->getFormationData($params);
			$fdata['candidats_id'] = $id_candidat;
			$fdata['date_debut'] = date('m/Y', strtotime($fdata['date_debut']));
			$fdata['date_fin'] = date('m/Y', strtotime($fdata['date_fin']));
			$fdata['copie_diplome'] = (isset($upload['files']['copie_diplome'])) ? $upload['files']['copie_diplome'] : '';
			$db->create('formations', $fdata, false);
			
			// Create experience
			if($params['experience']['date_debut'] != '') {
				$exp_date_fin = ($params['experience']['date_debut'] != '') ? date('d/m/Y', strtotime($params['experience']['date_fin'])) : '';
				$expData = $this->getExperienceData($params);
				$expData['candidats_id'] = $id_candidat;
				$expData['date_debut'] = date('d/m/Y', strtotime($params['experience']['date_debut']));
				$expData['date_fin'] = $exp_date_fin;
				$expData['copie_attestation'] = (isset($upload['files']['copie_attestation'])) ? $upload['files']['copie_attestation'] : '';
				$db->create('experience_pro', $expData, false);
			}

			// Create CV
			$db->create('cv', [
				'candidats_id' => $id_candidat,
				'titre_cv' => $upload['files']['cv'],
				'lien_cv' => $upload['files']['cv'],
				'principal' => 1,
				'actif' => 1
			], false);

			// Create LM
			if(isset($upload['files']['lm'])) {
				$db->create('lettres_motivation', [
					'candidats_id' => $id_candidat,
					'lettre' => $upload['files']['lm'],
					'titre' => $upload['files']['lm'],
					'principal' => 1,
					'actif' => 1
				], false);
			}

			// Send email to candidat
			$fullname = $this->getCandidatFullname($cdata['id_civi'], $cdata['nom'], $cdata['prenom']);
			$this->sendVerificationEmail($id_candidat, $fullname, $cdata['email'], $cdata['mdp']);
			
			return $this->jsonResponse('success', ['Votre compte à été créé avec succès.', 'Un e-mail vous a été envoyé avec des instructions détaillées sur la façon de l\'activer.']);
		} else {
			return $this->jsonResponse('error', $is_valid);
		}
	}


	public function terms()
	{
		return Ajax::renderAjaxView("LES CONDITIONS D'UTILISATION ET LES RÈGLES DE CONFIDENTIALITÉ.", "front/candidat/terms");
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
			'nl_emploi' => '',
			'nl_partenaire' => $params['candidat']['mdp'],
			'date_inscription' => date('Y-m-d'),
			'status' => 2,
			'last_connexion' => null,
			'vues' => 0,
			'dateMAJ' => null,
			'CVdateMAJ' => null,
			'can_update_account' => 1
		];
		$rules = preg_filter('/^candidat_(.*)/', '$1', array_keys($this->rules));
		foreach ($params['candidat'] as $key => $value) {
			if(in_array($key, $rules) && !in_array($key, ['tel1_deal_code', 'tel2_deal_code', 'mdp_confirm'])) {
				$data[$key] = $value;
			}
		}
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
		return $data;
	}
	

	private function getRules()
	{
		return array_map(function($rule) {
			return $rule[0];
		}, $this->rules);
	}


	private function setFieldNames()
	{
		Validator::set_field_names(array_map(function($rule) {
			return $rule[1];
		}, $this->rules));
	}


	private function uploadAttachements()
	{
		$return = [];
		$rules = [
			'photo' => [
				'name' => 'Photo',
				'path' => 'apps/upload/frontend/photo_candidats/',
				'required' => false,
				'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
			],
			'cv' => [
				'name' => 'CV',
				'path' => 'apps/upload/frontend/cv/',
				'required' => true,
				'extensions' => ['doc', 'docx', 'pdf'],
			],
			'lm' => [
				'name' => 'Lettre de motivation',
				'path' => 'apps/upload/frontend/lmotivation/',
				'required' => false,
				'extensions' => ['doc', 'docx', 'pdf'],
			],
			'copie_diplome' => [
				'name' => 'Copie du diplôme',
				'path' => 'apps/upload/frontend/candidat/copie_attestation/',
				'required' => false,
				'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
			],
			'copie_attestation' => [
				'name' => 'Copie de l’attestation',
				'path' => 'apps/upload/frontend/candidat/copie_diplome/',
				'required' => false,
				'extensions' => ['png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf'],
			]
		];

		foreach ($rules as $key => $rule) {
			$valid = true;
			if($rule['required'] && $_FILES[$key]['size'] < 1) {
				$return['errors'][] = "Le champs <strong>{$rule['name']}</strong> est obligatoire.";
				$valid = false;
			}
			$extension = pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION);
			if ($_FILES[$key]['size'] > 0) {
				if(!in_array($extension, $rule['extensions'])) {
					$return['errors'][] = "Le champ <strong>{$rule['name']}</strong> doit avoir les extensions suivantes (.". implode(', .', $rule['extensions']) .")";
				} else if($valid) {
					$upload = Media::upload($_FILES[$key], [
						'extensions' => $rule['extensions'],
						'uploadDir' => $rule['path']
					]);
					if(isset($upload['files'][0]) && $upload['files'][0] != '') {
						$return['files'][$key] = $upload['files'][0];
					} else {
						$return['errors'][$key] = $upload['errors'][0];
					}
				}
			}
		}
		return $return;
	}


	/**
	 * Tell if password is strong
	 *
	 * @param string $password
	 *
	 * @author Mhamed Chanchaf
	 */
	public static function isStrongPassword($password) 
	{
		$containsLetter  = preg_match('/[a-zA-Z]/',    $password);
		$containsDigit   = preg_match('/\d/',          $password);
		$containsAll = $containsLetter && $containsDigit;
		return $containsAll;
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

	
	private function sendVerificationEmail($id_candidat, $fullname, $email, $mdpHash)
	{
		global $email_e;

		// Get email template
		$template = getDB()->findOne('root_email_auto', 'ref', 'r');
		if(!isset($template->id_email)) return;

		$lien_confirmation = site_url("confirmation/?p=$mdpHash&i=$id_candidat");
    $message = Mailer::renderMessage($template->message, [
			'nom_candidat' => $fullname,
			'lieu_statu' => site_url(),
			'lien_confirmation' => '<a href="'. $lien_confirmation .'">'. $lien_confirmation .'</a>'
    ]);

		$bcc = [$email_e];
		if($email_e != $template->email) $bcc[] = $template->email;
		
    return Mailer::send($email, $template->objet, $message, [
		  'titre' => $template->titre,
		  'coresp_nom' => $fullname,
			'type_email' => 'Envoi automatique',
      'Bcc' => $bcc
    ]);
	}


} // END Class