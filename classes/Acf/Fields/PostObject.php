<?php

namespace Blueprint\Acf\Fields;

class PostObject extends Field {

  // Initializes the field

  protected function init() {

    $this->field['type'] = 'post_object';
    $this->setReturnFormat('id');
    $this->setMultiple(false);
    $this->setPostType(array('post','page'));

  }

  // Specifies whether to allow a blank value
  function allowNull($allow=false) {
    $this->field['allow_null'] = (bool) $allow;

    return $this;
  }

  // Specifies whether to allow the user to select
  // multiple posts
  function setMultiple($multiple) {

    $this->field['multiple'] = $multiple;
    return $this;

  }

  // Sets the post type
  // Accepts string or array

  function setPostType($type=null) {

    if (is_string($type)) {$type = array($type);}
    if (!$type) {$type = array('post','page');}

    $this->field['post_type'] = $type;
    return $this;

  }

  // Sets the return format (id or object)

  function setReturnFormat($format) {

    $formats = array('object','id');
    if (!in_array($format,$formats)) {$this->throwInputError('object or id');}

    $this->field['return_format'] = $format;
    return $this;

  }

  // Sets the max number of posts allowed
  function setMax($max) {
    $this->max = (int) $max;

    add_action('acf/validate_value/key=' . $this->key,array($this,'validateCount'),10,2);

    return $this;
  }

  // Sets the min number of posts allowed
  function setMin($min) {
    $this->min = (int) $min;

    add_action('acf/validate_value/key=' . $this->key,array($this,'validateCount'),10,2);

    return $this;
  }

  // Validates the post count
  function validateCount($valid,$value) {
    if (!$valid) {return $valid;}

    if (count($value) > $this->max) {
      return "Too many posts. $this->max is the maximum allowed.";
    } elseif (count($value) < $this->min) {
      return "Too few posts. $this->min is the minimum required.";
    } else {
      return $valid;
    } 
  }

}
