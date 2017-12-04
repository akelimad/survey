<?php
/**
 * Module
 * 
 * Manage modules
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.module
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Module {
	
    
	/**
     * Modules init
     *
     * @author Mhamed Chanchaf
     */
    public static function init(){
        $autoloader = require SITE_BASE . '/vendor/autoload.php';
        foreach(glob( site_base('modules/*/index.php'), GLOB_BRACE) as $moduleIndex) {
            $modulePath = str_replace('index.php', '', $moduleIndex);
            $moduleName = basename($modulePath);
            $autoloader->setPsr4('Modules\\'. ucfirst($moduleName) .'\\', $modulePath);
            require_once($moduleIndex);
        }
    }

    
    
} //END Class