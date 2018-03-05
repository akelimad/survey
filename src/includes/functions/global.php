<?php
/**
 * Global functions
 *
 * @author mchanchaf
 * @since 04/10/2017
 */

// Include all files inside this folder
/*foreach (glob(dirname(__FILE__) ."/*.php") as $path) {
	if( $path != __FILE__ ) {
		include_once($path);
	}
}
*/

include_once( dirname(__FILE__) .'/../ajax/actions.php');
include_once( dirname(__FILE__) .'/url.php');
include_once( dirname(__FILE__) .'/helpers.php');
include_once( dirname(__FILE__) .'/modules.php');
include_once( dirname(__FILE__) .'/assets.php');
include_once( dirname(__FILE__) .'/user.php');
include_once( dirname(__FILE__) .'/candidat.php');
include_once( dirname(__FILE__) .'/cookie-session.php');
include_once( dirname(__FILE__) .'/database.php');
include_once( dirname(__FILE__) .'/datetime.php');
include_once( dirname(__FILE__) .'/file.php');
include_once( dirname(__FILE__) .'/form.php');
include_once( dirname(__FILE__) .'/messages.php');
include_once( dirname(__FILE__) .'/mobile.php');
include_once( dirname(__FILE__) .'/views.php');
include_once( dirname(__FILE__) .'/site.php');
include_once( dirname(__FILE__) .'/menu.php');