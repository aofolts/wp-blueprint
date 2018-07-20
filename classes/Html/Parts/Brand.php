<?php

namespace Blueprint\Html\Parts;

class Brand extends BuilderPart {

  // Initializes the parts

  protected function init() {

    $this->setClass('brand');

  }

  // Sets the brand name

  function addSiteName($name=null) {

    $name = $name ?: get_bloginfo('name');

    $part = $this->addPart('site_name')
      ->addText($name);

      return $part;

  }

  // Adds a brand logo

  function addBrandLogo($type,$file) {

    $name = 'logo-' . $type;

    return $this->addThemeImage($name,$file);

  }

}
