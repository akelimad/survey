<?php
/**
 * Session
 * 
 * Manage sessions
 *
 * @author mchanchaf
 *
 * @package app.session
 * @version 1.0
 * @since 1.5.0
 */
namespace App;


class Session
{


	/**
     * Read session
     *
     * @param string $key
     * @param string $default
     *
     * @return $value || false
     */
	public static function get($key = null, $default = null)
    {
        self::startSession();

        if (is_null($key)) {
            return $_SESSION;
        }
        
        return (isset($_SESSION[$key]) && !empty($_SESSION[$key])) ? $_SESSION[$key] : $default;	
	}


    /**
     * Create session
     *
     * @param string $name
     * @param string $value
     *
     * @return bool
     */
    public static function set($key, $value)
    {
        if( $key == '' || $value == '' )
            return false;

        self::startSession();
        
        return $_SESSION[$key] = $value;
    }


    /**
     * Erase session
     *
     * @param string $name
     *
     * @return bool
     */
    public static function destroy($key)
    {
        if( !self::get($key) ) {
            return false;
        }
        unset($_SESSION[$key]);

        return true;
    }


    /**
     * Get flash message
     *
     * @param array $classes
     * @param bool $dismissible
     *
     * @return void
     */
    public static function getFlash($classes=[], $dismissible=true)
    {
        if( $flash = self::get('flash_message') ) {
            self::destroy('flash_message');
            foreach ($flash as $type => $messages) {
                get_view('alerts/'.$type, [
                    'messages' => $messages,
                    'classes' => $classes,
                    'dismissible' => $dismissible
                ]);
            }
        }
    }


    /**
     * Set flash message
     *
     * @param string $type
     * @param string $message
     *
     * @return bool
     */
    public static function setFlash($type, $message)
    {
        if( !in_array($type, ['success', 'danger', 'info', 'warning']) )
            return false;

        $flash = self::get('flash_message');
        if( !is_array($flash) ) $flash = [];

        // Add new error
        if( is_array($message) ) {
            $flash[$type] = $message;
        } else {
            $flash[$type][] = $message;
        }

        return self::set('flash_message', $flash);
    }


    /**
     * Tell if has flash message
     *
     * @param string $type
     *
     * @return bool
     */
    public static function hasFlash($type=[])
    {
        if( $flash = self::get('flash_message') ) {
            if( empty($type) ) {
                return is_array($flash);
            } elseif ( is_array($type) ) {
                foreach ($type as $key => $value) {
                    if(isset($flash[$value])) {
                        return true;
                    }
                }
            } else {
                return (isset($flash[$type]));
            }
        }
        return false;
    }


    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
    }


} // END Class