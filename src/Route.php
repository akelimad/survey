<?php
/**
 * Route
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.route
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Route
{

	private static $routes = [];


	public static function add($url, $callback)
	{
		self::$routes[$url] = $callback;
	}


	public static function dispach()
	{
		$route = Permission::getRoute();
		if(!isset(self::$routes[$route])) return;

		$callable = explode('@', self::$routes[$route]);
		if(!isset($callable[1])) return;

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
			exit;
		}
	}

}