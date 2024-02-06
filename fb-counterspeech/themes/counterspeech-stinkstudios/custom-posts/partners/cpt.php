<?php
//call the function
add_action('init', 'partner_posttype');

//setup our cpt
function partner_posttype()
{
    register_post_type('cntrspch_partner',
    array(
        'labels' => array(
        'name' => __('Partners', 'counterspeech-stinkstudios'),
        'singular_name' => __('Partner', 'counterspeech-stinkstudios'),
        'add_new' => __('Add New Partner', 'counterspeech-stinkstudios'),
        'add_new_item' => __('Add Partner', 'counterspeech-stinkstudios'),
        'edit_item' => __('Edit Partner', 'counterspeech-stinkstudios'),
        'new_item' => __('Add New Partner', 'counterspeech-stinkstudios'),
        'view_item' => __('View Partner', 'counterspeech-stinkstudios'),
        'not_found' => __('No Partner found', 'counterspeech-stinkstudios'),
        'not_found_in_trash' => __('No Partner found in trash', 'counterspeech-stinkstudios')
      ),
      'rewrite' => array( 'slug' => 'partners' ),
      'public' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
      'capability_type' => 'post',
    )
  );
}
