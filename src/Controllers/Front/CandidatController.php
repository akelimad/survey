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

  private $rules = [
    'id_civi' => 'required|numeric',
    'id_pays' => 'required|numeric',
    'id_situ' => 'required|numeric',
    'id_sect' => 'required|numeric',
    'id_fonc' => 'required|numeric',
    'id_salr' => 'required|numeric',
    'id_nfor' => 'required|numeric',
    'id_tfor' => 'required|numeric',
    'id_dispo' => 'required|numeric',
    'id_expe' => 'required|numeric',
    'titre' => 'required|eta_alpha_numeric|min_len,3|max_len,255',
    'nom' => 'required|valid_name|min_len,3|max_len,32',
    'prenom' => 'required|valid_name|min_len,3|max_len,32',
    'date_n' => 'required', // |date|min_age,17
    'adresse' => 'required|eta_alpha_numeric|max_len,255',
    'code' => 'numeric|max_len,10',
    'ville' => 'required|alpha',
    'nationalite' => 'required|alpha|max_len,16',
    'cin' => 'required|alpha_numeric',
    'tel1' => 'required|phone_number',
    'tel2' => 'phone_number',
    'mobilite' => 'required|alpha',
    'niveau_mobilite' => 'required|numeric',
    'taux_mobilite' => 'required|numeric'
  ];


  private $field_names = [
    'id_civi' => 'Civilité',
    'id_pays' => 'Pays de résidence',
    'id_situ' => 'Situation actuelle',
    'id_sect' => 'Secteur actuel',
    'id_fonc' => 'Fonction',
    'id_salr' => 'Salaire souhaité',
    'id_nfor' => 'Niveau de formation',
    'id_tfor' => 'Type de formation',
    'id_dispo' => 'Disponibilité',
    'id_expe' => 'Expérience',
    'titre' => 'Titre de votre profil',
    'nom' => 'Nom',
    'prenom' => 'Prénom',
    'date_n' => 'Date de naissance',
    'adresse' => 'Adresse',
    'code' => 'Code postal',
    'ville' => 'Ville',
    'nationalite' => 'Nationalité',
    'cin' => 'CIN',
    'tel1' => 'Téléphone',
    'tel2' => 'Téléphone secondaire',
    'mobilite' => 'Mobilité géographique',
    'niveau_mobilite' => 'Niveau de mobilité',
    'taux_mobilite' => 'Taux de mobilité'
  ];


  public function account()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon compte'];
    return get_page('front/candidat/account/index', $this->data);
  }


  public function informations($data)
  {
    if (is_ajax() && form_submited()) {
      Validator::set_field_names($this->field_names);

      $is_valid = Validator::is_valid($data, $this->rules);
      
      if(is_array($is_valid)) {
        return $this->jsonResponse('error', $is_valid);
      }

      $data['date_n'] = \english_to_french_date($data['date_n']);

      getDB()->update('candidats', 'candidats_id', get_candidat_id(), $data, false);

      return $this->jsonResponse('success', 'Vos informations personnalles ont été bien mis à jour.');

    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Informations personnalles'];

      $this->data['villes'] = getDB()->read('prm_villes');
      $this->data['pays'] = getDB()->read('prm_pays');
      $this->data['sectors'] = getDB()->read('prm_sectors');
      $this->data['niv_formation'] = getDB()->read('prm_niv_formation');

      return get_page('front/candidat/cv/informations/index', $this->data);
    }
  }


  public function languages()
  {
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil', 'Candidat', 'Mon CV', 'Langues et piéces joints'];
    return get_page('front/candidat/cv/langues_pj/index', $this->data);
  }


  public function deletePhoto($data)
  {
    unlinkFile(site_base('apps/upload/frontend/photo_candidats/'. $data['photo']));

    getDB()->update('candidats', 'candidats_id', get_candidat_id(), ['photo' => null]);

    return $this->jsonResponse('success', 'La photo a été bien supprimé.');
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

	
} // END Class