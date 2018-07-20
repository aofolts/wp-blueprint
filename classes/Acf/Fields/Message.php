<?php

namespace Blueprint\Acf\Fields;

class Message extends Field {

  // Initializes the field

  function init() {

    $this->setType('message');

  }

  // Sets the message

  function setMessage($message) {

    $this->field['message'] = $message;
    return $this;

  }

}
