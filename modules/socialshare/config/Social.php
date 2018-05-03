<?php
/**
 * Social
 *
 * @author saleh
 *
 * @package modules.Socialshare.config
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Socialshare\Config;

class Social {

  /*--------------------- LinkedIn API ATTRIBUTS config ---------------------*/
  public $CLIENT_ID     = NULL;
  public $CLIENT_SECRET = NULL;
  public $REDIRECT_URI  = NULL;
  public $COMPANY_ID    = NULL;
  public $SCOPE         = NULL;

  public static function getConfig()
  {
  	$setting = get_setting();
  	$linkedin_config = new Social();
  	$linkedin_config->CLIENT_ID = $setting['linkedin_client_id'];
  	$linkedin_config->CLIENT_SECRET = $setting['linkedin_client_secret'];
  	$linkedin_config->REDIRECT_URI = $setting['linkedin_redirect_uri'];
  	$linkedin_config->COMPANY_ID = $setting['linkedin_company_id'];
  	$linkedin_config->SCOPE = $setting['linkedin_scope'];
  	return $linkedin_config;
  }

}