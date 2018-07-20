<?php

namespace Blueprint\Acf;

class GroupCollection {

  protected $location;
  protected $prefix;

  function __construct($prefix) {
    $this->prefix = $prefix;
  }

  // Sets a common location
  // TODO: update location to support multiple conditions
  function setLocation($param,$value,$operator=null) {
    $this->location = array($param,$value,$operator);
    return $this;
  }

  // Adds a group to the collection
  // TODO: update location to support multiple conditions
  function addGroup($name) {
    $group = new_field_group($name)
      ->setKey($this->prefix . '_' . $name)
      ->setPrefix(true);
    
    if ($this->location) {
      $l = $this->location;
      $group->setLocation($l[0],$l[1],$l[2]);
    }

    return $group;
  }

}