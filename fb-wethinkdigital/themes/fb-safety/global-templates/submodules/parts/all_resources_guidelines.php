<?php
/**
 * Submodule Part: ALL RESOURCES AND GUIDELINES FOR ONE MODULE
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['which_part']) ) :
	$which_part = fbsafety_fm_get_data($args, 'which_part');
	$the_pid    = fbsafety_fm_get_data($args, 'the_pid');
	$module_id  = wp_get_post_parent_id( intval($the_pid) );

	$available_resources  = fbsafety_get_resources_and_guides( $which_part, $the_pid, 'resources' );
	$available_guidelines = fbsafety_get_resources_and_guides( $which_part, $the_pid, 'guidelines' );

	if ( !empty($available_resources) || !empty($available_guidelines) ) :
?>

<div class="guidelines-wrap">

<?php
		if ( ! empty($available_resources) ) :
?>
	<!--<div class="guideline-trigger no-actions">Resources</div>-->

	<div class="guideline-content acc_container panel show">

<?php
			//k=post_id; v=meta
			foreach ($available_resources as $k => $v) :
				$lesson_num = intval( fbsafety_generate_lesson_order_number( intval($module_id), intval($k) ) );
?>
		<div class="lesson-trigger acc_trigger_two accordion_2">Lesson <?php echo esc_html($lesson_num); ?>: <?php echo esc_html( get_the_title( intval($k) ) ); ?></div>
		<div class="lesson-content acc_container_two panel_2">

			<div class="resources-body-head">
				<a href="#" class="downloadall" data-which="aresource<?php echo esc_attr($k); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/download-icon.svg' ); ?>" alt="Download all"> Download all</a>
<?php
				//create printall link from $k (post_id)
				$printall_doc_id = get_post_meta( intval($k), 'all_resources', true );
				if ( ! empty($printall_doc_id) ) :
					$printall_doc  = esc_url( wp_get_attachment_url( intval($printall_doc_id) ) );
?>
				<a href="#" class="printall" data-which="<?php echo esc_attr($printall_doc); ?>" data-num="<?php echo esc_attr($printall_doc_id); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/print-icon.svg' ); ?>" alt="Print all"> Print All</a>
<?php
				else :
?>
				<a href="#" class="printall disabled" data-which="" disabled>&nbsp;</a>
<?php
				endif;//printall link
?>
			</div>

			<div class="resources-body-content">
<?php
				foreach ($v as $file) :
					$file_id       = fbsafety_fm_get_data($file, 'file_id');
					$file_path     = esc_url( wp_get_attachment_url( intval($file_id) ) );
					$file_name     = fbsafety_fm_get_data($file, 'file_name');
					$file_desc     = fbsafety_fm_get_data($file, 'file_desc');
					$resource_type = fbsafety_fm_get_data($file, 'rsrc_type');
					if ( empty($resource_type ) ) {
						$resource_type = 'supplementary_resource';
					}
					$type_display  = fbsafety_resource_type_display($resource_type);
?>
				<!--desktop-->
				<div class="desktop flex resources-body-content-box aresource-div-<?php echo esc_attr($k); ?> <?php echo esc_attr($resource_type); ?>" data-which="<?php echo esc_url($file_path); ?>" data-num="<?php echo esc_attr($file_id); ?>">
					<div class="inner-left">
						<h5><?php echo esc_html( $type_display ); ?></h5>
						<h4><?php echo esc_html( $file_name ); ?></h4>
						<!--<p></p>-->
						<div class="actions">
							<a class="aresource<?php echo esc_attr($k); ?>" id="aresource<?php echo esc_attr($k); ?>-download-<?php echo esc_attr($file_id); ?>" href="<?php echo esc_url($file_path); ?>" title="Download document" download>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/img/download-icon.svg' ); ?>" alt="Download document" title="Download document">
							</a>
							<a href="<?php echo esc_url($file_path); ?>"  class="cta-no-arrow print--now" target="_blank" title="Print document">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/img/print-icon.svg' ); ?>" alt="Print document" title="Print document">
							</a>
							<a href="<?php echo esc_url($file_path); ?>"  class="cta-no-arrow" target="_blank" title="View document">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/img/Right-Gray.svg' ); ?>" alt="View document" title="View document">
							</a>
						</div>
					</div>
					<div class="inner-right">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/img/icon_' . $resource_type . '.svg' ); ?>" alt="<?php echo esc_attr($type_display); ?>">
					</div>
				</div>
				<!--..desktop-->

				<!--mobile-->
				<div class="mobile resources-body-content-box aresource-div-<?php echo esc_attr($k); ?> <?php echo esc_attr($resource_type); ?>" data-which="<?php echo esc_url($file_path); ?>" data-num="<?php echo esc_attr($file_id); ?>">
					<h5><?php echo esc_html( $type_display ); ?></h5>
					<h4><?php echo esc_html( $file_name ); ?></h4>
					<!--<p></p>-->
					<a href="<?php echo esc_url($file_path); ?>"  class="cta-arrow" target="_blank">View</a>
					<a class="no--show mobile-aresource<?php echo esc_attr($k); ?>" id="aresource<?php echo esc_attr($k); ?>-download-<?php echo esc_attr($file_id); ?>" href="<?php echo esc_url($file_path); ?>" download>download</a>
				</div>
				<!--..mobile-->
<?php
				endforeach;//file
?>
	    </div><!--..resources-body-content-->
	  </div><!--..acc_container_two panel_2-->
<?php
			endforeach;//k=>v
?>
	</div><!--..acc_container.panel-->
<?php
		else :
?>
				<p style="padding-bottom:50px;">No resources available for this module.</p>
<?php
		endif;//available_resources
?>


<?php
		if ( ! empty($available_guidelines) ) :
?>
	<!--<div class="guideline-trigger no-actions">Guidelines</div>-->

	<div class="guideline-content acc_container panel">
<?php
			//k=post_id; v=meta
			foreach ($available_guidelines as $k => $v) :
				$lesson_num = intval( fbsafety_generate_lesson_order_number( intval($module_id), intval($k) ) );
?>
		<div class="lesson-trigger acc_trigger_two accordion_2">Lesson <?php echo esc_html($lesson_num); ?>: <?php echo esc_html( get_the_title( intval($k) ) ); ?></div>
		<div class="lesson-content acc_container_two panel_2">
<?php
				foreach ($v as $file) :
					$file_id       = fbsafety_fm_get_data($file, 'file_id');
					$file_path     = esc_url( wp_get_attachment_url( intval($file_id) ) );
					$file_name     = fbsafety_fm_get_data($file, 'file_name');
					$file_desc     = fbsafety_fm_get_data($file, 'file_desc');
					$resource_type = fbsafety_fm_get_data($file, 'rsrc_type');
					if ( empty($resource_type ) ) {
						$resource_type = 'supplementary_resource';
					}
					$type_display  = fbsafety_resource_type_display($resource_type);
?>
			<div class="mobile guidelines-box <?php echo esc_attr($resource_type); ?>">
					<h5><?php echo esc_html( $type_display ); ?></h5>
					<h4><?php echo esc_html( $file_name ); ?></h4>
				<!--<p></p>-->
				<a href="<?php echo esc_url($file_path); ?>"  class="cta-arrow" download>Download the guide</a>
			</div>
<?php
				endforeach;//file
?>
	  </div><!--..acc_container_two panel_2-->
<?php
			endforeach;//k=>v
?>
	</div><!--..acc_container.panel-->
<?php
		endif;//available_guidelines
?>

</div><!--..guidelines-wrap-->

<?php
	endif;

endif;//args check
