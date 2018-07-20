<?php

namespace Blueprint\Acf\Fields;

use Blueprint\Acf as acf;

class DatePicker extends Field {

  // Initializes the field

  function init() {

    $this->setType('date_picker');
    $this->setFormats();

  }

  // Sets the display and return formats

  protected function setFormats() {

    $this->setDisplayFormat();
    $this->setReturnFormat();

  }

  // Sets the display format

  function setDisplayFormat() {

    $format = 'F j, Y';
    $this->field['display_format'] = $format;

  }

  // Sets the return format

  protected function setReturnFormat($format=null) {

    if (!$format) {$format = 'Y-m-d';}
    $this->field['return_format'] = $format;

  }

}
