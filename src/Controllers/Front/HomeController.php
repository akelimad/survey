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
    	return get_page('front/home/index', $this->data);
	}


	
} // END Class