<?php

namespace Blueprint\Acf\Fields;

use \Blueprint\Acf as Acf;

class Group extends Field {

  use acf\FieldBuilder;

  protected $fields = array();

  function init() {

    $this->setType('group');
    $this->setRequired(false);
    $this->setLayout('row');

  }

  // Fires before field is added
  // TODO: rename method

  function preAddField($field) {

    // Prefix field key with group key
    //
    // NOTE: ACF automatically prefixes the field name
    // when saving its value to the database
    // i.e. "headline" gets saved as "group_headline"
    $key  = $this->getKey() . '_' . $field->getName();
    $field->setKey($key);

  }

  // Extends getField() from Field class

  function getField() {

    $this->field['sub_fields'] = array();

    // Store number of sub-fields
    $field_count = count($this->fields);

    // Add message if no sub fields
    if ($field_count == 0) {
      $this->addMessage('Notice','This group has no fields. Add some!');
    }

    // Hide the sub-field label if there is only one field
    // and the sub-field label is the same as the group label

    if (count($this->fields) == 1) {
      if ($this->getName() == $this->fields[0]->getName()) {
        $this->fields[0]->hideLabel();
      }
    }

    // Add sub-field arrays to field array

    foreach ($this->fields as $field) {
      $field = $field->getField();
      array_push($this->field['sub_fields'],$field);
    }

    // Return the parent getField method
    return parent::getField();

  }

  // Returns sub-fields array

  function getFields() {
    return $this->fields;
  }

}
