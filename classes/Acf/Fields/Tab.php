<?php

namespace Blueprint\Acf\Fields;

class Tab extends Field {

  // Initializes the field

  protected function init() {

    $this->field['type'] = 'tab';

  }

  // Prefix field name with "tab"

  function setName($name) {

    $prefixed_name = 'tab_' . $name;
    parent::setName($prefixed_name);
    $this->setLabel($name);

  }

  // Sets placement of tab

  function setPlacement($placement='top') {

    $options = array('left','top');

    if (!in_array($placement,$options)) {
      wp_die('setPlacement expects "left" or "top"');
    }

  }

}
