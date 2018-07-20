<?php

namespace Blueprint\Acf\Fields;

class Wysiwyg extends Field  {

  // Initializes the field

  function init() {

    $this->setType('wysiwyg');
    $this->setMedia(false);
    $this->setTabs();
    $this->setToolbar();
    $this->field['library'] = 'uploadedTo';

  }

  // Specify which editing tabs to enable

  function setTabs($type='visual') {

    $choices = array('all','visual','text');


    if (in_array($type,$choices)) {
      $this->fields['tabs'] = $type;
    } else {wp_die("Wysiwyg: invalid tabs type.");}

    return $this;

  }

  // Set the type of toolbar

  function setToolbar($type='basic') {

    $choices = array('full','basic');

    if (in_array($type,$choices)) {
      $this->fields['toolbar'] = $type;
    } else {wp_die("Wysiwyg: invalid toolbar type.");}

    return $this;

  }

  // Enable or disable adding media

  function setMedia($upload=false) {

    if ($upload) {$this->field['media_upload'] = true;}
    else {$this->field['media_upload'] = false;}

    return $this;

  }

}
