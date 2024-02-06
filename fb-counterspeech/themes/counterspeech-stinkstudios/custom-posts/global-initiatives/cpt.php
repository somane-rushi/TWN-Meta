<?php
//call the function
add_action('init', 'gi_posttype');

//setup our cpt
function gi_posttype()
{
    register_post_type('cntrspch_gi',
    array(
        'labels' => array(
        'name' => __('Initiatives', 'counterspeech-stinkstudios'),
        'singular_name' => __('Initiative', 'counterspeech-stinkstudios'),
        'add_new' => __('Add New Initiative', 'counterspeech-stinkstudios'),
        'add_new_item' => __('Add Initiative', 'counterspeech-stinkstudios'),
        'edit_item' => __('Edit Initiative', 'counterspeech-stinkstudios'),
        'new_item' => __('Add New Initiative', 'counterspeech-stinkstudios'),
        'view_item' => __('View Initiative', 'counterspeech-stinkstudios'),
        'not_found' => __('No Initiative found', 'counterspeech-stinkstudios'),
        'not_found_in_trash' => __('No Initiative found in trash', 'counterspeech-stinkstudios')
      ),
      'rewrite' => array( 'slug' => 'initiatives' ),
      'public' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
      'capability_type' => 'post',
    )
  );
}
