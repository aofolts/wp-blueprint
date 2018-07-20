<?php

namespace Blueprint\Html\Parts\Forms;

use \Blueprint\Html\Parts\Part as Part;

class Form extends Part {

  protected $childProps;

  // Initializes the part
  protected function init() {

    $this->childProps = (object) array();
    $this->childProps->formId = $this->getAttribute('id');
    $this->setTag('form');

  }

  // Extends Part setName method
  protected function setName($name) {

    $this->setId('form-' . $name);
    $this->name = $name;

  }

  // Adds a textarea field
  function addTextAreaField($name) {

    $field = new TextAreaField($name,$this->childProps);
    return $this->addField($field);

  }

  // Adds a text input field
  function addTextField($name) {

    $field = new InputField('name',$this->childProps);

    return $this->addField($field);

  }

  // Adds a form field
  protected function addField($field) {

    $field->setFormName($this->name);

    return $this->addPart($field);

  }

  // Adds a submit button
  function addSubmit() {

    $part = new_template_part('button.submit')
      ->addText('Submit');

    return $this->addPart($part);

  }

}
