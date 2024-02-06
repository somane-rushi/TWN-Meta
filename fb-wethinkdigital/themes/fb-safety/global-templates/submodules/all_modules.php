<?php
/**
 * Submodule: ALL MODULES
 * Built initially for the Modules Landing Page
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $all_modules_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $all_modules_toggle) :
    $the_title       = fbsafety_fm_get_data($sub_fields, 'title');
    $the_description = fbsafety_fm_get_data($sub_fields, 'description');
?>

<div class="moduler">
  <div class="container small">
    <div class="row">

      <center>
        <h2>
          <?php echo esc_html( $the_title ); ?> 
        </h2>
      </center>
      <p>
        <?php echo esc_html( $the_description ); ?>
      </p>
    <?php
      $modules_array = array();
      $modules_query = new WP_Query( 
        array( 
          'post_type'           => 'module', 
          'post_status'         => 'publish', 
          'post_parent'         => 0,
          'fields'              => 'ids',
          'ignore_sticky_posts' => true,
          'no_found_rows'       => true,
          'posts_per_page'      => 50,
          'meta_key'            => 'module_number',
          'orderby'             => 'meta_value_num',
          'order'               => 'ASC'
        ) 
      );
      if ( $modules_query->have_posts() ) :
    ?>

      <div class="moduler-row">

    <?php    
        while ( $modules_query->have_posts() ) :
          $modules_query->the_post(); 
    ?>

        <div class="moduler-column">
          <h4>
            <?php echo esc_html( get_the_title() ); ?>
          </h4>
          <p>
            <?php echo esc_html( get_the_excerpt() ); ?>
          </p>
          <a href="<?php echo esc_url( get_permalink() ); ?>">
            Learn More
          </a>
        </div>

    <?php
        endwhile;
    ?>

      </div><!--..moduler-row-->

    <?php
      endif;
      wp_reset_postdata();
    ?>
    </div>
  </div>
</div>

<?php
  endif;//toggle
endif;//sub_fields
