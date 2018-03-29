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
    erase_session('abb_admin');
    erase_session('id_role');
    erase_session('id_type_role');
    erase_session('ref_filiale_role');
    erase_session('query_ref_fili');
    erase_session('query_ref_fili_and');
    erase_session('compte_v');
    erase_session('menu1_c');
    erase_session('menu2_c');
    erase_session('menu3_c');
    erase_session('menu4_c');
    erase_session('menu5_c');
    erase_session('menu6_c');
    erase_session('menu7_c');
    erase_session('menu1');
    erase_session('menu2');
    erase_session('menu3');
    erase_session('menu4');
    erase_session('menu5');
    erase_session('menu6');
    erase_session('menu7');
    redirect('backend/login/');
  }

  
} // END Class