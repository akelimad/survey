<?php
/**
 * Form
 *
 * @author mchanchaf
 *
 * @package app
 * @version 1.0
 * @since 1.5.0
 */
namespace App;

class Form
{

  /**
   * input
   *
   * @param string $type
   * @param string $name
   * @param string $label
   * @param string $default
   * @param array  $attributes
   *
   * @return string $html
   *
   * @author Mhamed Chanchaf
   */
  public static function input($type, $name, $label = null, $default = null, $attrs = [])
  {
    $html = '';
    if (!is_null($label)) {
      $html .= '<div class="form-group">';
      $html .= '<label for="'. $name .'">'. $label .'</label>';
    }

    if (!empty($name)) {
      $attrs['name'] = $name;
      if (!isset($attrs['id'])) $attrs['id'] = $name;
    }
    $attrs['type'] = $type;
    $attrs['value'] = (is_null($default) && isset($_GET[$name])) ? $_GET[$name] : $default;
    
    $html .= '<input '. self::getAttributes($attrs) .'>';
    if (!is_null($label)) $html .= '</div>';

    return $html;
  }


  /**
   * select
   *
   * @param string $name
   * @param string $label
   * @param string $default
   * @param array  $options
   * @param array  $attributes
   *
   * @return string $html
   *
   * @author Mhamed Chanchaf
   */
  public static function select($name, $label = null, $default = null, $options = [], $attrs = [])
  {
    $html = '';
    if (!is_null($label)) {
      $html .= '<div class="form-group">';
      $html .= '<label for="'. $name .'">'. $label .'</label>';
    }

    if (!empty($name)) {
      $attrs['name'] = $name;
      if (!isset($attrs['id'])) $attrs['id'] = $name;
    }

    $html .= '<select '. self::getAttributes($attrs) .'>';
    foreach ($options as $key => $option) :
      if (is_object($option)) {
        $value = (isset($option->value)) ? $option->value : null;
        $text  = (isset($option->text)) ? $option->text : null;
      } else {
        $value = $key;
        $text  = $option;
      }

      $default = (is_null($default) && isset($_GET[$name])) ? $_GET[$name] : $default;
      $selected = ($default == $value) ? 'selected' : '';

      $html .= '<option value="'. $value .'" '. $selected .'>'. $text .'</option>';
    endforeach;

    $html .= '</select>';
    if (!is_null($label)) $html .= '</div>';

    return $html;
  }


  /**
   * textarea
   *
   * @param string $name
   * @param string $label
   * @param string $default
   * @param array  $attributes
   *
   * @return string $html
   *
   * @author Mhamed Chanchaf
   */
  public static function textarea($name, $label = null, $default = null, $attrs = [])
  {
    $html = '';
    if (!is_null($label)) {
      $html .= '<div class="form-group">';
      $html .= '<label for="'. $name .'">'. $label .'</label>';
    }

    if (!empty($name)) {
      $attrs['name'] = $name;
      if (!isset($attrs['id'])) $attrs['id'] = $name;
    }

    if (is_null($default) && isset($_GET[$name])) {
      $default = $_GET[$name];
    }

    $html .= '<textarea '. self::getAttributes($attrs) .'>'. $default .'</textarea>';
    if (!is_null($label)) $html .= '</div>';

    return $html;
  }


  /**
   * Get field attributes
   *
   * @param array  $attrs
   * @param string $label
   *
   * @return string $attribures
   *
   * @author Mhamed Chanchaf
   */
  private static function getAttributes($attrs, $label = null)
  {
    $attrs_arr = [];
    if (!is_null($label)) $attrs['title'] = $label;

    foreach ($attrs as $k => $v) {
      $attrs_string = (is_numeric($k)) ? $v : $k;
      if (!empty($v) && !is_numeric($k)) $attrs_string .= '="'. $v .'"';
      $attrs_arr[] = $attrs_string;
    }

    return implode(' ', $attrs_arr);
  }


} // End Class