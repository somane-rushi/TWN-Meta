<?php
/**
 * Submodule: TWO COLUMNS, TEXT & IMAGE 
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $two_col_text_img_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $two_col_text_img_toggle) :
  	$main_text = fbsafety_fm_get_data( $sub_fields, 'main_text' );
  	$img_id    = fbsafety_fm_get_data($sub_fields, 'image');
  	$img_alt   = get_the_title( intval($img_id) ) ?: 'Image';
  	$the_img   = wp_get_attachment_image_src( intval($img_id), 'full' )[0];
  	$image_pos = fbsafety_fm_get_data( $sub_fields, 'image_pos' );
  	if ( empty($image_pos) ) {
  		$image_pos = 'left';
  	}
    $btn_toggle = fbsafety_fm_get_data( $sub_fields, 'btn_toggle' );
    $btn_group  = fbsafety_fm_get_data( $sub_fields, 'btn_group' );
    $btn_text   = fbsafety_fm_get_data( $btn_group, 'btn_text' );
    $btn_link   = fbsafety_fm_get_data( $btn_group, 'btn_link' );
    $btn_target = fbsafety_fm_get_data( $btn_group, 'btn_target_blank' );
?>

	<!--image-with-content-wrap-->
	<div class="image-with-content-wrap <?php echo esc_attr( fbsafety_fm_get_data( $sub_fields, 'bg_color' ) ); ?>">
  	<div class="container">
    	<div class="image-with-content-main">

      <?php
      	if ('left' === $image_pos) :
      ?>
      	<div class="image-with-content-img">
        <?php
          if ("1" === $btn_toggle) :
        ?>
          <a 
            href="<?php echo esc_url($btn_link); ?>" 
            rel="noopener" 
            <?php echo esc_attr($btn_target); ?>
          >
        <?php
          endif;
        ?>
          <img src="<?php echo esc_url( $the_img ); ?>" alt="<?php echo esc_attr( $img_alt); ?>">
        <?php
          if ("1" === $btn_toggle) :
        ?>
          </a>
        <?php
          endif;
        ?>
        </div>
      <?php
      	endif;
      ?>

        <div class="image-with-content-desc">
        	<?php 
        		echo wp_kses( $main_text, allowed_html_tags() ); 
            $btn_group = fbsafety_fm_get_data( $sub_fields, 'btn_group' );
            $btn_args  = array(
              'btn_toggle' => $btn_toggle,
              'btn_text'   => $btn_text,
              'btn_link'   => $btn_link,
              'btn_target' => $btn_target
            );
            get_template_part( 'global-templates/submodules/parts/button', null, $btn_args );
          ?>  
        </div>

      <?php
      	if ('right' === $image_pos) :
      ?>
      	<div class="image-with-content-img">
        <?php
          if ("1" === $btn_toggle) :
        ?>
          <a 
            href="<?php echo esc_url($btn_link); ?>" 
            rel="noopener" 
            <?php echo esc_attr($btn_target); ?>
          >
        <?php
          endif;
        ?>
          <img src="<?php echo esc_url( $the_img ); ?>" alt="<?php echo esc_attr( $img_alt); ?>">
        <?php
          if ("1" === $btn_toggle) :
        ?>
          </a>
        <?php
          endif;
        ?>
        </div>
      <?php
      	endif;
      ?>

    	</div>
  	</div>
  </div>
	<!--image-with-content-wrap-->

<?php
  endif;//toggle
endif;//sub_fields
