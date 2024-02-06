<?php
/**
 * Submodule: OVERVIEW
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$the_pid = get_the_ID();

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
	$sub_fields = $args['sub_fields'];
	$the_title  = fbsafety_fm_get_data($sub_fields, 'heading');

	$module_id          = intval( fbsafety_fm_get_data($args, 'module_id') );
	$module_title       = get_the_title( $module_id );
	$module_number      = intval( get_post_meta( $module_id, 'module_number', true ) );
	$module_num_display = ($module_number < 10) ? str_pad($module_number, 2, '0', STR_PAD_LEFT) : $module_number;

	$all_module_lessons  = get_post_meta( $module_id, 'lessons' );

	// this should always be 0 for the parent (module overview page)
	$this_part_order_num = intval( fbsafety_generate_lesson_order_number( $module_id, $the_pid ) );
?>

<div class="a--lesson">
	<p style="position:relative;">
		<a style="position:absolute; top:-100px;" id="<?php echo esc_attr( 'anchor-' . $module_number . '.' . $this_part_order_num ); ?>"></a>
	</p>
	<h3>
		<?php
			//echo esc_html( $module_number . '.' . $this_part_order_num . ' ' . $the_title );
			echo esc_html( $the_title );
		?>
	</h3>

	<?php
		echo wp_kses( fbsafety_fm_get_data( $sub_fields, 'body' ), allowed_html_tags() );
	?>

	<?php
		// prev & next links
		$prev_next_args = array(
			'lesson_data'  => $all_module_lessons, 
			'module_id'    => $module_id,
			'order_num'    => $this_part_order_num,
			'the_pid'      => $the_pid,
			'is_resources' => false
		);
		get_template_part( 'global-templates/submodules/parts/prev_next', null, $prev_next_args );
	?>

</div>

<?php
endif;//sub_fields
