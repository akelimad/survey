<?php
/**
 * Route
 *
 * @author mchanchaf
 *
 * @package app.route
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Route
{

	private static $routes = [];


	public static function add($url, $callback, $is_ajax = false, $can_access = true)
	{
		self::$routes[$url] = [
			'callback' => $callback,
			'is_ajax' => $is_ajax,
      'can_access' => $can_access
		];
	}


	public static function dispach()
	{
    // admin auth
    if (isBackend() && !isLogged('admin')) return redirect('backend/login');

    $route = self::getRouteParams();
    if(!$route) return get_view('errors/404');

    if($route['is_ajax'] && !is_ajax()) {
      header('HTTP/1.0 403 Forbidden');
      exit;
    }
    if(!$route['can_access']) return redirect('/');

		$callable = explode('@', $route['callback']);
		if(!isset($callable[1])) return get_view('errors/404');

		$controller = $callable[0];
		$method = $callable[1];
		$params = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;
		if ( method_exists($controller, $method) && is_callable($callable)) {
			if( is_ajax() ) {
				header('HTTP/1.1 200 OK');
				echo call_user_func_array([new $controller(), $method], [$params]);
			} else {
				call_user_func_array([new $controller(), $method], [$params]);
			}
		} else {
      get_view('errors/404');
    }
	}


  public static function getRoute()
  {
    $route = strtok($_SERVER['REQUEST_URI'], '?');

    if(PHYSICAL_URI != '/') {
      $route = str_replace(PHYSICAL_URI, '', $route);
    }
    
    return ($route == '' || $route == '/') ? '/' : trim($route, '/');
  }


	public static function getRouteParams()
	{
		$route = self::getRoute();
		foreach(self::$routes as $k => $v) {
      $patern = '!^'. $k .'$!';
      if (preg_match($patern, $route)) {
        return self::$routes[$k];
      }
    }
    return false;
	}

}