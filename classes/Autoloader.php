<?php

namespace Blueprint;

class Autoloader {

  protected $base;
  protected $directory;
  protected $namespace;

  function __construct( $namespace, $directory ) {

    $this->namespace = $namespace;
    $this->directory = $directory;

    spl_autoload_register(array($this,'autoloadClass'));

  }

  // Class Loader

  function autoloadClass($class) {

    // Bail if not in specified namespace
    if (!is_int(strpos($class,$this->namespace))) {return false;}

    // Convert class into file path
    $file = str_replace("$this->namespace\\",'',$class);
    $file = str_replace('\\','/',$file);
    $file = $this->directory . '/' . $file . '.php';

    // Require file if it exists
    if (file_exists($file)) {
      require_once($file);
    }

  }

}
