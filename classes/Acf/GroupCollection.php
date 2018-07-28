<?php

namespace Blueprint\Acf;

class GroupCollection {

  // $location, getLocation, setLocation
  use LocationBuilderTrait;

  protected $prefix;

  function __construct($prefix) {
    $this->prefix = $prefix;
  }

  // Adds a group to the collection
  // TODO: update location to support multiple conditions
  function addGroup($name) {
    $group = new_field_group($name)
      ->setKey($this->prefix . '_' . $name)
      ->setPrefix(true);
    
    if ($this->location) {
      $l = $this->location;
      $group->setLocationByObject($this->location);
    }

    return $group;
  }

}