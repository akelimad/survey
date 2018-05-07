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

use App\File;

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


    /**
     * Upload multiple files
     *
     * @param $rules = [
        [
          'name' => 'cv',
          'title' => trans("CV"),
          'required' => true,
          'uploadDir' => 'uploads/cv/',
          'extensions' => ['doc', 'docx', 'pdf']
        ]
      ]
     *
     */
    public static function uploadMultiple($rules = [])
    {
        $max_file_size = get_setting('max_file_size');
        $return = [
            'files' => [], 
            'errors' => []
        ];
        $upload_paths = [];

        foreach ($rules as $key => $rule) {
            $valid = true;
            $required = (array_key_exists('required', $rule) && $rule['required']);
            $rule_name = $rule['name'];

            // Check if file is required
            if ($required) {
                $size = (is_array($_FILES[$rule_name]['size'])) ? $_FILES[$rule_name]['size'][0] : $_FILES[$rule_name]['size'];
                if(!isset($_FILES[$rule_name]) || $size < 1) {
                    $return['errors'][] = sprintf(trans("Le champs <strong>%s</strong> est obligatoire."), $rule['title']);
                    $valid = false;
                }
            }

            if(!isset($_FILES[$rule_name])) continue;

            $rule_files = self::getFilesAttributes($_FILES[$rule_name]);

            // Continue if not uploaded
            if ($rule_files['size'][0] < 1) continue;

            foreach ($rule_files['name'] as $k => $name) {
                // Check if file respect extensions
                $extension = File::getExtension($name);

                if(!empty($rule['extensions']) && !in_array($extension, $rule['extensions'])) {
                    $return['errors'][$rule_name .'_ext'] = sprintf(trans("Le champ <strong>%s</strong> doit avoir les extensions suivantes: (%s)"), $rule['title'], '.'. implode(', .', $rule['extensions']));
                    $valid = false;
                }

                if ($rule_files['size'][$k] > File::koToOctet($max_file_size)) {
                    $return['errors'][$rule_name .'_size'] = sprintf(trans("Vous avez depassé la taille maximal <strong>(%sko)</strong> pour le champ <strong>%s</strong>"), $max_file_size, $rule['title']);
                    $valid = false;
                }
            }

            if(!$valid) continue;

            // Upload file if there no problem
            $upload = self::upload($_FILES[$rule_name], [
                'extensions' => $rule['extensions'],
                'uploadDir'  => $rule['uploadDir']
            ]);

            // Upload files succes
            if(isset($upload['files']) && !empty($upload['files'])) {
                foreach ($upload['files'] as $fk => $fname) {
                    $return['files'][$rule_name][$fk]['name'] = $fname;
                    $return['files'][$rule_name][$fk]['path'] = site_base($rule['uploadDir'] . $fname);
                    $return['files'][$rule_name][$fk]['title'] = File::getName($rule_files['name'][$fk]);
                }
            } else {
                $return['errors'][$rule_name] = $upload['errors'][0];
            }
        }

        // Remove uploaded files if errors
        if(!empty($return['errors'])) {
            if(!empty($return['files'])) {
                foreach ($return['files'] as $key => $files) {
                    foreach ($files as $key => $file) {
                        unlinkFile($file['path']);
                    }
                }
            }
            unset($return['files']);
        } else {
            unset($return['errors']);
        }

        return $return;
    }


    public static function getFilesAttributes($files)
    {
        if (!is_array($files['name'])) {
            $_files['name'][] = $files['name'];
            $_files['type'][] = $files['type'];
            $_files['tmp_name'][] = $files['tmp_name'];
            $_files['error'][] = $files['error'];
            $_files['size'][] = $files['size'];
            return $_files;
        }
        return $files;
    }


    public function deleteUploadedFiles($upload = [])
    {
        if (!isset($upload['files']) || empty($upload['files'])) return;

        foreach ($upload['files'] as $key => $files) {
            foreach ($files as $key => $file) {
                unlinkFile($file['path']);
            }
        }
    }


} // End class