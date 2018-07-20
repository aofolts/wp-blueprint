<?php

namespace Blueprint\Html\Builders;

use \Blueprint\Html\Traits as Traits;

/**
 * A class with access to part building methods
 *
 * Is not a part itself.
 */

class Basic {

  use Traits\Builders\Basic;

  function __construct() {

    // Initializes the builder
    if (method_exists($this,'init')) {
      $this->init();
    }

  }

  function build() {

    return $this->buildParts();

  }

  function render() {

    echo $this->build();

  }

}
