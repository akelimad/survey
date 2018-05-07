<?php
/**
 * EventController
 *
 * @author mchanchaf
 *
 * @package modules.fiches.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Controllers;

use App\Event;
use App\View;
use App\Session;
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
		Event::add('change_status_form_submit', [$this, 'candidatureFormSubmit']);

	}
	

	public static function getInstance()
	{
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
	}


	public function afterOffreFields($data)
	{
		$fiche = new \stdClass;
		if (isset($data['id_offre'])) {
			// TODO - Get fiche by offer ID
			// $fiche = Fiche::getOffreFicheByType($data['id_offre'], '');
		}
		return View::get('admin/offre/fields', [
			'fiche' 	 => $fiche,
			'ficheTypes' => $this->ficheTypes,
			'id_offre'   => (isset($data['id_offre'])) ? $data['id_offre'] : null
		], __FILE__);
	}


	public function afterFormSubmit($data)
	{
		if( !isset($data['id_offre']) || empty($data['data']['offre_fiche_type']) ) return;

		$db = getDB();
		$id_offre = $data['id_offre'];
		foreach ($data['data']['offre_fiche_type'] as $fiche_type => $id_fiche) {
			if( $id_fiche == '' || !is_numeric($id_fiche) ) {
				if (Fiche::canChangeOffreFiche($id_offre, $fiche_type)) {
					$fid = Fiche::getOffreFicheByType($id_offre, $fiche_type);
					if (!is_null($fid)) {
						$db->prepare("DELETE FROM fiche_offre WHERE id_fiche=? AND id_offre=?", [$fid, $id_offre]);
					}
				} else {
					set_flash_message('warning', sprintf(trans("Impossible de détacher la fiche N°%s parce qu'elle a déja utilisé."), $fid));
				}
			} else {
				$count = $db->prepare("SELECT COUNT(*) AS nbr FROM fiche_offre WHERE id_fiche=? AND id_offre=?", [$id_fiche, $id_offre], true);
				if( $count->nbr == 0 ) {
					$db->create('fiche_offre', ['id_fiche' => $id_fiche, 'id_offre' => $id_offre]);
				}
			}
		}
	}


	public function changeStatusFormFields($data)
	{
		$db = getDB();
		$fiche_offre = $db->prepare("SELECT f.name, f.id_fiche FROM fiche_offre fo JOIN fiches f ON f.id_fiche=fo.id_fiche WHERE f.fiche_type=? AND fo.id_offre=?", [0, $data['candidature']->id_offre], true);
		$id_candidature = $data['candidature']->cid;
		$fiche_candidature = $db->findOne('fiche_candidature', 'id_candidature', $id_candidature) ?: new \stdClass;

		return View::get('admin/candidature/fields', [
			'ficheTypes' => $this->ficheTypes,
			'fiche_candidature' => $fiche_candidature,
			'id_candidature' => $id_candidature,
			'fiche_offre' => $fiche_offre,
			'id_fiche' => (isset($fiche_offre->id_fiche)) ? $fiche_offre->id_fiche : 0
		], __FILE__);
	}



	public function candidatureFormSubmit($data)
	{
		$id_role = read_session('id_role');
		if( !isset($data['fiche']['blocks']) || empty($data['fiche']['blocks']) || !isset($id_role) ) return;
		
		$db = getDB();
		$currentDate = date("Y-m-d H:i:s");
		$id_candidature = $data['fiche']['id_candidature'];

		// Telle if current Admin has already submit a fiche
		$fcand = $db->prepare("SELECT id_fiche_candidature FROM fiche_candidature WHERE id_fiche=? AND id_candidature=? AND id_evaluator=?", [$data['fiche']['id'], $id_candidature, $id_role], true);

		if( !isset($fcand->id_fiche_candidature) || $data['fiche']['type'] == 0 ) {
			$id_fiche_candidature = $db->create('fiche_candidature', [
				'id_fiche' => $data['fiche']['id'],
				'id_candidature' => $id_candidature,
				'id_historique' => (isset($data['id_historique'])) ? $data['id_historique'] : 0,
				'id_evaluator' => $id_role,
				'comments' => $data['fiche']['comments'],
				'created_at' => $currentDate,
				'updated_at' => $currentDate
			]);
		} else {
			$db->update('fiche_candidature', 'id_fiche_candidature', $fcand->id_fiche_candidature, [
				'comments' => $data['fiche']['comments'],
				'updated_at' => $currentDate
			]);
			$id_fiche_candidature = $fcand->id_fiche_candidature;
		}

		if( intval($id_fiche_candidature) > 0 ) : 
			foreach ($data['fiche']['blocks'] as $id_block => $blockItems) :
				if( !empty($blockItems) ) : foreach ($blockItems as $id_item => $item) :
					$result = $db->prepare("SELECT id_result FROM fiche_candidature_results WHERE id_fiche_candidature=? AND id_block=? AND id_item=?", [$id_fiche_candidature, $id_block, $id_item], true);
					if( !isset($result->id_result) ) {
						$db->create('fiche_candidature_results', [
							'id_fiche_candidature' => $id_fiche_candidature,
							'id_item' => $id_item,
							'id_block' => $id_block,
							'value' => (isset($item['value'])) ? $item['value'] : '',
							'observations' => (isset($item['observations'])) ? $item['observations'] : ''
						]);
					} else {
						$db->update('fiche_candidature_results', 'id_result', $result->id_result, [
							'value' => (isset($item['value'])) ? $item['value'] : '',
							'observations' => (isset($item['observations'])) ? $item['observations'] : ''
						]);
					}
				endforeach; endif;
			endforeach;

			// update note orale
			if(isset($data['fiche']['type']) && $data['fiche']['type'] == 1) $this->updateNoteOrale($id_candidature);

			Session::setFlash('success', trans("La fiche a bien été sauvegardée."));
		else :
			Session::setFlash('danger', trans("Impossible de sauvegarder la fiche."));
		endif;
	}


	public function updateNoteOrale($id_candidature)
	{
		$db = getDB();
	    $note = $db->prepare("
	      SELECT COUNT(fcr.id_result) AS nbr, SUM(fcr.value) AS total
	      FROM fiches f
	      JOIN fiche_candidature fc ON fc.id_fiche=f.id_fiche
	      JOIN fiche_candidature_results fcr ON fcr.id_fiche_candidature=fc.id_fiche_candidature
	      WHERE fc.id_candidature=? AND f.fiche_type=?
	    ", [$id_candidature, 1], true);

	    $db->update('candidature', 'id_candidature', $id_candidature, [
	    	'note_orale' => ($note->total/$note->nbr)
	    ]);
	}


  
} // END Class