<?php
/**
 * Submodule Part: BUTTON
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['btn_toggle']) && isset($args['btn_text']) ) :
	
	$btn_fields = $args;

	if ("1" === fbsafety_fm_get_data( $btn_fields, 'btn_toggle' ) ) :

		$btn_text   = fbsafety_fm_get_data( $btn_fields, 'btn_text' );
		$btn_link   = fbsafety_fm_get_data( $btn_fields, 'btn_link' );
		
		$btn_target = '';
		if ("1" === fbsafety_fm_get_data( $btn_fields, 'btn_target') ) {
			$btn_target = ' target="_blank"';
		}
?>

  <a 
  	href="<?php echo esc_url($btn_link); ?>" 
  	class="cta-arrow" 
  	rel="noopener"
  	<?php echo esc_attr($btn_target); ?>
  >
  	<?php echo esc_html($btn_text); ?>
  </a> 

<?php

	endif;//btn_toggle

endif;//btn_fields
