<?php

namespace Blueprint\Acf\Fields;

use Blueprint\Acf as acf;

class Timestamp extends Field {

  // Initializes the field

  function init() {

    $this->setType('date_picker');
    $this->setFormats();

  }

  setPresetFormat($preset) {

    // TODO: test formats, best for searching

    $presets = array(
      'date' => array(
        'display' => 'F j, Y',
        'return'  => 'Y-m-d'
      ),
      'time' => array(
        'display' => 'g:i a',
        'return'  => 'H:i:s'
      ),
      'date_time' => array(
        'display' => 'F j, Y g:i a',
        'return'  => 'Y-m-d-H-i-s'
      )
    )

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
