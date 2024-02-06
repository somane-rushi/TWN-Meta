<?php
/**
 * Submodule: HERO SECTION (BASIC, NO IMAGE)
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $hero_basic_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $hero_basic_toggle) :
  	$hero_title    = fbsafety_fm_get_data($sub_fields, 'title');
  	$hero_bg_color = fbsafety_fm_get_data($sub_fields, 'bg_color');
    if ( ! empty($hero_bg_color) ) :
      $hero_bg_color_class = $hero_bg_color . '-bg';
?>

<section class="inner-hero <?php echo esc_attr( $hero_bg_color_class ); ?>">
  <h1>
    <?php echo esc_html( $hero_title ); ?>
  </h1>
</section>

<?php
    endif;//bg_color
  endif;//toggle
endif;//sub_fields
