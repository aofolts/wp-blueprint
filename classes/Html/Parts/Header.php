<?php

namespace Blueprint\Html\Parts;

class Header extends Part {

  // Initializes the part
  protected function init() {

    $this->setTag('header');
    $this->setId('header');

  }

  // Adds the navigation element
  function addNavigation() {

    return $this->addPart((new Navigation));

  }

  // Extends build method from part class
  function build() {

    return parent::build();

  }

}
