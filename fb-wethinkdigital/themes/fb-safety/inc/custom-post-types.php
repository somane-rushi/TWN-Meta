<?php
/**
 * Custom POST TYPES
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register custom post types
 *
 * @return void
 */
function fbsafety_cpts_init() {

  register_post_type( 'module', 
    array (
      'public'              => true,
      'map_meta_cap'        => true,
      'rewrite'             => array(
        'slug' => 'module',
        'with_front' => false
      ),
      'show_ui'             => true,
      'menu_icon'           => 'dashicons-feedback',
      'show_in_menu'        => true,
      'show_in_rest'        => true,
      'has_archive'         => true,
      'menu_position'       => 21,
      'label'               => 'Modules',
      'supports'            => array(
          'title',
          'editor',
          'revisions',
          'author',
          'excerpt',
          'thumbnail',
          'page-attributes'
      ),
      'taxonomies'          => array(),
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => false,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
      'query_var'           => true,
    )
  );

  register_post_type( 'lesson', 
    array (
      'public'              => true,
      'map_meta_cap'        => true,
      'rewrite'             => array(
        'slug' => 'lesson',
        'with_front' => false
      ),
      'show_ui'             => true,
      'menu_icon'           => 'dashicons-list-view',
      'show_in_menu'        => true,
      'show_in_rest'        => true,
      'has_archive'         => true,
      'menu_position'       => 21,
      'label'               => 'Lessons',
      'supports'            => array(
          'title',
          'editor',
          'revisions',
          'author',
          'excerpt',
          'thumbnail',
          //'page-attributes'
      ),
      'taxonomies'          => array(),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => false,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
      'query_var'           => true,
    )
  );

  register_post_type( 'video', 
    array (
      'public'              => true,
      'map_meta_cap'        => true,
      'rewrite'             => array(
        'slug' => 'video',
        'with_front' => false
      ),
      'show_ui'             => true,
      'menu_icon'           => 'dashicons-format-video',
      'show_in_menu'        => true,
      'show_in_rest'        => true,
      'has_archive'         => true,
      'menu_position'       => 21,
      'label'               => 'Videos',
      'supports'            => array(
          'title',
          //'editor',
          'revisions',
          'author',
          'excerpt',
          'thumbnail',
          //'page-attributes'
      ),
      'taxonomies'          => array(),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => false,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
      'query_var'           => true,
    )
  );

}

add_action( 'init', 'fbsafety_cpts_init' );
