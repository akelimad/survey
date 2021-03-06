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


	public static function add($urls, $callback, $is_ajax = false, $can_access = true)
	{
    if (!is_array($urls)) $urls = [$urls];

    foreach ($urls as $key => $url) {
  		self::$routes[$url] = [
  			'callback' => $callback,
  			'is_ajax' => $is_ajax,
        'can_access' => $can_access
  		];
    }
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

    // Extract url params
    $uri = strtok(get_current_url(), '?');
    $uri = str_replace(site_url(), '', $uri);
    $patern = '!^'. str_replace('/', '\/', $route['name']) .'$!';
    preg_match($patern, $uri, $matches);
    if (count($matches) > 1) {
      unset($matches[0]);
      $params['params'] = $matches;
    }
    
		if ( method_exists($controller, $method) && is_callable($callable)) {
			if( is_ajax() ) {
				header('HTTP/1.1 200 OK');
        $response = call_user_func_array([new $controller(), $method], [$params]);
        if (is_array($response)) $response = json_encode($response);
				echo $response;
			} else {
				return call_user_func_array([new $controller(), $method], [$params]);
			}
		} else {
      return get_view('errors/404');
    }
	}


  public static function getRoutes()
  {
    return self::$routes;
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
		$route = preg_replace('!\.php$!', '', self::getRoute());
		foreach(self::$routes as $k => $v) {
      $patern = '!^'. $k .'$!';
      if (preg_match($patern, $route)) {
        return ['name' => $k] + self::$routes[$k];
      }
    }
    return false;
	}

}