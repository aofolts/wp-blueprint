<?php

namespace Blueprint;

class PostType {

  protected $args;
  protected $rewrite;
  protected $type;

  function __construct($type) {

    // Sets post $type and $args
    $this->type = $type;
    $this->args = array();
    $this->rewrite = (object) array();

    // Sets default args
    $this->setLabel(ucwords($type));
    $this->setArg('public',true);
    $this->setArg('has_archive',false);
    $this->setSupports(null);

    // Sets the action, depending on whether the init action
    // has already fired
    if (current_action() == 'init') {$action = 'bp/register_post_types';}
    else {$action = 'init';}

    // Registers the post type
    add_action($action,array($this,'register'));
 
  }

  // Validates a slug value
  function slugify($slug) {
    $slug = strtolower($slug);
    return str_replace(' ','-',$slug);
  }

  // Sets an $args value
  function setArg($key,$val) {

    $this->args[$key] = $val;
    return $this;

  }

  // Gets an arg
  function getArg($name) {
    if (isset($this->args[$name])) {
      return $this->args[$name];
    } else {
      return null;
    }
  }

  // Sets a plural label
  function setLabel($label) {

    $this->setArg('label',$label);
    return $this;

  }

  // Sets all plural labels
  function setPlural($label) {
    if ($this->getArg('show_in_rest')) {
      $this->setRestBase($label);
    }

    return $this;
  }

  // Specifies whether the post type should be
  // publicly visible
  function setPublic($public) {

    $this->args['public'] = (bool) $public;
    return $this;

  }

  // Sets the rest base slug
  function setRestBase($slug) {
    $slug = $this->slugify($slug);
    $this->setArg('rest_base',$slug);
  }

  // Sets the rewrite array
  function getRewrite($arr) {
    return $this->rewrite;
  }

  // Specifies which features the post type supports
  function setSupports($features) {

    // Converts args to array if string(s) given
    if (is_string($features)) {

      $features = func_get_args();

    }

    $this->setArg('supports',$features);
    return $this;

  }

  // Specifies whether to show an admin interface
  // for the post type
  function setUi($bool) {

    $bool = (bool) $bool;
    $this->setArg('show_ui',$bool);
    return $this;

  }

  // Specifies whether the post type should be
  // publically queryable
  function setQueryable($bool) {

    $this->args['publicly_queryable'] = (bool) $bool;
    return $this;

  }

  // Sets the menu icon
  function setMenuIcon($icon) {

      $icon = 'dashicons-' . $icon;
      $this->args['menu_icon'] = $icon;
      return $this;

  }

  // Sets show_in_rest
  function setRest($bool) {
    $this->args['show_in_rest'] = (bool) $bool;

    return $this;
  }

  // Sets slug in $rewrite
  function setSlug($slug) {
    $this->rewrite->slug = $slug;
    $this->rewrite->with_front = true;

    return $this;
  }

  // Sets with_front in $rewrite
  function setWithFront($bool) {
    $this->rewrite->with_front = (bool) $bool;
    return $this;
  }

  // Registers the post type
  function register() {

    $this->args['rewrite'] = (array) $this->rewrite;

    // Registers the post type
    $post_type = register_post_type($this->type,$this->args);

  }

}
