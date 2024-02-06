<?php
//call the function
add_action('init', 'country_posttype');

//setup our cpt
function country_posttype()
{
    register_post_type('cntrspch_country',
        array(
            'labels' => array(
                'name' => __('Countries', 'counterspeech-stinkstudios'),
                'singular_name' => __('Country', 'counterspeech-stinkstudios'),
                'add_new' => __('Add New Country', 'counterspeech-stinkstudios'),
                'add_new_item' => __('Add Country', 'counterspeech-stinkstudios'),
                'edit_item' => __('Edit Country', 'counterspeech-stinkstudios'),
                'new_item' => __('Add New Country', 'counterspeech-stinkstudios'),
                'view_item' => __('View Country', 'counterspeech-stinkstudios'),
                'not_found' => __('No Country found', 'counterspeech-stinkstudios'),
                'not_found_in_trash' => __('No Country found in trash', 'counterspeech-stinkstudios')
            ),
            'rewrite' => array( 'slug' => 'locations' ),
            'public' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'capability_type' => 'post',
            'taxonomies' => array('cntrspch_region'),
        )
    );
}
