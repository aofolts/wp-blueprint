<?php

namespace Blueprint\Acf\Fields;

use \Blueprint\Acf as Acf;

class Field {

  // Used for both "field group" and "group field"
  use Acf\FieldBuilder;

  protected $debugId;
  protected $name;
  protected $field = array();
  protected $hidden;
  protected $key;
  protected $logic;
  protected $prefix;
  protected $saveKeys;
  protected $saveValue;

  /**
   *
   *
   * @param string $name: the name of the field
   */

  function __construct($name) {

    $this->setName($name);
    $this->field['wrapper'] = array();
    $this->setRequired(true);

    if (method_exists($this,'init')) {$this->init();}

  }

  /**
   * Adds an additional key to be saved
   *
   * @param string $key: the name of the key to save
   * @param string $table: the name of the SQL table to save to
   */

  function addSaveKey($key,$table=null) {

    // if (!$table) {
    //   switch ($key) {
    //     case 'post_title'   : $table = 'wp_posts'; break;
    //     case 'post_content' : $table = 'wp_posts'; break;
    //     default : $table = 'wp_postmeta';
    //   }
    // }

    $table = $table ?: 'wp_postmeta';

    // Setup vars
    $save = array();
    if (!is_array($this->saveKeys)) {$this->saveKeys = array();}

    // Set table type
    $tables = array('wp_posts','wp_postmeta','wp_options','wp_users');
    if (!in_array($table,$tables)) {diedump('Field addSaveKey: invalid db table');}
    $save['table'] = $table;

    // Add key
    $save['key'] = $key;

    array_push($this->saveKeys,$save);

    add_filter("acf/update_value/key=$this->key",array($this,'saveValue'));

    return $this;

  }

  // Makes field read-only
  function setDisabled($bool) {
    $this->field['disabled'] = (bool) $bool;
    $this->field['readonly'] = (bool) $bool;

    return $this;
  }

  // Returns $key
  function getKey($format='raw') {
    if ($format == 'raw') {return str_replace('field_','',$this->key);}
    else {return $this->key;}
  }

  // Gets the field logic

  function getLogic() {
    if (!isset($this->logic)) {$this->setLogic();}
    return $this->logic;
  }

  // Gets the field name

  function getName() {
    return $this->field['name'];
  }

  // Gets the field type

  function getType() {
    return $this->field['type'];
  }

  function hideLabel() {
    $this->addClass('hide_label');
    return $this;
  }

  //Sets the field's conditional logic
  //TODO: Rewrite LogicBuilder

  function setLogic($key,$value=null,$operator='==') {
    // Get parent key
    $keyPrefix = str_replace($this->getName(),'',$this->getKey());
  
    $logic = (new Acf\LogicBuilder($keyPrefix));
    $this->logic = $logic;
  
    $logic->addRuleGroup()
      ->addRule($key,$value,$operator);
  
    return $this;
  }

  // Adds a secondary field key/value to load
  // if the primary key is null or not set

  function addLoadKey($key,$table=null) {

    // TODO: Is this necessary?

  }

  // Saves the field in addition keys
  // as specified in addSaveKey()

  function saveValue($val) {

    if (is_array($this->saveKeys)) {
      foreach ($this->saveKeys as $save) {
        switch($save['table']) {
          case 'wp_postmeta' :
            $update = update_post_meta(get_the_ID(),$save['key'],$val);
            break;
          case 'wp_posts' :
            $update = wp_update_post(array(
              'ID' => get_the_ID(),
              $save['key'] => $val
            ));
            break;
        }
      }
    }
    return $val;

  }

  function setClass($class) {
    $this->field['wrapper']['class'] = $class;
    return $this;
  }

  function addClass($class) {

    if (!isset($this->field['wrapper']['class'])) {
      $this->field['wrapper']['class'] = '';
    }
    $this->field['wrapper']['class'] .= " $class ";
    return $this;

  }

  function setDefaultValue($value) {
    $this->field['default_value'] = $value;
    return $this;
  }

  function setHidden($bool) {
    $this->hidden = (bool) $bool;
    return $this;
  }

  // Adds instructions to the field

  function setInstructions($desc) {

    $this->field['instructions'] = $desc;
    return $this;

  }

  // Set field key

  function setKey($key) {

    // Add "field_" prefix if absent
    if (strpos($key,'field_') !== 0) {
      $key = 'field_' . $key;
    }

    // Store as property for easy access
    $this->key = $key;

    // Store in field array
    $this->field['key'] = $key;
    return $this;

  }

  // Sets the field name

  protected function setName($name) {

    $this->name = strtolower($name);
    $this->field['name']  = $name;
    $this->field['_name'] = '_' . $name;
    $this->setKey($name);
    $this->setLabel($name);

    return $this;

  }

  // Set field label

  function setLabel($label) {

    $label = ucwords(str_replace('_',' ',$label));
    $this->field['label'] = $label;
    return $this;

  }

  // Set the field type

  function setType($type) {
    $this->field['type'] = strtolower($type);
    return $this;
  }

  // Set required or optional

  function setRequired($required) {

    $this->field['required'] = (bool) $required;
    return $this;

  }

  // Set the field width

  function setWidth($width) {
    $this->field['wrapper']['width'] = $width;
    return $this;
  }

  // Returns field array

  function getField() {

    // Add save keys as backup values (if default key has no value)
    if ($this->saveKeys) {
      add_action("acf/load_value/key=$this->key",array($this,'loadSaveKeys'));
    }

    if ($this->logic) {
      $this->field['conditional_logic'] = $this->logic->getLogic();
    }

    if ($this->hidden) {
      $this->addClass('hidden');
    }

    return $this->field;

  }

  // Loads fallback values if the field is empty
  function loadSaveKeys($value) {

    global $post;
    // Convert object to array
    $arr = (array) $post;
    
    // Attempt to load value if empty for easy access
    if (empty($value)) {
      // Loop through save keys
      foreach ($this->saveKeys as $pair) {
        $table = $pair['table'];
        $key   = $pair['key'];
        
        // Get value from appropriate table
        if ($table == 'wp_postmeta') {
          $value = get_post_meta($post->ID,$key,true);
        } elseif ($table == 'wp_posts') {
          $value = $post[$key];
        }

        if ($value) {break;}
      }
    }

    return $value;

  }

}
