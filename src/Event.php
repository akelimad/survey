<?php
/**
 * Event
 * 
 * Manage events
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.event
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Event
{

    public static $events = [];


    /** 
     * Add new event
     *
     * @param string $name
     * @param array $callable
     *
     * @author Mhamed Chanchaf
     */
    public static function add($name, $callable)
    {
        return self::$events[$name][] = $callable;
    }


    /** 
     * Get registered events
     *
     * @author Mhamed Chanchaf
     */
    public static function getEvents()
    {
        return self::$events;
    }


    /** 
     * Execute event
     *
     * @param string $name
     * @param array $args
     *
     * @author Mhamed Chanchaf
     */
    public static function trigger($name, $args=[])
    {
        $events = self::getEvents();
        if( !isset($events[$name]) )
            return false;

        $listeners = $events[$name];
        foreach ($listeners as $key => $listener) {
            if( is_array($listener) && !empty($listener) ) {
                $controller = $listener[0];
                $method = $listener[1];
                if ( method_exists($controller, $method) && is_callable($listener)) {
                    call_user_func_array(array(new $controller(), $method), [$args]);
                }
            } else if( is_callable($listener) ) {
                call_user_func_array($listener, [$args]);
            }   
        }
    }


    
} //End class