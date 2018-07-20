<?php

namespace Blueprint\Acf\Fields;

use \Blueprint as bp;
use \Blueprint\Acf as acf;

class Repeater extends Field {

  function init() {
    $this->setType('repeater');
  }

  // Extends parent getField()

  function getField() {

    $this->field['sub_fields'] = array();

    // Add fields to sub_field array

    foreach ($this->fields as $field) {

      $field = $field->getField();
      array_push($this->field['sub_fields'],$field);

    }

    return parent::getField();

  }

  // Sets the "add row" button label

  function setButtonLabel($label) {

    $this->field['button_label'] = $label;
    return $this;

  }

  // Sets the maximum number of rows

  function setMax($max) {
    if (!is_int($max)) {$this->throwInputError('int');}
    $this->field['max'] = $max;
    return $this;
  }

  // Sets the minimum number of rows

  function setMin($min) {
    if (!is_int($min)) {$this->throwInputError('int');}
    $this->field['min'] = $min;
    return $this;
  }

}
