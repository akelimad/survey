<?php
/**
 * View
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.view
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class View {
	



	/**
     * GET VIEW
     *
     * @param string $path
     * @param object $variables
     *
     * @author Mhamed Chanchaf
     */
    public static function get($path, $variables=[], $file=null){
        $viewBase = $moduleViewBase = '';
        $coreViewBase = site_base('src/views/'. $path .'.php');

        $replace = str_replace(site_base(), '', $file);
        $replace = str_replace('\\', '/', $replace);
        $replace = str_replace('/', '#', $replace);
        if (preg_match("/modules#([a-zA-Z0-9_-]*)#/", $replace, $match) === 1) {
            $moduleViewBase = site_base('modules/'. $match[1] .'/views/'. $path .'.php');
        }

        if( file_exists($coreViewBase) ) {
            $viewBase = $coreViewBase;
        } else if( !empty($moduleViewBase) && file_exists($moduleViewBase) ) {
            $viewBase = $moduleViewBase;
        } 

        // render view
        if( !empty($viewBase) ) {
            extract($variables);
            require($viewBase);
        } else {
            get_alert('warning', $path .' <strong>Not found.</strong>', false);
        }
    }



    /**
     * Render page
     *
     * @param string $viewPath
     * @param object $variables
     *
     * @author Mhamed Chanchaf
     */
    public static function getPage($viewPath, $variables=[], $file=null){

        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
        }

        global $lang;
        global $languages;
        global $nom_site;

        $variables['lang']      = $lang;
        $variables['languages'] = $languages;
        $variables['nom_site']  = SITE_NAME;
        $variables['roles']     = getDB()->findOne('root_roles', 'login', $_SESSION['abb_admin']) ?: [];
        $variables['site']      = site_url();
        $variables['jsurl']     = site_url('assets/js/');
        $variables['cssurl']    = site_url('assets/css/');
        $variables['ariane'] = $variables['nom_page_site'] = '';
        if(isset($variables['breadcrumbs'])) {
            $variables['ariane'] = implode(' > ', array_map('ucfirst', $variables['breadcrumbs']));
            $variables['nom_page_site'] = SITE_NAME .' || '. strtoupper(end($variables['breadcrumbs']));            
        }

        ob_start();
        self::get($viewPath, $variables, $file);
        $variables['content'] = ob_get_clean();

        if(isset($variables['layout'])) {
            self::get('layouts/'.$variables['layout'], $variables, $file);
        } else {
            self::get('partials/header', $variables, $file);
            $template = (isset($variables['template'])) ? $variables['template'] : 'full-width'; 
            if( isBackend() ) {
                self::get('templates/'.$template, $variables, $file);
            } else {
                self::get('templates/front/'.$template, $variables, $file);
            }
            self::get('partials/footer', $variables, $file);
        }
    }

    




    


//END CLASS	
}