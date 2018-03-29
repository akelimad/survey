<?php
/**
 * AuthController
 *
 * @author mchanchaf
 *
 * @package app.controllers.admin
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers\Admin;

use App\Controllers\Controller;

class AuthController extends Controller
{


  public function logout($data)
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    session_destroy();
    redirect('backend/login/');
  }

  
} // END Class