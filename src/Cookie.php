<?php
/**
 * Cookie
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.cookie
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Cookie
{
    
	/**
     * Singleton int
     * @var Singleton $instance
     */
    private static $instance;


    /**
     * GET THEME INSTANCE
     * @return object $instance
     */
    public static function getInstance()
    {
        if( is_null(self::$instance) ){
            self::$instance = new Cookie();
        }
        return self::$instance;
    }


	/**
     * GET COOKIE BY KEY
     * @param $key int
     * @return $key || false
     */
	public static function get($key){
        if( array_key_exists($key, $_COOKIE) && !empty($_COOKIE[$key]) ){
            global $_COOKIES;
            $cookie_value = $_COOKIE[$key];
            $data = @unserialize($cookie_value);
            if ($data !== false) {
                return $data;
            } else {
                return $cookie_value;
            }
        }

        return false;		
	}


    /**
     * SET COOKIE KEY
     * @param $key int
     * @param $value int
     * @return boolean
     */
    public static function set($key, $value, $expire=null, $path=null){
        if( $key == '' || $value == '' )
            return false;

        if( is_null($expire) ) $expire = time()+60*60*24*30;
        if( is_null($path) ) $path = PHYSICAL_URI;

        $serialized = serialize($value);
        return setcookie($key, $serialized, $expire, $path);
    }


    /**
     * COOKIE DESTROY ELEMENT
     * @param $key int
     * @return boolean
     */
    public static function destroy($key){
        if( !self::get($key) )
            return false;

        //empty value and expiration one hour before
        unset($_COOKIE[$key]);
        setcookie($key, '', time() - 3600, PHYSICAL_URI);
        return true;
    }



//END CLASS
}