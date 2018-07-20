<?php

namespace Blueprint\Html\Traits\Builders;

use \Blueprint\Html\Parts as Parts;

/**
 * Allows a part or part builder to
 * create and/or render layout parts
 *
 */

trait Layout {

  // Adds a section part
  function addSection($name) {

    return $this->addPart('section#section-' . $name);

  }

  // Adds a wrap part
  function addWrap($name) {

    return $this->addPart('wrap-' . $name);

  }

  function addContainer($name) {

    return $this->addPart('container-' . $name);

  }

}
