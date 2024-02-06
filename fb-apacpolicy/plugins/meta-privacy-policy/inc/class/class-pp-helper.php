<?php
function enqueuing_admin_scripts()
{
	// Global Admin Variable, It tells which page is on now.
	global $pagenow;

	if ($pagenow == 'options-general.php') {
		wp_enqueue_style('meta-pp-style', plugin_dir_url(__FILE__) . '../assets/css/pp-style.css');
		wp_enqueue_script('meta-pp-js', plugin_dir_url(__FILE__) . '../assets/js/admin.js', array(), null, true);
	}
}
add_action('admin_enqueue_scripts', 'enqueuing_admin_scripts');