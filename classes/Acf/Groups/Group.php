<?php

namespace Blueprint\Acf\Groups;

use \Blueprint\Acf as Acf;

class Group {

  // Used for both "field group" and "group field"
  use Acf\FieldBuilder;

  // $location, getLocation, setLocation
  use Acf\LocationBuilderTrait;

  protected $key;
  protected $title;
  protected $field;

  /**
   * Sets group key and title
   *
   * @param string $name : The name of the group
   */

  function __construct($name) {

    $this->setKey($name);
    $this->name = $name;

    $title = str_replace('_',' ',$name);
    $title = ucwords($title);
    $this->setTitle($title);
    $this->setLabelPlacement('left');

    // Initialize child groups
    if (method_exists($this,'init')) {
      $this->init();
    }

    // Sets the action, depending on whether the init action
    // has already fired
    if (current_action() == 'init') {$action = 'bp/register_fields';}
    else {$action = 'init';}

    // Registers the field
    add_action($action,array($this,'register'));

  }

   // Adds a location to the field group
   function addLocation($param=null,$val=null,$operator='==') {

    $this->location->addLocation($param,$val,$operator); 
    return $this;

  }

  // Returns array of fields
  function getFields() {
    return $this->fields;
  }

  // Returns $key
  function getKey($format=raw) {
    $key = $this->group['key'];

    if ($format == 'raw') {return str_replace('group_','',$key);}
    else {return $key;}
  }

  

  // Returns the group name (not used in field array output)
  function getName() {

    return $this->name;

  }

  // Activates or deactives group

  function setActive($active) {

   $this->field['active'] = (bool) $active;

   return $this;

  }

  // Sets group key

  function setKey($key) {

    $key = strtolower($key);
    $key = str_replace(' ','_',$key);
    $this->group['key'] = 'group_' . $key;

    return $this;

  }

  // Sets position of field labels

  function setLabelPlacement($placement) {

    $placements = array('left','top');

    // TODO: class for errors
    if (!in_array($placement,$placements)) {wp_die('Invalid setLabelPlacement value');}
    $this->group['label_placement'] = $placement;

    return $this;

  }

  // Sets position of metabox
  function setPosition($position) {

    // Checks for a valid $position
    switch ($position) {
      case 'high' : $position = 'acf_after_title'; break;
      case 'side' : $this->setLabelPlacement('top'); break;
      default     : $position = 'normal';
    }

    $this->group['position'] = $position;
    return $this;

  }

  // Sets display style of group (boxed or seamless)

  function setStyle($style='default') {

    // Set style to display with or without metabox
    switch ($style) {
      case 'seamless' : $this->setLabelPlacement('top'); break;
      default         : $style = 'default';
    }

    $this->group['style'] = $style;
    return $this;

  }

  // Sets group title

  function setTitle($title) {

    $this->group['title'] = $title;
    return $this;

  }

  // Registers the group

  function register() {

    $field_count = count($this->fields);

    // Add message if no fields
    if ($field_count == 0) {
      $this->addMessage('Notice','This group has no fields. Add some!');
    }

    // Hide labels for single-field groups
    if ($field_count == 1) {

      $field_name = $this->fields[0]->getName();

      if ($field_name == $this->getName()) {
        $this->fields[0]->hideLabel();
      }

    }

    // Add location rules
    if ($this->location) {
      $this->group['location'] = $this->location->getRules();
    }

    // Add fields

    $this->group['fields'] = array();

    foreach ($this->fields as $field) {
      global $post;
      if (is_object($field)) {$field = $field->getField();}
      array_push($this->group['fields'],$field);
    }

    // Register group
    acf_add_local_field_group(
      $this->group
    );

  }

}
