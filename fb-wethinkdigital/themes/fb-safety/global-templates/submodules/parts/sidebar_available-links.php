<?php
/**
 * Submodule Part: SIDEBAR, AVAILABLE LINKS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['which_part']) ) :
	$which_part = fbsafety_fm_get_data($args, 'which_part');
	$the_pid    = fbsafety_fm_get_data($args, 'the_pid');

	$available_resources  = fbsafety_get_resources_and_guides( $which_part, $the_pid, 'resources' );
	$available_guidelines = fbsafety_get_resources_and_guides( $which_part, $the_pid, 'guidelines' );

	/**** ALL BUT RESOURCES PAGES ****/
	if ('cpt-module-child' !== $which_part) :
?>

<div class="available-links desktop">

<?php
		if ( ! empty($available_resources) ) :
			$k = get_the_ID();
?>
	<div class="available-trigger acc_trigger accordion active">Available Lesson Resources</div>
	<div class="available-content acc_container panel show" id="the-available-resources">
		<div class="available-content-head">
			<input type="button" class="selectall" data-which="aresource-<?php echo esc_attr($k); ?>" value="Select All" />
			<input type="button" class="deselectall" data-which="aresource-<?php echo esc_attr($k); ?>" value="Deselect All" />
		</div>
		<div class="available-body-content" id="aresource-<?php echo esc_attr($k); ?>">

<?php
			foreach ($available_resources as $file) :
				$file_id   = fbsafety_fm_get_data($file, 'file_id');
				$file_path = wp_get_attachment_url( intval($file_id) );
				$file_name     = fbsafety_fm_get_data($file, 'file_name');
				$file_desc     = fbsafety_fm_get_data($file, 'file_desc');
				$resource_type = fbsafety_fm_get_data($file, 'rsrc_type');
				if ( empty($resource_type ) ) {
					$resource_type = 'supplementary_resource';
				}
				$type_display  = fbsafety_resource_type_display($resource_type);
?>
			<div class="input-col">
        <input class="aresource-<?php echo esc_attr($k); ?>" type="checkbox" value="<?php echo esc_url($file_path); ?>" data-num="<?php echo esc_attr($file_id); ?>" data-rtype="<?php echo esc_attr($resource_type); ?>" name="<?php echo esc_attr( sanitize_key( $file_name ) ); ?>">
        <label>
        	<span class="resource-label"><?php echo esc_html( $type_display ); ?></span>
        	<?php echo esc_html( $file_name ); ?>
        	<!--<span>PDF</span>-->
        	<!--<span>View <a href="#">local resources</a> for more details</span>-->
    		</label>
    		<a class="no--show" id="aresource-<?php echo esc_attr($k); ?>-download-<?php echo esc_attr($file_id); ?>" href="<?php echo esc_url($file_path); ?>" download>download</a>
    	</div>
<?php
			endforeach;
?>

		</div>

	  <div class="available-content-bottom">
	    <a href="#" id="download--resources" class="download--resources-guidelines" data-which="aresource-<?php echo esc_attr($k); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/download-icon-small.jpg' ); ?>" alt="Download Selected">Download Selected</a>
<?php
				//create printall link from $k (post_id)
				$printall_doc_id = get_post_meta( intval($k), 'all_resources', true );
				if ( ! empty($printall_doc_id) ) :
					$printall_doc  = esc_url( wp_get_attachment_url( intval($printall_doc_id) ) );
?>
		    <a href="#" id="print--resources" class="print--resources-guidelines" data-which="<?php echo esc_attr($printall_doc); ?>" data-num="<?php echo esc_attr($printall_doc_id); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/print-icon-small.jpg' ); ?>" alt="Print Selected">Print All</a>
<?php
				endif;
?>
	  </div>

	</div>

<?php
		endif;//available_resources

		if ( ! empty($available_guidelines) ) :
			$k = intval(1);
?>
	<div class="available-trigger acc_trigger accordion">Available Lesson Guidelines</div>
	<div class="available-content acc_container panel">
		<div class="available-content-head">
			<input type="button" class="selectall" data-which="aguideline-<?php echo esc_attr($k); ?>" value="Select All" />
			<input type="button" class="deselectall" data-which="aguideline-<?php echo esc_attr($k); ?>" value="Deselect All" />
		</div>
		<div class="available-body-content" id="aguideline-<?php echo esc_attr($k); ?>">

<?php
			foreach ($available_guidelines as $file) :
				$file_id   = fbsafety_fm_get_data($file, 'file_id');
				$file_path = wp_get_attachment_url( intval($file_id) );
				$file_name     = fbsafety_fm_get_data($file, 'file_name');
				$file_desc     = fbsafety_fm_get_data($file, 'file_desc');
				$resource_type = fbsafety_fm_get_data($file, 'rsrc_type');
				if ( empty($resource_type ) ) {
					$resource_type = 'supplementary_resource';
				}
				$type_display  = fbsafety_resource_type_display($resource_type);
?>
			<div class="input-col">
        <input class="aguideline-<?php echo esc_attr($k); ?>" type="checkbox" value="<?php echo esc_url($file_path); ?>" data-num="<?php echo esc_attr($file_id); ?>" data-rtype="<?php echo esc_attr($resource_type); ?>" name="<?php echo esc_attr( sanitize_key( $file_name ) ); ?>">
        <label>
        	<?php echo esc_html( $file_name ); ?>
        	<!--<span>PDF</span>-->
        	<!--<span>View <a href="#">local resources</a> for more details</span>-->
    		</label>
    		<a class="no--show" id="aguideline-<?php echo esc_attr($k); ?>-download-<?php echo esc_attr($file_id); ?>" href="<?php echo esc_url($file_path); ?>" download>download</a>
    	</div>
<?php
			endforeach;
?>

		</div>

	  <div class="available-content-bottom">
	    <a href="#" id="download--guidelines" class="download--resources-guidelines" data-which="aguideline-<?php echo esc_attr($k); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/download-icon-small.jpg' ); ?>" alt="Download Selected">Download Selected</a>
<?php
				//create printall link from $k (post_id)
				$printall_doc_id = get_post_meta( intval($k), 'all_guidelines', true );
				if ( ! empty($printall_doc_id) ) :
					$printall_doc  = esc_url( wp_get_attachment_url( intval($printall_doc_id) ) );
?>
		    <a href="#" id="print--guidelines" class="print--resources-guidelines" data-which="<?php echo esc_attr($printall_doc); ?>" data-num="<?php echo esc_attr($printall_doc_id); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/print-icon-small.jpg' ); ?>" alt="Print Selected">Print Selected</a>
<?php
				endif;
?>
	  </div>

	</div>

<?php
		endif;//available_guidelines
?>

</div><!-- ../available links -->

<?php

	endif;

endif;//args check
