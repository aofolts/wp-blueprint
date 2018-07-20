<?php

namespace Blueprint\Html\Parts;

class Footer extends Container {

  // Initializes the part
  protected function init() {

    $this->setTag('footer');
    $this->setId('footer');

  }

  // Extends build method from part class
  function build() {

    return parent::build();

  }

}
