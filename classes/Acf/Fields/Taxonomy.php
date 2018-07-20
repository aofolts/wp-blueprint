<?php

namespace Blueprint\Acf\Fields;

class Taxonomy extends Field {

  // Initializes the field

  protected function init() {

    $this->field['type'] = 'taxonomy';
    $this->setReturnFormat('object');

  }

  // Whether the user can add new terms

  function setAddTerm($add) {
    $this->field['add_term'] = (int) $add;
    return $this;
  }

  // Set the type of UI

  function setUi($type='checkbox') {

    $choices = array('checkbox','multi_select','radio','select');

    if (!in_array($type,$choices)) {wp_die('setFieldType invalid field type');}

    $this->field['field_type'] = $type;

    return $this;

  }

  // Set the return format (when get_field is called)

  function setReturnFormat($format='id') {

    $choices = array('id','object');

    $this->field['return_format'] = $format;

    return $this;

  }

  // Specify whether terms should be attached
  // to the current post

  function setSaveTerms($bool) {

    $this->field['save_terms'] = (int) $bool;

    return $this;

  }

  // Set the taxonomy

  function setTaxonomy($taxonomy) {

    $this->field['taxonomy'] = $taxonomy;

    return $this;

  }

}
