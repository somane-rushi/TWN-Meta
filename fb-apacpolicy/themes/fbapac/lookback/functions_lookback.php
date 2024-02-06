<?php
/**
 * Custom FUNCTIONS relating to the Annual Report / Lookback section of the site
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


/**
 * Assets: styles & scripts
 *
 * @return void
 */
function fbapac_lookback_assets() {
    if ( is_singular('lookback_region') || is_page_template('lookback/page-lookback.php') ) {
        $lookback_version = '0.2';
        wp_enqueue_style( 'lookback-styles', get_template_directory_uri() . '/lookback/css/lookback.css', array(), $lookback_version);
        wp_enqueue_style( 'owl-carousel-styles', get_template_directory_uri() . '/lookback/css/owl.carousel.css', array(), $lookback_version);
        wp_enqueue_script( 'owl-carousel-scripts', get_template_directory_uri() . '/lookback/js/owl.carousel.js', array(), $lookback_version, TRUE );
        wp_enqueue_script( 'lookback-scripts', get_template_directory_uri() . '/lookback/js/lookback.js', array(), $lookback_version, TRUE );
    }
}
add_action('wp_enqueue_scripts', 'fbapac_lookback_assets');


/**
 * Admin-only scripts
 *
 * @return void
 */
function fbapac_lookback_admin_scripts() {
    wp_enqueue_script( 'lookback-admin-js', get_template_directory_uri() . '/lookback/js/lookback-admin-only.js', array(), '0.1' );
}
add_action('admin_enqueue_scripts', 'fbapac_lookback_admin_scripts');


/**
 * Lookback functionality on init
 * Register custom post types
 * Add thumbnail sizes
 *
 * @return void
 */
function fbapac_lookback_init() {

    register_post_type( 'lookback_region', array (
        'public'              => true,
        'map_meta_cap'        => true,
        'rewrite'             => array(
            'slug' => 'lookback',
            'with_front' => false
        ),
        'show_ui'             => true,
        'menu_icon'           => 'dashicons-admin-site',
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'has_archive'         => true,
        'menu_position'       => 21,
        'label'              => 'Lookback Regions',
        'supports'            => array(
            'title',
            'editor',
            'revisions',
            'author',
            'excerpt',
            'thumbnail', 
            'page_attributes',
            'custom-fields',
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
        'capability_type'     => 'post',
        'query_var'           => true,
    ));

    if ( function_exists( 'add_theme_support' ) ) { 
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'square-large', 600, 600, true);
    }

    register_nav_menus(
        array(
        'header-lookback' => esc_html__('Header (Lookback)', 'fb_file_repository'),
        'footer-lookback' => esc_html__('Footer (Lookback)', 'fb_file_repository'),
        )
    );

}

add_action( 'init', 'fbapac_lookback_init' );


/**
 * Fieldmanager: check and get field data
 * Lookback helper function
 *
 * @return mixed
 */
function fbapac_fm_get_data($fields=array(), $key='') {
    $data = ( isset( $fields[$key] ) ) ? $fields[$key] : '';
    return $data;
}


/**
 * Reusable color array
 * Lookback helper function
 *
 * @return array
 */
function fbapac_lookback_colors_basic_array() {
    return array(
        'blue'   => 'Blue',
        'green'  => 'Green',
        'indigo' => 'Indigo',
        'navy'   => 'Navy',
        'orange' => 'Orange',
        'purple' => 'Purple',
        'red'    => 'Red',
        'teal'   => 'Teal',
        'yellow' => 'Yellow',
    );
}

/**
 * Reusable color array
 * Lookback helper function
 *
 * @return array
 */
function fbapac_lookback_colors_advanced_array() {
    return array(
        'blue-deep'    => 'Blue (Deep)',
        'blue-core'    => 'Blue (Core)',
        'blue-pale'    => 'Blue (Pale)',
        'blue-light'   => 'Blue (Light)',
        'green-deep'   => 'Green (Deep)',
        'green-core'   => 'Green (Core)',
        'green-pale'   => 'Green (Pale)',
        'green-light'  => 'Green (Light)',
        'indigo-deep'  => 'Indigo (Deep)',
        'indigo-pale'  => 'Indigo (Pale)',
        'indigo-light' => 'Indigo (Light)',
        'navy-deep'    => 'Navy (Deep)',
        'navy-core'    => 'Navy (Core)',
        'navy-pale'    => 'Navy (Pale)',
        'navy-light'   => 'Navy (Light)',
        'orange-deep'  => 'Orange (Deep)',
        'orange-core'  => 'Orange (Core)',
        'orange-pale'  => 'Orange (Pale)',
        'orange-light' => 'Orange (Light)',
        'purple-deep'  => 'Purple (Deep)',
        'purple-pale'  => 'Purple (Pale)',
        'purple-light' => 'Purple (Light)',
        'red-deep'     => 'Red (Deep)',
        'red-core'     => 'Red (Core)',
        'red-pale'     => 'Red (Pale)',
        'red-light'    => 'Red (Light)',
        'teal-deep'    => 'Teal (Deep)',
        'teal-pale'    => 'Teal (Pale)',
        'teal-light'   => 'Teal (Light)',
        'yellow-deep'  => 'Yellow (Deep)',
        'yellow-pale'  => 'Yellow (Pale)',
        'yellow-light' => 'Yellow (Light)',
    );
}


/**
 * Reusable color array
 * Lookback helper function
 *
 * @return array
 */
function fbapac_lookback_colors_bgs_array() {
    return array(
        'blue-pale'    => 'Blue (Pale)',
        'blue-light'   => 'Blue (Light)',
        'green-pale'   => 'Green (Pale)',
        'green-light'  => 'Green (Light)',
        'indigo-pale'  => 'Indigo (Pale)',
        'indigo-light' => 'Indigo (Light)',
        'navy-pale'    => 'Navy (Pale)',
        'navy-light'   => 'Navy (Light)',
        'orange-pale'  => 'Orange (Pale)',
        'orange-light' => 'Orange (Light)',
        'purple-pale'  => 'Purple (Pale)',
        'purple-light' => 'Purple (Light)',
        'red-pale'     => 'Red (Pale)',
        'red-light'    => 'Red (Light)',
        'teal-pale'    => 'Teal (Pale)',
        'teal-light'   => 'Teal (Light)',
        'yellow-pale'  => 'Yellow (Pale)',
        'yellow-light' => 'Yellow (Light)',
    );
}


/**
 * Reusable icon array
 * Lookback helper function
 *
 * @return array
 */
function fbapac_lookback_icons_array() {
    return array(
        'awardwin'            => 'Award Win',
        'bargraph'            => 'Bar Graph',
        'covid19support'      => 'COVID-19 Support',
        'economicempowerment' => 'Economic Empowerment',
        'education'           => 'Education',
        'government'          => 'Government',
        'partnership'         => 'Partnership',
        'smallbusiness'       => 'Small Business',
        'smallbusinesswomen'  => 'Small Business (Women)',
        'socialgood'          => 'Social Good',
        'training'            => 'Training',
    );
}


/**
 * Lookback Options using Fieldmanager plugin
 * Fields for page template page-lookback
 *
 * @return void
 */
function fbapac_page_lookback_fields() {

    $fm0 = new Fieldmanager_Group( array(
        'name'     => 'lookback_page_main',
        'children' => array(
            'hero_toggle' => new Fieldmanager_Checkbox(
                'Display the hero section?'
            ),
            'hero_title' =>  new Fieldmanager_Textfield(
                'Hero Title'
            ),
            'hero_text_color' => new Fieldmanager_Select( array(
                'label'       => 'Hero Text Color',
                'first_empty' => true,
                'options'     => fbapac_lookback_colors_advanced_array()
            ) ),
            'hero_image' => new Fieldmanager_Media(
                'Hero Image'
            ),
            'hero_image_mob' => new Fieldmanager_Media(
                'Hero Image (Mobile)'
            ),
            'hero_video' => new Fieldmanager_Media(
                'Hero Video'
            ),
            'hero_video_link_toggle' => new Fieldmanager_Checkbox(
                'Display a link to a video in the hero?'
            ),
            'hero_video_ext_toggle' => new Fieldmanager_Checkbox(
                'Make it an external link to a video? [Will override any video uploaded above]'
            ),
            'hero_video_ext_link' =>  new Fieldmanager_Textfield(
                'Hero Video External Link'
            ),
        ), 
    ) );
    $fm0->add_meta_box( 'Main Page Settings', array( 'page' ), 'normal', 'high' );

    $fm1_children = array();
    $fm1_children['toggle']        = new Fieldmanager_Checkbox( 'Display this section?' );
    $fm1_children['section_title'] = new Fieldmanager_Textfield( 'Section Title' );
    // set max here
    $fm1_howmany = range(1,4);
    foreach ( $fm1_howmany as $i ) {
        $fm1_children['pillar_' . $i] = new Fieldmanager_Group( array( 'label' => 'Pillar ' . $i, 'children' => array( 'title' => new Fieldmanager_Textfield( 'Title' ), 'color' => new Fieldmanager_Select( array( 'label' => 'Color', 'first_empty' => true, 'options' => fbapac_lookback_colors_advanced_array() ) ), 'content' =>  new Fieldmanager_Textarea( 'Long Description' ) ) ) );
    }
    $fm1 = new Fieldmanager_Group( array(
        'name'     => 'lookback_page_pillars',
        'children' => $fm1_children,
    ) );
    $fm1->add_meta_box( 'Pillars', array( 'page' ), 'normal', 'high' );


    $fm2 = new Fieldmanager_Group( array(
        'name'     => 'lookback_page_lf',
        'children' => array(
            'lf_toggle' => new Fieldmanager_Checkbox(
                'Display the hero section?'
            ),
            'lf_bgcolor' => new Fieldmanager_Select( array( 
                'label' => 'Long Form Content, Background Color', 
                'first_empty' => true, 
                'options' => fbapac_lookback_colors_bgs_array() 
            ) ),
            'lf_title' =>  new Fieldmanager_TextField(
                'Long Form Content, Title'
            ),
            'lf_subtitle' =>  new Fieldmanager_TextField(
                'Long Form Content, Subtitle'
            ),
            'lf_content' =>  new Fieldmanager_TextArea(
                'Long Form Content, Body Content'
            ),
        ), 
    ) );
    $fm2->add_meta_box( 'Long Form Content', array( 'page' ), 'normal', 'high' );

    $fm3_children = array();
    $fm3_children['toggle']        = new Fieldmanager_Checkbox( 'Display this section?' );
    $fm3_children['section_title'] = new Fieldmanager_Textfield( 'Section Title' );
    // set max here
    $fm3_howmany = range(1,9);
    foreach ( $fm3_howmany as $i ) {
        $fm3_children['number_' . $i] = new Fieldmanager_Group( array( 'label' => 'Item ' . $i, 'children' => array( 'toggle' => new Fieldmanager_Checkbox( 'Display this item?' ), 'number' => new Fieldmanager_Textfield( 'Number' ), 'icon' => new Fieldmanager_Select( array( 'label' => 'Icon', 'first_empty' => true, 'options' => fbapac_lookback_icons_array() ) ), 'description' => new Fieldmanager_Textarea( 'Description' ) ) ) );
    }
    $fm3 = new Fieldmanager_Group( array(
        'name'     => 'lookback_page_numbers',
        'children' => $fm3_children,
    ) );
    $fm3->add_meta_box( 'By the Numbers', array( 'page' ), 'normal', 'high' );

    $fm4 = new Fieldmanager_Group( array(
        'name'     => 'lookback_page_regions',
        'children' => array(
            'toggle' => new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'section_title' => new Fieldmanager_Textfield( 
                'Section Title' 
            ),
        ),
    ) );
    $fm4->add_meta_box( 'Regions', array( 'page' ), 'normal', 'high' );

}

add_action( 'fm_post_page', 'fbapac_page_lookback_fields' );


/**
 * Lookback Options using Fieldmanager plugin
 * Fields for custom post type lookback_region
 *
 * @return void
 */
function fbapac_cpt_lookback_region_fields() {

    $fm0 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_main',
        'children' => array(
            'main_color' => new Fieldmanager_Select( array(
                'label'       => 'Main Color',
                'first_empty' => true,
                'options'     => fbapac_lookback_colors_advanced_array()
            ) ),
            'image_square' => new Fieldmanager_Media(
                'Square Image (used for previews)'
            ),
            'hero_toggle' => new Fieldmanager_Checkbox(
                'Display the hero section?'
            ),
            'hero_title' => new Fieldmanager_Textfield(
                'Hero Title'
            ),
            'hero_text_color' => new Fieldmanager_Select( array(
                'label'       => 'Hero Text Color',
                'first_empty' => true,
                'options'     => fbapac_lookback_colors_advanced_array()
            ) ),
            'hero_image' => new Fieldmanager_Media(
                'Hero Image'
            ),
            'hero_image_mob' => new Fieldmanager_Media(
                'Hero Image (Mobile)'
            ),
        ), 
    ) );
    $fm0->add_meta_box( 'General Region Settings', array( 'lookback_region' ), 'normal', 'high' );

    $fm1 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_introduction',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'bg_color' => new Fieldmanager_Select( array( 
                'label' => 'Color', 
                'first_empty' => true, 
                'options' => fbapac_lookback_colors_bgs_array() 
            ) ),
            'title' =>  new Fieldmanager_Textfield(
                'Title'
            ),
            'content' => new Fieldmanager_Textarea(
                'Content'
            ),
        ),
    ) );
    $fm1->add_meta_box( 'Region Introduction', array( 'lookback_region' ), 'normal', 'high' );

    $fm2_children = array();
    $fm2_children['toggle']        = new Fieldmanager_Checkbox( 'Display this section?' );
    $fm2_children['section_title'] = new Fieldmanager_Textfield( 'Section Title');
    // set max here
    $fm2_howmany = range(1,9);
    foreach ( $fm2_howmany as $i ) {
        $fm2_children['number_' . $i] = new Fieldmanager_Group( array( 'label' => 'item ' . $i, 'children' => array( 'toggle' => new Fieldmanager_Checkbox( 'Display this item?' ), 'number' => new Fieldmanager_Textfield( 'Number' ), 'icon' => new Fieldmanager_Select( array( 'label' => 'Icon', 'first_empty' => true, 'options' => fbapac_lookback_icons_array() ) ), 'description' => new Fieldmanager_Textarea( 'Description' ) ) ) );
    }
    $fm2 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_numbers',
        'children' => $fm2_children,
    ) );
    $fm2->add_meta_box( 'By the Numbers', array( 'lookback_region' ), 'normal', 'high' );

    $fm3 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_quotes',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'quotes' => new Fieldmanager_Group( [
                'limit'              => 10,
                'add_more_label'     => 'Add another quote',
                'sortable'           => true,
                'extra_elements'     => 0,
                'group_is_empty' => function ( $values ) {
                    return empty( $values['quote_item'] );
                },
                'children'       => array(
                    'quote_item' => new Fieldmanager_Group( [
                        'extra_elements'     => 0,
                        'group_is_empty' => function ( $values ) {
                            return empty( $values['quote_body'] );
                        },
                        'label'          => 'A Quote',
                        'children'       => [
                            'quote_body' => new Fieldmanager_Textarea(
                                'The Quote'
                            ),
                            'quote_name' => new Fieldmanager_TextField(
                               'Name'
                            ),
                            'quote_title' => new Fieldmanager_TextField(
                               'Title'
                            ),
                            'quote_font_size' => new Fieldmanager_Select( array(
                                'label' => 'Font Size',
                                'options' => array(
                                    'reg' => 'Regular',
                                    'xl'  => 'Extra Large',
                                    'lg'  => 'Large',
                                    'sm'  => 'Small',
                                    'xs'  => 'Extra Small',
                                ),
                            ) ),
                            'quote_image' => new Fieldmanager_Media(
                                [
                                    'label' => 'Image',
                                    'description' => 'Add optional image'
                                ]
                            ),
                        ],
                    ] ),
                ),
            ] ),          
        ),
    ) );
    $fm3->add_meta_box( 'Quotes', array( 'lookback_region' ), 'normal', 'high' );

    $fm4 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_social_impact',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'bg_image' => new Fieldmanager_Media(
                'Section Background Image'
            ),
            'section_title_1' =>  new Fieldmanager_Textfield(
                'Section Title (Part 1)'
            ),
            'section_title_2' =>  new Fieldmanager_Textfield(
                'Section Title (Part 2)'
            ),
            'cards' => new Fieldmanager_Group( [
                'limit'              => 12,
                'add_more_label'     => 'Add another card',
                'sortable'           => true,
                'extra_elements'     => 0,
                'group_is_empty' => function ( $values ) {
                    return empty( $values['card_item'] );
                },
                'children'      => array(
                    'card_item' => new Fieldmanager_Group( [
                        'extra_elements'     => 0,
                        'group_is_empty' => function ( $values ) {
                            return empty( $values['card_front'] );
                        },
                        'label'          => 'A Card',
                        'children'       => [
                            'card_type' => new Fieldmanager_Select( array(
                                'label'     => 'Card Type',
                                'options'   => array(
                                    'data'  => 'Data Card',
                                    'info'  => 'Info Card',
                                    'quote' => 'Quote Card',
                                ),
                            ) ),
                            'card_front' => new Fieldmanager_TextArea(
                               'Card Front'
                            ),
                            'card_back' => new Fieldmanager_TextArea(
                               'Card Back'
                            ),
                            'card_person' => new Fieldmanager_TextField(
                                [
                                    'label' => 'Name of Person Quoted',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                            'card_image' => new Fieldmanager_Media(
                                [
                                    'label' => 'Card Image',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                        ],
                    ] ),
                ),
            ] ), 
            'long_form' => new Fieldmanager_Group( [
                'label' => 'Long Form Content',
                'children' => array(
                    'toggle' =>  new Fieldmanager_Checkbox(
                        'Display a long form content subsection in this section?'
                    ),
                    'lf_bgcolor' => new Fieldmanager_Select( array( 
                        'label' => 'Long Form Content, Background Color', 
                        'first_empty' => true, 
                        'options' => fbapac_lookback_colors_bgs_array() 
                    ) ),
                    'lf_title' =>  new Fieldmanager_TextField(
                        'Long Form Content, Title'
                    ),
                    'lf_subtitle' =>  new Fieldmanager_TextField(
                        'Long Form Content, Subtitle'
                    ),
                    'lf_content' =>  new Fieldmanager_TextArea(
                        'Long Form Content, Body Content'
                    ),
                ),
            ] ), 
        ),
    ) );
    $fm4->add_meta_box( 'Social Impact', array( 'lookback_region' ), 'normal', 'high' );

    $fm5 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_economic_impact',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'bg_image' => new Fieldmanager_Media(
                'Section Background Image'
            ),
            'section_title_1' =>  new Fieldmanager_Textfield(
                'Section Title (Part 1)'
            ),
            'section_title_2' =>  new Fieldmanager_Textfield(
                'Section Title (Part 2)'
            ),
            'cards' => new Fieldmanager_Group( [
                'limit'              => 12,
                'add_more_label'     => 'Add another card',
                'sortable'           => true,
                'extra_elements'     => 0,
                'group_is_empty' => function ( $values ) {
                    return empty( $values['card_item'] );
                },
                'children'      => array(
                    'card_item' => new Fieldmanager_Group( [
                        'extra_elements'     => 0,
                        'group_is_empty' => function ( $values ) {
                            return empty( $values['card_front'] );
                        },
                        'label'          => 'A Card',
                        'children'       => [
                            'card_type' => new Fieldmanager_Select( array(
                                'label'     => 'Card Type',
                                'options'   => array(
                                    'data'  => 'Data Card',
                                    'info'  => 'Info Card',
                                    'quote' => 'Quote Card',
                                ),
                            ) ),
                            'card_front' => new Fieldmanager_TextArea(
                               'Card Front'
                            ),
                            'card_back' => new Fieldmanager_TextArea(
                               'Card Back'
                            ),
                            'card_person' => new Fieldmanager_TextField(
                                [
                                    'label' => 'Name of Person Quoted',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                            'card_image' => new Fieldmanager_Media(
                                [
                                    'label' => 'Card Image',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                        ],
                    ] ),
                ),
            ] ), 
            'long_form' => new Fieldmanager_Group( [
                'label' => 'Long Form Content',
                'children' => array(
                    'toggle' =>  new Fieldmanager_Checkbox(
                        'Display a long form content subsection in this section?'
                    ),
                    'lf_bgcolor' => new Fieldmanager_Select( array( 
                        'label' => 'Long Form Content, Background Color', 
                        'first_empty' => true, 
                        'options' => fbapac_lookback_colors_bgs_array() 
                    ) ),
                    'lf_title' =>  new Fieldmanager_TextField(
                        'Long Form Content, Title'
                    ),
                    'lf_subtitle' =>  new Fieldmanager_TextField(
                        'Long Form Content, Subtitle'
                    ),
                    'lf_content' =>  new Fieldmanager_TextArea(
                        'Long Form Content, Body Content'
                    ),
                ),
            ] ), 
        ),
    ) );
    $fm5->add_meta_box( 'Economic Impact', array( 'lookback_region' ), 'normal', 'high' );

    $fm6 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_digital',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'bg_image' => new Fieldmanager_Media(
                'Section Background Image'
            ),
            'section_title_1' =>  new Fieldmanager_Textfield(
                'Section Title (Part 1)'
            ),
            'section_title_2' =>  new Fieldmanager_Textfield(
                'Section Title (Part 2)'
            ),
            'cards' => new Fieldmanager_Group( [
                'limit'              => 12,
                'add_more_label'     => 'Add another card',
                'sortable'           => true,
                'extra_elements'     => 0,
                'group_is_empty' => function ( $values ) {
                    return empty( $values['card_item'] );
                },
                'children'      => array(
                    'card_item' => new Fieldmanager_Group( [
                        'extra_elements'     => 0,
                        'group_is_empty' => function ( $values ) {
                            return empty( $values['card_front'] );
                        },
                        'label'          => 'A Card',
                        'children'       => [
                            'card_type' => new Fieldmanager_Select( array(
                                'label'     => 'Card Type',
                                'options'   => array(
                                    'data'  => 'Data Card',
                                    'info'  => 'Info Card',
                                    'quote' => 'Quote Card',
                                ),
                            ) ),
                            'card_front' => new Fieldmanager_TextArea(
                               'Card Front'
                            ),
                            'card_back' => new Fieldmanager_TextArea(
                               'Card Back'
                            ),
                            'card_person' => new Fieldmanager_TextField(
                                [
                                    'label' => 'Name of Person Quoted',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                            'card_image' => new Fieldmanager_Media(
                                [
                                    'label' => 'Card Image',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                        ],
                    ] ),
                ),
            ] ),
            'long_form' => new Fieldmanager_Group( [
                'label' => 'Long Form Content',
                'children' => array(
                    'toggle' =>  new Fieldmanager_Checkbox(
                        'Display a long form content subsection in this section?'
                    ),
                    'lf_bgcolor' => new Fieldmanager_Select( array( 
                        'label' => 'Long Form Content, Background Color', 
                        'first_empty' => true, 
                        'options' => fbapac_lookback_colors_bgs_array() 
                    ) ),
                    'lf_title' =>  new Fieldmanager_TextField(
                        'Long Form Content, Title'
                    ),
                    'lf_subtitle' =>  new Fieldmanager_TextField(
                        'Long Form Content, Subtitle'
                    ),
                    'lf_content' =>  new Fieldmanager_TextArea(
                        'Long Form Content, Body Content'
                    ),
                ),
            ] ), 
        ),
    ) );
    $fm6->add_meta_box( 'Digital Literacy', array( 'lookback_region' ), 'normal', 'high' );

    $fm7 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_government',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'bg_image' => new Fieldmanager_Media(
                'Section Background Image'
            ),
            'section_title_1' =>  new Fieldmanager_Textfield(
                'Section Title (Part 1)'
            ),
            'section_title_2' =>  new Fieldmanager_Textfield(
                'Section Title (Part 2)'
            ),
            'cards' => new Fieldmanager_Group( [
                'limit'              => 12,
                'add_more_label'     => 'Add another card',
                'sortable'           => true,
                'extra_elements'     => 0,
                'group_is_empty' => function ( $values ) {
                    return empty( $values['card_item'] );
                },
                'children'      => array(
                    'card_item' => new Fieldmanager_Group( [
                        'extra_elements'     => 0,
                        'group_is_empty' => function ( $values ) {
                            return empty( $values['card_front'] );
                        },
                        'label'          => 'A Card',
                        'children'       => [
                            'card_type' => new Fieldmanager_Select( array(
                                'label'     => 'Card Type',
                                'options'   => array(
                                    'data'  => 'Data Card',
                                    'info'  => 'Info Card',
                                    'quote' => 'Quote Card',
                                ),
                            ) ),
                            'card_front' => new Fieldmanager_TextArea(
                               'Card Front'
                            ),
                            'card_back' => new Fieldmanager_TextArea(
                               'Card Back'
                            ),
                            'card_person' => new Fieldmanager_TextField(
                                [
                                    'label' => 'Name of Person Quoted',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                            'card_image' => new Fieldmanager_Media(
                                [
                                    'label' => 'Card Image',
                                    'description' => '* Only used with Quote cards'
                                ]
                            ),
                        ],
                    ] ),
                ),
            ] ), 
            'long_form' => new Fieldmanager_Group( [
                'label' => 'Long Form Content',
                'children' => array(
                    'toggle' =>  new Fieldmanager_Checkbox(
                        'Display a long form content subsection in this section?'
                    ),
                    'lf_bgcolor' => new Fieldmanager_Select( array( 
                        'label' => 'Long Form Content, Background Color', 
                        'first_empty' => true, 
                        'options' => fbapac_lookback_colors_bgs_array() 
                    ) ),
                    'lf_title' =>  new Fieldmanager_TextField(
                        'Long Form Content, Title'
                    ),
                    'lf_subtitle' =>  new Fieldmanager_TextField(
                        'Long Form Content, Subtitle'
                    ),
                    'lf_content' =>  new Fieldmanager_TextArea(
                        'Long Form Content, Body Content'
                    ),
                ),
            ] ), 
        ),
    ) );
    $fm7->add_meta_box( 'Politics and Government Outreach', array( 'lookback_region' ), 'normal', 'high' );

    $fm8 = new Fieldmanager_Group( array(
        'name'     => 'cptlr_conclusion',
        'children' => array(
            'toggle' =>  new Fieldmanager_Checkbox(
                'Display this section?'
            ),
            'bg_color' => new Fieldmanager_Select( array( 
                'label' => 'Color', 
                'first_empty' => true, 
                'options' => fbapac_lookback_colors_bgs_array() 
            ) ),
            'title' =>  new Fieldmanager_Textfield(
                'Title'
            ),
            'content' => new Fieldmanager_Textarea(
                'Content'
            ),
        ),
    ) );
    $fm8->add_meta_box( 'Region Conclusion', array( 'lookback_region' ), 'normal', 'high' );

}

add_action( 'fm_post_lookback_region', 'fbapac_cpt_lookback_region_fields' );

