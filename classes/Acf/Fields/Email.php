<?php

namespace Blueprint\Acf\Fields;

class Email extends Text {

  // Initializes the field

  function init() {

    $this->setType('email');

  }

  // Sets placeholder text

  function setPlaceholder($placeholder='example@website.com') {

    $this->field['placeholder'] = $placeholder;
    return $this;

  }

}
