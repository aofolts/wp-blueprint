<?php

// Enqueues a Typekit Kit
function enqueue_typekit($kit_id) {

  // Enqueue Typekit
  add_action('wp_enqueue_scripts',function() use ($kit_id) {

    wp_enqueue_script('typekit',"//use.typekit.net/$kit_id.js");
    wp_add_inline_script('typekit','try{Typekit.load();}catch(e){}');

  });

}
