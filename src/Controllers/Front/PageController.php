<?php
/**
 * PageController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.controllers.front
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Front;

use App\Controllers\Controller;

class PageController extends Controller
{


	public function terms()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Mentions légales'];
		$this->data['titre_site'] = $GLOBALS['etalent']->config['titre_site'];
		$this->data['terms_site_title'] = get_setting('terms_site_title', 'E-talent');
    	return get_page('front/page/terms', $this->data);
	}


	public function conditions()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Conditions générales d\'utilisation'];
		$this->data['titre_site'] = $GLOBALS['etalent']->config['titre_site'];
		$this->data['terms_site_title'] = get_setting('terms_site_title', 'E-talent');
    	return get_page('front/page/conditions', $this->data);
	}


	public function sitemap()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Plan du site'];
    	return get_page('front/page/sitemap', $this->data);
	}


	public function contact()
	{
		$this->data['layout'] = 'front';
		$this->data['breadcrumbs'] = ['Accueil', 'Contactez nous'];
    	return get_page('front/page/contact', $this->data);
	}




	
} // END Class