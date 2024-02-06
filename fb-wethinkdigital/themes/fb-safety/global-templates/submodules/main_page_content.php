<?php
/**
 * Submodule: MAIN PAGE CONTENT
 * This section displays main page content
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $main_content_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $main_content_toggle) :
  	$main_text = fbsafety_fm_get_data( $sub_fields, 'main_text' );
?>

<div class="container small content-main">
	<div class="row">
		<div class="main-content">

			<?php 
				echo wp_kses( apply_filters('the_content', $main_text), allowed_html_tags() ); 
			?>

		</div>
	</div>
</div>

<?php
  endif;//toggle
endif;//sub_fields
