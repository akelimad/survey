<?php
/**
 * EventController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.fiches.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use App\Event;
use App\View;
use Modules\Fiches\Models\Fiche;

class EventController
{

	private static $_instance = null;

	private $ficheTypes = [];

	public function __construct()
	{
		$this->ficheTypes = Fiche::getTypes();

		// Offre events
		Event::add('after_offre_fields', [$this, 'afterOffreFields']);
		Event::add('offre_form_submit', [$this, 'afterFormSubmit']);
		
		// Candidature change status events
		Event::add('change_status_form_fields', [$this, 'changeStatusFormFields']);
		Event::add('change_status_form_submit', [$this, 'changeStatusFormSubmit']);
	}
	

	public static function getInstance()
	{
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
	}


	public function afterOffreFields($args)
	{
		return View::get('admin/offre/fields', [
			'fiche' 	 => $fiche,
			'ficheTypes' => $this->ficheTypes,
			'id_offre'   => $args['id_offre'] ?: null
		], __FILE__);
	}


	public function afterFormSubmit($args)
	{
		if( isset($args['id_offre']) && !empty($args['data']['offre_fiche_type']) ) {
			$db = getDB();
			foreach ($args['data']['offre_fiche_type'] as $key => $id_fiche) {
				if( $id_fiche == '' || !is_numeric($id_fiche) ) continue;
				if( !$db->exists('fiche_offre', 'id_fiche', $id_fiche) ) {
					$db->create('fiche_offre', [
						'id_fiche' => $id_fiche,
						'id_offre' => $args['id_offre'] ?: null
					]);
				}
			}
		}
	}


	public function changeStatusFormFields($args)
	{
		$id_candidature = $args['candidature']->id_candidature;
		return View::get('admin/candidature/fields', [
			'ficheTypes' => $this->ficheTypes,
			'fiche_candidature' => getDB()->findOne('fiche_candidature', 'id_candidature', $id_candidature) ?: new \stdClass,
			'id_candidature' => $id_candidature
		], __FILE__);
	}


	public function changeStatusFormSubmit($args)
	{
		/*if( isset($args['id_offre']) && !empty($args['data']['offre_fiche_type']) ) {
			$db = getDB();
			foreach ($args['data']['offre_fiche_type'] as $key => $id_fiche) {
				if( $id_fiche == '' || !is_numeric($id_fiche) ) continue;
				if( !$db->exists('fiche_offre', 'id_fiche', $id_fiche) ) {
					$db->create('fiche_offre', [
						'id_fiche' => $id_fiche,
						'id_offre' => $args['id_offre'] ?: null
					]);
				}
			}
		}*/
	}






  
} // END Class