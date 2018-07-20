<?php

namespace Blueprint\Html\Traits\Builders;

/**
 * Supplies basic part building methods
 *
 * @var array $parts: stores child parts
 */

trait Basic {

  protected $parts = array();

  // Adds an HTML comment

  function addComment($comment) {

    $comment = "<!-- $comment -->";
    $this->addHtml($comment);

  }

  // Adds an HTML string to $parts

  function addHtml($html) {

    if (is_string($html)) {
      array_push($this->parts,$html);
    }
    else {
      wp_die('addHtml expects string.');
    }

    return $this;

  }

  // Adds a part to the $parts array
  //
  // Creates a new part if string name given
  // Also accepts an existing part object

  function addPart($part=null) {

    // Creates a new part if $part is a string (name)
    if (is_string($part) || is_null($part)) {
      $part = new_builder_part($part);
    }

    // Adds the part to the $parts array
    array_push($this->parts,$part);

    return $part;

  }

  // Adds a plain text string to $parts

  function addText($text) {

    $text = strip_tags($text);
    $this->addHtml($text);
    return $this;

  }

  // Adds a theme part from the parts directory

  function addThemePart($slug) {

    ob_start();
    get_template_part("parts/$slug");
    $this->addHtml(ob_get_clean());

  }

  // Converts the given array of parts into an HTML string

  function buildParts($parts=null) {

    // Build $this->parts if no $parts is null
    if (!is_array($parts)) {
      $parts = $this->parts;
    }

    $el = '';
    $parts = (array) $parts;

    // Loop over parts
    foreach($parts as $part) {

      // Build child parts if $part is a class
      if (is_object($part)) {
        $el .= $part->build();
      }
      // Append part to $el if it is a string
      elseif (is_string($part)) {
        $el .= $part;
      }

    }

    // Return an HTML string of parts
    return $el;

  }

}
