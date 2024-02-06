<?php
//call the function
add_action('init', 'resource_posttype');

//setup our cpt
function resource_posttype()
{
    register_post_type('cntrspch_resource',
        array(
            'labels' => array(
                'name' => __('Resources', 'counterspeech-stinkstudios'),
                'singular_name' => __('Resource', 'counterspeech-stinkstudios'),
                'add_new' => __('Add New Resource', 'counterspeech-stinkstudios'),
                'add_new_item' => __('Add Resource', 'counterspeech-stinkstudios'),
                'edit_item' => __('Edit Resource', 'counterspeech-stinkstudios'),
                'new_item' => __('Add New Resource', 'counterspeech-stinkstudios'),
                'view_item' => __('View Resource', 'counterspeech-stinkstudios'),
                'not_found' => __('No Resource found', 'counterspeech-stinkstudios'),
                'not_found_in_trash' => __('No Resource found in trash', 'counterspeech-stinkstudios')
            ),
            'rewrite' => array( 'slug' => 'resources' ),
            'public' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'capability_type' => 'post',
            'taxonomies' => array('cntrspch_resource_language'),
        )
    );
}
