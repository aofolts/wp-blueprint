<?php

namespace Blueprint\Acf;

trait LocationBuilderTrait {

  protected $location;

  // Gets the location builder
  function getLocation() {
    if (!$this->location) {
      $this->location = (new LocationBuilder($this));
    }

    return $this->location;
  }

  // Sets the location of the field group
  function setLocation($param=null,$val=null,$operator='==') {
    $this->location = $location = (new LocationBuilder($this));

    if ($param) {$location->addLocation($param,$val,$operator); return $this;}
    else {return $location;}
  }

  // Sets the location using a LocationBuilder object
  function setLocationByObject($object) {
    $this->location = $object;
    
    return $this;
  }

}