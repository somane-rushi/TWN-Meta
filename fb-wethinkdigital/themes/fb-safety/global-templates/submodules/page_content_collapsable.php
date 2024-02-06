<?php
/**
 * Submodule: MAIN PAGE CONTENT COLLAPSABLE
 * Main page content that can be collapsed via accordion
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $content_part_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $content_part_toggle) :
  	$xtra_classes   = '';
  	$title_classes  = '';
  	$is_collapsable = false;
  	$collapsable = fbsafety_fm_get_data($sub_fields, 'collapsable');
  	if ('1' === $collapsable) {
  		$is_collapsable = true;
  		$xtra_classes   = ' collapsable';
  	}
  	$is_collapsed = false;
  	$collapsed = fbsafety_fm_get_data($sub_fields, 'collapsed');
  	if ('1' === $collapsed) {
  		$is_collapsed  = true;
  		$title_classes = ' closed';
  		$xtra_classes .= ' collapsed';
  	}
  	$section_title = fbsafety_fm_get_data( $sub_fields, 'title' );
  	$main_text     = fbsafety_fm_get_data( $sub_fields, 'main_text' );
  	$part_id       = 'coll' . wp_rand(9999,9999999999999);
?>

<div class="container small content-part">
	<div class="row">
		<div class="main-content">
			<?php
				if (true === $is_collapsable) : 
			?>
				<a href="#" class="collapsable-title<?php echo esc_attr($title_classes); ?>" data-which="<?php echo esc_attr($part_id); ?>">
					<h3>
						<?php echo esc_html($section_title); ?>
					</h3>
				</a>
			<?php 
				endif;
			?>
			<div class="inner<?php echo esc_attr($xtra_classes); ?>" id="<?php echo esc_attr($part_id); ?>">
				<?php 
					echo wp_kses( apply_filters('the_content', $main_text), allowed_html_tags() ); 
				?>
			</div>
		</div>
	</div>
</div>

<?php
  endif;//toggle
endif;//sub_fields
