<?php

namespace Blueprint\Acf\Fields;

class Text extends Field {

  // Initializes the field

  function init() {
    $this->setType('text');
  }

  // Sets the max length of the input

  function setMaxLength($length) {

    $this->field['maxlength'] = $length;
    return $this;

  }

  // Sets the max length of the input

  function setMinLength($length) {

    $this->field['minlength'] = $length;
    return $this;

  }

  // Appends the input with a string

  function setAppend($text) {

    $this->field['append'] = $text;
    return $this;

  }

  // Prepends the input with a string

  function setPrepend($text) {

    $this->field['prepend'] = $text;
    return $this;

  }

  // Sets the input placeholder text

  function setPlaceholder($text) {
    $this->field['placeholder'] = $text;
    return $this;
  }

}
