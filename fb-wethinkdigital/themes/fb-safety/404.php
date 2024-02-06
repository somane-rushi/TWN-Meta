<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$global_fields = get_option('global_fields');
$text_404      = fbsafety_fm_get_data($global_fields, 'text_404');
if ( empty($text_404) ) {
	$text_404 = "Error, page cannot be found.";
}

$image_404 = fbsafety_fm_get_data($global_fields, 'image_404');
if ( empty($image_404) ) {
	$image_404 = 945;
}

$args = array(
	"sub_fields" => array(
		"toggle"         => "1",
		"image"          => intval($image_404),
		"image_mob"      =>	intval($image_404),
		"lighter_toggle" => "",
		"title"          => $text_404,
		"text_color"     => "white"
	)
);
get_template_part( 'global-templates/submodules/hero_section', null, $args );

get_footer();
