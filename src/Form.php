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

  private static $field_attrs = [
    'name' => null,
    'label' => null,
    'type' => null,
    'value' => null,
    'options' => [],
    'help' => null,
    'required' => true,
    'show' => true,
    'group_name' => null,
    'columns' => 4,
    'offset' => 0,
    'attributes' => []
  ];


  private static $buttons = [
    [
      'label'   => 'Fermer',
      'type'    => 'button',
      'attributes' => [
        'class' => 'btn btn-danger btn-sm'
      ]
    ],
    [
      'label'   => 'Enregistrer',
      'type'    => 'submit',
      'attributes' => [
        'class' => 'btn btn-primary pull-right btn-sm'
      ]
    ]
  ];


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

    if (!empty($name)) {
      $attrs['name'] = $name;
      if (!isset($attrs['id'])) $attrs['id'] = $name;
    }
    $attrs['type'] = $type;
    $attrs['value'] = (is_null($default) && isset($_GET[$name])) ? $_GET[$name] : $default;

    $helpBlock = '';
    if (isset($attrs['help']) && !empty($attrs['help'])) {
      $helpBlock = self::getHelpBlock($attrs['help']);
      unset($attrs['help']);
    }

    if (!is_null($label)) {
      $required = (in_array('required', $attrs)) ? ' required' : '';
      $html .= '<div class="form-group'. $required .'">';
      if (in_array($type, ['checkbox', 'radio'])) {
        $html .= '<label for="'. $name .'">';
      } else {
        $html .= '<label for="'. $name .'">'. $label .'</label>';
      }
    }

    // Remove attr value for inout type file
    if ($type == 'file') {
      unset($attrs['value']);
    }

    // Remove default class
    if (in_array($type, ['checkbox', 'radio']) && !isset($attrs['class'])) {
      $attrs['class'] = '';
    }
    
    $html .= '<input '. self::getAttributes($attrs) .'>';
    if (in_array($type, ['checkbox', 'radio']) && !is_null($label)) {
      $html .= '&nbsp;'. $label . '</label>';
    }

    $html .= $helpBlock;

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
      $required = (in_array('required', $attrs)) ? ' required' : '';
      $html .= '<div class="form-group'. $required .'">';
      $html .= '<label for="'. $name .'">'. $label .'</label>';
    }

    if (!empty($name)) {
      $attrs['name'] = $name;
      if (!isset($attrs['id'])) $attrs['id'] = $name;
    }

    $helpBlock = '';
    if (isset($attrs['help']) && !empty($attrs['help'])) {
      $helpBlock = self::getHelpBlock($attrs['help']);
      unset($attrs['help']);
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

    $html .= '</select>'. $helpBlock;
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
      $required = (in_array('required', $attrs)) ? ' required' : '';
      $html .= '<div class="form-group'. $required .'">';
      $html .= '<label for="'. $name .'">'. $label .'</label>';
    }

    if (!empty($name)) {
      $attrs['name'] = $name;
      if (!isset($attrs['id'])) $attrs['id'] = $name;
    }

    if (is_null($default) && isset($_GET[$name])) {
      $default = $_GET[$name];
    }

    $helpBlock = '';
    if (isset($attrs['help']) && !empty($attrs['help'])) {
      $helpBlock = self::getHelpBlock($attrs['help']);
      unset($attrs['help']);
    }

    $html .= '<textarea '. self::getAttributes($attrs) .'>'. $default .'</textarea>'. $helpBlock;
    if (!is_null($label)) $html .= '</div>';

    return $html;
  }


  /**
   * Get field attributes
   *
   * @param array  $attrs
   * @param string $label
   *
   * @return string $attributes
   *
   * @author Mhamed Chanchaf
   */
  private static function getAttributes($attrs, $label = null)
  {
    $attrs_arr = [];
    if (!is_null($label)) $attrs['title'] = $label;

    // add form-group class
    if (!isset($attrs['class'])) $attrs['class'] = 'form-control mb-0';

    foreach ($attrs as $k => $v) {
      $attrs_string = (is_numeric($k)) ? $v : $k;
      if (!is_numeric($k)) $attrs_string .= '="'. $v .'"';
      $attrs_arr[] = $attrs_string;
    }

    return implode(' ', $attrs_arr);
  }


  private static function getHelpBlock($text)
  {
    return '<p class="help-block">'. $text .'</p>';
  }


  /**
   * Draw form elements
   *
   * @param array  $fields
   *
   * @return string $html
   *
   * @author mchanchaf
   */
  public static function draw($fields = [], $model = null)
  {
    $html = null;
    $row_cols = 0;
    $fields = self::sortFields($fields);

    $groups = [];
    foreach (array_keys($fields) as $key => $group_name) {
      // Reset columns counter
      $group[] = $group_name;
      if (!in_array($group_name, $groups)) $row_cols = 0;

      // Print fields group name
      $html .= '<div class="styled-title mt-0 mb-10"><h3>'. $group_name .'</h3></div>';

      // Generate fields
      $html .= '<div class="row">';
      foreach ($fields[$group_name] as $key => $field) {
        // merge default field attributes with current one
        $field = array_replace_recursive(self::$field_attrs, $field);

        // add form-group class
        if (!isset($field['attributes']['class'])) {
          $field['attributes']['class'] = 'form-control mb-0';
        }

        // Field apearance
        if (!$field['show'] || $field['type'] == 'submit') continue;

        // Add require attribute
        $required_class = '';
        if ($field['required']) {
          $required_class = ' required';
          if (
            !isset($field['attributes']['required']) 
            && !in_array('required', $field['attributes'])
          ) $field['attributes'][] = 'required';
        }

        // Increment columns
        $columns = intval($field['columns']);
        $total_cols = ($row_cols + $columns);
        $offset_class = ($field['offset'] > 0) ? ' col-md-offset-'. $field['offset'] : '';
        $pl = ($row_cols > 0) ? ' pl-0' : '';

        $html .= '<div class="col-md-'. $columns . $offset_class . $pl .'">';
        $html .= '<div class="form-group'. $required_class .'">';

        if (!empty($field['label'])) {
          $html .= '<label for="'. $field['name'] .'">'. $field['label'] .'</label>';
        }

        // Set value from model
        preg_match('/\[([a-zA-Z0-9_-]+)]/', $field['name'], $matches);
        $table_col = (isset($matches[1])) ? $matches[1] : $field['name'];

        if (isset($model->$table_col)) {
          $column = $model->$table_col;
        } else if (isset($_POST[$table_col])) {
          $column = $_POST[$table_col];
        }

        if (isset($field['value']) && !empty($field['value'])) {
          $field['value'] = self::getFieldValue($field['value'], $column);
        } else {
          $field['value'] = $column;
        }

        // Render field
        switch ($field['type']) {
          case 'text':
            $html .= self::input(
              'text',
              $field['name'],
              null,
              $field['value'],
              $field['attributes']
            );
            break;
          case 'select':
            $html .= self::select(
              $field['name'],
              null,
              $field['value'],
              (['' => ''] + $field['options']),
              $field['attributes']
            );
            break;
          case 'textarea':
            $html .= self::textarea(
              $field['name'],
              null,
              $field['value'],
              $field['attributes']
            );
            break;
        }

        // Print help block
        if (!empty($field['help'])) {
          $html .= self::getHelpBlock($field['help']);
        }

        $html .= '</div></div>'; // .col-md-* / .form-group

        // Close row
        if ($total_cols >= 12) {
          $html .= '</div><div class="row">';
          $row_cols = 0;
        } else {
          $row_cols += $columns;
        }
      }
      $html .= '</div>';
    }

    // Submit button
    $html .= '<div class="row"><div class="col-md-12"><div class="ligneBleu mt-10"></div>';
    foreach (self::$buttons as $key => $button) {
      $html .= '<button type="'. $button['type'] .'" '. self::getAttributes($button['attributes']) .'>'. $button['label'] .'</button>';
    }
    $html .= '</div></div>';

    return $html;
  }


  private static function sortFields($fields)
  {
    $sorted_fields = [];
    foreach ($fields as $key => $field) {
      if (isset($fields['buttons']) && $key == 'buttons') {
        self::$buttons = array_replace_recursive(self::$buttons, $fields['buttons']);
        continue;
      }
      $group_name = $field['group_name'];
      unset($field['group_name']);
      $sorted_fields[$group_name][] = $field;
    }
    return $sorted_fields;
  }


  private static function getFieldValue($value, $column)
  {
    if(is_callable($value)) {
      return call_user_func($value, $column);
    } else {
      return $value;
    }
  }


} // End Class