<?php

namespace Blueprint\Html\Parts\Forms;

use \Blueprint\Html\Parts\Part as Part;

class Element extends Part {

  use Traits\Identifier;

  // Sets the form element name
  protected function setName($name) {

    // Sets form name from $properties
    $this->setId();

    $this->name = $name;
    $this->setAttribute('name',$name);
    return $this;

  }

}
