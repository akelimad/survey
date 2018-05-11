<?php
/**
 * AlertController
 *
 * @author mchanchaf
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Helpers\Form\Validator;
use App\Ajax;

class AlertController extends Controller
{

  protected $data = [];

	public function form($data)
  {
    $id = intval($data['id']);
    if ( form_submited() && $data['titre'] != '' ) {
      Validator::set_field_names([
        'titre' => trans("Description de l'alerte")
      ]);

      $is_valid = Validator::is_valid($data, [
        'titre' => 'eta_string'
      ]);
      
      if(is_array($is_valid)) {
        return $this->jsonResponse('error', $is_valid);
      }

      if ($id > 0) {
        if ($this->isOwner($data['id'])) {
          getDB()->update('alert', 'id_alert', $data['id'], ['titre' => $data['titre']]);
          return $this->jsonResponse('success', trans("L'alerte a été mis à jour."));
        } else {
          return $this->jsonResponse('error', trans("Vous n'avez pas les permissions pour modifier cette alerte."));
        }
      } else {
        getDB()->create('alert', [
          'candidats_id' => get_candidat_id(),
          'titre' => $data['titre'],
          'date' => date('d/m/Y', time()),
          'activate' => 1
        ]);
        return $this->jsonResponse('success', trans("L'alerte a été créée avec succès."));
      }
    } else {
      $title = trans("Créer une alerte");
      if ($id > 0) {
        $title = trans("Modifier une alerte");
        $this->data['alert'] = getDB()->findOne('alert', 'id_alert', $id);
      }
      return Ajax::renderAjaxView($title, 'front/candidat/alert/form', $this->data);
    }
  }


  public function activate($data)
  {
    if ($this->isOwner($data['id'])) {
      $status = ($data['curStatus'] == 1) ? 0 : 1;
      getDB()->update('alert', 'id_alert', $data['id'], ['activate' => $status]);
      return $this->jsonResponse('success', trans("Le statut a bien été mis à jour."));
    } else {
      return $this->jsonResponse('error', trans("Vous n'avez pas les permissions de mettre à jour le status."));
    }
  }


  public function delete($data)
  {
    if ($this->isOwner($data['id'])) {
      getDB()->delete('alert', 'id_alert', $data['id']);
      return $this->jsonResponse('success', trans("L'alerte a été supprimé."));
    } else {
      return $this->jsonResponse('error', trans("Vous n'avez pas les permissions de supprimer cette alerte."));
    }
  }


  public function isOwner($alert_id)
  {
    $count = getDB()->prepare("SELECT COUNT(*) AS nbr FROM alert WHERE id_alert=? AND candidats_id=?", [$alert_id, get_candidat_id()], true);
    return ($count->nbr > 0);
  }

	
} // END Class