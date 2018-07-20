<?php

namespace Blueprint\Html\Parts;

class Template extends Part {

  protected $body;

  // Initializes the template

  protected function init() {

    $this->setTag('html');
    $this->setAttribute('lang','en');
    $this->unsetAttribute('class');

    $this->setBody();

  }

  // Gets the HTML body element

  function getBody() {

    return $this->body;

  }

  // Sets the HTML body element

  protected function setBody() {

    $this->body = new_builder_part('body#body');

  }

  // Extends parent build()

  function build() {

    // Add head element
    $this->addHtml($this->buildHead());

    // Add template parts
    $this->addPart($this->getBody());

    // Adds wp_footer output
    $this->addHtml($this->buildWpFooter());

    // Return document with doctype
    return '<!DOCTYPE html>' . parent::build();

  }

  // Builds the head element
  protected function buildHead() {

    $head = new Head();

    return $head->build();

  }

  // Builds the wp_footer output
  protected function buildWpFooter() {

    ob_start();
    wp_footer();
    return ob_get_clean();

  }

}
