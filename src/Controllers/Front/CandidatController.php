<?php
/**
 * CandidatController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Helpers\Form\Validator;
use App\Models\Candidat;

class CandidatController extends Controller
{


  public function account()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon compte'];
    return get_page('front/candidat/account/index', $this->data);
  }


  public function changePassword($data)
  {
    if(is_ajax() && form_submited()) {

      // Validate passwords
      Validator::set_field_names([
        'current_password' => 'Mot de passe actuel',
        'password' => 'Nouveau mot de passe',
        'confirm_password' => 'Confirmer le nouveau mot de passe'
      ]);

      $is_valid = Validator::is_valid($data, [
        'current_password' => 'required|min_len,6',
        'password' => 'required|min_len,6',
        'confirm_password' => 'required|min_len,6'
      ]);

      if(is_array($is_valid)) {
        return $this->jsonResponse('error', $is_valid);
      }

      // Check password strength
      if( $data['password'] != $data['confirm_password'] ) {
        return $this->jsonResponse('error', 'Les deux mot de passe ne sont pas identique.');
      } elseif (!Candidat::isStrongPassword($data['password'])) {
        return $this->jsonResponse('error', 'Le mot de passe doit contenir les chiffres et des lettres.');
      }

      // Check current password
      $count = getDB()->prepare("SELECT COUNT(*) as nbr FROM candidats WHERE mdp=?", [md5($data['current_password'])], true);
      if(intval($count->nbr) == 0) {
        return $this->jsonResponse('error', 'Le mot de passe actuel est incorrect.');
      }

      // Update password
      getDB()->update('candidats', 'candidats_id', get_candidat_id(), [
        'mdp' => md5($data['password']),
        'nl_partenaire' => $data['password']
      ]);

      return $this->jsonResponse('success', 'Votre mot de passe a été bien mis à jour.');
    }
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mes identifiants'];
    return get_page('front/candidat/account/change-password', $this->data);
  }


  public function formations()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon CV', 'Formations'];
    return get_page('front/candidat/cv/formations', $this->data);
  }

	
} // END Class