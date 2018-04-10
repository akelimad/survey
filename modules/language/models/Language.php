<?php
/**
 * Language
 *
 * @author mchanchaf
 *
 * @package modules.Llanguage.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Language\Models; 

class Language {

  private $strings = [];


  private $paths = [
    'apps',
    'config',
    'public',
    'src',
    'modules'
  ];


  /**
   * Scan code for strings
   *
   * @return arary $strings
   */
  public function getStringsFromCode()
  {
    foreach ($this->paths as $key => $path) {
      $files = $this->getDirectoryFiles( site_base($path) );
      foreach($files as $v) {
        if ( preg_match("/\/.*?\.[a-z0-9]+$/uis", $v) ) {
          preg_match_all("/(?:\<\?.*?\?\>)|(?:\<\?.*?[^\?]+[^\>]+)/uis", file_get_contents($v), $p);
          if (count($p[0])) {
            foreach ($p[0] as $pv) {
              preg_match_all("/trans[_]?[_e][\s]*\([\s]*[\"](.*?)[\"].*?\)/uis", $pv, $m);
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