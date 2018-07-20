<?php

namespace Blueprint\Acf;

class LocationBuilder {

  protected $location = array();
  protected $locationIndex = 0;

  /**
   * Adds a location to the group
   *
   * @param $param_or_val: value if only one argument given
   * ex: addLocation('post') ... displays when post_type is 'post'
   * ex: addLocation(43) ... displays on page 43
   */

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
      $this->location,
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

  function getLocation() {
    return $this->location;
  }

}
