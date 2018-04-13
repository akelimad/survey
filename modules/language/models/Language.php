<?php
/**
 * Language
 *
 * @author mchanchaf
 *
 * @package modules.Language.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Language\Models;

use App\Controllers\Controller;

class Language {

  private $strings = [];


  private $paths = [
    'apps',
    'config',
    'public',
    'src',
    'modules'
  ];


  public static function findAll()
  {
    return getDB()->read('languages');
  }


  public static function getActiveLanguages()
  {
    return getDB()->prepare("SELECT iso_code as value, name as text FROM languages WHERE active=?", [1]);
  }


  public static function getDefaultLanguage($key = null)
  {
    $lang = getDB()->findOne('languages', 'default_lang', 1);
    if (!isset($lang->id)) return false;

    if (!is_null($key) && isset($lang->$key)) {
      return $lang->$key;
    }

    return $lang;
  }


  public static function getCurrentLanguage($key = null, $default = null)
  {
    $iso_code = read_cookie('eta_lang', self::getDefaultLanguage('iso_code', 'fr'));
    $language = (isset($GLOBALS['etalent']->language)) ? $GLOBALS['etalent']->language : [];
    if (!isset($language->id)) {
      $language = getDB()->findOne('languages', 'iso_code', $iso_code);
      $GLOBALS['etalent']->language = $language;
    }

    if (!is_null($key)) {
      return (isset($language->$key)) ? $language->$key : $default;
    }

    return $language;
  }


  /**
   * Scan code for strings
   *
   * @return arary $strings
   */
  public function getStringsFromCode()
  {
    // TODO - add JS trans support
    foreach ($this->paths as $key => $path) {
      $files = (new Controller())->getDirectoryFiles( site_base($path) );
      foreach($files as $v) {
        if ( preg_match("/\/.*?\.[a-z0-9]+$/uis", $v) ) {
          preg_match_all("/(?:\<\?.*?\?\>)|(?:\<\?.*?[^\?]+[^\>]+)/uis", file_get_contents($v), $p);
          if (count($p[0])) {
            foreach ($p[0] as $pv) {
              preg_match_all("/trans[_]?[_e]?[\s]*\([\s]*[\"](.*?)[\"].*?\)/uis", $pv, $m);
              if (count($m[0])) {
                foreach ($m[1] as $mv) {
                  if (!in_array($mv, $this->strings)) {
                    $this->strings[] = $mv;
                  }
                }
              }
            }
          }
        }
      }
    }
    return $this->strings;
  }



} // End Class