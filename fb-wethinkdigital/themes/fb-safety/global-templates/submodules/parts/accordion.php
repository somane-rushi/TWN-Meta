<?php
/**
 * Submodule Part: ACCORDION
 * See inc/custom-shortcodes.php, function fbsafety_accordion()
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['title']) && isset($args['content']) ) :
	$the_title   = fbsafety_fm_get_data( $args, 'title' );
	$the_content = fbsafety_fm_get_data( $args, 'content' );
	$collapsed   = strtolower( fbsafety_fm_get_data( $args, 'collapsed' ) );
  	$xtra_classes  = ' collapsable collapsed';
  	$title_classes = ' closed';
  	if ('false' === $collapsed || 'no' === $collapsed ) {
  		$title_classes = '';
  		$xtra_classes  = ' collapsable';
  	}
  	$part_id       = 'acc' . wp_rand(9999,9999999999999);
?>

<div class="content-part cp-accordion">
	<div class="main-content">
			<a href="#" class="collapsable-title<?php echo esc_attr($title_classes); ?>" data-which="<?php echo esc_attr($part_id); ?>">
				<h4>
					<?php echo esc_html($the_title); ?>
				</h4>
			</a>
		<div class="inner<?php echo esc_attr($xtra_classes); ?>" id="<?php echo esc_attr($part_id); ?>">
			<?php 
				echo wp_kses( apply_filters('the_content', $the_content), allowed_html_tags() ); 
			?>
		</div>
	</div>
</div>

  

<?php
endif;//args
