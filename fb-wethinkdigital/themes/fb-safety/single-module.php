<?php
/**
 * The template for custom post type MODULE
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$template = 'single-module-';
$sub_part = ($post->post_parent) ? 'child' : 'parent';
get_template_part( $template . $sub_part );
