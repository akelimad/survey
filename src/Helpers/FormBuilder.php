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
  protected $name;

  /**
   * Model
   *
   * @access protected
   * @var    object
   */
  protected $model;

  /**
   * Array of options
   *
   * @access protected
   * @var    array
   */
  protected $options = [
    'method' => 'POST',
    'action' => '',
    'template' => '',
    'attributes' => [
      'class' => 'chm-simple-form',
      'id' => ''
    ]
  ];

  /**
   * Array of fields
   *
   * @access protected
   * @var    array
   */
  protected $fields = [];

  /**
   * Array of sections
   *
   * @access protected
   * @var    array
   */
  protected $sections = [];


  /**
   * Constructor
   *
   * @access  public
   * @param   string $name Form name
   * @param   array $options An array of options
   * @param   array $model Object contain fields values
   * 
   * @return  void
   */
  public function __construct($name, $options = [], $model = null)
  {
    $this->name = $name;
    $this->model = $model;

    $this->options['attributes']['id'] = $name .'Form';
    $this->options = array_replace_recursive($this->options, $options);
  }

  /**
   * Add new field
   *
   * @access  public
   * @param   string $name
   * @param   string $type
   * @param   array $options
   * 
   * @return  FormBuilder
   */
  public function add($name, $type, $options = [])
  {
    // Create ID from name
    $id = str_replace('[', '_', $name);

    // Get field column name
    preg_match('/\[([a-zA-Z0-9_-]+)]/', $name, $matches);
    $column = (isset($matches[1])) ? $matches[1] : $name;

    // Get value
    $value = null;
    if (isset($_POST[$column])) {
      $value = $_POST[$column];
    } else if (isset($_GET[$column])) {
      $value = $_GET[$column];
    } else if (isset($this->model->$column)) {
      $value = $this->model->$column;
    }

    // Add to fields list
    $this->fields[$name] = array_replace_recursive([
      'name'       => $name,
      'type'       => $type,
      'label'      => null,
      'value'      => $value,
      'section'    => 'NA',
      'template'   => null,
      'options'    => [],
      'with_other' => false,
      'attributes' => [
        'value' => $value,
        'id' => trim(str_replace(']', '', $id), '_'),
        'class' => 'form-control mb-0',
        'inline' => false,
      ],
      'columns'    => 4,
      'offset'     => 0,
      'order'      => (count($this->fields) + 1),
      'rules'      => null,
      'help'       => null,
      'required'   => false,
      'displayed'  => true,
    ], $options);

    // Set field section
    $sectionName = $this->fields[$name]['section'];
    if (!isset($this->sections[$sectionName])) {
      $this->sections[$sectionName] = [
        'label' => null,
        'order' => (count($this->sections) + 1)
      ];
    }

    return $this;
  }


  /**
   * Set section attributes
   *
   * @access  public
   * @param   string $name
   * @param   array $options
   * 
   * @return  FormBuilder
   */
  public function setSection($name, $options = [])
  {
    $this->sections[$name] = array_merge([
      'label' => null,
      'order' => (count($this->sections) + 1)
    ], $options);

    return $this;
  }


  private function sortFields()
  {
    $sorted_fields = [];
    foreach ($this->fields as $key => $field) {
      $section = $field['section'];
      if (!isset($this->sections[$section])) continue;

      unset($field['section']);

      $sorted_fields[$section][] = $field;
    }
    return $sorted_fields;
  }


  /**
   * Render form HTML
   *
   * @access  public
   * 
   * @return  string $form
   */
  public function render()
  {
    $html = null;
    $sortedFields = $this->sortFields();

    foreach ($this->sections as $section_name => $section) {
      // Reset columns counter
      $row_cols = 0;

      if (!isset($sortedFields[$section_name])) continue;

      // Print fields group name
      if (!is_null($section['label'])) {
        $html .= '<div class="styled-title mt-0 mb-10"><h3>'. $section['label'] .'</h3></div>';
      }

      // Generate fields
      $html .= '<div class="row">';
      // TODO - sort fields
      foreach ($sortedFields[$section_name] as $key => $field) {
        if (!$this->isDisplayed($field)) continue;



      }
      $html .= '</div>';
    }


    return $html;

    // echo $this->getTemplate($this->fields['offer[Name]']);exit;
    // // return $this->model->Name;
    // return $this->getTemplate($this->fields['offer[Name]']);


    // return $this->execute('App\Models\City@findAll');
  }


  /**
   * Render field HTML
   *
   * @param array $field
   *
   * @access  public
   * 
   * @return  string $field
   */
  public function renderField($field)
  {
    switch ($field['type']) {
      case 'select':
        return $this->select($field);
        break;
      case 'textarea':
        return $this->textarea($field);
        break;
      default:
        return $this->input($field);
        break;
    }
  }


  /**
   * Input
   *
   * @param array $field
   *
   * @access  public
   * 
   * @return  string $input
   */
  public function input($field)
  {
    $html = '';
    $type = $field['type'];
    if (in_array($type, ['checkbox', 'radio'])) {
      $inline = ($this->execute($field['attributes']['inline'])) ? $type .'-inline' : '';
      $html .= '<div class="mt-10">';
      foreach ($field['options'] as $key => $value) {
        $html .= '<label class="'. $inline .'">';
        $html .= '<input type="'. $type .'" name="'. $field['name'] .'" value="'. $key .'">&nbsp;'. $value;
        $html .= '</label>';
      }
      $html .= '</div>';
    } else {
      $html .= '<input '. $this->getAttributes($field) .'>';
    }
    return $html;
  }


  /**
   * Select
   *
   * @param array $field
   *
   * @access  public
   * 
   * @return  string $select
   */
  public function select($field)
  {
    $is_selected = false;
    $fieldId = $field['attributes']['id'] .'_other';
    $html = '<select '. $this->getAttributes($field) .'>';
    foreach (self::execute($field['options']) as $value => $text) :
      if (is_object($text)) {
        $value = (isset($text->value)) ? $text->value : null;
        $text  = (isset($text->text)) ? $text->text : null;
      }
      $selected = '';
      if ($field['value'] === $value) {
        $selected = ' selected';
        $is_selected = true;
      }
      $html .= '<option value="'. $value .'"'. $selected .'>'. $text .'</option>';
    endforeach;
    if($field['with_other']) {
      $selected = ($is_selected) ? ' selected' : '';
      $html .= '<option value="_other" chm-form-other="'. $fieldId .'"'. $selected .'>'. trans("Autres (à péciser)") .'</option>';
    }
    $html .= '</select>';
    // Add other input
    if($field['with_other']) {
      $html .= $this->input([
        'type' => 'text',
        'attributes' => [
          'name' => $fieldId,
          'type' => 'text',
          'title' => trans("Autres (à péciser)"),
          'class' => 'form-control mt-10 mb-0',
          'id' => $fieldId,
          'style' => 'display:none;',
          // TODO - Set value
        ]
      ]);
    }
    return $html;
  }


  /**
   * Textarea
   *
   * @param array $field
   *
   * @access  public
   * 
   * @return  string $textarea
   */
  public function textarea($field)
  {
    return '<textarea '. $this->getAttributes($field) .'>'. $field['value'] .'</textarea>';
  }


  /**
   * Get field attributes
   *
   * @param array  $field
   *
   * @return string $attributes
   *
   * @author Mhamed Chanchaf
   */
  private function getAttributes($field)
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

    unset($field['attributes']['inline']);
    foreach ($field['attributes'] as $k => $v) {
      $value = $this->execute($v, $this);
      $attributes[] = (is_numeric($k)) ? $value : $k .'="'. $value .'"';
    }

    return implode(' ', $attributes);
  }


  /**
   * Execute
   *
   * @param string|callable $name
   *
   * @access  private
   * 
   * @return  string $value
   */
  private function execute($name, $args = [])
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


  /**
   * Get field template
   *
   * @access  public
   * 
   * @return  string $form
   */
  private function getTemplate($field)
  {
    // Default template
    $template = '<div class="form-group{required_class}">{html_label}{html_field}{help_block}</div>';
    if (!empty($field['template'])) {
      // Custom field template
      $template = $field['template'];
    } else if (!empty($this->options['template'])) {
      // Global form template
      $template = $this->options['template'];
    }

    $variables = [
      'html_field' => $this->renderField($field),
      'required_class' => ($this->isRequired($field)) ? ' required' : '',
      'html_label' => '',
      'help_block' => '',
    ];

    // add label
    if (!empty($field['label'])) {
      $variables['html_label'] = '<label for="'. $field['attributes']['id'] .'">'. $field['label'] .'</label>';
    }

    // add help block
    if (!empty($field['help'])) {
      $variables['help_block'] = $this->getHelpBlock($field['help']);
    }

    // Render template
    return preg_replace_callback('#{([^}]+)}#', function($m) use ($template, $variables){
      if(isset($variables[$m[1]])){
        return $variables[$m[1]];
      }else{
        return $m[0];
      }
    }, $template);
  }


  /**
   * Check if field required
   *
   * @param string $field
   * @access  public
   * 
   * @return   bool $required
   */
  private function isRequired($field)
  {
    if (isset($field['attributes']['required'])) {
      return $this->execute($field['attributes']['required']);
    }

    if (in_array('required', $field['attributes'])) {
      return true;
    }

    return self::getFieldOption('displayed', $this->name, $field['name']);
  }


  /**
   * Check if field displayed
   *
   * @param string $field
   * @access  public
   * 
   * @return   bool $displayed
   */
  private function isDisplayed($field)
  {
    if (isset($field['attributes']['displayed'])) {
      return $this->execute($field['attributes']['displayed']);
    }

    if (in_array('displayed', $field['attributes'])) {
      return true;
    }

    return self::getFieldOption('displayed', $this->name, $field['name']);
  }


  /**
   * Get Help Block
   *
   * @param string $text
   * @access  public
   * 
   * @return  string $help_block
   */
  private function getHelpBlock($text)
  {
    return "<p class=\"help-block\">{$text}</p>";
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
