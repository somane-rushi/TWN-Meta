<?php
/**
 * Submodule Part: MODULE NAV MOBILE
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['the_pid']) && isset($args['which_part']) ) :
	$which_part = fbsafety_fm_get_data($args, 'which_part');
	$the_pid    = fbsafety_fm_get_data($args, 'the_pid');

	if ('cpt-module-child' !== $which_part) :

		$available_resources  = fbsafety_get_resources_and_guides( $which_part, $the_pid, 'resources' );
		$available_guidelines = fbsafety_get_resources_and_guides( $which_part, $the_pid, 'guidelines' );

		if ( !empty($available_resources) || !empty($available_guidelines) ) :
?>

<div class="sticky-menu mobile">
	<span>Resources</span>
	<ul>
<?php
		if ( !empty($available_resources) ) :
?>
<li class="is-header-li"><a href="#">Available Resources</a></li>
<?php
			foreach ($available_resources as $file) :
				$file_id   = fbsafety_fm_get_data($file, 'file_id');
				$file_path = wp_get_attachment_url( intval($file_id) );
				$file_name = fbsafety_fm_get_data($file, 'file_name')
?>
		<li>
			<a href="<?php echo esc_url( $file_path ); ?>">
				<?php echo esc_html( $file_name ); ?>
			</a>
		</li>
<?php
			endforeach;
		endif;
?>
<?php
		if ( !empty($available_guidelines) ) :
?>
<li class="is-header-li"><a href="#">Available Guidelines</a></li>
<?php
			foreach ($available_guidelines as $file) :
				$file_id   = fbsafety_fm_get_data($file, 'file_id');
				$file_path = wp_get_attachment_url( intval($file_id) );
				$file_name = fbsafety_fm_get_data($file, 'file_name')
?>
		<li>
			<a href="<?php echo esc_url( $file_path ); ?>">
				<?php echo esc_html( $file_name ); ?>
			</a>
		</li>
<?php
			endforeach;
		endif;
?>
	</ul>
</div>

<?php
		endif;//available_resources
	endif;//which_part
endif;//args
