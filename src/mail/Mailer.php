<?php
/**
 * Mailer
 * 
 * Send emails using PHPMailer library
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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
	 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
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
				$nom = (isLogged('admin')) ? read_session('abb_admin') : $nom;
				
				getDB()->create('corespondances', [
					'sujet' => $subject,
					'nom' => $nom,
					'date_envoi' => date('Y-m-d H:i:s'),
					'type_email' => (isset($args['type_email'])) ? $args['type_email'] : 'Envoi manuel',
					'titre' => (isset($args['titre'])) ? $args['titre'] : 'Contact avec le candidat',
					'message' => $message,
					'ref_filiale' => (isset($args['ref_filiale'])) ? $args['ref_filiale'] : ''
				]);
				
				return array("response" => "success", "message" => "L'email a été bien envoyé.");
			} else {
				return array("response" => "error", "message" => "Une erreur est survenu lors d'envoi de l'email.");
			}

		} catch (Exception $e) {
			return array("response" => "error", "message" => "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}");
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





} // END Class