<?php
/**
 * Template Name: Front Page / Home Page
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$the_pid  = get_the_ID();
$fbs_coun = fbsafety_which_country_language()[0];
$fbs_lang = fbsafety_which_country_language()[1];

if ( class_exists('FieldManagerCustomRender') ) :
	$render_which = 'pagefields';
	$cfm__render  = new FieldManagerCustomRender();
	$cfm__render->display( intval($the_pid), sanitize_key($render_which), sanitize_key($fbs_lang) );
endif;

get_footer();
