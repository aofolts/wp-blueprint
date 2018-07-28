<?php

namespace Blueprint\Acf;

/**
 * Creates an ACF options page
 *
 * @var string $slug
 */

class OptionsPage {

  protected $name;
  protected $options = array();
  protected $hasParent;
  protected $label;
  protected $slug;

  function __construct($slug) {

    // Store original slug
    $this->options['menu_slug'] = $slug;

    // Set options page defaults
    $this->setTitle($slug);
    $this->setPostId($slug);
    $this->setPageTitle();
    $this->setCapability();

    // Register the options page
    add_action('init',array($this,'add'));

  }

  // Adds a sub options page

  function addSubPage($name) {

    $page = (new OptionsPage($name))
      ->setParentSlug($this->options['menu_slug']);
    return $page;

  }

  // Sets both the menu and page title

  function setTitle($title=null) {

    $title = preg_replace('/[-_]/',' ',$title);
    $title = ucwords($title);

    $this->options['page_title'] = $title;
    $this->options['menu_title'] = $title;

    return $this;

  }

  // Sets the menu icon
  //
  // https://developer.wordpress.org/resource/dashicons

  function setIcon($icon) {

    $icon = 'dashicons-' . $icon;
    $this->options['icon_url'] = $icon;

    return $this;

  }

  // Sets the menu title

  // Sets the options page parent slug

  function setParentSlug($slug) {

    $this->options['parent_slug'] = $slug;
    $this->hasParent = true;

    return $this;

  }

  private function setPageTitle($title = null) {
    if (!$title) {$title = $this->label;}
    $this->options['page_title'] = $title;
    return $this;
  }

  function setCapability($capability=null) {
    if (!$capability) {$capability = 'manage_options';}
    $this->options['capability'] = $capability;
    return $this;
  }

  // Sets the post_id (for saving)
  function setPostId($id) {
    $this->options['post_id'] = $id;
    return $this;
  }

  function setRedirect($redirect) {
    if (is_bool($redirect)) {$this->options['redirect'] = $redirect;}
    return $this;
  }

  // Sets the page slug

  function setSlug($slug) {

    $this->options['menu_slug'] = $slug;
    return $this;

  }

  // Returns the array of options
  function getOptions() {

    return $this->options;

  }

  function add() {

    // Add a child page
    if ($this->hasParent) {
      $add = acf_add_options_sub_page($this->getOptions());
    }
    // Add a parent page
    else {
      $add = acf_add_options_page($this->getOptions());
    }

    return $add;

  }

}
