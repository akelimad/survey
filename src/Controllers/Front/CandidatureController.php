<?php
/**
 * CandidatureController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;

class CandidatureController extends Controller
{


  public function deleteSpontanee($data)
  {
    $candidature = getDB()->prepare("SELECT * FROM candidature_spontanee WHERE candidats_id=? AND id_candidature=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($candidature->id_candidature)) {
      return $this->jsonResponse('error', 'Impossible de supprimer la candidature.');
    }

    getDB()->delete('candidature_spontanee', 'id_candidature', $data['id']);

    return $this->jsonResponse('success', 'La candidature a été bien supprimé.');
  }


	public function deleteStage($data)
	{
    $candidature = getDB()->prepare("SELECT * FROM candidature_stage WHERE candidats_id=? AND id_candidature=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($candidature->id_candidature)) {
      return $this->jsonResponse('error', 'Impossible de supprimer la candidature.');
    }

    getDB()->delete('candidature_stage', 'id_candidature', $data['id']);

    return $this->jsonResponse('success', 'La candidature a été bien supprimé.');
	}

	
} // END Class