<?php
/**
 * Assets
 * 
 * Manage website assets
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.assets
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Assets {
    
    
	/**
     * Glob all added styles
     * 
     * @var array $styles
     */
    private static $styles;
    
    
	/**
     * Glob all added scripts
     * 
     * @var array $scripts
     */
    private static $scripts;


    /**
     * Register a CSS stylesheet.
     *
     * @param string $unique_id
     * @param array  $params
     *
     * @return void
     */
    public static function addCSS($unique_id, $params=[]){
        if( empty($params) && isset(self::$styles[$unique_id]) ){
            unset(self::$styles[$unique_id]);
        } else {
            $params = array_merge([
                'version' => false,
                'media'   => 'all',
                'admin'   => false,
                'front'   => true
            ], $params);

            if( \isBackend() ){
                if( $params['admin'] !== false ){
                    self::$styles[$unique_id] = $params;
                }
            } elseif ( $params['front'] !== false ){
                self::$styles[$unique_id] = $params;
            } 
        }
    }


    /**
     * Register a javascript.
     *
     * @param string $unique_id
     * @param array  $params
     *
     * @return void
     */
    public static function addJS($unique_id, $params=[]){
        if( empty($params) && isset(self::$scripts[$unique_id]) ){
            unset(self::$scripts[$unique_id]);
        } else {
            $params = array_merge([
                'version'   => false,
                'media'     => 'all',
                'admin'     => false,
                'front'     => true,
                'in_footer' => true
            ], $params);

            if( \isBackend() ){
                if( $params['admin'] !== false ){
                    self::$scripts[$unique_id] = $params;
                }
            } elseif ( $params['front'] !== false ){
                self::$scripts[$unique_id] = $params;
            }
        }
    }
  

    /**
     * Get styles.
     *
     * @return array $styles
     */
    public static function getStyles(){
        return self::$styles;
    }


    /**
     * Get scripts.
     *
     * @return array $scripts
     */
    public static function getScripts(){
        return self::$scripts;
    }



} // END Class