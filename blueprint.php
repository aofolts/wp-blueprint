<?php
/*
Plugin Name: WP Blueprint
Plugin URI: https://sherpadesignco.gitbook.io/wp-blueprint
Description: Build Wordpress themes faster with object-oriented elements and fields.
Version: 1.0.0
Author: Andrew Folts
Author URI: http://www.sherpadesign.co/
Copyright: Andrew Folts
Text Domain: bp
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// TODO: move to proper location

register_activation_hook( __FILE__, 'child_plugin_activate' );

function child_plugin_activate(){

    // Require parent plugin
    if ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
        wp_die('Sorry, but this plugin requires the ACF plugin to be installed and active. <a href="' . admin_url( 'plugins.php' ) . '">Return to Plugins</a>');
    }
}

// Check for unique namespace
if (!class_exists('Blueprint')) :

// Main plugin class
class Blueprint {

  function __construct() {

    $this->defineConstants();
    $this->loadCore();

  }

  // Define plugin constants
  protected function defineConstants() {

    define( 'BP_PATH', __DIR__ );

    // TODO: remove "-2" when WP Blueprint 2 is the default version
    define('BP_URL',plugins_url('wp-blueprint-2'));
    define('BP_URI',plugins_url('wp-blueprint-2'));
    define('BP_JS_URI',BP_URI . '/assets/js/');

  }

  // Load core files

  protected function loadCore() {

    // Require core functions
    require __DIR__ . '/inc/functions.php';

    // Initialize plugin autoloader
    bp_require('classes/autoloader.php');

    // Normalizes Wordpress
    bp_require('inc/normalize.php');

    // Initializes Blueprint autoloader
    $autoloader = (new Blueprint\Autoloader( 'Blueprint', BP_PATH . '/classes' ));

    // Reqire other core files
    require 'inc/reset.php';
    bp_require('inc/acf/functions.php');
    bp_require('inc/temp.php');
    bp_require('inc/parts/functions.php');
    require 'inc/menus/menus.php';
    bp_require('inc/options/index.php');
    require 'inc/type.php';

    require 'inc/public.php';

  }

}

$blueprint = (new Blueprint());

endif; // End if class exists
