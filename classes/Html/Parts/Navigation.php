<?php

namespace Blueprint\Html\Parts;

class Navigation extends Part {

  protected $brand;
  protected $mainMenu;

  // Initializes the part

  function init() {

    $this->setTag('nav');
    $this->setId('nav-main');

  }

  // Sets the brand part

  function addBrand() {

    // Add brand once only
    if (!$this->brand){
      $this->brand = new Brand();
    }

    return $this->addPart($this->brand);

  }

  // Adds the main menu part

  function addMainMenu($id) {

    // Add brand once only
    if (!$this->mainMenu) {
      $this->mainMenu = (new MainMenu())
        ->setMenuId($id);
    }

    return $this->addPart($this->mainMenu);

  }

}
