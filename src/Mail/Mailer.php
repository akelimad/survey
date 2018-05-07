<?php
/**
 * Mailer
 * 
 * Send emails using PHPMailer library
 *
 * @author mchanchaf
 *
 * @package app.mail.mailer
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Mail;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
use \PHPMailer\PHPMailer\SMTP;
use \App\emailTemplateParser;
use App\Models\Candidat;
use App\Models\Status;
use App\Models\Civility;

class Mailer
{

	private static $args = array(
		'from' => [
			'name'  => SITE_NAME,
			'email' => SITE_EMAIL
		],
		'replyto' => [
			'name'  => SITE_NAME,
			'email' => SITE_EMAIL
		],
		'headers' => [],
		'attachements' => [],
		'isHTML' => true,
		'CC' => [],
		'BCC' => [],
		'data' => []
	);


	/**
	 * Send simple email
	 *
	 * @param string $receiver
	 * @param string $subject
	 * @param string $message
	 * @param array  $args
	 *
	 * @return array $response 
	 * 
	 * @author mchanchaf
	 */
	public static function send($receiver, $subject, $message, $args=[]) {
		try {
			// Prepare arguments
			$args = array_replace_recursive(self::$args, $args);

			// New instance
			$mail = new PHPMailer();

			// SMTP connect
			if( defined('SMTP_username') ) {
				$mail->IsSMTP(true); // use SMTP
				$mail->SMTPAuth   = true;
				$mail->AuthType   = "LOGIN";
				// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // 2
				$mail->Host       = SMTP_host;
				$mail->Port       = SMTP_port;
				$mail->Username   = SMTP_username;
				$mail->Password   = SMTP_password;

				if( defined('SMTP_ssl') && SMTP_ssl == true ) {
					$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);
				}
			}

			// Recipients
			$mail->setFrom($args['from']['email'], $args['from']['name']);
			$mail->addReplyTo($args['replyto']['email'], $args['replyto']['name']);

			// Add recipients
			$receivers = (is_array($receiver)) ? $receiver : [$receiver];
			foreach ($receivers as $key => $receiver) $mail->addAddress($receiver);	

			// Add attachments
			if( !empty($args['attachements']) ) : foreach ($args['attachements'] as $key => $file) :
				if( !file_exists($file) ) continue;
				$mail->addAttachment( $file );
			endforeach; endif;

			// Add headers
			if( !empty($args['headers']) ) : foreach ($args['headers'] as $key => $value) :
				$mail->addCustomHeader($key, $value);
			endforeach; endif;

			// Add CC
			if( !empty($args['CC']) ) : foreach ($args['CC'] as $key => $value) :
				$mail->addCC($value);
			endforeach; endif;

			// Add CC
			if( !empty($args['BCC']) ) : foreach ($args['BCC'] as $key => $value) :
				$mail->addBCC($value);
			endforeach; endif;

			// Prepare Content
			$mail->CharSet = 'UTF-8';
			$mail->Subject = $subject;
			$mail->Body    = html_entity_decode($message);
			$mail->isHTML($args['isHTML']);
			if( !$args['isHTML'] ) $mail->AltBody = $message;
			
			// Send email
			if( $mail->Send() ) {
				$nom = (isset($args['coresp_nom'])) ? $args['coresp_nom'] : 'NA';
				$nom = (isBackend()) ? get_admin('nom') .' ('. get_admin('email') .')' : $nom;
				
				getDB()->create('corespondances', [
					'sujet' => $subject,
					'nom' => $nom,
					'date_envoi' => date('Y-m-d H:i:s'),
					'type_email' => (isset($args['type_email'])) ? $args['type_email'] : 'Envoi manuel',
					'titre' => (isset($args['titre'])) ? $args['titre'] : 'Contact avec le candidat',
					'message' => $message,
					'ref_filiale' => (isset($args['ref_filiale'])) ? $args['ref_filiale'] : ''
				]);
				
				return array("response" => "success", "message" => trans("L'email a été bien envoyé."));
			} else {
				return array("response" => "error", "message" => trans("Une erreur est survenue lors d'envoi de l'email."));
			}

		} catch (Exception $e) {
			return array(
				"response" => "error",
				"message" => trans("Le message n'a pas pu être envoyé. Erreur:") ." {$mail->ErrorInfo}" 
			);
		}
	}



	public static function renderMessage($message, $variables)
	{
		return preg_replace_callback('#{{([^}]+)}}#', function($m) use ($message, $variables){
			if(isset($variables[$m[1]])){
				return $variables[$m[1]];
			}else{
				return $m[0];
			}
		}, $message);
	}


	public static function getVariables(
		$candidat = null, 
		$offer = null, 
		$candidature_id = null, 
		$message = null
	) {

		$variables = [
			'nom_candidat' => null,
			'nom' => null,
			'prenom' => null,
			'civilite' => null,
			'email_candidat' => null,
			'mot_passe' => null,
			'nom_partenaire' => null,
			'titre_offre' => null,
			'nom_poste' => null,
			'lien_offre' => null,
			'date_postulation' => null,
			'statu_candidature' => null,
			'statut_candidature' => null,
			'date_statu' => null,
			'date_statut' => null,
			'lieu_statu' => null,
			'lieu_statut' => null,
			'lien_confirmation' => null,
			'message' => null,
			'site_name' => get_setting('nom_site'),
			'site' => site_url()
		];

		if (is_null($candidat) && is_null($offer) && is_null($candidature_id)) 
			return $variables;

		if (is_numeric($candidat)) {
			$candidat = getDB()->findOne('candidats', 'candidats_id', $candidat);
		}

		if (is_numeric($offer)) {
			$offer = getDB()->findOne('offre', 'id_offre', $offer);
		}

		if (intval($candidature_id) > 0) {
			$cand = getDB()->prepare("
				SELECT c.id_candidature, c.candidats_id, c.date_candidature, c.status, h.date_modification, h.lieu, o.Name AS titre_offre, o.reference AS ref_offre, a.id_agend 
				FROM candidature AS c 
				JOIN historique AS h ON h.id_candidature=c.id_candidature 
				JOIN offre AS o ON o.id_offre=c.id_offre 
				LEFT JOIN agenda AS a ON a.id_candidature=c.id_candidature 
				WHERE c.id_candidature=? 
				ORDER BY h.date_modification DESC
			", [$candidature_id], true);

			if (isset($cand->id_candidature) && !isset($candidat->candidats_id)) {
				$candidat = getDB()->findOne('candidats', 'candidats_id', $cand->candidats_id);
			}
		}

		if (isset($candidat->candidats_id)) {
			$with_civilite = (get_setting('candidat_show_civility_with_fullname', 1) == 1);
			$variables['nom_candidat'] = Candidat::getDisplayName($candidat, $with_civilite);
			$variables['nom'] = $candidat->nom;
			$variables['prenom'] = $candidat->prenom;
			$variables['civilite'] = Civility::getNameById($candidat->id_civi);

			$variables['email_candidat'] = $candidat->email;
			$variables['mot_passe'] = $candidat->nl_partenaire;
			$variables['nom_partenaire'] = null;
		}

		if (isset($offer->id_offre)) {
			$variables['titre_offre'] = $offer->Name;
			$variables['nom_poste'] = $offer->Name;
			$variables['ref_offre'] = $offer->reference;
			$variables['lien_offre'] = site_url('offre/'. $offer->id_offre);
		}

		if (isset($cand->id_candidature)) {
			$variables['date_postulation'] = eta_date($cand->date_candidature);
			$status = Status::getNameById($cand->status);
			$variables['statu_candidature'] = $status;
			$variables['statut_candidature'] = $status;
			$date_statu = eta_date($cand->date_modification, 'd.m.Y');
			$variables['date_statu'] = $date_statu;
			$variables['date_statut'] = $date_statu;
			$variables['lieu_statu'] = $cand->lieu;
			$variables['lieu_statut'] = $cand->lieu;
			if (isset($cand->id_agend)) {
				$link = site_url('candidature/confirm/'. md5($cand->id_agend));
				$variables['lien_confirmation'] = '<a href="'. $link .'"><b>'. trans("Confirmer") .'</b></a>';

			}
		}

		return $variables;
	}



} // END Class