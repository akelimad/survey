<?php
/** 
 * Ajax Controller
 *
 * @author Mhamed Chanchaf
 */
namespace App\Controllers; 

use \App\Controllers\Controller;


class AjaxController extends Controller
{
	
    public static $actions = [];


	/** 
	 * Add new ajax action
	 *
	 * @param string $name
	 * @param array $callable
	 *
	 * @author Mhamed Chanchaf
	 */
    public static function addAction($name, $callable)
    {
        return self::$actions[$name] = $callable;
    }


    /** 
	 * Get registered ajax actions
	 *
	 * @author Mhamed Chanchaf
	 */
    public static function getActions()
    {
        return self::$actions;
    }


    /** 
	 * Execute ajax action
	 *
	 * @param string $name
	 * @param array $args
	 *
	 * @author Mhamed Chanchaf
	 */
    public static function doAction($name, $args=[])
    {
        $actions = self::getActions();
        if( !isset($actions[$name]) )
            return false;

        $callable = $actions[$name];

        if( is_array($callable) && !empty($callable) ) {
            // $controller = key($callable);
            // $method = reset($callable);
            $controller = $callable[0];
            $method = $callable[1];
            if ( method_exists($controller, $method) && is_callable($callable)) {
                return call_user_func_array(array(new $controller(), $method), [$args]);
            }

        } else if( is_callable($callable) ) {
            return call_user_func_array($callable, [$args]);
        }
        return false;
    }



} // END Class