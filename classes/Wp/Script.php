<?php

namespace Blueprint\Wp;

class Script {

  protected $data;
  protected $dependencies;
  protected $handle;
  protected $inFooter;
  protected $src;

  function __construct($handle,$src) {

    $this->data = array();
    $this->handle = $handle;
    $this->setSrc($src);

  }

  // Sets the file src
  protected function setSrc($src) {

    $this->src = $src;

  }

  // Provides the file with the WP AJAX url
  function addAjax() {

    $this->addData('ajax',array('url' => admin_url( 'admin-ajax.php' )));
    return $this;

  }

  // Localizes data to the script
  // $vars: array
  function addData($name,$vars) {

    // Store data
    array_push($this->data,array(
      'name' => $name,
      'vars' => (array) $vars
    ));

    return $this;

  }

  // Sets the script dependencies
  function setDependencies($arr) {

    $this->dependencies = (array) $arr;
    return $this;

  }

  // Specifies whether to enqueue script in footer
  function setInFooter($bool=true) {

    $this->inFooter = (bool) $bool;
    return $this;

  }

  protected function setAjax() {
    wp_localize_script(
      $this->name,
      'ajax',
      array(
        'url' => admin_url('admin-ajax.php')
      )
    );
  }

  // Localizes data to the script
  protected function localizeData() {

    // Loop through data
    foreach ($this->data as $data) {

      // Localize the data
      wp_localize_script(
        $this->handle,
        $data['name'],
        $data['vars']
      );

    }

  }

  // Enqueues the script
  function enqueue() {

    wp_enqueue_script($this->handle,$this->src,$this->dependencies,null,$this->inFooter);

    // Localize data
    if ($this->data) {
      $this->localizeData();
    }

  }

}
