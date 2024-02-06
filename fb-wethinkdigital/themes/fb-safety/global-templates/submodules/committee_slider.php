<?php
/**
 * Submodule: COMMITTEE SLIDER
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $committee_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $committee_toggle) :
    $classes = '';
    $bg_color = fbsafety_fm_get_data($sub_fields, 'bg_color');
    if ( ! empty( $bg_color ) ) {
      $classes = ' ' . $bg_color . '-bg';
    }
    $slider = fbsafety_fm_get_data($sub_fields, 'slider');
    shuffle($slider);
?>

<section class="committee<?php echo esc_attr( $classes ); ?>" id="steering-committee">
  <div class="container">
    <div class="row">
      <div class="committee-row">

        <div class="committee-top">
        <?php
          $the_title       = fbsafety_fm_get_data($sub_fields, 'title');
          $the_description = fbsafety_fm_get_data($sub_fields, 'description');
        ?>
              <h3>
                <?php echo esc_html( $the_title ); ?>
              </h3>
              <p>
                <?php echo esc_html( $the_description ); ?>
              </p>

              <div class="mobile-bio-links mobile">
        <?php
          if ( ! empty($slider) ) :
            foreach($slider as $slide) :
              $sld             = fbsafety_fm_get_data($slide, 'a_person');
              $the_name        = fbsafety_fm_get_data($sld, 'name');
              $the_key         = str_replace(' ', '', $the_name);
              if ( ! empty($the_name) ) :
        ?>
            <div class="a--member">
              <span class="name">
                <?php echo esc_html( $the_name); ?>
              </span>
              <a href="#<?php echo esc_attr( sanitize_key($the_key) ); ?>" class="a-mobile-bio-link" data-which="<?php echo esc_attr( sanitize_key($the_key) ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/img/right-green-dark.svg' ); ?>" class="bio-arrow" alt="View Bio" />
                <span>View Bio</span>
              </a>
            </div>
        <?php
              endif;
            endforeach;
          endif;
        ?> 
              </div>

        </div>

        <div class="committee-bot" id="the-committee-group">

        <?php
          if ( ! empty($slider) ) :
            foreach($slider as $slide) :
              $sld             = fbsafety_fm_get_data($slide, 'a_person');
              $the_name        = fbsafety_fm_get_data($sld, 'name');
              $the_key         = str_replace(' ', '', $the_name);
              $the_title       = fbsafety_fm_get_data($sld, 'title');
              $the_description = fbsafety_fm_get_data($sld, 'description');
              $the_image_id    = fbsafety_fm_get_data($sld, 'image');
              $the_image       = get_template_directory_uri() . '/img/placeholder.png';
              if ( ! empty($the_image_id) ) {
                $the_image = wp_get_attachment_image_src( $the_image_id, 'full' )[0];
              }
              if ( ! empty($the_name) ) :
        ?>
        <div class="square">
          <div class="content" style="background-image:url('<?php echo esc_url( $the_image); ?>');">
            <a href="#" class="open-a-member" data-which="<?php echo esc_attr( sanitize_key($the_key) ); ?>">
              <div class="colorbox"></div>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/img/right-CAD1D8.png' ); ?>" class="cmt-arrow" alt="View profile" />
              <span class="name"><?php echo esc_html( $the_name); ?></span>
            </a>
          </div>
        </div>

        <?php
              endif;
            endforeach;
          endif;
        ?>

        </div>


      </div>
    </div>
  </div>

      <span class="profile-modals">
        <?php
          if ( ! empty($slider) ) :
            foreach($slider as $slide) :
              $sld             = fbsafety_fm_get_data($slide, 'a_person');
              $the_name        = fbsafety_fm_get_data($sld, 'name');
              $the_key         = str_replace(' ', '', $the_name);
              $the_title       = fbsafety_fm_get_data($sld, 'title');
              $the_description = fbsafety_fm_get_data($sld, 'description');
              $the_image_id    = fbsafety_fm_get_data($sld, 'image');
              $the_image       = get_template_directory_uri() . '/img/placeholder.png';
              if ( ! empty($the_image_id) ) {
                $the_image = wp_get_attachment_image_src( $the_image_id, 'thumbnail' )[0];
              }
              if ( ! empty($the_name) ) :
        ?>
          <div id="<?php echo esc_attr( sanitize_key($the_key) ); ?>" class="full-profile">
            <div class="inner">
              <a href="#" class="profile-close">
                <img class="modal-close-btn" src="<?php echo esc_url( get_template_directory_uri() . '/img/modal-close-btn.png' ); ?>" />
              </a>
              <div class="profile-content">
                <img src="<?php echo esc_url( $the_image); ?>" class="profile-img" alt="<?php echo esc_attr($the_name); ?>" />
                <div class="description">
                  <span class="pname"><?php echo esc_html( $the_name); ?></span>
                  <span class="ptitle"><?php echo esc_html( $the_title); ?></span>
                  <?php echo wp_kses( $the_description, allowed_html_tags() ); ?>
                </div>
              </div>
            </div>
          </div>
        <?php
              endif;
            endforeach;
          endif;
        ?>  
      </span>

</section>

<?php
  endif;//toggle
endif;//sub_fields
