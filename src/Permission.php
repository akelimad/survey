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

use Modules\Candidatures\Models\Candidature;
use Modules\Offer\Models\Offer;
use App\Route;

class Permission
{

  public static function canViewPage()
  {
    if(isAdmin()) return true;

    return self::allowed();
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
    $allowedRoutes = [
      'backend/login', 
      'backend/accueil', 
      'backend/cv', 
      'backend/module/candidatures/candidat/lettre/([0-9]+)',
      'backend/module/candidatures/candidat/cv/([0-9]+)'
    ];
    if (read_session('menu7', 0) == 1) {
      $allowedRoutes[] = 'backend/administration/champs_editables_root/([a-zA-Z_-]+)';
    }
    $menuLinks = require( site_base('src/includes/data/adminMenuLinks.php') );
    for ($i=1; $i < 8; $i++) {
      if (read_session('menu'. $i, 0) == 1) {
        $allowedRoutes[] = $menuLinks[$i-1]['route'];
        if (isset($menuLinks[$i-1]['childrens'])) {
          $menuRoutes = array_column($menuLinks[$i-1]['childrens'], 'route');
          $allowedRoutes = array_merge($allowedRoutes, preg_replace('{/$}', '', $menuRoutes));
        }
      }
    }
    return array_merge($allowedRoutes, Candidature::getUserStatusUrls(), Offer::getSharedOffersUrls());
  }

}