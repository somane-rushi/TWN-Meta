<?php
/**
 * Custom FUNCTIONS for CPT LESSON
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Determine Lesson order for different parts of a module
 *
 * @param integer $lesson_id post_id of lesson being viewed
 * @param integer $module_id post_id of Module that owns this lesson
 *
 * @return integer
 */
function fbsafety_generate_lesson_order_number( $module_id=null, $lesson_id=null ) {
	$num = 0;
	if ( !empty($module_id) && !empty($lesson_id) ) {
		// for overview (first lesson)
		if ( intval($module_id) === intval($lesson_id) ) {
			$num = 0;
		}
		$lessons = get_post_meta( $module_id, 'lessons' );
		// for the rest of the lessons
		if ( ! empty($lessons) ) {
			foreach ($lessons as $lesson) {
				$i = 0;
				foreach ($lesson as $part) {
					if ( isset($part['which_subgroup']) ) {
						if ( 'overview' !== $part['which_subgroup'] ) {
							$i++;
						}
						if ( 'lesson' === $part['which_subgroup'] ) {
							$curr_lesson_id = fbsafety_fm_get_data( $part['lesson'], 'lesson_id' );
							if ( intval($curr_lesson_id) === intval($lesson_id) ) {
								$num = $i;
							}
						}
						if ( 'resources' === $part['which_subgroup'] ) {
							$curr_lesson_id = fbsafety_fm_get_data( $part['resources'], 'lesson_id' );
							if ( intval($curr_lesson_id) === intval($lesson_id) ) {
								$num = $i;
							}
						}
					}
				}
			}
		}
	}
	return intval( $num );
}


/**
 * Determine the first (active) lesson title
 *
 * @param integer $module_id post_id of module being viewed
 *
 * @return string
 */
function fbsafety_determine_first_lesson( $module_id=null ) {
	$active_title = '';
  if ( ! empty( $module_id) ) {
    $lessons_meta  = get_post_meta( $module_id, 'lessons' );
    $i = 0;
    foreach ($lessons_meta as $meta) {
      foreach ($meta as $lsn) {
        $i++;
        if (1 === $i) {
          $which_subgroup = fbsafety_fm_get_data($lsn, 'which_subgroup');
          $active_title   = isset($lsn[$which_subgroup]['heading']) ? $lsn[$which_subgroup]['heading'] : '';
        }
      }
    }
  }
  return $active_title;
}


/**
 * Determine how many total lessons (parts) are associated with a specfic module
 *
 * @param integer $module_id post_id of module being viewed
 *
 * @return integer
 */
function fbsafety_determine_how_many_lessons( $module_id=null ) {
	$num = 0;
	if ( ! empty($module_id) ) {
		$all_module_lessons = get_post_meta( $module_id, 'lessons', true ) ?: array();
		if ( ! empty($all_module_lessons) ) {
			$num = count($all_module_lessons);
		}
	}
	return intval( $num );
}

