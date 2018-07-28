<?php

// Add post thumbnail support
add_theme_support('post-thumbnails');

// Remove autop from the_excerpt
remove_filter ('the_excerpt','wpautop');

// Disable comments
function bp_disable_comments() {

    remove_menu_page('edit-comments.php');

} add_action('admin_init','bp_disable_comments');

// Add Image Sizes
add_image_size('lowres',10,10,false);
add_image_size('hero',1600,800,false);