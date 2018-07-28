<?php

namespace Blueprint\Acf\Fields;

use \Blueprint\Acf as Acf;

class Checkbox extends Field {

  use Acf\Traits\Field\Choice;

  // Initializes the field

  protected function init() {

    $this->setType('checkbox');
    $this->setRequired(false);

  }

  // Specifies whether to allow the user to
  // add custom choices

  function setAllowCustomChoices($bool) {

    $this->field['allow_custom'] = (bool) $bool;
    return $this;

  }

  // Specifies whether to save custom choices
  // that the user has added

  function setSaveCustomChoices($bool) {

    $this->field['save_custom'] = (bool) $bool;
    return $this;

  }

  // Sets the layout orientation
  function setOrientation($layout='checkbox') {
    $this->field['layout'] = $layout;

    return $this;
  }

}
