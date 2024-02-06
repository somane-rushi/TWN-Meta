<?php
/**
 * Custom FUNCTIONS for SHORTCODES
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Display a Download Button
 *
 * @return mixed
 */
function fbsafety_download_button( $atts = array() ) {
    $a = shortcode_atts( array(
      'url'  => '',
      'text' => ''
    ), $atts );
    $url  = $a['url'];
    $text = $a['text'];

    return '<a class="a-download-link" href="' . esc_url($url) . '" download>' . esc_html($text) . '</a>';
}
add_shortcode('download_button', 'fbsafety_download_button');


/**
 * Display a Begin Lesson alert
 *
 * @return mixed
 */
function fbsafety_begin_lesson( $atts = array() ) {
	ob_start();
  get_template_part( 'global-templates/alerts/begin_lesson' );
  return ob_get_clean();
}
add_shortcode('begin_lesson', 'fbsafety_begin_lesson');


/**
 * Display a End Lesson alert
 *
 * @return mixed
 */
function fbsafety_end_lesson( $atts = array() ) {
	ob_start();
  get_template_part( 'global-templates/alerts/end_lesson' );
  return ob_get_clean();
}
add_shortcode('end_lesson', 'fbsafety_end_lesson');


/**
 * Display a Begin Module alert
 *
 * @return mixed
 */
function fbsafety_begin_module( $atts = array() ) {
	ob_start();
  get_template_part( 'global-templates/alerts/begin_module' );
  return ob_get_clean();
}
add_shortcode('begin_module', 'fbsafety_begin_module');


/**
 * Display a End Module alert
 *
 * @return mixed
 */
function fbsafety_end_module( $atts = array() ) {
	ob_start();
  get_template_part( 'global-templates/alerts/end_module' );
  return ob_get_clean();
}
add_shortcode('end_module', 'fbsafety_end_module');


function fbsafety_source( $atts, $content='' ) {
 $a = shortcode_atts( array(), $atts );
 if ( ! empty($content) ) {
 	$output  = '<div class="a-source"><h6>Source:</h6>';
 	$output .= wp_kses( $content, allowed_html_tags() );
 	$output .= '</div>';
 	return $output;
 }
}
add_shortcode( 'source', 'fbsafety_source' );


function fbsafety_highlighted( $atts, $content='' ) {
 $a = shortcode_atts( array( 'title' => '' ), $atts );
 $title     = $a['title'];
 $the_title = '';
 if ( ! empty($title) ) {
 	$the_title = '<span class="htitle">' . $title . '</span><br />';
 }
 if ( ! empty($content) ) {
 	$output  = '<div class="highlighted"><div class="inner">';
 	$output .= $the_title;
 	$output .= wp_kses( $content, allowed_html_tags() );
 	$output .= '</div></div>';
 	return $output;
 }
}
add_shortcode( 'highlighted', 'fbsafety_highlighted' );


function fbsafety_greentext( $atts, $content='' ) {
 $a = shortcode_atts( array(), $atts );
 if ( ! empty($content) ) {
 	$output  = '<div class="greentext">';
 	$output .= wp_kses( $content, allowed_html_tags() );
 	$output .= '</div>';
 	return $output;
 }
}
add_shortcode( 'greentext', 'fbsafety_greentext' );


function fbsafety_accordion( $atts, $content='' ) {
 $a = shortcode_atts( array( 
 	'title'     => '',
 	'collapsed' => 'true'
 ), $atts );
 $title     = $a['title'];
 $collapsed = $a['collapsed'];
 if ( ! empty($content) ) {
		ob_start();
  	$args = array(
      'title'     => $title,
      'collapsed' => $collapsed,
      'content'   => $content
    );
	  get_template_part( 'global-templates/submodules/parts/accordion', null, $args );
	  return ob_get_clean();
 }
}
add_shortcode( 'accordion', 'fbsafety_accordion' );


/**
 * Display a spacer within content
 * size: xs, sm, md, lg, xl
 *
 * @return mixed
 */
function fbsafety_spacer( $atts = array() ) {
  $a = shortcode_atts( array( 
    'size' => 'sm' 
  ), $atts );
  $size = $a['size'];
  $output  = '<span class="content--spacer ' . esc_attr($size) .'"></span>';
  return $output;
}
add_shortcode('spacer', 'fbsafety_spacer');

