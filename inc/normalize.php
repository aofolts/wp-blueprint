<?php

// Hides default post type

function remove_default_post_type() {
	remove_menu_page('edit.php');
}

add_action('admin_menu','remove_default_post_type');

// Removes the admin bar
show_admin_bar(false);
