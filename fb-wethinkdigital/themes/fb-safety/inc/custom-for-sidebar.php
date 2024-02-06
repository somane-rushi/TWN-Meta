<?php
/**
 * Custom FUNCTIONS for SIDEBARS
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Generate Overview Links for Sidebar on Lesson pages
 *
 * @param integer $module_id post_id of module being viewed
 *
 * @return array
 */
function fbsafety_generate_module_downloads( $module_id=null ) {
	$response = array();
	if ( ! empty($module_id) ) {
		$user_downloads  = get_post_meta( intval($module_id), 'user_downloads', true );
		$module_download = fbsafety_fm_get_data($user_downloads, 'module_download');
		if ( ! empty($module_download) ) {
			$response['module_download'] = array(
				"link" => wp_get_attachment_url( intval($module_download) ),
				"text" => 'Download Module'
			);
		}
		$guide_download  = fbsafety_fm_get_data($user_downloads, 'guide_download');
		if ( ! empty($guide_download) ) {
			$response['guide_download'] = array(
				"link" => wp_get_attachment_url( intval($guide_download) ),
				"text" => 'Download Facilitator Guide'
			);
		}
	}
	return $response;
}


/**
 * Generate Overview Links for Sidebar on Lesson pages
 *
 * @param array $lessons Array of all lesson data for one module
 * @param integer $module_id post_id of module being viewed
 *
 * @return array
 */
function fbsafety_generate_lesson_links( $lessons=array(), $module_id=null ) {
	$link_data = array();
	if ( !empty($lessons) && !empty($module_id) ) {
		foreach ($lessons as $lesson) {
			$i = 0;
			foreach ($lesson as $part) {
				if ( isset($part['which_subgroup']) ) {

					$link         = '';
					$title        = '';
					$is_resources = false;

					if ( 'overview' === $part['which_subgroup'] ) {
						$link  = get_permalink( $module_id );
						$title = fbsafety_fm_get_data( $part[ $part['which_subgroup'] ], 'heading' );
						$pid   = $module_id;
					}

					if ( 'lesson' === $part['which_subgroup'] ) {
						$lesson_id = fbsafety_fm_get_data( $part['lesson'], 'lesson_id' );
						$link      = get_permalink( $lesson_id );
						$title     = get_the_title( $lesson_id );
						$pid       = $lesson_id;
					}

					if ( 'resources' === $part['which_subgroup'] ) {
						$lesson_id    = fbsafety_fm_get_data( $part['resources'], 'lesson_id' );
						$link         = get_permalink( $lesson_id );
						$title        = get_the_title( $lesson_id );
						$pid          = $lesson_id;
						$is_resources = true;
					}

					$link_data[$i] = array(
						'pid'          => $pid,
						'link'         => $link,
						'title'        => $title,
						'is_resources' => $is_resources
					);

					$i++;

				}
			}
		}
	}
	return $link_data;
}


/**
 * Generate Overview Links for Sidebar on Lesson pages
 *
 * @param string $part (cpt-module-parent, cpt-module-child, or cpt-lesson)
 * @param integer $post_id of page being viewed
 * @param string $type (resources or guidelines)
 *
 * @return array
 */
function fbsafety_get_resources_and_guides( $part='', $the_pid=null, $type='' ) {
	$response = array();
	if ( ! empty($the_pid) ) {

		if ('cpt-lesson' === $part ) {
			$field   = 'available_' . sanitize_text_field($type);
			$files   = get_post_meta( intval($the_pid), $field, true );
			if ($files) {
				foreach ($files as $file) {
					if ( isset($file['a_file']) ) {
						$f = $file['a_file'];
						$response[] = array( 
							'file_id'   => fbsafety_fm_get_data( $f, 'file'), 
							'file_name' => fbsafety_fm_get_data( $f, 'file_name'), 
							'file_desc' => fbsafety_fm_get_data( $f, 'file_desc'), 
							'rsrc_type' => fbsafety_fm_get_data( $f, 'resource_type')
						);
					}
				}
			}
		}//cpt-lesson

		// resources pages
		if ('cpt-module-child' === $part ) {
			$module_id  = wp_get_post_parent_id( $the_pid );
			$lesson_ids = get_all_lesson_ids( intval($module_id) );
			if ( ! empty($lesson_ids) ) {
				foreach($lesson_ids as $lid) {
					$field   = 'available_' . sanitize_text_field($type);
					$files   = get_post_meta( intval($lid), $field, true );
					if ($files) {
						foreach ($files as $file) {
							if ( isset($file['a_file']) ) {
								$f = $file['a_file'];
								// array with k(post_id) => file values
								$response[$lid][] = array( 
									'file_id'   => fbsafety_fm_get_data( $f, 'file'), 
									'file_name' => fbsafety_fm_get_data( $f, 'file_name'), 
									'file_desc' => fbsafety_fm_get_data( $f, 'file_desc'), 
									'rsrc_type' => fbsafety_fm_get_data( $f, 'resource_type')
								);
							}
						}
					}
				}
			}
		}//cpt-module-child

	}
	return $response;
}


/**
 * Generate consistent display name of resource types
 *
 * @param string $resource_type
 *
 * @return string
 */
function fbsafety_resource_type_display($resource_type) {
	$display_name = ucwords( str_replace('_',' ', $resource_type) );
	if ('Educator Copy' === $display_name) {
		$display_name = "Educator's Copy";
	}
	return $display_name;
}

