<?php
/**
 *
 * @package WordPress
 */

get_header();

	$pageID = get_the_ID();
	$block_manager->render_blocks( $pageID );

get_footer();
