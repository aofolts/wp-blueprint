<?php

use Blueprint\Acf as Acf;

// Enqueue ACF custom styles
add_action('admin_enqueue_scripts',function() {

  wp_enqueue_style('bp_acf_style',BP_URL . '/assets/css/acf.css');

});

// The action to register ACF fields
// Priority 11 in case init has already fired
add_action('init',function() {

  do_action('bp/register_fields');

},11);

// Returns a new ACF field group object

function new_field_group($name) {

  return new Acf\Groups\Group($name);

}

// Returns a new ACF field object

function new_field($name) {

  return new Acf\Fields\Field($name);

}

// Returns a new ACF SEO field group object

function new_seo_field_group() {

  return new Acf\Groups\Seo('search_engine_optimization');

}

// Returns a new ACF field group preset object

function new_field_group_preset($name) {

  // List of available presets
  $presets = array(
    'featured_image' => 'FeaturedImage',
    'seo'            => 'Seo'
  );

  // Return new instance if in array
  if (isset($presets[$name])) {

    $class = '\\Blueprint\\Acf\\Groups\\' . $presets[$name];
    return new $class($name);

  }
  // Throw error
  else {

    diedump("'$name' is not a valid field group preset.");

  }

}

// Registers a new options page

function new_options_page($name) {

  return new Acf\OptionsPage($name);

}

// Returns a new field group collection 
function new_field_group_collection($prefix=null) {
  return new Acf\GroupCollection($prefix);
}
