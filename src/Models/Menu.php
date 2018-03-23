<?php
/**
 * Menu
 *
 * @author mchanchaf
 *
 * @package app.models
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Models;

use App\Route;

class Menu {


  
  /**
   * Draw menu
   *
   * @param array $items 
   * @return string $menu 
   * 
   * @author Mhamed Chanchaf
   */
  public static function draw($items) {
    $route = Route::getRoute();
    $default = [
      "label" => "Sans titre",
      "route" => "/",
      "icon" => "fa fa-dot-circle-o",
      "isVisible" => true,      
      "isActive" => true      
    ];
    $output = '';
    foreach ($items as $key => $item) {
      $classes = [];

      // Merge item params
      $item = array_merge($default, $item);
      if(!$item['isVisible']) continue;

      // Set url
      $url = site_url($item['route']);
      if(!$item['isActive'] || $item['route'] == '') $url = 'javascript:void(0)';

      // Add active class
      if ($route == $item['route']) $classes[] = 'active';

      // Add disabled class
      if(!$item['isActive']) $classes[] = 'disabled';

      $class = (!empty($classes)) ? ' class="'. implode(' ', $classes) .'"' : '';

      // add attributes
      $attrs = '';
      if (!empty($item['attributes'])) {
        foreach ($item['attributes'] as $key => $value) {
          $attrs .= ' '. $key .'="'. $value .'"';
        }
      }

      // Draw menu item
      $output .= '<li'. $class .'>';
      $output .= '<a href="'. $url .'" '. $attrs .'><i class="'. $item['icon'] .'"></i>&nbsp;'. $item['label'] .'</a>';
      if( isset($item['childrens']) && !empty($item['childrens']) ) {
        $output .= '<ul>';
        $output .= self::draw($item['childrens']);
        $output .= '</ul>';
      }
      $output .= '</li>';
    }
    return $output;
  }


}