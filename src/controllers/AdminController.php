<?php
/**
 * AdminController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers;


class AdminController extends Controller
{


	public function __construct() {
    if( !isLogged('admin') ) {
      redirect('backend/login');
    }
  }


} // END Class