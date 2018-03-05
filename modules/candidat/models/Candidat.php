<?php
/**
 * Candidat
 *
 * @author mchanchaf
 *
 * @package modules.candidatures.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Candidat\Models; 

use App\Models\Model;
use App\Session;

class Candidat extends Model {

	public static function canUpdateAccount($candidat=null)
	{
		if( is_null($candidat) ) {
			$candidat = getDB()->findOne('candidats', 'candidats_id', Session::get('abb_id_candidat'));
		} else {
			$candidat = (object) $candidat; 
		}
		return (isset($candidat->can_update_account) && $candidat->can_update_account == 1);
	}


} // End model