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
    'class' => 'chm-simple-form'
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
   * Array of fieldsetsFields
   *
   * @access protected
   * @var    array
   */
  protected static $fieldsetsFields = [];

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
    static::$name = $name;
    static::$model = (array) $model;

    static::$attributes['id'] = $name .'Form';
    static::$options = array_replace_recursive(static::$options, $options);
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
    $column = static::getFieldName($name);

    // Get field value
    $value = null;
    if (isset($_POST[$column])) {
      $value = $_POST[$column];
    } else if (isset($_GET[$column])) {
      $value = $_GET[$column];
    } else if (isset(static::$model[$column])) {
      $value = static::$model[$column];
    }

    $fieldset = (isset($options['fieldset'])) ? $options['fieldset'] : 'NA';

    // Add to fields list
    $options = array_replace_recursive([
      'name'       => $name,
      'type'       => $type,
      'label'      => null,
      'value'      => $value,
      'fieldset'   => $fieldset,
      'template'   => null,
      'options'    => [],
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
      'order'      => (count(static::$fields) + 1),
      'rules'      => null,
      'help'       => null,
      'required'   => false,
      'displayed'  => true,
    ], $options);

    // Add ability to get value as closure
    $options['value'] = static::execute($options['value'], $value);

    static::$fields[$name] = $options;
    static::$fieldsetsFields[$fieldset][$name] = $options;

    // Set field fieldset
    if (!isset(static::$fieldsets[$fieldset])) {
      $order = ($fieldset == 'NA') ? 0 : (count(static::$fieldsets) + 1);
      static::$fieldsets[$fieldset] = [
        'name' => $fieldset,
        'label' => null,
        'order' => $order
      ];
    }

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
      static::$fieldsets[ $options['name'] ] = array_merge([
        'name' => null,
        'label' => null,
        'order' => (count(static::$fieldsets) + 1)
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
    $html = null;
    usort(static::$fieldsets, static::usort('order', 'asc'));

    foreach (static::$fieldsets as $key => $fieldset) {
      $fieldset_name = $fieldset['name'];
      if (empty(static::$fieldsetsFields[$fieldset_name])) continue;

      // Reset columns counter
      $countCols = 0;

      $html .= '<fieldset>';
      if ($fieldset_name != 'NA') $html .= '<legend>'. $fieldset['label'] .'</legend>';
      $html .= '<div class="row">';
      usort(static::$fieldsetsFields[$fieldset_name], static::usort('order', 'asc'));
      foreach (static::$fieldsetsFields[$fieldset_name] as $key => $field) {
        if (!static::getFieldOption('displayed', static::$name, $field['name'])) continue;

        $countCols = ($countCols + $field['columns'] + $field['offset']);
        if ($countCols > 12) {
          $countCols = 0;
          $html .= '</div><div class="row">';
        }

        $html .= static::getTemplate($field);
      }
      $html .= '</div>';
      $html .= '</fieldset>';
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
    $attributes = static::getFieldAttributes($field);

    switch ($field['type']) {
      case 'select':
        $is_selected = false;
        $fieldId = $field['attributes']['id'] .'_other';
        $html = '<select '. $attributes .'>';
        foreach (static::execute($field['options']) as $value => $text) :
          if (is_object($text)) {
            $value = (isset($text->value)) ? $text->value : null;
            $text  = (isset($text->text)) ? $text->text : null;
          }
          $selected = '';
          if ($field['value'] === $value) {
            $selected = ' selected';
            $is_selected = true;
          }

          if (!empty($field['option_tpl'])) {
            $html .= static::parseTemplate($field['option_tpl'], [
              'value' => $value,
              'text' => $text,
              'attributes' => $selected,
            ]);
          } else {
            $html .= '<option value="'. $value .'"'. $selected .'>'. $text .'</option>';
          }
        endforeach;
        if($field['with_other']) {
          $selected = ($is_selected) ? ' selected' : '';
          $html .= '<option value="_other" chm-form-other="'. $fieldId .'"'. $selected .'>'. trans("Autres (à péciser)") .'</option>';
        }
        $html .= '</select>';
        // Add other input
        if($field['with_other']) {
          $html .= static::field([
            'name'       => $fieldId,
            'type'       => 'text',
            'attributes' => [
              'value' => (isset(static::$model[$fieldId])) ? static::$model[$fieldId] : null,
              'name' => $fieldId,
              'type' => 'text',
              'title' => trans("Autres (à péciser)"),
              'class' => 'form-control mt-10 mb-0',
              'id' => $fieldId,
              'style' => (!$is_selected) ? 'display:none;' : '',
            ]
          ]);
        }
        break;
      case 'textarea':
        $html .= '<textarea '. $attributes .'>'. $field['value'] .'</textarea>';
        break;
      default:
        $html = '';
        $type = $field['type'];
        if (in_array($type, ['checkbox', 'radio'])) {
          $inline = (static::execute($field['inline'])) ? ' class="'. $type .'-inline"' : '';
          $html .= '<div class="mt-10">';
          foreach ($field['options'] as $key => $value) {
            $checked = ($key == $field['value']) ? ' checked' : '';
            $html .= '<label'. $inline .'>';
            $html .= '<input type="'. $type .'" name="'. $field['name'] .'" value="'. $key .'"'. $checked .'>&nbsp;'. $value;
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
    if(isset($field['required'])) $field['attributes']['required'] = $field['required'];

    foreach ($field['attributes'] as $k => $v) {
      $value = static::execute($v);
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
    static::$settings = array_replace_recursive(static::$settings, $settings);
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
    static::$attributes = array_replace_recursive(static::$attributes, $attributes);
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
    $template = (!empty($field['template'])) ? $field['template'] : static::$template;

    // Prepare template variables
    $isRequired = static::getFieldOption('required', static::$name, $field['name']);
    $label = (!empty($field['label'])) ? '<label for="'. $field['attributes']['id'] .'">'. $field['label'] .'</label>' : '';
    $variables['html_label'] = $label;
    $variables['help_block'] = (!empty($field['help'])) ? static::getHelpBlock($field['help']) : '';
    $variables['html_field'] = static::field($field);
    $required = ($isRequired) ? ' required' : '';
    $variables['attributes'] ='class="form-group'.$required.'"';

    // Parse template
    $fieldHtml = static::parseTemplate($template, $variables);

    if (intval($field['columns']) > 0) {
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
    static::$template = $template;
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
    static::triggerEvent('chmFormSetting', $form_id);

    $fname = static::getFieldName($field_name);
    if ($option_name == 'required' && !static::getFieldOption('displayed', $form_id, $fname)) {
      return false;
    }

    if (!isset(static::$settings[$fname][$option_name])) {
      if (isset(static::$fields[$field_name][$option_name])) {
        return static::execute(static::$fields[$field_name][$option_name]);
      } else {
        return true;
      }
    }

    return static::$settings[$fname][$option_name];
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
    static::$events[$name][] = $callable;
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
    if (empty(static::$events) || in_array($name, static::$triggeredEvents)) return;

    foreach (static::$events[$name] as $key => $callback) {
      static::execute($callback, $args);
    }

    static::$triggeredEvents[] = $name;
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
    // Check if is a callback function
    if (is_callable($name)) {
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
