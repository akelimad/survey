<?php
/**
 * Ajax
 * 
 * Manage Ajax calls
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.ajax
 * @version 1.0
 * @since 1.5.0
 */
namespace App;


class Ajax
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
    public static function add($name, $callable)
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
	 * Trigger ajax action by name
	 *
	 * @param string $name
	 * @param array $args
	 *
	 * @author Mhamed Chanchaf
	 */
    public static function trigger($name, $args=[])
    {
        $actions = self::getActions();
        if( !isset($actions[$name]) )
            return false;

        $callable = $actions[$name];
        if( is_array($callable) && !empty($callable) ) {
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

    
    public function renderAjaxView($title, $viewPath, $variables=[], $file = null)
    {
        ob_start();
        get_view($viewPath, $variables, $file);
        $content = ob_get_clean();
        $response = ['content' => $content, 'title' => $title, 'data' => $variables];
        if(isset($variables['status'])) $response['status'] = $variables['status'];
        if(isset($variables['message'])) $response['message'] = $variables['message'];
        return json_encode($response);
    }


} // END Class