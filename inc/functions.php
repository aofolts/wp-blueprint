<?php

use Blueprint\Wp as Wp;

// The action to register post_types
//
// Priority 11 in case init has already fired
// TODO: move to proper location

add_action('init',function() {

  do_action('bp/register_post_types');

},11);

// Requires plugin files

function bp_require($file) {

  require BP_PATH . '/' . $file;

}

// Requires plugin files once only

function bp_require_once($file) {

  require BP_PATH . '/' . $file;

}

// Dumps var into a wp_die dialogue

function diedump($var) {

  echo "<pre>";
  var_dump($var);
  echo "</pre>";

  wp_die();

}

// Returns a new post type class instance

function new_post_type($type) {

  return new Blueprint\PostType($type);

}

// Returns a new taxonomy class instance
function new_taxonomy($name,$post_type) {

  return new Blueprint\Wp\Taxonomy($name,$post_type);

}

// Gets a theme path
function get_theme_asset_uri($type,$file) {

  $paths = array(
    'js'  => 'assets/js',
    'css' => 'assets/css'
  );

  $path = $paths[$type];

  return get_template_directory_uri() . '/' . $path . '/' . $file;

}

// Returns a new Script instance (for themes)
function new_script($name,$src) {

  return new Wp\Script($name,$src);

}

// Returns a new Script instance (for Blueprint)
function new_bp_script($name,$src) {

  return new Wp\Script($name,BP_JS_URI . $src);

}
