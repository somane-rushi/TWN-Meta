<?php
/**
 * ADMIN-ONLY functions
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Admin-only scripts
 *
 * @return void
 */
function fbsafety_admin_scripts() {
    wp_enqueue_script( 'fbsafety-admin-js', get_template_directory_uri() . '/js/admin-only.js', array(), '0.1' );
    wp_enqueue_style( 'fbsafety-admin-js', get_template_directory_uri() . '/css/admin-only.css', array(), '0.1' );
}
add_action('admin_enqueue_scripts', 'fbsafety_admin_scripts');



/**********************************************
**********************************************
For: /wp-admin/edit.php?post_type=lesson
**********************************************
**********************************************/

/**
 * Add 'Module' column to lesson edit screen in wp-admin
 * /wp-admin/edit.php?post_type=lesson
 *
 * @return mixed
 */
add_filter( 'manage_edit-lesson_columns', 'fbsafety_lessons_custom_column');
function fbsafety_lessons_custom_column( $columns ) {
  $columns['which_module'] = 'Module';
  return $columns;
}

/**
 * Make new 'Module' column sortable
 * /wp-admin/edit.php?post_type=lesson
 *
 * @return mixed
 */
add_filter( 'manage_edit-lesson_sortable_columns', 'fbsafety_lessons_custom_sortable_column');
function fbsafety_lessons_custom_sortable_column( $columns ) {
  $columns['which_module'] = 'Module';
  return $columns;
}

/**
 * Display asssociated module on lesson edit screen in wp-admin
 * /wp-admin/edit.php?post_type=lesson
 *
 * @return mixed
 */
add_action( 'manage_lesson_posts_custom_column', 'fbsafety_lessons_custom_column_data', 10, 2);
function fbsafety_lessons_custom_column_data( $column, $post_id ) {
  if ( 'which_module' === $column ) {
    $module_id = get_post_meta($post_id, 'module_id', true);
    echo esc_html( get_the_title( $module_id ) );
  }
}

/**
 * What to sort 'Module' column by
 * /wp-admin/edit.php?post_type=lesson
 *
 * @return void
 */
add_action( 'pre_get_posts', 'fbsafety_lessons_custom_column_orderby' );
function fbsafety_lessons_custom_column_orderby( $query ) {
  if( ! is_admin() ) {
  	return;
  }
  if ( $query->is_main_query() ) {
    $orderby = $query->get( 'orderby');
    if( 'Module' == $orderby ) {
      $query->set('meta_key','module_id');
      $query->set('orderby','meta_value_num');
    }
  }
}



/**********************************************
**********************************************
For: /wp-admin/edit.php?post_type=module
**********************************************
**********************************************/

/**
 * Add 'Module #' column to lesson edit screen in wp-admin
 * /wp-admin/edit.php?post_type=module
 *
 * @return mixed
 */
add_filter( 'manage_edit-module_columns', 'fbsafety_modules_custom_column');
function fbsafety_modules_custom_column( $columns ) {
  $columns['module_number'] = 'Module Number';
  return $columns;
}

/**
 * Display asssociated module on lesson edit screen in wp-admin
 * /wp-admin/edit.php?post_type=module
 *
 * @return mixed
 */
add_action( 'manage_module_posts_custom_column', 'fbsafety_modules_custom_column_data', 10, 2);
function fbsafety_modules_custom_column_data( $column, $post_id ) {
  if ( 'module_number' === $column ) {
    $module_number = get_post_meta($post_id, 'module_number', true);
    if ( empty($module_number) ) {
      $module_id     = wp_get_post_parent_id( $post_id );
      $module_number = get_post_meta($module_id, 'module_number', true);
    }
    echo esc_html( $module_number );
  }
}

