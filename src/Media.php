<?php
/**
 * Media
 *
 * @author mchanchaf
 *
 * @package app.media
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Media {
	
	
    /**
     * Upload Medias
     *
     * @param $files array
     * @param $options array
     *
     * @return $files || $errors
     */
    public static function upload($files=array(), $options=array())
    {
        $default = array(
            'extensions' => null, // array('jpg', 'gif', 'png', 'doc', 'ppt', 'odt', 'docx', 'xlsx', 'pptx', 'psd' , 'rar', 'zip')
            'uploadDir' => 'apps/upload/',
            'title' => array('auto', 15)
        );
        $args = array_merge($default, $options);
        $uploadDir = SITE_BASE .'/'. $args['uploadDir'];
        //Create directory if not exist
        if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
        $args['uploadDir'] = $uploadDir;
        //Start uploading files
        $uploader = new Uploader();
        $upload = $uploader->upload($files, $args);
        if($upload['hasErrors']){
            $return['errors'] = $upload['errors'];
        } else if($upload['isComplete']){
            $return['files'] = str_replace($args['uploadDir'], '', $upload['data']['files']);
        }
        return $return;
    }



//END CLASS	
}