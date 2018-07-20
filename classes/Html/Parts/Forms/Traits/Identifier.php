<?php

namespace Blueprint\Html\Parts\Forms\Traits;

trait Identifier {

  protected $formId;

  // Stores the form id
  function setId($id=null) {

    // Set default id
    if (!$id) {

      $form_id = $this->props->formId;
      $id      = $form_id . '__' . $this->name;

    }

    return parent::setId($id);

  }

}
