<?php

namespace Blueprint\Acf\Fields;

class Number extends Text {

  // Initializes the field

  function init() {

    $this->setType('number');
    $this->setMin(0);

  }

  // Sets the min value

  function setMin($num) {

    $this->field['min'] = $num;
    return $this;
    
  }

  // Sets the max value

  function setMax($num) {

    $this->field['max'] = $num;
    return $this;

  }

  // Sets the amount to increment by

  function setStep($step) {

    $this->field['step'] = $step;
    return $this;

  }

}
