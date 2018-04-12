<?php
namespace App;

class File
{

    public static function getIconClass($filename)
    {
        return self::getIconClassByExt(
            strtolower( self::getExtension($filename) )
        );
    }

    public static function getIconClassByExt($ext)
    {
        if (in_array($ext, ['html', 'cmd', 'bat', 'xml'])) {
            return "fa fa-file-code-o";
        } elseif (in_array($ext, ['zip', 'rar', 'gz', 'tar'])) {
            return "fa fa-file-archive-o";
        } elseif (in_array($ext, ['mp3', 'wav'])) {
            return "fa fa-file-audio-o";
        } elseif (in_array($ext, ['xls', 'xlsx'])) {
            return "fa fa-file-excel-o";
        } elseif (in_array($ext, ['jpg', 'gif', 'bmp', 'svg', 'tiff', 'png'])) {
            return "fa fa-file-image-o";
        } elseif (in_array($ext, ['pdf'])) {
            return "fa fa-file-pdf-o";
        } elseif (in_array($ext, ['ppt', 'pptx'])) {
            return "fa fa-file-powerpoint-o";
        } elseif (in_array($ext, ['txt', 'log', 'md'])) {
            return "fa fa-file-text-o";
        } elseif (in_array($ext, ['mp4', 'mpeg', 'swf'])) {
            return "fa fa-file-video-o";
        } elseif (in_array($ext, ['doc', 'docx'])) {
            return "fa fa-file-word-o";
        }
        return 'fa fa-file-o';
    }

    public static function getExtension($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    public static function getName($filename)
    {
        return pathinfo($filename, PATHINFO_FILENAME);
    }

    public static function genRandomName($filename)
    {
        $ext = self::getExtension($filename);

        return self::randomString() .'.'. $ext;
    }

    public static function copyFile($source, $distination)
    {
        if (file_exists($source) && is_file($source) && is_readable($source)) {
            try {
                chown($distination, 666);
                return copy($source, $distination);
            } catch (\Exception $e) {}
        }
        return false;
    }

    public static function deleteFile($path)
    {
        if( file_exists($path) ) {
            chown($path, 666);
            if ( unlink($path) ) return true;
        }
        return false;
    }

    /**
     * Generate random string
     *
     * @param int $length
     *
     * @return string $string
     *
     * @author Mhamed Chanchaf
     */
    public static function randomString($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

}
