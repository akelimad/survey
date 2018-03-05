<?php
/**
 * Permission
 *
 * @author mchanchaf
 *
 * @package app.permission
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

use Modules\Candidatures\Models\Candidatures;
use Modules\Offer\Models\Offer;
use App\Route;

class Permission
{

  public static function canViewPage()
  {
    if(isAdmin()) return true;

    $id_type_role = \App\Session::get('id_type_role');

    return (self::allowed() && in_array($id_type_role, [1, 2, 3]));
  }

  public static function allowed()
  {
    $route = Route::getRoute();
    $allowedRoutes = self::getAllowedRoutes();

    if (in_array($route, $allowedRoutes))
      return true;

    // Dispatch route 
    foreach($allowedRoutes as $k => $v) {
      $patern = '!^'.$v.'$!';
      if (preg_match($patern, $route)) {
        return true;
      }
    }

    return false;
  }

  public static function getAllowedRoutes()
  {
    return array_merge([
      'backend/login',
      'backend/accueil'
    ], Candidatures::getUserStatusUrls(), Offer::getSharedOffersUrls());
  }

}