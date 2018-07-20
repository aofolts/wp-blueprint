<?php

namespace Blueprint\Html\Parts;

class Text extends Part {

  protected $text;
  protected $inner;

  // Initializes the part

  function init() {

    $this->setTag('p');

  }

  // Adds placeholder text
  function addPlaceholder($word_count) {

    // Gets a word-limited string
    $greek = 'Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Aenean commodo ligula eget dolor. Curabitur a felis in nunc fringilla tristique. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Fusce a quam.';
    $arr   = explode(' ',$greek);
    $arr   = array_slice($arr,0,$word_count);
    $text  = implode(' ',$arr);

    return $this->addText($text);

  }

  // Gets the inner span element

  function getInner() {

    // Create inner span if not set
    if (!$this->inner) {
      $this->setInner();
    }

    return $this->inner;

  }

  // Adds an inner span to the element

  function setInner($name=null) {

    $this->inner = new_template_part($name)
      ->addClass('text-inner')
      ->setTag('span');

    return $this->inner;

  }

  // Extends parent build method

  function build() {

    // Copy $inner part to $parts
    if ($this->inner) {

      // Clear $parts
      $this->parts = array();

      $this->addPart($this->inner);

    }

    return parent::build();

  }

}
