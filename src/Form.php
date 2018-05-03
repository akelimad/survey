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
    'required' => false,
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
  public static function input($type, $name, $label = null, $default = null, $options = [], $attrs = [])
  {
    $html = '';

    if (!empty($name) && !isset($attrs['id'])) {
      $id = str_replace('[', '_', $name);
      $attrs['id'] = trim(str_replace(']', '', $id), '_');
    }

    $attrs['name'] = $name;
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
        $html .= '<label for="'. $attrs['id'] .'">';
      } else {
        $html .= '<label for="'. $attrs['id'] .'">'. $label .'</label>';
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

    if (in_array($type, ['checkbox', 'radio']) && !empty($options)) {
      $html .= '<div class="mt-10">';
      foreach ($options as $key => $option) {
        $inline = (!isset($attrs['inline']) || $attrs['inline']) ? $type .'-inline' : '';
        $html .= '<label class="'. $inline .'">';
        $html .= '<input type="'. $type .'" name="'. $name .'" value="'. $key .'">&nbsp;'. $option;
        $html .= '</label>';
      }
      $html .= '</div>';
    } else {
      $html .= '<input '. self::getAttributes($attrs) .'>';
    }
    
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

    $attrs['name'] = $name;
    if (!empty($name) && !isset($attrs['id'])) {
      $id = str_replace('[', '_', $name);
      $attrs['id'] = trim(str_replace(']', '', $id), '_');
    }

    $helpBlock = '';
    if (isset($attrs['help']) && !empty($attrs['help'])) {
      $helpBlock = self::getHelpBlock($attrs['help']);
      unset($attrs['help']);
    }
    $html .= '<select '. self::getAttributes($attrs) .'>';
    $options = self::execute($options);
    $otherOptionLabel = '';
    foreach ($options as $key => $option) :
      if (is_object($option)) {
        $value = (isset($option->value)) ? $option->value : null;
        $text  = (isset($option->text)) ? $option->text : null;
      } else {
        $value = $key;
        $text  = $option;
      }

      if ($value === '_other') {
        $otherOptionLabel = $text;
        $dataOther = ' chm-form-other="'. $attrs['id'] .'_other"';
      } else {
        $dataOther = '';
      }

      $default = (is_null($default) && isset($_GET[$name])) ? $_GET[$name] : $default;
      $selected = ($default === $value) ? ' selected' : '';

      $html .= '<option value="'. $value .'"'. $dataOther . $selected .'>'. $text .'</option>';
    endforeach;

    $html .= '</select>'. $helpBlock;

    if ($otherOptionLabel != '') {
      $html .= self::input('text', $attrs['id'] .'_other', null, null, [], [
        'class' => 'form-control mt-10 mb-0',
        'style' => 'display:none;',
        'title' => $otherOptionLabel,
        'placeholder' => $otherOptionLabel
      ]);
    }

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

    $attrs['name'] = $name;
    if (!empty($name) && !isset($attrs['id'])) {
      $id = str_replace('[', '_', $name);
      $attrs['id'] = trim(str_replace(']', '', $id), '_');
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
   * @param array $array
   *
   * @return string $html
   *
   * @author mchanchaf
   */
  public static function draw($array = [], $model = null)
  {
    if (!isset($array['groups']) || empty($array['groups']))
      return;

    $html = null;
    $sorted_fields = self::sortFields($array);

    if (isset($array['buttons'])) {
      self::$buttons = array_replace_recursive(self::$buttons, $array['buttons']);
    }

    foreach ($array['groups'] as $group_name => $group_label) {
      // Reset columns counter
      $row_cols = 0;

      if (!isset($sorted_fields[$group_name])) continue;

      // Print fields group name
      $html .= '<div class="styled-title mt-0 mb-10"><h3>'. $group_label .'</h3></div>';

      // Generate fields
      $html .= '<div class="row">';
      foreach ($sorted_fields[$group_name] as $key => $field) {
        // merge default field attributes with current one
        $field = array_replace_recursive(self::$field_attrs, $field);

        // add form-group class
        if (!isset($field['attributes']['class'])) {
          $field['attributes']['class'] = 'form-control mb-0';
        }

        // Set value from model
        preg_match('/\[([a-zA-Z0-9_-]+)]/', $field['name'], $matches);
        $table_col = (isset($matches[1])) ? $matches[1] : $field['name'];

        $column = null;
        if (isset($model->$table_col)) {
          $column = $model->$table_col;
        } else if (isset($_POST[$table_col])) {
          $column = $_POST[$table_col];
        }

        // Field apearance
        if (!self::execute($field['show'], ['value' => $column])) continue;

        // Add require attribute
        $required_class = '';
        if (self::execute($field['required'], ['value' => $column])) {
          $required_class = ' required';
          if (!isset($field['attributes']['required']) && !in_array('required', $field['attributes'])) $field['attributes'][] = 'required';
        }

        $value = (isset($field['value'])) ? $field['value'] : $column;
        $value = self::execute($value, ['value' => $column]);
        $field['value'] = $field['attributes']['value'] = $value;

        // Increment columns
        $columns = intval($field['columns']);
        $offset = intval($field['offset']);
        $offset_class = ($field['offset'] > 0) ? ' col-md-offset-'. $field['offset'] : '';
        $pl = ($row_cols > 0) ? ' pl-0' : '';
        $row_cols = ($row_cols + $columns + $offset);

        // Close row
        if ($row_cols > 12) {
          $html .= '</div><div class="row">';
          $row_cols = 0;
        }

        $html .= '<div class="col-md-'. $columns . $offset_class . $pl .'">';
        $html .= '<div class="form-group'. $required_class .'">';

        if (!empty($field['label'])) {
          $html .= '<label for="'. $field['name'] .'">'. $field['label'] .'</label>';
        }

        // Render field
        switch ($field['type']) {
          case 'select':
            $html .= self::select(
              $field['name'],
              null,
              $field['value'],
              $field['options'],
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
          case ('text' || 'number' || 'date' || 'radio' || 'checkbox'):
            $html .= self::input(
              $field['type'],
              $field['name'],
              null,
              $field['value'],
              $field['options'],
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
        if ($row_cols >= 12) {
          $html .= '</div><div class="row">';
          $row_cols = 0;
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


  private static function sortFields($array)
  {
    $sorted_fields = [];
    foreach ($array['fields'] as $key => $field) {
      $group_name = $field['group_name'];
      if (!isset($array['groups'][$group_name])) continue;
      unset($field['group_name']);
      $sorted_fields[$group_name][] = $field;
    }
    return $sorted_fields;
  }


  private static function execute($value, $args = [])
  {
    if (is_callable($value)) {
      return call_user_func($value, $args);
    } elseif (is_string($value) && strpos($value, '@') !== false) {
      $callable = explode('@', $value);
      if(isset($callable[1])) {
        $controller = $callable[0];
        $method = $callable[1];
        if ( method_exists($controller, $method) && is_callable($callable)) {
          return call_user_func_array([new $controller(), $method], $args);
        }
      }
    }
    return $value;
  }


  public static function getSectionOption($section_name, $form_id, $field_name)
  {
    $settings = get_setting('form.sections.'. $form_id, '{}');
    $settings = json_decode($settings, true) ?: [];

    if (!isset($settings[$field_name][$section_name])) {
      return true;
    }

    return $settings[$field_name][$section_name];
  }


  public static function getFieldOption($option_name, $form_id, $field_name)
  {
    $settings = get_setting('form.fields.'. $form_id, '{}');
    $settings = json_decode($settings, true) ?: [];

    if (
      $option_name == 'required' && 
      !self::getFieldOption('displayed', $form_id, $field_name)
    ) {
      return false;
    }

    if (!isset($settings[$field_name][$option_name])) {
      return true;
    }

    return $settings[$field_name][$option_name];
  }


} // End Class