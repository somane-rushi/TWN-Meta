<?php
/**
 * Submodule Part: PREV NEXT links
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['lesson_data']) && isset($args['module_id']) && isset($args['the_pid']) ) :
	$lesson_data    = fbsafety_fm_get_data($args, 'lesson_data');
	$module_id      = fbsafety_fm_get_data($args, 'module_id');
	$the_pid        = fbsafety_fm_get_data($args, 'the_pid');
	$order_num      = fbsafety_fm_get_data($args, 'order_num');
	$next_num       = intval( $order_num + 1 );
	$order_num_true = intval( $order_num + 1);
	$next_num_true  = intval( $order_num_true + 1);
	$is_resources   = fbsafety_fm_get_data($args, 'is_resources');
	$link_data      = fbsafety_generate_lesson_links( $lesson_data, $module_id ) ?: array();
	$total_parts    = intval( fbsafety_determine_how_many_lessons( $module_id ) );
?>

<div class="lesson-nav">

<?php 
	if ($order_num > 0) : 
		$prev_num  = intval( $order_num - 1 );
		$prev_data = $link_data[ $prev_num ];
		$prev_link = fbsafety_fm_get_data($prev_data, 'link');
		$prev_text = 'Previous Lesson';
		if (1 === $order_num) {
			$prev_text = 'Back to Overview';
		}
		if (true === $is_resources) {
			$prev_link = get_permalink( intval($module_id) );
			$prev_text = 'Back to Module';
		}
?>
	<a href="<?php echo esc_url( $prev_link ); ?>">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/img/Left-Gray.svg' ); ?>" alt="Previous">
		<?php echo esc_html( $prev_text ); ?>
	</a>
<?php 
	endif; 
?>

<?php 
	$next_data = $link_data[ $next_num ];
	$next_link = fbsafety_fm_get_data($next_data, 'link');
	$next_text = 'Next Lesson';
	if (0 === $order_num) {
		$next_text = 'Begin Module';
	}
	if ($next_num_true === $total_parts) {
		$next_text = 'Module Resources';
	}
	if (true === $is_resources) {
		$next_text = 'Next Module';
		$this_module_num = intval( get_post_meta( $module_id, 'module_number', true ) );
		$next_module_id  = fbsafety_get_next_module($this_module_num);
		if ( ! empty($next_module_id) ) {
			$next_link     = get_permalink( intval($next_module_id) );
		}
	}
?>
	<a href="<?php echo esc_url( $next_link ); ?>"<?php if ($order_num < 1) : ?> class="no-previous-link"<?php endif; ?>>
		<img src="<?php echo esc_url( get_template_directory_uri() . '/img/Right-Gray.svg' ); ?>" alt="Next">
		<?php echo esc_html( $next_text ); ?>
	</a>

</div>

<?php
endif;//args
