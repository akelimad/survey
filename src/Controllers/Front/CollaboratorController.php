<?php
/**
 * CollaboratorController
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

class CollaboratorController extends Controller
{

  protected $data;

  public function register($params)
  {
    if (form_submited()) {
      

    } else {
      $this->data['layout'] = 'front';
      $this->data['breadcrumbs'] = [trans("Accueil"), trans("Je suis un collaborateur")];
      return get_page('front/candidat/collaborator/register', $this->data);
    }
  }
	
} // END Class