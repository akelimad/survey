<?php
/**
 * Messages
 *
 * @author mchanchaf
 * @since 03/10/2017
 */


/**
 * Get alert
 *
 * @param string $type
 * @param mixt $messages
 * @param bool $dismiss
 *
 * @author Mhamed Chanchaf
 */
function get_alert($type, $messages, $dismiss=true){
	\App\View::get('alerts/'.$type, [
		'messages' => (is_array($messages)) ? $messages : array($messages),
		'dismissible' => $dismiss
	]);
}


/**
 * Set flash message
 *
 * @return $message array
 */
function set_flash_message($type, $message) {
	if( !in_array($type, ['success', 'error', 'danger', 'info', 'warning']) )
		return false;

	if($type == 'error') $type = 'danger';

	$flash = read_session('flash_message');
	if( !$flash ) $flash = [];

	// Add new error
	if( is_array($message) ) {
		$flash[$type] = $message;
	} else {
		$flash[$type][] = $message;
	}

	return create_session('flash_message', $flash);
}


/**
 * Get flash message
 *
 * @return void
 */
function get_flash_message($print = true) {
	if( $flash = read_session('flash_message') ) {
		erase_session('flash_message');
		// Render views
		$msgs = [];
		foreach ($flash as $type => $messages) {
			if ($print) {
				get_view('alerts/'.$type, ['messages' => $messages]);
			} else {
				$msgs += (is_array($messages)) ? $messages : [$messages];
			}
		}
		if (!$print) return $msgs;
	}
}


/**
 * Tell if has flash message
 *
 * @param string $type
 *
 * @return bool
 */
function has_session_flash($type) {
	if( $flash = read_session('flash_message') ) {
		if( is_array($type) ) {
			foreach ($type as $key => $t) {
				if (isset($flash[$t])) {
					return true;
				}
			}
		} else {
			return (isset($flash[$type]));
		}
	}
	return false;
}