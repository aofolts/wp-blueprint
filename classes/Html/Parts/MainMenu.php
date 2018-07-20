<?php

namespace Blueprint\Html\Parts;

class MainMenu extends Part {

  protected $menuId;

  // Initializes the part

  protected function init() {

    $this->setTag('ul');
    $this->setId('menu-main');

  }

  // Sets the menu id

  function setMenuId($id) {

    $this->menuId = $id;
    return $this;

  }

  // Adds a menu item part

  function addMenuItem($item) {

    $part = new MenuItem($item);

    return $this->addPart($part);

  }

  // Builds the menu items

  protected function buildMenuItems() {

    $items = bp_get_menu($this->menuId);

    // Add items
    foreach ($items as $item) {

      $this->addMenuItem($item);

    }

  }

  // Extends parent build method

  function build() {

    $this->buildMenuItems();

    return parent::build();

  }

}
