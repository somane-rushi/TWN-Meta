<?php
add_action('init', 'cntrspch_region_taxonomies');
function cntrspch_region_taxonomies()
{
    $labels = array(
    'name' => _x('Regions', 'taxonomy general name'),
    'singular_name' => _x('Region', 'taxonomy singular name'),
    'search_items' =>  __('Search Regions'),
    'all_items' => __('All Regions'),
    'edit_item' => __('Edit Region'),
    'update_item' => __('Update Region'),
    'add_new_item' => __('Add New Region'),
    'new_item_name' => __('New Region'),
  );
    register_taxonomy('cntrspch_region', array('cntrspch_regions'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
     'rewrite' => array('slug' => 'cntrspch_regions', 'with_front' => false),
  ));
}
