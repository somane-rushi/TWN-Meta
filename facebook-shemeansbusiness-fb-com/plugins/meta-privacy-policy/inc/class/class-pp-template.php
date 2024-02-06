<?php
function pp_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {
    $post_templates['page-privacy-policy.php'] = __('Privacy Policy Plugin');
    return $post_templates;
}
add_filter( 'theme_page_templates', 'pp_add_template_to_select', 10, 4 );

function pp_load_plugin_template( $template ) {
    if(  get_page_template_slug() === 'page-privacy-policy.php' ) {
        $template = plugin_dir_path( __DIR__ ) . '/template/page-privacy-policy.php';
    }
    return $template;
}
add_filter( 'template_include', 'pp_load_plugin_template' );