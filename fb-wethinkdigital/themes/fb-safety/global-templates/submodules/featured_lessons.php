<?php
/**
 * Submodule: FEATURED LESSONS (SLIDER)
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $global_fields = get_option('global_fields');
  $sub_fields    = $args['sub_fields'];
  $featured_lessons_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $featured_lessons_toggle) :
    $custom_selections_toggle = fbsafety_fm_get_data($sub_fields, 'custom_toggle');
    if ('1' === $custom_selections_toggle) {
      $the_lessons = fbsafety_fm_get_data($sub_fields, 'the_lessons');
    } else {
      $the_lessons = fbsafety_fm_get_data($global_fields, 'the_lessons');
    }
    if ( ! empty($the_lessons) ) :

      $module_ids_arr = array();
      foreach ($the_lessons as $lsn) {
        $lsn_exp    = explode('__', $lsn);
        $pid        = intval( $lsn_exp[1] );
        $pid_status = get_post_status( $pid );
        // dont include lessons currently in draft
        if ( 'publish' === $pid_status) {
          $module_id  = get_post_meta($pid, 'module_id', true);
          $module_num = intval( get_post_meta( $module_id, 'module_number', true ) );
          if ( ! in_array($module_num, $module_ids_arr, true ) ){
            $module_ids_arr[$module_num] = array(
              $module_id, 
              get_the_title($module_id)
            ); 
          }
        }
      }
      // order by assigned module number
      ksort($module_ids_arr);
      
      $the_title    = 'Featured';
      $custom_title = fbsafety_fm_get_data($sub_fields, 'custom_title');
      if ( ! empty($custom_title) ) {
        $the_title = $custom_title;
      } else {
        $custom_title = fbsafety_fm_get_data($global_fields, 'fl_custom_title');
        if ( ! empty($custom_title) ) {
          $the_title = $custom_title;
        }
      }
?>

<!--featured-carousel-->
<div class="featured-carousel-wrap">
  <div class="container">
    
    <div class="featured-carousel-head">
      <h2>
        <?php echo esc_html( $the_title ); ?>
      </h2>
    </div>
        
    <div class="featured-carousel-main">
        	
    	<div class="featured-carousel-nav">
        <ul class="featured-carousel-nav-init">
          <li class="current featured-lessons-nav" data-which="all"><a href="">All</a></li>
        <?php 
          // k = module_number
          // v = 0:module_id ; 1:module title
          foreach ($module_ids_arr as $k => $v) :
        ?>
          <li>
            <a 
              href="#" 
              class="featured-lessons-nav" 
              data-which="<?php echo esc_attr( sanitize_key($v[1]) ); ?>"
            >
              <?php echo esc_html( $v[1] ); ?>
            </a>
          </li>
        <?php 
          endforeach;
        ?>
        </ul>
        <select id="featured-carousel-nav-select">
          <option value="all">All</option>
        <?php 
          // k = module_number
          // v = 0:module_id ; 1:module title
          $i = 0;
          foreach ($module_ids_arr as $k => $v) :
            $i++;
        ?>
          <option value="<?php echo esc_attr( sanitize_key($v[1]) ); ?>" data-index="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $v[1] ); ?></option>
        <?php 
          endforeach;
        ?>
        </select>
      </div><!--../.featured-carousel-nav-->
            
      <div class="featured-carousel-content"> 	

        <div class="featured-carousel-panes active" data-which="all">
          <div class="owl-carousel featured-carousel-init custom-carousel-style">
        <?php
          fbsafety_display_featured_lessons( $the_lessons, 'all' );
        ?>
          </div>
        </div><!--../.featured-carousel-panes (active)-->

        <?php 
          // k = module_number
          // v = 0:module_id ; 1:module title
          foreach ($module_ids_arr as $k => $v) :
            $which = sanitize_key( $v[1] );
        ?>
        <div class="featured-carousel-panes" data-which="<?php echo esc_attr($which); ?>">
          <div class="owl-carousel featured-carousel-init custom-carousel-style">
        <?php
          fbsafety_display_featured_lessons( $the_lessons, $v[0] );
        ?>
          </div>
        </div><!--../.featured-carousel-panes (<?php echo esc_html($which); ?>)-->
        <?php 
          endforeach;
        ?>

      </div><!--../.featured-carousel-content-->
            
    </div><!--../.featured-carousel-main--> 
  </div>
</div><!--../.featured-carousel-wrap-->

<?php
    endif;//the_lessons
  endif;//toggle
endif;//sub_fields
