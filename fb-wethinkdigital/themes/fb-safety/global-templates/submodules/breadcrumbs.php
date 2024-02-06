<?php
/**
 * Submodule: BREADCRUMBS
 * This part can be used universally in different post types and parts
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $breadcrumbs_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $breadcrumbs_toggle) :

    // find module page
    $modules_pg_id  = null;
    $modules_pg_obj = wpcom_vip_get_page_by_path( 'modules' );
    if ($modules_pg_obj) {
      $modules_pg_id = $modules_pg_obj->ID;
    }
?>

<!-- breadcrumb -->
<div class="breadcrumb">
  <div class="container">
    <div class="row">
      <ul>

        <li><a href="<?php echo esc_url( home_url() ); ?>">Homepage</a></li>

      <?php 
        //standard pages
        if ( is_page() ) : 
      ?>
        <li id="crumb-current"><?php echo esc_html( get_the_title() ); ?></li>
      <?php 
        endif; 
      ?>

      <?php 
        // modules
        if ( is_singular('module') ) : 
          //module (child)
          if ($post->post_parent) :
            $module_id    = wp_get_post_parent_id( $post );
            $active_title = get_the_title(); 
      ?>
        <li><a href="<?php echo esc_url( get_permalink($modules_pg_id) ); ?>"><?php echo esc_html( get_the_title($modules_pg_id) ); ?></a></li>
        <li><a href="<?php echo esc_url( get_permalink($module_id) ); ?>"><?php echo esc_html( get_the_title($module_id) ); ?></a></li>
        <li class="lesson--active" id="crumb-active"><?php echo esc_html( $active_title ); ?></a></li>
      <?php
          //module (parent) 
          else :
            $active_title = fbsafety_determine_first_lesson( get_the_ID() );
      ?>
        <li><a href="<?php echo esc_url( get_permalink($modules_pg_id) ); ?>"><?php echo esc_html( get_the_title($modules_pg_id) ); ?></a></li>
        <li><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></li>
        <li class="lesson--active" id="crumb-active"><?php echo esc_html( $active_title ); ?></a></li>
      <?php 
          endif;
        endif; 
      ?>

      <?php 
        if ( is_singular('lesson') ) : 
          $active_title = get_the_title();
          $module_id    = get_post_meta( get_the_ID(), 'module_id', true );
      ?>
        <li><a href="<?php echo esc_url( get_permalink($modules_pg_id) ); ?>"><?php echo esc_html( get_the_title($modules_pg_id) ); ?></a></li>
        <li><a href="<?php echo esc_url( get_permalink($module_id) ); ?>"><?php echo esc_html( get_the_title($module_id) ); ?></a></li>
        <li class="lesson--active" id="crumb-active"><?php echo esc_html( $active_title ); ?></a></li>
      <?php 
        endif; 
      ?>

      </ul>
    </div>
  </div>
</div>
<!-- breadcrumb -->

<?php
  endif;//toggle
endif;//sub_fields
