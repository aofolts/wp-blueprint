<?php

namespace Blueprint\Html\Traits\Builders;

use \Blueprint\Html\Parts as Parts;

/**
 * Allows a part or part builder to
 * create and/or render child parts
 *
 */

trait Media {

  /**
   * Adds an image part
   *
   * @var $file: accepts src or WP attachement id
   */

  function addImage($name) {

    $part = (new Parts\Image($name));

    return $this->addPart($part);

  }

  // Adds an static theme image

  function addThemeImage($name,$file) {

    $src = get_template_directory_uri() . '/assets/img/' . $file;

    return $this->addImage($name,$src);

  }

}
