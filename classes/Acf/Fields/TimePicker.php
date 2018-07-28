<?php

namespace Blueprint\Acf\Fields;

use Blueprint\Acf as acf;

class TimePicker extends Field {

  // Initializes the field
  function init() {
    $this->setType('time_picker');
    $this->setFormats();
  }

  // Sets the display and return formats
  protected function setFormats() {
    $this->setDisplayFormat();
    $this->setReturnFormat();
  }

  // Sets the display format
  function setDisplayFormat() {
    $format = 'g:i a';

    $this->field['display_format'] = $format;
  }

  // Sets the return format
  protected function setReturnFormat($format=null) {
    if (!$format) {$format = 'g:i a';}

    $this->field['return_format'] = $format;
  }

}
