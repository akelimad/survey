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

use App\Ajax;
use App\Mail\Mailer;
use App\Controllers\Controller;
use App\Models\Candidat;

class CandidatureController extends Controller
{

  public function spontanee($data)
  {
    // Check if candiat logged
    if(!isLogged('candidat')) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Connectez-vous !"), 'content' => trans("Vous devez") .' <strong onclick="return chmAuth.loginModal()" style="cursor: pointer;">'. trans("vous connecter") .'</strong> '. trans("pour répondre à cette l'offre.")]);
    }

    // Check if candidat has resume
    if(!Candidat::hasResume()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Profile incomplète!"), 'content' => trans("Il faut avoir renseigné au moins un CV pour pouvoir envoyer la candidature.")]);
    }

    // Check if candidat has formation
    if(!Candidat::hasFormation()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Profile incomplète!"), 'content' => trans("Il faut avoir renseigné au moins une formation pour pouvoir envoyer la candidature.")]);
    }

    // Check if candidat already postuled
    if(Candidat::hasCandidatureSpontannee()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Vous avez déjà deposé une candidature spontanée.")]);
    }

    // Store candidature
    if (form_submited()) {
      if(!isset($data['motivation']) || $data['motivation'] == '') {
        return $this->jsonResponse('error', trans("Vous n'avez pas précisé vos motivations pour cette candidature spontanée!"));
      }

      // Save candidature
      $candidature_id = getDB()->create('candidature_spontanee', [
        'candidats_id' => get_candidat_id(),
        'message' => $data['motivation'],
        'id_cv' => $data['id_cv'],
        'id_fonc' => (isset($data['id_fonc'])) ? $data['id_fonc'] : 0,
        'date_cs' => date('Y-m-d H:i:s')
      ]);

      if ($candidature_id > 0) {
        // Send email
        $template = getDB()->findOne('root_email_auto', 'ref', 'd');
        if(isset($template->id_email)) {
          $variables = Mailer::getVariables(null, null, $candidature_id);
          $subject = Mailer::renderMessage($template->objet, $variables);
          $message = Mailer::renderMessage($template->message, $variables);

          Mailer::send(get_candidat('email'), $subject, $message, [
            'titre' => $template->titre,
            'type_email' => 'Envoi automatique'
          ]);
          return $this->jsonResponse('success', trans("Votre candidature a bien été envoyée."));
        }
      }
      return $this->jsonResponse('error', trans("Une erreur est survenue réessayer plus tard."));
    } else {
      return Ajax::renderAjaxView(trans("Déposer une candidature spontanée"), 'front/candidature/spontanee', $data);
    }
  }


  public function stage($data)
  {
    // Check if candidat has resume
    if(!Candidat::hasResume()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Profile incomplète!"), 'content' => trans("Il faut avoir renseigné au moins un CV pour pouvoir envoyer la candidature.")]);
    }

    // Check if candidat has formation
    if(!Candidat::hasFormation()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Profile incomplète !"), 'content' => trans("Il faut avoir renseigné au moins une formation pour pouvoir envoyer la candidature.")]);
    }

    // Check if candidat already postuled
    if(Candidat::hasCandidatureStage()) {
      return json_encode(['status' => 'hide_form', 'title' => trans("Vous avez déjà deposé une candidature pour un stage.")]);
    }

    // Store candidature
    if (form_submited()) {

      if(!isset($data['stage_subject']) || $data['stage_subject'] == '') {
        return $this->jsonResponse('error', trans("Le champs") ." <b>". trans("Objet du stage") ."</b> ". trans("est obligatoire."));
      }

      if(!isset($data['motivation']) || $data['motivation'] == '') {
        return $this->jsonResponse('error', trans("Le champs") ." <b>". trans("Vos motivations") ."</b> ". trans("est obligatoire."));
      }

      // Save candidature
      $candidature_id = getDB()->create('candidature_stage', [
        'candidats_id' => get_candidat_id(),
        'etat' => 'en attente',
        'ecole' => $data['school'],
        'type' => $data['stage_type'],
        'entite' => $data['direction'],
        'duree' => $data['duree'],
        'motivations' => $data['motivation'],
        'objet' => $data['stage_subject'],
        'date' => date('Y-m-d H:i:s')
      ]);

      if ($candidature_id > 0) {
        // Send email
        $template = getDB()->findOne('root_email_auto', 'ref', 'a');
        if(isset($template->id_email)) {
          $variables = Mailer::getVariables(null, null, $candidature_id);
          $subject = Mailer::renderMessage($template->objet, $variables);
          $message = Mailer::renderMessage($template->message, $variables);

          Mailer::send(get_candidat('email'), $subject, $message, [
            'titre' => $template->titre,
            'type_email' => 'Envoi automatique'
          ]);
          return $this->jsonResponse('success', trans("Votre candidature a bien été envoyée."));
        }
      }
      return $this->jsonResponse('error', trans("Une erreur est survenue réessayer plus tard."));
    } else {
      return Ajax::renderAjaxView(trans("Déposer une candidature pour un stage"), 'front/candidature/stage', $data);
    }
  }


  public function deleteSpontanee($data)
  {
    $candidature = getDB()->prepare("SELECT * FROM candidature_spontanee WHERE candidats_id=? AND id_candidature=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($candidature->id_candidature)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer la candidature."));
    }

    getDB()->delete('candidature_spontanee', 'id_candidature', $data['id']);

    return $this->jsonResponse('success', trans("La candidature a été bien supprimé."));
  }


	public function deleteStage($data)
	{
    $candidature = getDB()->prepare("SELECT * FROM candidature_stage WHERE candidats_id=? AND id_candidature=?", [
      get_candidat_id(),
      $data['id']
    ], true);

    if (!isset($candidature->id_candidature)) {
      return $this->jsonResponse('error', trans("Impossible de supprimer la candidature."));
    }

    getDB()->delete('candidature_stage', 'id_candidature', $data['id']);

    return $this->jsonResponse('success', trans("La candidature a été bien supprimé."));
	}

	
} // END Class