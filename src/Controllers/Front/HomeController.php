<?php
/**
 * HomeController
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
use App\Ajax;
use App\Media;
use App\Mail\Mailer;

class HomeController extends Controller
{


	public function index()
	{
    $this->data['layout'] = 'front';
    $this->data['breadcrumbs'] = ['Accueil'];
    $this->data['offers'] = getDB()->prepare("
      SELECT o.id_offre, o.reference, o.Name, o.date_expiration, o.Profil, f.fonction
      FROM offre o JOIN prm_fonctions f 
      ON f.id_fonc = o.id_fonc
      WHERE o.status=? AND DATE(o.date_expiration) >= CURDATE()
      ORDER BY o.date_insertion
      DESC LIMIT 0, 5
    ", ['En cours']);
    return get_page('front/home/index', $this->data);
	}


	
} // END Class