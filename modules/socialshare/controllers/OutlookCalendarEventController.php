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
use Modules\Socialshare\Models\Share;
use Modules\Socialshare\Config\Social;
use Modules\Socialshare\Models\LinkedInOAuth2;

class OutlookCalendarEventController extends Controller
{

  private $config = NULL;

  public function __construct()
  {
    //$this->config = Social::getConfig();
  }

  public function event()
  {
  	$link = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=60af2d04-993c-4dc4-ae35-fb4a7c1f5150&redirect_uri=https://etalent.local/socialshare/outlook/calendar/codeF&response_type=code&scope=openid+Mail.Read";
    header('location: '. $link);
  }

  public function getCode()
  {
  	die(var_dump($_GET['code']));
  }

} // END Class