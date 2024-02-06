<?php
/**
 * The Main Header
 *
 * @package fbsafety
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$fbs_coun = fbsafety_which_country_language()[0];
$fbs_lang = fbsafety_which_country_language()[1];

get_template_part( 'global-templates/core/header--global' );
