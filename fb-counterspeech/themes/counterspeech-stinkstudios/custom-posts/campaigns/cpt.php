<?php
//call the function
add_action('init', 'campaign_posttype');

//setup our cpt
function campaign_posttype()
{
    register_post_type('cntrspch_campaign',
        array(
            'labels' => array(
                'name' => __('Case Studies', 'counterspeech-stinkstudios'),
                'singular_name' => __('Case Study', 'counterspeech-stinkstudios'),
                'add_new' => __('Add New Case Study', 'counterspeech-stinkstudios'),
                'add_new_item' => __('Add Case Study', 'counterspeech-stinkstudios'),
                'edit_item' => __('Edit Case Study', 'counterspeech-stinkstudios'),
                'new_item' => __('Add New Case Study', 'counterspeech-stinkstudios'),
                'view_item' => __('View Case Study', 'counterspeech-stinkstudios'),
                'not_found' => __('No Case Study found', 'counterspeech-stinkstudios'),
                'not_found_in_trash' => __('No Case Study found in trash', 'counterspeech-stinkstudios')
            ),
            'rewrite' => array( 'slug' => 'Case Studies' ),
            'public' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'capability_type' => 'post',
        )
    );
}
