<?php

namespace Blueprint\Acf;

class LocationBuilder {

  protected $rules = array();

  // Adds a location rule
  function addLocation($param_or_val,$val=null,$operator='==') {

    // If only 1 argument
    if (!$val) {
      $val = $param_or_val;
      if (is_int($val)) {$param = 'page';}
      elseif (is_string($val)) {$param = 'post_type';}
    }
    else {
      $param = $param_or_val;
    }

    array_push(
      $this->rules,
      array(
        array(
          'param'    => $param,
          'operator' => $operator,
          'value'    => $val
        )
      )
    );

    return $this;

  }

  function getRules() {
    return $this->rules;
  }

}
