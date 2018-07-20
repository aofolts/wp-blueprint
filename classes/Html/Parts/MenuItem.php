<?php

namespace Blueprint\Html\Parts;

class MenuItem extends Part {

  // Initializes the part

  protected function init() {

    // Store menu object
    if (is_object($this->name)) {
      $this->menuObject = $this->name;
    }

    $this->setTag('li');

  }

}
