<?php
/**
 * Permission
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.permission
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

use Modules\Candidatures\Models\Candidatures;
use Modules\Offer\Models\Offer;

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
    $route = self::getRoute();
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


  public static function getRoute()
  {
    $route = str_replace(PHYSICAL_URI, '', $_SERVER['REQUEST_URI']);
    $route = (PHYSICAL_URI != '/') ? $route : $_SERVER['REQUEST_URI'];
    return ($route == '/') ? $route : trim($route, '/');
  }


}