<?php

namespace Blueprint\Acf\Fields;

use \Blueprint\Acf as Acf;
use \Blueprint\Acf\Fields as Fields;

class TrueFalse extends Field {

  use Acf\Traits\Field\Choice;

  // Initializes the field

  function init() {

    $this->setType('true_false');
    $this->setUI(true);
    $this->setDefaultValue(0);
    $this->setRequired(0);

  }

  // Set text show along side the input

  function setMessage($message) {

    $this->field['message'] = $message;
    return $this;

  }

  // Use fancy UI input (true) or checkbox (false)

  function setUI($ui=true) {

    $this->field['ui'] = (bool) $ui;
    return $this;

  }

  // Set UI labels labels (default is "True/False")

  function setLabels($on,$off) {

    $this->field['ui_on_text'] = $on;
    $this->field['ui_off_text'] = $off;

  }

}
