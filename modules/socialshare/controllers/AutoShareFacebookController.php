<?php
/**
 * AutoShareController
 *
 * @author saleh
 *
 * @package modules.Socialshare.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Socialshare\Controllers;

use App\Controllers\Controller;
use Modules\Socialshare\Config\Social;

class AutoShareFacebookController extends Controller
{

  private $config = NULL;

  public function __construct()
  {
    //$this->config = Social::getConfig();
  }

  public function share()
  {
  	$link = "https://www.facebook.com/dialog/oauth?client_id=505499076531643&redirect_uri=http://localhost/socialshare/facebook/share/page";
    header('location: '. $link);
  }

  public function getCode()
  {
  	die(var_dump($_GET['code']));
  }

} // END Class