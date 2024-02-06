<?php
add_action('init', 'cntrspch_resource_language_taxonomies');
function cntrspch_resource_language_taxonomies()
{
    $labels = array(
    'name' => _x('Resource Languages', 'taxonomy general name'),
    'singular_name' => _x('Resource Language', 'taxonomy singular name'),
    'search_items' =>  __('Search Resource Languages'),
    'all_items' => __('All Resource Languages'),
    'edit_item' => __('Edit Resource Languages'),
    'update_item' => __('Update Resource Language'),
    'add_new_item' => __('Add New Resource Language'),
    'new_item_name' => __('New Resource Language'),
  );
    register_taxonomy('cntrspch_resource_language', array('cntrspch_resource_languages'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
     'rewrite' => array('slug' => 'cntrspch_resource_languages', 'with_front' => false),
  ));
}
