<?php
/**
 * FormBuilder
 * 
 * @author mchanchaf
 *
 * @package app.helpers
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Helpers;

use App\File;

class FormBuilder {

  /**
   * Unique name
   *
   * @access protected
   * @var    string
   */
  protected static $name;

  /**
   * Model
   *
   * @access protected
   * @var    object
   */
  protected static $model;

  /**
   * Field HTML Template
   *
   * @access protected
   * @var    string
   */
  protected static $template = '<div {attributes}>{html_label}{html_field}{help_block}</div>';

  /**
   * Array of options
   *
   * @access protected
   * @var    array
   */
  protected static $options = [
    'with_wrapper' => true,
    'method' => 'POST',
    'action' => ''
  ];

  /**
   * Array of settings
   *
   * @access protected
   * @var    array
   */
  protected static $settings = [];

  /**
   * Array of HTML attributes
   *
   * @access protected
   * @var    array
   */
  protected static $attributes = [
    'class' => 'chm-simple-form mb-15'
  ];

  /**
   * Array of fields
   *
   * @access protected
   * @var    array
   */
  protected static $fields = [];

  /**
   * Array of fieldsets
   *
   * @access protected
   * @var    array
   */
  protected static $fieldsets = [];

  /**
   * Array of buttons
   *
   * @access protected
   * @var    array
   */
  protected static $buttons = [];

  /**
   * Array of events
   *
   * @access protected
   * @var    array
   */
  protected static $events = [];

  /**
   * Array of triggered events
   *
   * @access protected
   * @var    array
   */
  protected static $triggeredEvents = [];


  /**
   * Constructor
   *
   * @param   string $name Form name
   * @param   array $options An array of options
   * @param   array $model Object contain fields values
   *
   * @access  public
   * 
   * @return  void
   *
   * @author mchanchaf
   */
  public function __construct($name, $options = [], $model = null)
  {
    self::$name = $name;
    self::$model = (array) $model;

    self::$attributes['id'] = $name .'Form';
    self::$options = array_replace_recursive(self::$options, $options);
  }


  /**
   * Add new field
   *
   * @param   string $name
   * @param   string $type
   * @param   array $options
   *
   * @access  public
   * 
   * @return  FormBuilder
   *
   * @author mchanchaf
   */
  public function add($name, $type, $options = [])
  {
    // Create ID from name
    $id = str_replace('[', '_', $name);

    // Get field MySql column name
    $column = self::getFieldName($name);

    // Get field value
    $value = null;
    if (isset($_POST[$column])) {
      $value = $_POST[$column];
    } else if (isset($_GET[$column])) {
      $value = $_GET[$column];
    } else if (isset(self::$model[$column])) {
      $value = self::$model[$column];
    }

    $fieldset = (isset($options['fieldset'])) ? $options['fieldset'] : 'NA';

    if ($name == 'button' && !isset($options['attributes']['class'])) {
      $options['attributes']['class'] = 'btn btn-primary pull-right btn-sm';
    }

    // Add to fields list
    $options = array_replace_recursive([
      'name'       => $name,
      'type'       => $type,
      'label'      => null,
      'value'      => $value,
      'fieldset'   => $fieldset,
      'template'   => null,
      'options'    => [],
      'extensions'    => [],
      'keys_as_values' => false,
      'delete_callback' => null,
      'delete_args' => '{}',
      'option_tpl' => null,
      'with_other' => false,
      'inline' => false,
      'attributes' => [
        'value'  => $value,
        'id'     => trim(str_replace(']', '', $id), '_'),
        'class'  => 'form-control mb-0',
      ],
      'columns'    => 4,
      'offset'     => 0,
      'order'      => (count(self::$fields) + 1),
      'rules'      => null,
      'help'       => null,
      'required'   => false,
      'displayed'  => true,
    ], $options);

    if ($name == 'button') {
      self::$buttons[] = $options;
    } else {
      self::$fields[$name] = $options;

      // Add ability to get value as closure
      self::$fields[$name]['value'] = self::execute($options['value'], ['form' => $this, 'model' => self::$model, 'value' => $value]);
      $options = self::execute($options['options'], ['form' => $this, 'model' => self::$model]);
      self::$fields[$name]['options'] = $options;

      // Set field fieldset
      if (!isset(self::$fieldsets[$fieldset])) {
        $order = ($fieldset == 'NA') ? 0 : (count(self::$fieldsets) + 1);
        self::$fieldsets[$fieldset] = [
          'name' => $fieldset,
          'label' => null,
          'order' => $order
        ];
      }
    }

    return $this;
  }


  /**
   * Change field option
   *
   * @param   string $field_name
   * @param   string $option_name
   * @param   string $value
   *
   * @access  public
   * 
   * @return  FormBuilder
   *
   * @author mchanchaf
   */
  public function setFieldOptions($field_name, $option_name, $value)
  {
    self::$fields[$field_name][$option_name] = $value;

    return $this;
  }


  /**
   * Set fieldsets
   *
   * @param   array $fieldsets
   *
   * @access  public
   * 
   * @return void
   *
   * @author mchanchaf
   */
  public function setFieldsets($fieldsets = [])
  {
    foreach ($fieldsets as $key => $options) {
      self::$fieldsets[ $options['name'] ] = array_merge([
        'name' => null,
        'label' => null,
        'order' => (count(self::$fieldsets) + 1)
      ], $options);
    }
    return $this;
  }


  /**
   * Render form HTML
   *
   * @access  public
   * 
   * @return  string $form
   *
   * @author mchanchaf
   */
  public function render()
  {
    // Before render event
    $form_id = self::$name;
    self::triggerEvent($form_id .'BeforeRender', $form_id);
    
    $html = null;
    $fieldsetsFields = self::getFieldsetsFields();

    usort(self::$fieldsets, self::usort('order', 'asc'));
    foreach (self::$fieldsets as $key => $fieldset) {
      $fieldset_name = $fieldset['name'];
      if (!isset($fieldsetsFields[$fieldset_name]) || empty($fieldsetsFields[$fieldset_name])) 
        continue;

      // Reset columns counter
      $countCols = 0;

      $html .= '<fieldset>';
      if ($fieldset_name != 'NA') $html .= '<legend>'. $fieldset['label'] .'</legend>';
      $html .= '<div class="row">';
      usort($fieldsetsFields[$fieldset_name], self::usort('order', 'asc'));
      foreach ($fieldsetsFields[$fieldset_name] as $key => $field) {
        // Count grid columns
        $countCols = ($countCols + $field['columns'] + $field['offset']);

        // Close row if grid is full
        if ($countCols > 12) {
          $countCols = 0;
          $html .= '</div><div class="row">';
        }

        $html .= self::getTemplate($field);

        // Close row if grid is full
        if ($countCols == 12) {
          $countCols = 0;
          $html .= '</div><div class="row">';
        }
      }
      $html .= '</div>';
      $html .= '</fieldset>';
    }

    // Buttons
    if (!empty(self::$buttons)) {
      $html .= '<div class="row"><div class="col-md-12"><div class="ligneBleu mt-10"></div>';
      foreach (self::$buttons as $key => $button) {
        $html .= self::field($button);
      }
      $html .= '</div></div>';
    }

    if (self::$options['with_wrapper']) {
      $html = '<form method="'. self::$options['method'] .'" action="'. self::$options['action'] .'" '. self::getAttributes(self::$attributes) .'>'. $html .'</form>';
    }

    return $html;
  }


  /**
   * Sort a multi-domensional array of objects by key value
   * Usage: usort($array, arrSortObjsByKey('VALUE_TO_SORT_BY'));
   * Expects an array of objects. 
   *
   * @param array   $array
   * @param string  $key  The name of the parameter to sort by
   * @param string  $order the sort order
   * @return void
   *
   * @author mchanchaf
   */ 
  public static function usort($key, $order = 'DESC')
  {
    return function($a, $b) use ($key, $order) {
      // Swap order if necessary
      if ($order == 'DESC') {
        list($a, $b) = array($b, $a);
      } 
      // Check data type
      if (is_numeric($a[$key])) {
        return $a[$key] - $b[$key]; // compare numeric
      } else {
        return strnatcasecmp($a[$key], $b[$key]); // compare string
      }
    };
  }


  private static function getFieldsetsFields()
  {
    $fieldsetsFields = [];
    foreach (self::$fields as $key => $field) {
      if (!self::getFieldOption('displayed', self::$name, $field['name'])) continue;

      $fieldset = $field['fieldset'];
      $fieldsetsFields[$fieldset][] = $field;
    }
    return $fieldsetsFields;
  }


  /**
   * Render field HTML
   *
   * @param array $field
   *
   * @access  public
   * 
   * @return  string $html
   *
   * @author mchanchaf
   */
  public static function field($field)
  {
    $html = '';
    $attributes = self::getFieldAttributes($field);

    switch ($field['type']) {
      case 'select':
        $otherSelected = false;
        $fieldId = $field['attributes']['id'] .'_other';
        $otherValue = (isset(self::$model[$fieldId])) ? self::$model[$fieldId] : null;

        $html = '<select '. $attributes .'>';
        foreach ($field['options'] as $value => $text) :
          if (is_object($text)) {
            $value = (isset($text->value)) ? $text->value : null;
            $text  = (isset($text->text)) ? $text->text : null;
          }
          $selected = '';
          if ($field['value'] == $value) {
            $selected = ' selected';
          }

          if ($field['keys_as_values']) {
            $value = $text;
          }

          if (!empty($field['option_tpl'])) {
            $html .= self::parseTemplate($field['option_tpl'], [
              'value' => $value,
              'text' => $text,
              'attributes' => $selected,
            ]);
          } else {
            $html .= '<option value="'. $value .'"'. $selected .'>'. $text .'</option>';
          }
        endforeach;
        if (!empty($otherValue)) $otherSelected = true;
        if($field['with_other']) {
          $selected = ($otherSelected) ? ' selected' : '';
          $html .= '<option value="_other" chm-form-other="'. $fieldId .'"'. $selected .'>'. trans("Autres (à péciser)") .'</option>';
        }
        $html .= '</select>';

        // Add other input
        if($field['with_other']) {
          $html .= self::field([
            'name'       => $fieldId,
            'type'       => 'text',
            'attributes' => [
              'value' => $otherValue,
              'name'  => $fieldId,
              'type'  => 'text',
              'title' => trans("Autres (à péciser)"),
              'class' => 'form-control mt-5 mb-0',
              'id'    => $fieldId,
              'style' => ($otherSelected) ? 'display:block;' : 'display:none;',
            ]
          ]);
        }
        break;
      case 'textarea':
        $html .= '<textarea '. $attributes .'>'. $field['value'] .'</textarea>';
        break;
      case 'file':
        $value = $field['value'];
        $display = (!empty($value)) ? ' style="display:none;"' : '';
        $html .= '<div class="input-group file-upload"'. $display .'>
          <input type="text" class="form-control" readonly>
          <label class="input-group-btn">
            <span class="btn btn-success btn-sm">
              <i class="fa fa-upload"></i>
              <input '. $attributes .'>
            </span>
          </label>
        </div>';
        if (!empty($value)) {
          $delete_args = self::parseTemplate($field['delete_args'], self::$model, '$', '$');
          $confirm = "return chmModal.confirm('', 'Alert!', '". trans("Êtes-vous sûr?") ."', '". $field['delete_callback'] ."', ". htmlentities($delete_args) .", {width: 300})";
          $html .= '<div class="btn-group" role="group">
          <a href="javascript:void(0)" class="btn btn-danger" style="padding: 3px 8px;" title="'. trans("Supprimer") .'" onclick="'. $confirm .'"><i class="fa fa-trash"></i></a>
          <a href="'. $value .'" target="_blank" class="btn btn-default" style="padding: 3px 8px;" title="'. trans("Télécharger") .'"><i class="'. File::getIconClass($value) .'"></i></a>';
          $html .= '</div>';
        }
        break;
      case (in_array($field['type'], ['submit', 'reset', 'button'])):
        $html .= '<button type="'. $field['type'] .'" '. $attributes .'>'. $field['label'] .'</button>';
        break;
      default:
        $html = '';
        $type = $field['type'];
        if (in_array($type, ['checkbox', 'radio'])) {
          $inline = (self::execute($field['inline'], self::$model)) ? ' class="'. $type .'-inline"' : '';
          $html .= '<div class="mt-10">';
          foreach ($field['options'] as $value => $text) {
            if (is_object($text)) {
              $value = (isset($text->value)) ? $text->value : null;
              $text  = (isset($text->text)) ? $text->text : null;
            }

            // Tell if field is checked
            $checked = '';
            if (
              (is_array($field['value']) && in_array($value, $field['value'])) || 
              ($value == $field['value'])
            ) {
              $checked = ' checked';
            }

            $html .= '<label'. $inline .'>';
            $html .= '<input type="'. $type .'" name="'. $field['name'] .'" value="'. $value .'"'. $checked .'>&nbsp;'. $text;
            $html .= '</label>';
          }
          $html .= '</div>';
        } else {
          $html .= '<input '. $attributes .'>';
        }
        break;
    }

    return $html;
  }


  /**
   * Get Help Block markup
   *
   * @param string $text
   * @access  public
   * 
   * @return  string $help_block
   *
   * @author mchanchaf
   */
  public static function getHelpBlock($text)
  {
    return "<p class=\"help-block\">{$text}</p>";
  }


  /**
   * Get attributes
   *
   * @param array  $attributes
   *
   * @access  public
   *
   * @return string $attributes
   *
   * @author mchanchaf
   */
  public static function getAttributes($attributes)
  {
    $attr_arr = [];
    foreach ($attributes as $k => $v) {
      if ($k == 'value' && is_array($v)) continue;
      $value = self::execute($v, self::$model);
      $attr_arr[] = (is_numeric($k)) ? $value : $k .'="'. $value .'"';
    }
    return implode(' ', $attr_arr);
  }


  /**
   * Get field attributes
   *
   * @param array  $field
   *
   * @access  public
   *
   * @return string $attributes
   *
   * @author mchanchaf
   */
  public static function getFieldAttributes($field)
  {
    $attributes = [];

    // Add title
    if (!empty($field['label']) && !isset($field['attributes']['title'])) {
      $field['attributes']['title'] = $field['label'];
    }

    // Remove attr value for input type file
    if (in_array($field['type'], ['select', 'textarea', 'file'])) {
      unset($field['attributes']['value']);
    }
    $field['attributes']['type'] = $field['type'];
    $field['attributes']['name'] = $field['name'];
    if(isset($field['value'])) $field['attributes']['value'] = $field['value'];
    if(isset($field['required']) && $field['required'] == true) $field['attributes'][] = 'required';

    foreach ($field['attributes'] as $k => $v) {
      if (!empty($field['value']) && $field['type'] == 'file' && $k == 'id') continue;
      if ($k == 'value' && is_array($v)) continue;
      $value = self::execute($v, self::$model);
      $attributes[] = (is_numeric($k)) ? $value : $k .'="'. $value .'"';
    }

    return implode(' ', $attributes);
  }


  /**
   * Set form settings
   *
   * @param array  $settings
   *
   * @access  public
   *
   * @return void
   *
   * @author mchanchaf
   */
  public static function setSettings($settings)
  {
    self::$settings = array_replace_recursive(self::$settings, $settings);
  }


  /**
   * Set form attributes
   *
   * @param array  $attributes
   *
   * @access  public
   *
   * @return void
   *
   * @author mchanchaf
   */
  public static function setAttributes($attributes)
  {
    self::$attributes = array_replace_recursive(self::$attributes, $attributes);
  }


  /**
   * Get field template
   *
   * @param array|null $field
   *
   * @access  public
   * 
   * @return  string $field
   *
   * @author mchanchaf
   */
  public static function getTemplate($field = null)
  {
    // Get template 
    $template = (!empty($field['template'])) ? $field['template'] : self::$template;

    // Prepare template variables
    $isRequired = (!empty($field)) ? self::getFieldOption('required', self::$name, $field['name']) : false;
    $label = (!empty($field['label'])) ? '<label for="'. $field['attributes']['id'] .'">'. $field['label'] .'</label>' : '';
    $variables['html_label'] = $label;
    $variables['help_block'] = (!empty($field['help'])) ? self::getHelpBlock($field['help']) : '';
    $variables['html_field'] = (!empty($field)) ? self::field($field) : '';
    $required = ($isRequired) ? ' required' : '';
    $variables['attributes'] ='class="form-group'.$required.'" id="'. $field['attributes']['id'] .'Container"';

    // Parse template
    $fieldHtml = self::parseTemplate($template, $variables);

    if (isset($field['columns']) && intval($field['columns']) > 0) {
      $offset = (intval($field['offset']) > 0) ? ' col-md-offset-'. $field['offset'] : '';
      $fieldHtml = '<div class="col-md-'. $field['columns'] . $offset. '">'. $fieldHtml .'</div>';
    }

    return $fieldHtml;
  }


  /**
   * Set global template
   * This will be applied for all form fields
   *
   * @param string $template
   *
   * @access  public
   * 
   * @return void
   *
   * @author mchanchaf
   */
  public static function setTemplate($template)
  {
    self::$template = $template;
  }


  /**
   * Returns the Parsed Field Template
   *
   * @param string $template
   * @param array  $variables
   * @param string $openingTag
   * @param string $closingTag
   *
   * @access  public
   * 
   * @return string HTML with any matching variables {{varName}} replaced with there values.
   *
   * @author mchanchaf
   */
  public static function parseTemplate($template, $variables = [], $openingTag = '{', $closingTag = '}') {
    foreach ($variables as $key => $variable) :
      $template = str_replace($openingTag. $key . $closingTag, $variable, $template);
    endforeach;

    return $template;
  }

  /**
   * Get field MySql column name
   *
   * @param string $field_name
   *
   * @access  public
   * 
   * @return  string $name
   *
   * @author mchanchaf
   */
  public static function getFieldName($field_name)
  {
    preg_match('/\[([a-zA-Z0-9_-]+)]/', $field_name, $matches);
    return (isset($matches[1])) ? $matches[1] : $field_name;
  }


  /**
   * Get field option by name
   *
   * @param string $option_name
   * @param string $form_id
   * @param string $field_name
   *
   * @access  public
   * 
   * @return  string $option value
   *
   * @author mchanchaf
   */
  public static function getFieldOption($option_name, $form_id, $field_name, $type = 'fields')
  {
    // Trigger form setting event to get settings from a resource
    self::triggerEvent('chmFormSetting', $form_id);

    $fname = self::getFieldName($field_name);
    if ($option_name == 'required' && !self::getFieldOption('displayed', $form_id, $fname)) {
      return false;
    }

    if (!isset(self::$settings[$fname][$option_name])) {
      if (isset(self::$fields[$field_name][$option_name])) {
        return self::execute(self::$fields[$field_name][$option_name]);
      } else {
        return true;
      }
    }

    return self::$settings[$fname][$option_name];
  }


  /** 
   * Add new event
   *
   * @param string $name
   * @param array $callable
   *
   * @access  public
   * 
   * @return void
   *
   * @author mchanchaf
   */
  public static function addEvent($name, $callable)
  {
    self::$events[$name][] = $callable;
  }


  /**
   * Trigger form event
   *
   * @param string $name
   * @param array $args
   *
   * @access  public
   * 
   * @return void
   *
   * @author mchanchaf
   */
  public static function triggerEvent($name, $args = [])
  {
    if (!isset(self::$events[$name]) || in_array($name, self::$triggeredEvents)) return;

    foreach (self::$events[$name] as $key => $callback) {
      self::execute($callback, $args);
    }

    self::$triggeredEvents[] = $name;
  }


  /**
   * Execute
   *
   * @param string|callable $name
   * @param array $args
   *
   * @access  public
   * 
   * @return  string $value
   *
   * @author mchanchaf
   */
  public static function execute($name, $args = [])
  {
    $excluded_func = ['file', 'date'];

    // Check if is a callback function
    if (is_callable($name) && !in_array($name, $excluded_func)) {
      return call_user_func($name, $args);
    }

    // Check if class with method
    if (is_string($name) && strpos($name, '@') !== false) {
      $callable = explode('@', $name);
      if(method_exists($callable[0], $callable[1]) && is_callable($callable)) {
        return call_user_func_array($callable, $args);
      }
    }

    return $name;
  }


} // End Class
