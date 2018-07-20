<?php

namespace Blueprint\Html\Traits\Builders;

use \Blueprint\Html\Parts as Parts;

/**
 * Allows a part or part builder to
 * create and/or render child parts
 *
 */

trait Master {

  // Include all part builders

  use Basic;
  use Layout;
  use Media;
  use Text;

  // Adds Wordpress content
  function addContent($content) {

    $this->addHtml(apply_filters('the_content',$content));
    return $this;

  }

  // Adds a form part
  function addForm($name) {

    $part = (new Parts\Forms\Form($name));
    return $this->addPart($part);

  }

  // Adds a theme class (color)
  function setTheme($type) {

    $this->addClass('theme-' . $type);
    return $this;

  }

}
