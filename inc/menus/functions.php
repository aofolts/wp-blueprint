<?php

function bp_get_menu($id) {

  // TODO: create menu class?

  // Get all items
  $items = wp_get_nav_menu_items($id);
  $items_sorted = array();

  // Get all parents
  $parents = array_filter($items,function($item) {
    $parent = $item->menu_item_parent;
    if ($parent == 0) {$item->isPrimary = true; return true;}
  });

  foreach ($parents as $parent) {

    $kids = array();

    foreach ($items as $kid) {

      // Add child to $kids array
      if ($kid->menu_item_parent == $parent->ID) {
        array_push($kids,$kid);
      }

    }

    // Store $kids array
    if (!empty($kids)) {$parent->sub_menu = $kids;}

    // Store parent in $items_sorted array
    array_push($items_sorted,$parent);

  }

  return $items_sorted;

}
