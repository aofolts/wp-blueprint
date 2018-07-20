<?php

namespace Blueprint\Acf\Fields;

use \Blueprint\Acf as Acf;

class Select extends Field {

  use Acf\Traits\Field\Choice;

  // Initializes the field

  protected function init() {

    $this->setType('select');
    $this->setReturnFormat('value');
    $this->setRequired(false);

  }

  // Specify whether the input can be empty

  function setAllowNull($bool) {

    $this->field['allow_null'] = (bool) $bool;

    return $this;

  }

  // Set Ajax loading of choices

  function setAjax($ajax) {

    $this->field['ajax'] = (bool) $ajax;

    return $this;

  }

  // Enable/disable fancy UI

  function setUi($ui) {

    if ($ui) {$this->field['ui'] = 1;}

    return $this;

  }

}
