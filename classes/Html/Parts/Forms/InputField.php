<?php

namespace Blueprint\Html\Parts\Forms;

use \Blueprint\Html\Parts\Part as Part;

class InputField extends Field {

  // Sets the form element part
  protected function setElement() {

    $this->element = new Input($this->name,$this->props);

  }

}
