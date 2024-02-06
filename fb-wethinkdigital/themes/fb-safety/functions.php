<?php
/**
 * fbsafety functions and definitions
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$fbsafety_includes = array(
	'/theme-init.php',          // Items specifically for theme init.
	'/setup-general.php',       // Theme setup and custom theme supports.
	'/custom-post-types.php',   // Custom fbsafety theme post types.
	'/enqueue-scripts.php',     // Enqueue scripts and styles.
	'/custom-global.php',       // Custom global theme functions.
	'/custom-shortcodes.php',   // Custom functions for shortcodes.
	'/custom-fm-build.php',     // Custom fieldmanager build in backend.
	'/custom-fm-render.php',    // Custom fieldmanager render in frontend.
	'/custom-for-lessons.php',  // Custom functions for CPT => lesson.
	'/custom-for-modules.php',  // Custom functions for CPT => module.
	'/custom-for-sidebar.php',  // Functions for sidebar used on both cpt module & cpt lesson
	'/custom-for-search.php',   // Custom search functionality.
	'/admin-only.php',          // Admin-only functions.
);

foreach ( $fbsafety_includes as $file ) {
	$filepath = locate_template( 'inc' . $file ) ?: '';
	if ( ! empty($filepath) ) {
		require_once $filepath;
	}
}
