<?php
/**
 * Share
 *
 * @author saleh
 *
 * @package modules.Socialshare.models
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Socialshare\Models;

use App\Session;

class Share {

	public static function checkExistToken()
	{
		$token = getDB()->prepare("SELECT count(*) as exist FROM setting WHERE name='linkedin_access_token'", NULL, TRUE);
		return ( $token->exist == 0 ? FALSE : TRUE);
	}

	public static function saveToken($obj_token)
	{
		$save_token = getDB()->prepare("INSERT INTO setting(field_type, name, description, value) VALUES
			('text', 'linkedin_access_token', 'Linkedin access token for get profil data and share content', '". $obj_token['access_token'] ."'),
			('text', 'Linkedin_access_token_expires_in', 'Linkedin expires access token', '". $obj_token['expires_in'] ."')
			");
		return $save_token;
	}

	public static function saveApp()
	{
		$profil_infos = Session::get('profil_infos');
		$app_infos = Session::get('app_infos');
		$cpt = 0;
		$app_json = '{';
		$app_json .= '"Client_ID": '. '"'.$app_infos['CLIENT_ID'].'"' .', "Client_secret": '. '"'.$app_infos['CLIENT_SECRET'].'"' .', "Redirect_URI": '. '"'.$app_infos['REDIRECT_URI'].'"' .', ';
		foreach ($profil_infos as $key => $value) {
			$app_json .= '"'.$key.'"' .': '. ( is_numeric($value) ? $value : '"'.$value.'"' ) .( $cpt < count($profil_infos) - 1 ? ',' : '' );
			$cpt++;
		}
		$app_json .= '}';
		$name = 'linkedin_app_'. $profil_infos['profil_ID'];
		if(create_setting($name, $app_json)){
			return [ 'etat' => 'success', 'message' => 'Votre app est bien enregistré' ];
		} else {
			return [ 'etat' => 'error', 'message' => 'Votre app déjà existant' ];
		}
	}

	public static function getApps()
	{
		$apps = getDB()->prepare("SELECT name, value FROM setting WHERE name LIKE '%linkedin_app%'", NULL, FALSE);
		return $apps;
	}

	public static function checkRequiredParameters()
	{
		$params = getDB()->prepare("SELECT count(*) as exist FROM setting WHERE name = 'linkedin_config_app'", NULL, TRUE);
		return ( $params->exist == 1 ? TRUE : FALSE );
	}

	public static function deleteApp($app_id)
	{
		$delete_app = getDB()->delete('setting', 'name', $app_id);
		return ( $delete_app == 1 ? TRUE : FALSE);
	}

	public static function clean($string) {
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

}
