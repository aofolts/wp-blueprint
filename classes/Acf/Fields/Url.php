<?php

namespace Blueprint\Acf\Fields;

class Url extends Text {

  // Initializes the field

  function init() {
    $this->setType('url');
  }

}
