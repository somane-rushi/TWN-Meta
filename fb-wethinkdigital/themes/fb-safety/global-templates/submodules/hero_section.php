<?php
/**
 * Submodule: HERO SECTION
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $hero_section_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $hero_section_toggle) :
  	$img_desktop_id = fbsafety_fm_get_data($sub_fields, 'image');
  	$img_alt_title  = get_the_title( intval($img_desktop_id) ) ?: 'Image';
  	$img_desktop    = wp_get_attachment_image_src( intval($img_desktop_id), 'full' )[0];
    if ( empty($img_desktop) ) {
      $img_desktop  = get_stylesheet_directory_uri() .'/img/hero-background-default.png';
    }
  	$img_mobile     = $img_desktop;
  	$img_mobile_id  = fbsafety_fm_get_data($sub_fields, 'image_mob');
  	if ( ! empty($img_mobile_id) ) {
  		$img_mobile   = wp_get_attachment_image_src( intval($img_mobile_id), 'full' )[0];
  	}
    $is_a_light_img = fbsafety_fm_get_data($sub_fields, 'lighter_toggle');
    $the_img_type   = 'normal';
    if ( '1' === $is_a_light_img ) {
      $the_img_type   = 'light';
    }
  	$hero_title     = fbsafety_fm_get_data($sub_fields, 'title');
  	$hero_subtitle  = fbsafety_fm_get_data($sub_fields, 'subtitle');
  	$hero_txt_color = fbsafety_fm_get_data($sub_fields, 'text_color');
?>

  <!--page-banner-->
	<div class="page-banner parallax hero-contained" style="background-image:url('<?php echo esc_url( $img_desktop ); ?>');" data-desktop="<?php echo esc_url( $img_desktop ); ?>" data-mobile="<?php echo esc_url( $img_mobile ); ?>" role="img" aria-label="<?php echo esc_attr( $img_alt_title ); ?>" data-imgtype="<?php echo esc_attr($the_img_type); ?>">
  	<div class="page-banner-inner">

      <div class="container <?php echo esc_attr( $hero_txt_color ); ?>">
      <?php 
      	if ( ! empty($hero_title) ) :
      ?>
        <h1>
        	<?php echo esc_html( $hero_title ); ?>
        </h1>
      <?php 
      	endif;
      	if ( ! empty($hero_subtitle) ) :
      ?>
        <p>
        	<?php echo esc_html( $hero_subtitle ); ?>
        </p>
      <?php 
      	endif;
      ?>
      </div>

<?php
  if ( is_singular( array('lesson','module') ) ) :

    $modules_pg_id  = null;
    $modules_pg_obj = wpcom_vip_get_page_by_path( 'modules' );
    if ($modules_pg_obj) {
      $modules_pg_id = $modules_pg_obj->ID;
    }

    //module (parent)
    $active_title = get_the_title();

    //module (child)
    if ($post->post_parent) {
      $module_id    = wp_get_post_parent_id( $post );
      $module_title = get_the_title( $module_id );
      $active_title = $module_title; 
    }

    //lesson
    if ( is_singular( 'lesson' ) ) {
      $module_id    = get_post_meta( get_the_ID(), 'module_id', true );
      $module_title = get_the_title( $module_id );
      $active_title = $module_title; 
    }
?>
      <div class="container mobile">
        <!--<p><?php //echo esc_html( strtoupper( get_the_title($modules_pg_id) ) ); ?></p>-->
        <!--<h1 class="lesson--active" id="h1-active"><?php //echo esc_html($active_title); ?></h1>-->
      </div>
<?php
  endif;
?>

    </div>
<?php
	if ($img_mobile !== $img_desktop) :
?>
  <script>which_hero_img('div.hero-contained');jQuery(window).resize(function(){which_hero_img('div.hero-contained');});</script>
<?php
	endif;
?>
  </div>
  <!--page-banner-->

<?php
  endif;//toggle
endif;//sub_fields
