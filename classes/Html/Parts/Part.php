<?php

namespace Blueprint\Html\Parts;

use \Blueprint\Html\Traits as Traits;

class Part {

  use Traits\Builders\Basic;

  protected $attributes;
  protected $name;
  protected $props;

  function __construct($name=null,$props=null) {

    // Initializes the core properties
    $this->attributes = array();
    $this->parts      = array();
    $this->props      = (object) $props;

    // Sets the part HTML tag
    $this->setTag('div');

    // Sets the part name, if given
    if (is_string($name)) {
      $this->setName($name);
    // Else, store part
    } else {
      $this->name = $name;
    }

    // Initilize child class
    if (method_exists($this,'init')) {
      $this->init();
    }

  }

  // Adds a HTML class to the part
  function addClass($class) {

    // TODO: change storage to array

    if (!isset($this->attributes['class'])) {
      $this->attributes['class'] = array();
    }

    array_push($this->attributes['class'],$class);

    return $this;

  }

  // Gets a specific HTML attribute
  function getAttribute($attr) {

    return $this->attributes[$attr] ?: null;

  }

  // Gets the attributes array
  function getAttributes() {

    return $this->attributes;

  }

  // Sets a specific part attribute
  function setAttribute($key,$val=null) {

    $this->attributes[$key] = $val;
    return $this;

  }

  // Sets the part HTML class
  function setClass($class) {

    $this->setAttribute('class',$class);
    return $this;

  }

  // Sets the part HTML id attribute
  function setId($id) {

    $this->setAttribute('id',$id);
    return $this;

  }

  // Sets the part link
  function setLink($link) {

    $this->setTag('a');

    if (intval($link) > 0) {
      $link = get_permalink($link);
    }
    elseif (is_string($link)) {

      if ($target) {

        if ($target == 'external' || $target == 'file' || $target == '_blank') {
          $this->setTarget('_blank');
        } else {
          $target = str_replace('_link','',$target);
          $link = $target . '-' . $link;
          $link = '#' . $link;
        }

      }
      else {

        $domain = parse_url(str_replace('localhost/','',get_bloginfo('url')));
        $domain = $domain['host'];

        if (!strpos($link,$domain)) {

          $this->setTarget('_blank');

        }
        else {

          if (is_int(strpos($link,'wp-content'))) {
            $this->setTarget('_blank');
          }

        }
      }

    }

    $this->setAttribute('href',$link);
    return $this;

  }

  /**
   * Sets the part name and (optionally) a class or id
   *
   * @param string $name
   *
   */

  protected function setName($name) {

    // Check for id "#" or class "."
    preg_match('/([.#])/',$name,$symbol);
    $symbol = $symbol[0] ?? null;

    // Get name (and tag, if given)
    $arr  = preg_split('/([.#])/',$name,0,PREG_SPLIT_NO_EMPTY);
    $name = $arr[count($arr) - 1];

    // Set id if name contains id
    if ($symbol == '#') {
      $this->setId($name);
    } else {
      $this->addClass($name);
    }

    // Set tag if name is prefixed with an HTML element tag
    if (count($arr) > 1) {
      $this->setTag($arr[0]);
    }

    $this->name = $name;

  }

  // Unsets an HTML attribute

  function unsetAttribute($key) {

    unset($this->attributes[$key]);
    return $this;

  }

  // Converts the attributes array to a HTML string

  protected function buildAttributes() {

    $atts = $this->getAttributes();
    $el   = '';

    // Add attributes
    // * Attributes CAN be blank (i.e. data-value, etc)
    foreach ($atts as $key => $val) {

      // Converts array to attribute string
      if (is_array($val)) {

        // Filter empty values
        $val = implode(' ',array_filter($val));

      }

      $el .= " $key='$val'";
    }

    return $el;

  }

  // Builds the part output

  function build() {

    $parts = $this->buildParts();
    $atts  = $this->buildAttributes();
    $tag   = $this->tag;

    return "<$tag $atts>$parts</$tag>";

  }

  // Echoes the part output

  function render() {

    echo $this->build();

  }

  // Sets the part HTML tag

  function setTag($tag) {

    $this->tag = $tag;
    return $this;

  }

}
