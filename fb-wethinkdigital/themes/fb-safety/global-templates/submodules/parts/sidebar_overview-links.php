<?php
/**
 * Submodule Part: SIDEBAR, OVERVIEW LINKS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['lesson_data']) ) :

	$lesson_data   = fbsafety_fm_get_data($args, 'lesson_data');
	$module_number = fbsafety_fm_get_data($args, 'module_number');
	$module_id     = fbsafety_fm_get_data($args, 'module_id');
	$the_pid       = fbsafety_fm_get_data($args, 'the_pid');

	$link_data     = fbsafety_generate_lesson_links( $lesson_data, $module_id ) ?: array();
	$which_lesson  = intval( fbsafety_generate_lesson_order_number( $module_id, $the_pid ) );
	$total_lessons = intval( fbsafety_determine_how_many_lessons( $module_id ) - 1 );
?>
				<!-- overview links -->
					<div class="overview-links">
						<span class="lesson--order mobile">
							<h5>
								<?php echo esc_html('Lesson ' . $which_lesson . '/' . $total_lessons); ?>
							</h5>
						</span>
						<div class="the--links">
							<?php 
								if ( ! empty($link_data) ) :
									foreach( $link_data as $k => $v ) :
										$link_url     = fbsafety_fm_get_data($v, 'link');
										$is_resources = intval( fbsafety_fm_get_data($v, 'is_resources') );
										$curr_pid     = intval( fbsafety_fm_get_data($v, 'pid') );
										$order_num    = fbsafety_generate_lesson_order_number( $module_id, $curr_pid );

										$is__first    = false;
										$is__last     = false;
										$link_txt     = fbsafety_fm_get_data($v, 'title');
										if (0 === intval($order_num)) {
											$link_txt  = 'Module Overview';
											$is__first = true;
										}
										if (intval($order_num) === $total_lessons) {
											$link_txt = 'Module Resources';
											$is__last = true;
										}
										if ( (false === $is__first) && (false === $is__last) ) {
											$link_txt = 'Lesson ' . intval($order_num) . ': ' . $link_txt;
										}

										$classes = '';
										if ( $curr_pid === $the_pid ) {
											$classes = 'active';
										}
							?>
								<a 
									href="<?php echo esc_url( rtrim( $link_url ,'/' ) . '#anchor-' . $module_number . '.' . $order_num ); ?>" 
									class="<?php echo esc_attr( $classes ); ?>"
									data-num="">
									<?php 
										//echo esc_html( $module_number . '.' . $order_num . ' ' .  $link_txt );
										echo esc_html( $link_txt );
									?>
								</a>
							<?php
									endforeach;
								endif;
							?>
						</div>
						<script>mobile_scroll_to_overview_links();</script>
					</div>
				<!-- ../overview links -->
<?php
endif;//args check
