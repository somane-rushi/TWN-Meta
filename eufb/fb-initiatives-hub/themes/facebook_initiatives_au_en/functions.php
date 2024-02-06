<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'facebook-initiatives-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/assets/css/main.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
    wp_enqueue_style( 'mobile-menu-style', get_stylesheet_directory_uri() . '/css/slide-menu.css');


}

//Add script
function my_custom_scripts() {
    wp_enqueue_script( 'slide-menu-js', get_stylesheet_directory_uri() . '/js/slide-menu.js', array(),'',true );
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );



//Added footer menu
register_nav_menus(
    array(
        'foo-bottom-menu'    => esc_html__( 'Footer bottom Menu', '_s' ),
    )
);

//Arrow Button Shortcode

function arrow_button_shortcode($atts, $content = null) {
extract(shortcode_atts(array('link' => '#', 'target' => '' ), $atts));
return '<a class="arrow-btn btn-code" href="'.$link.'" target="'.$target.'"><span class="arrow-icon"><i class="far fa-arrow-alt-circle-right" aria-hidden="true"></i></span>' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'arrow_button_shortcode');

