<?php
/**
 * PHPMail
 * 
 * Send emails using php mail() function
 *
 * @author mchanchaf
 *
 * @package app.mail.phpmail
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Mail;


class PHPMail
{
	
	/**
	 * Send simple email
	 *
	 * @param string $templateRef 
	 * @param array $variables 
	 * 
	 * @author mchanchaf
	 */
	public static function sendMail($receiver, $subject, $message, $args=[]) {
		$default = array(
			'sender_name'  => SITE_NAME,
			'sender_email' => SITE_EMAIL,
			'headers' => [
		    "MIME-Version" => "1.0",
		    "Content-type" => "text/html; charset=UTF-8"
			]
		);
		$params = array_merge_recursive($default, $args);

		// Set headers
		if( !isset($params['headers']['From']) ) {
			$headers = "From: ".$params['sender_name']." <".$params['sender_email'].">\r\n";
		} else {
			$headers = "";
		}
		foreach ($params['headers'] as $key => $value) $headers .= $key .": ". $value ."\r\n";

		// Send email
		if ( function_exists( 'mail' ) && mail($receiver, $subject, $message, $headers) ) {
			return array('response' => 'success', 'message' => trans("L'email a été bien envoyé."));
		}

		// Function mail() has been disabled or send error
		return array('response' => 'error', 'message' => trans("Une erreur est survenue lors d'envoi de l'email."));
 	}


 	/**
	 * Send email from template
	 *
	 * @param string $templateRef 
	 * @param array $variables 
	 * 
	 * @author mchanchaf
	 */
	public static function sendEmailFromTemplate($receiver, $templateRef, $variables=[], $args=[]) {

		// Get email template
		$mailAuto = getDB()->_prepare("SELECT * FROM root_email_auto WHERE ref=?", [$templateRef], true);

		if( !isset($mailAuto->id_email) ) {
		  return array("response" => "error", "message" => trans("Cette email template n'exist pas."));
		}

		// Set args
		$default = array(
			'sender_name'  => SITE_NAME,
			'sender_email' => $mailAuto->email,
			'headers' => [
			    "MIME-Version" => "1.0",
			    "Content-type" => "text/html; charset=UTF-8"
			]
		);
		$params = array_merge_recursive($default, $args);

		// get attachement path
		$attachmentPath = SITE_BASE . '/upload/backend/upload_pj/'. $mailAuto->p_joint;
		$attachementExist = (file_exists($attachmentPath)) ? true : false;
		if( $attachementExist ) {
			$params['headers']['Content-Type'] = "multipart/mixed; charset=UTF-8";
		}

		// Set headers
		if( !isset($params['headers']['From']) ) {
			$headers = "From: ".$params['sender_name']." <". $params['sender_email'].">\r\n";
		} else {
			$headers = "";
		}
		foreach ($params['headers'] as $key => $value) $headers .= $key .": ". $value ."\r\n";

		// Prepare template
		$emailHtml = new emailTemplateParser($mailAuto->message);
		$emailHtml->setVars($variables);
		$message = $emailHtml->output();
		if( $attachementExist )  {
			// Read and format the attachment
			$file = file_get_contents($attachmentPath);
			$file = chunk_split( base64_encode($file) );
			// Add attachment
			$message .= "Content-Type: application/msword; name=\"$mailAuto->p_joint\"\r\n".
			"Content-Transfer-Encoding: base64\r\n".
			"Content-Disposition: attachment; filename=\"$mailAuto->p_joint\"\r\n\n".
			"$file";
		}

		// Send email
		if ( function_exists( 'mail' ) && mail($receiver, $mailAuto->objet, $message, $headers) ) {
			return array('response' => 'success');
		}

		// Function mail() has been disabled or send error
		return array('response' => 'error', 'message' => trans("Une erreur est survenue lors d'envoi de l'email."));
 	}

 	

 	/**
	 * Ajax action to send emails
	 *
	 * @param array $data 
	 * 
	 * @author Mhamed Chanchaf
	 */
	public static function send($data) {
		if( !isset($data['email']) || !isset($data['subject']) || !isset($data['message']) ) {
			return array('response' => 'error', 'message' => trans("Une erreur est survenue lors d'envoi de l'email."));
		}
		return self::sendEmail($data['email'], $data['subject'], $data['message']);
	}



} // END Class