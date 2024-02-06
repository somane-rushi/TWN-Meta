<?php
/**
 * Submodule: TWO COLUMNS, ALL TEXT
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $two_col_text_all_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $two_col_text_all_toggle) :
  	$main_text      = fbsafety_fm_get_data( $sub_fields, 'main_text' );
  	$large_text     = fbsafety_fm_get_data( $sub_fields, 'large_text' );
  	$large_text_pos = fbsafety_fm_get_data( $sub_fields, 'large_text_pos' );
  	if ( empty($large_text_pos) ) {
  		$large_text_pos = 'left';
  	}
    $bg_color_class = '';
    $bg_color       = fbsafety_fm_get_data( $sub_fields, 'bg_color' );
    if ( ! empty($bg_color) ) {
      $bg_color_class = $bg_color . '-bg';
    }
?>

	<div class="two-column-content-wrap <?php echo esc_attr( $bg_color_class ); ?>">
		<div class="container">
	  	<div class="two-column-content-main">
      
      <?php
      	if ('left' === $large_text_pos) :
      ?>
      	<div class="two-column-desc">
        	<h2>
        		<?php echo esc_html( $large_text ); ?>
        	</h2>
        </div>
      <?php
      	endif;
      ?>

        <div class="two-column-desc">
          <?php 
            echo wp_kses( $main_text, allowed_html_tags() ); 
            $btn_group = fbsafety_fm_get_data( $sub_fields, 'btn_group' );
            $btn_args  = array(
              'btn_toggle' => fbsafety_fm_get_data( $sub_fields, 'btn_toggle' ),
              'btn_text'   => fbsafety_fm_get_data( $btn_group, 'btn_text' ),
              'btn_link'   => fbsafety_fm_get_data( $btn_group, 'btn_link' ),
              'btn_target' => fbsafety_fm_get_data( $btn_group, 'btn_target_blank' )
            );
            get_template_part( 'global-templates/submodules/parts/button', null, $btn_args );
          ?>
        </div>
      
      <?php
      	if ('right' === $large_text_pos) :
      ?>
      	<div class="two-column-desc">
        	<h2>
        		<?php echo esc_html( $large_text ); ?>
        	</h2>
        </div>
      <?php
      	endif;
      ?>

	  	</div>
		</div>
	</div><!--../two-column-content-wrap-->

<?php
  endif;//toggle
endif;//sub_fields
