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
use App\Session;
use Modules\Socialshare\Models\Share;
use Modules\Socialshare\Config\Social;
use Modules\Socialshare\Models\LinkedInOAuth2;

class AutoShareLinkedinController extends Controller
{

  private $config = NULL;
  private $Auth2linkedin = NULL;

  public function __construct()
  {
    $this->config = Social::getConfig();
    $this->Auth2linkedin = new LinkedInOAuth2();
  }

  public function view()
  {
    $this->publishPost();
    $this->data['layout'] = (isBackend()) ? 'admin' : 'front';
    $this->data['apps'] = Share::getApps();
    $this->data['breadcrumbs'] = [
      trans("Gestion de partage"),
      trans("linkedin")
    ];

    return get_page('common/socialshare/index', $this->data, __FILE__);
  }

  public function addconfig($data)
  {
    Session::set('app_infos', array(
      'CLIENT_ID'     => $data['client_id'],
      'CLIENT_SECRET' => $data['client_secret'],
      'REDIRECT_URI'  => $data['redirect_uri'],
      'SHARE_IN'      => $data['share_in'],
      'COMPANY_ID'    => ( isset($data['company_id']) ? $data['company_id'] : NULL)
    ));
    $this->generateCodeForToken();
 }

 public function generateCodeForToken($token_expired = FALSE)
  {
   ( $token_expired === TRUE ? Session::set('token_expired', $token_expired) : '' );
   $app_infos = Session::get('app_infos');
   $link = $this->Auth2linkedin->getAuthorizeUrl($app_infos['CLIENT_ID'], $app_infos['REDIRECT_URI'], $this->config->SCOPE);
   header('location: '. $link);
   exit;
 }

 public function getcode()
  {
   $code = $_GET['code'];
   if (isset($code)) {
     $app_infos = Session::get('app_infos');
     $response = $this->Auth2linkedin->getAccessToken($app_infos['CLIENT_ID'], $app_infos['CLIENT_SECRET'], $app_infos['REDIRECT_URI'], $code);
     $obj_token = [ 'access_token' => $response['access_token'], 'expires_in' => time() + $response['expires_in'] ];
     if ($obj_token['access_token'] == NULL) {
      set_flash_message('error', trans('Veuillez vérifier vos paramètres(Client ID + Client Secret + Redirect_URI) pour créer l\'application'));
      redirect( site_url(). 'backend/socialshare/linkedin/gestion' );
     }
     if ( count($obj_token) > 0 AND !empty($obj_token['access_token']) AND !empty($obj_token['expires_in']) ) {
      $this->Auth2linkedin = new LinkedInOAuth2($obj_token['access_token']);
      $result_profil = $this->Auth2linkedin->getProfilByToken();
      $result_company = $this->Auth2linkedin->getCompany($app_infos['COMPANY_ID']);
      if( $app_infos['SHARE_IN'] == 'profil' ) {
        Session::set('profil_infos', array(
        'profil_ID'      => $result_profil['id'],
        'firstName'      => Share::clean($result_profil['firstName']),
        'lastName'       => Share::clean($result_profil['lastName']),
        'pictureUrl'     => $result_profil['pictureUrl'],
        'share_in'       => 'profil',
        'publish_status' => 'play',
        'token'          => $obj_token['access_token'],
        'expires_in'     => $obj_token['expires_in']
        ));
      } elseif ($app_infos['SHARE_IN'] == 'company') {
        Session::set('profil_infos', array(
        'profil_ID' => $result_company['id'],
        'logoUrl'    => $result_company['logoUrl'],
        'name'       => $result_company['name'],
        'share_in'   => 'company',
        'publish_status' => 'play',
        'token'      => $obj_token['access_token'],
        'expires_in' => $obj_token['expires_in']
        ));
      } else {
        Session::set('profil_infos', array(
        'profil_ID'  => $result_profil['id'],
        'firstName'  => Share::clean($result_profil['firstName']),
        'lastName'   => Share::clean($result_profil['lastName']),
        'pictureUrl' => $result_profil['pictureUrl'],
        'company_ID' => $result_company['id'],
        'logoUrl'    => $result_company['logoUrl'],
        'name'       => $result_company['name'],
        'share_in'   => 'company+profil',
        'publish_status' => 'play',
        'token'      => $obj_token['access_token'],
        'expires_in' => $obj_token['expires_in']
        ));
      }
      $alert = Share::saveApp();
      if (!isset($_SESSION['token_expired'])) {
        set_flash_message($alert['etat'], trans($alert['message']));
        redirect( site_url(). 'backend/socialshare/linkedin/gestion' );
      }
     } else {
      set_flash_message('error', trans("Une erreur est survenue lors de partage de l'offre veuillez réessayer plus tard!"));
      redirect( site_url(). 'backend/socialshare/linkedin/gestion' );
     }
   }
 }

 public function publishPost()
 {
  $post = array(
    'title' => 'Test work app',
    'comment' => 'This is the comment',
    'submitted-url' => site_url(''),
    'submitted-image-url' => 'http://biomattitude.com/wp-content/uploads/2016/02/recrutement.jpg',
    'description' => 'Test work description'
  );
  foreach (Share::getApps() as $app) {
    $app = json_decode($app->value, TRUE);
    if ($app['publish_status'] == 'stop') {
      continue;
    }
    if (time() > $app['expires_in']) {
      $this->generateCodeForToken(TRUE);
      unset($_SESSION['token_expired']);
    }
    $this->Auth2linkedin = new LinkedInOAuth2($app['token']);
    if ($app['share_in'] == 'profil') {
      $this->Auth2linkedin->shareStatus($post);
    } elseif ($app['share_in'] == 'company') {
      $this->Auth2linkedin->postToCompany($app['profil_ID'], $post);
    } else {
      $this->Auth2linkedin->shareStatus($post);
      $this->Auth2linkedin->postToCompany($app['profil_ID'], $post);
    }
  }
 }

 public function deleteApp($data)
 {
  if (Share::deleteApp($data['app_id'])) {
    return $this->jsonResponse('success', trans("Votre application à bien été supprimé"));
  } else {
    return $this->jsonResponse('success', trans("Erreur lors de la suppression de votre application réessayer plus tard!"));
  }
 }

 public function setPublishStatus($data)
 {
  $app_json = get_setting($data['app_id']);
  $app_infos = json_decode(get_setting($data['app_id']), TRUE);
  $app_infos['publish_status'] = $data['new_status'];
  create_setting($data['app_id'], json_encode($app_infos));
 }

} // END Class