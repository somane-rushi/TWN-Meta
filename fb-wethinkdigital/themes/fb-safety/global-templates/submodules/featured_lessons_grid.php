<?php
/**
 * Submodule: FEATURED LESSONS (GRID)
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
	$sub_fields = $args['sub_fields'];
	$featured_lessons_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
	if ('1' === $featured_lessons_toggle) :
		$the_lessons = fbsafety_fm_get_data($sub_fields, 'the_lessons');
		if ( ! empty($the_lessons) ) :
			shuffle($the_lessons);
			$lesson_data = array();
			foreach ($the_lessons as $lsn) {
				$lsn_exp       = explode('__', $lsn);
				$pid           = $lsn_exp[1];
				$module_id     = get_post_meta($pid, 'module_id', true);
				$lesson_img    = get_stylesheet_directory_uri() .'/img/placeholder440.jpg';
				$lesson_img_id = get_post_thumbnail_id($pid);
				if ( ! empty( $lesson_img_id ) ) {
					$lesson_img = wp_get_attachment_image_src( intval($lesson_img_id), 'full' )[0];
				}
				$lesson_object = get_post($pid);
				$lesson_data[] = array(
					'lesson_id'    => $pid,
					'module_id'    => $module_id,
					'lesson_link'  => get_permalink($pid),
					'lesson_title' => $lesson_object->post_title,
					'lesson_short' => $lesson_object->post_excerpt,
					'lesson_long'  => $lesson_object->post_content,
					'lesson_img'   => $lesson_img
				);
			}
			$the_title    = 'Featured Lessons';
			$custom_title = fbsafety_fm_get_data($sub_fields, 'custom_title');
			if ( ! empty($custom_title) ) {
				$the_title = $custom_title;
			}
?>

	<div class="featured-content-wrap">
		<div class="container">
			
			<div class="featured-content-heading">
				<h2>
					<?php echo esc_html( $the_title ); ?>
				</h2>
				</h2>
			</div>
						
			<div class="featured-content-main">
						
				<!--featured-content-col-1-->
				<div class="featured-content-col">
					<a href="<?php echo esc_url( $lesson_data[0]['lesson_link'] ); ?>" 
						title="<?php echo esc_attr( $lesson_data[0]['lesson_title'] ); ?>"
					>
						<div class="featured-content-col-image">
							<img 
								src="<?php echo esc_url( $lesson_data[0]['lesson_img'] ); ?>" 
								alt="<?php echo esc_attr( $lesson_data[0]['lesson_title'] ); ?>" 
								title="<?php echo esc_attr( $lesson_data[0]['lesson_title'] ); ?>"
							>
						</div>
							
						<div class="featured-content-col-desc roll-on-hover">
							<h4>
								<?php echo esc_html( $lesson_data[0]['lesson_title'] ); ?>
							</h4>
							<p>
								<?php echo esc_html( $lesson_data[0]['lesson_short'] ); ?>
							</p>
							<a 
								class="featured-content-col-link-arrow" 
								href="<?php echo esc_url( $lesson_data[0]['lesson_link'] ); ?>" 
								title="<?php echo esc_attr( $lesson_data[0]['lesson_title'] ); ?>"
							></a>
						
						</div>                       
							
					</a>    
				</div><!--../featured-content-col-1-->
								
				<!--featured-content-col-2-->
				<div class="featured-content-col">
					<a href="<?php echo esc_url( $lesson_data[1]['lesson_link'] ); ?>" 
						title="<?php echo esc_attr( $lesson_data[1]['lesson_title'] ); ?>"
					>             
						<div class="featured-content-col-image">
							<img 
								src="<?php echo esc_url( $lesson_data[1]['lesson_img'] ); ?>" 
								alt="<?php echo esc_attr( $lesson_data[1]['lesson_title'] ); ?>" 
								title="<?php echo esc_attr( $lesson_data[1]['lesson_title'] ); ?>"
							>
						</div>
												
						<div class="featured-content-col-desc roll-on-hover">
							<h4>
								<?php echo esc_html( $lesson_data[1]['lesson_title'] ); ?>
							</h4>
							<p>
								<?php echo esc_html( $lesson_data[1]['lesson_short'] ); ?>
							</p>
							<a 
								class="featured-content-col-link-arrow" 
								href="<?php echo esc_url( $lesson_data[1]['lesson_link'] ); ?>" 
								title="<?php echo esc_attr( $lesson_data[1]['lesson_title'] ); ?>"
							></a>
						</a>
					</div>
											
				</div><!--../featured-content-col-2-->
								
				<!--featured-content-col-3-->
				<div class="featured-content-col">
					<a href="<?php echo esc_url( $lesson_data[2]['lesson_link'] ); ?>" 
						title="<?php echo esc_attr( $lesson_data[2]['lesson_title'] ); ?>"
					>             
						<div class="featured-content-col-image">
							<img 
								src="<?php echo esc_url( $lesson_data[2]['lesson_img'] ); ?>" 
								alt="<?php echo esc_attr( $lesson_data[2]['lesson_title'] ); ?>" 
								title="<?php echo esc_attr( $lesson_data[2]['lesson_title'] ); ?>"
							>
						</div>
												
						<div class="featured-content-col-desc roll-on-hover">
								<h4>
									<?php echo esc_html( $lesson_data[2]['lesson_title'] ); ?>
								</h4>
								<p>
									<?php echo esc_html( $lesson_data[2]['lesson_short'] ); ?>
								</p>
								<a 
								class="featured-content-col-link-arrow" 
								href="<?php echo esc_url( $lesson_data[2]['lesson_link'] ); ?>" 
								title="<?php echo esc_attr( $lesson_data[2]['lesson_title'] ); ?>"
								></a>
						</div>
					</a>                   
				</div>
				<!--../featured-content-col-3-->
						
			</div><!--../featured-content-main-->
		</div>
	</div><!--../featured-content-wrap-->

<?php
		endif;//the_lessons
	endif;//toggle
endif;//sub_fields
