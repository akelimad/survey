<?php
/**
 * DashboardController
 *
 * @author mchanchaf
 *
 * @package app.controllers.admin
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Admin;

use App\Ajax;
use App\Controllers\Controller;

class DashboardController extends Controller
{


  public function getStatistics()
  {
    $db = getDB();
    $this->data['layout'] = 'admin';
    $this->data['breadcrumbs'] = ['Accueil', 'Statistiques'];
        
    return get_page('admin/dashboard/statistics', $this->data);
  }

	
} // END Class