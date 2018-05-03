<?php
/**
 * EventController
 *
 * @author mchanchaf
 *
 * @package modules.socialshare.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Socialshare\Controllers;

use App\Event;
use Modules\Socialshare\Models\Share;
use Modules\Socialshare\Models\LinkedInOAuth2;

class EventController
{

	private static $_instance = null;


	public function __construct()
	{
		Event::add('offer_published', [$this, 'publishPost']);
	}
	

	public static function getInstance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}


	public function publishPost($offer_id)
	{
		dump($offer_id);
		$offer = getDB()->findOne('offre', 'id_offre', $offer_id);
		if (!isset($offer->id_offre)) return;

		$post = array(
			'title' => $offer->Name,
			'comment' => $offer->Details,
			'submitted-url' => site_url(),
			'submitted-image-url' => module_url(__FILE__, 'assets/img/post-img.jpg'),
			'description' => $offer->description
		);

		foreach (Share::getApps() as $app) {
			$app = json_decode($app->value, true);

			if ($app['publish_status'] == 'stop') continue;

			if (time() > $app['expires_in']) {
				$this->generateCodeForToken(true);
				unset($_SESSION['token_expired']);
			}

			$this->Auth2linkedin = new LinkedInOAuth2($app['token']);
			switch ($app['share_in']) {
				case 'profil':
					$this->Auth2linkedin->shareStatus($post);
					break;
				case 'company':
					$this->Auth2linkedin->postToCompany($app['profil_ID'], $post);
					break;
				default:
					$this->Auth2linkedin->shareStatus($post);
					$this->Auth2linkedin->postToCompany($app['profil_ID'], $post);
					break;
			}
		}
	}


} // END Class