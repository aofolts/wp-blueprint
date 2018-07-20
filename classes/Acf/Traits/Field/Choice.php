<?php

namespace Blueprint\Acf\Traits\Field;

trait Choice {

  protected function init() {

    $this->field['type'] = 'select';

  }

  // Whether to allow the input to be empty

  function allowNull($bool=true) {

    $this->field['allow_null'] = $bool;

    return $this;

  }

  // Set field choices

  function setChoices($choices) {

    $choices = (array) $choices;
    $this->field['choices'] = array();

    // Format choices into key/value

    foreach ($choices as $key => $val) {

      // Format key and value
      $key = strtolower($key);
      $val = ucwords(str_replace('_',' ',$val));

      $this->field['choices'][$key] = $val;

    }

    return $this;

  }

  // Set return format (key, value, or array)

  function setReturnFormat($format) {

    if (!in_array($format,array('value','key','array'))) {diedump('setReturnFormat expects "value","key", or "array"');}

    $this->field['return_format'] = $format;

    return $this;

  }

}
