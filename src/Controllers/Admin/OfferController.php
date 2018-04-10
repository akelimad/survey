<?php
/**
 * OfferController
 *
 * @author mchanchaf
 *
 * @package app.controllers.admin
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Admin;

use App\Controllers\Controller;

class OfferController extends Controller
{


  public function getForm($data)
  {
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = [trans("Offres"), trans("Créer une offre")];
    
    return get_page('admin/offer/form', $this->data);
  }

	
} // END Class