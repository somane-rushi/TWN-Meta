<?php
/**
 * Submodule: SIDEBAR for both MODULE & LESSON
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['module_data']) && !empty($args['module_data']) ) :

	$module_data   = fbsafety_fm_get_data($args, 'module_data');
	$module_id     = fbsafety_fm_get_data($module_data, 'module_id');
	$module_title  = fbsafety_fm_get_data($module_data, 'module_title');
	$module_number = fbsafety_fm_get_data($module_data, 'module_number');
	$lesson_data   = fbsafety_fm_get_data($args, 'lesson_data');
	$the_pid       = intval( fbsafety_fm_get_data($args, 'the_pid') );
	$which_part    = fbsafety_fm_get_data($args, 'which_part');


	// TOP DOWNLOADS
	$all_module_downloads = fbsafety_generate_module_downloads( $module_id );
	$main_downloads_args = array(
		'which_part'           => $which_part, 
		'all_module_downloads' => $all_module_downloads,
	);
	get_template_part( 
		'global-templates/submodules/parts/sidebar_main-downloads', 
		null, 
		$main_downloads_args 
	);


	// OVERVIEW LINKS
	$overview_links_args = array(
		'lesson_data'   => $lesson_data,
		'module_number' => $module_number,
		'module_id'     => $module_id,
		'the_pid'       => $the_pid,
	);
	get_template_part( 
		'global-templates/submodules/parts/sidebar_overview-links', 
		null, 
		$overview_links_args 
	);


	// AVAILABLE LINKS
	$avail_links_args = array(
		'which_part' => $which_part,
		'the_pid'    => $the_pid,
	);
	get_template_part( 
		'global-templates/submodules/parts/sidebar_available-links', 
		null, 
		$avail_links_args 
	);

endif;//args
