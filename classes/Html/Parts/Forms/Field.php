<?php

namespace Blueprint\Html\Parts\Forms;

use \Blueprint\Html\Parts\Part as Part;

class Field extends Part {

  use Traits\Identifier;

  protected $element;
  protected $label;

  // Initializes the part
  function init() {

    $this->setRequired(true);

  }

  // Extends Part setName method
  protected function setName($name) {

    $this->name = $name;
    $this->setAttribute('name',$name);
    $this->addClass('field');
    $this->addClass('field-' . $this->name);

  }

  // Stores the form name
  function setFormName($name) {

    // TODO: Move to method?
    $id = 'form-' . $name . '__' . $this->name;

    $this->getElement()
      ->setId($id);

    $this->getLabel()
      ->setAttribute('for',$id);

    return $this;

  }

  // Get the label part
  function getLabel() {

    if (!isset($this->label)) {$this->setLabel();}
    return $this->label;

  }

  // Returns the form element part (select, input, etc)
  function getElement() {

    if (!$this->element) {$this->setElement();}
    return $this->element;

  }

  // Sets the field label
  function setLabel($label=null) {

    // Sets the default label
    if (!$label) {
      $label = ucwords(str_replace('_',' ',$this->name));
    }

    $this->label = new_template_part()
      ->setTag('label')
      ->setAttribute('for',$this->props->formId . '__' . $this->name)
      ->addText($label);

    return $this;

  }

  // Specifies whether the field is required
  function setRequired($bool) {

    $el = $this->getElement();

    if ($bool) {$el->setAttribute('required');}
    else       {$el->unsetAttribute('required');}

  }

  // Extends Part build method
  function build() {

    $this->addPart($this->getLabel());
    $this->addPart($this->getElement());

    return parent::build();

  }

}
