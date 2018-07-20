<?php

namespace Blueprint\Wp;

class Taxonomy {

  private $taxonomy;
  private $postType;
  private $args = array();
  private $labels = array();

  function __construct($taxonomy,$postType) {

    $this->setTaxonomy($taxonomy);
    $this->setHierarchical(true);
    $this->setPostType($postType);

    // Sets the action, depending on whether the init action
    // has already fired
    if (current_action() == 'init') {$action = 'bp/register_fields';}
    else {$action = 'init';}

    // Registers the field
    add_action($action,array($this,'register'));

  }

  function setLabel($label) {
    $label = ucwords($label);
    $this->args['label'] = $label;
    return $this;
  }

  function setMetaBox($bool) {
    $this->args['meta_box_cb'] = (bool) $bool;
    return $this;
  }

  function setPostType($type) {
    $this->postType = $type;
    return $this;
  }

  function setTaxonomy($taxonomy=null) {
    $this->taxonomy = $taxonomy;
    return $this;
  }

  // Default: false (tags)

  function setHierarchical($bool) {
    $this->args['hierarchical'] = $bool;
    return $this;
  }

  // Registers the taxonomy
  function register() {

    $this->args['labels'] = $this->labels;
    register_taxonomy($this->taxonomy,$this->postType,$this->args);

  }

}
