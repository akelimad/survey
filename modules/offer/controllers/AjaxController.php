<?php
/**
 * AjaxController
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package modules.offer.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Controllers;

use App\Ajax;
use Modules\Offer\Models\Fiche;

class AjaxController extends Ajax
{

  private static $_instance = null;


  public function __construct()
  {
    Ajax::add('offer_share_popup', [$this, 'showSharePopup']);
  }
  

  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self;
    }
    return self::$_instance;
  }

  /**
   * Show note orale popup
   * 
   * @author M'hamed Chanchaf
   */
  public function showSharePopup($data)
  {
    if( empty($data['id_offer']) ) return [];

    echo self::renderAjaxView('Partager un offre', 'admin/offer/popup/share', [
      'id_offer' => $data['id_offer'], 
      'users' => getDB()->findByColumn('root_roles', 'id_type_role', 2)
    ], __FILE__);
  }
  

} // END Class