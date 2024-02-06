<?php
/**
 * Custom FUNCTIONS for CPT MODULE
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Update post_content on post save for CPT => module (parent only).
 *
 * @param array $data
 * @param array $postarr
 *
 * @return array
 */
add_filter( 'wp_insert_post_data', 'fbsafety_update_module_post_content', 11, 2 ); 
function fbsafety_update_module_post_content( $data, $postarr ) {
  if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
    return $data;
  }
  $continue = false;
  //module parents
  if ( isset($postarr['post_type']) && 'module' === $postarr['post_type'] && isset($postarr['post_parent']) && 0 === $postarr['post_parent'] ) {
    $continue = true;
  }
  //standard pages
  if ( isset($postarr['post_type']) && 'page' === $postarr['post_type'] ) {
    $continue = true;
  }
  if (true === $continue) {
    $the_nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : null;
    $post_id   = $postarr['ID'];
    if ( wp_verify_nonce($the_nonce, 'update-post_' . $post_id) || current_user_can('manage_options') ) {

      // for standard pages
      if ( isset($postarr['pagefields']) ) {
        $subfields_to_aggregate = array(
          'description',
          'large_text',
          'main_text',
          'main_text_1',
          'main_text_2',
          'main_text_3',
          'partner_name',
          'partner_description',
          'subtitle',
          'title',
          'question',
          'answer',
          'term',
          'definition'
        );
        $all_body   = '';
        $pagefields = $postarr['pagefields'];
        foreach ($pagefields as $pf) {
          foreach ($pf as $item) {

            /* check for first level subfields */
            foreach ($subfields_to_aggregate as $subfield) {
              if (isset($item[ $subfield ])) {
                $all_body .= sanitize_text_field( wp_strip_all_tags( $item[ $subfield ]) ) . ' ';
              }
            }

            /* check for nested subfields */
            $subitems_to_check_for = array(
              'content',
              'partners',
              'slider',
            );
            foreach ($subitems_to_check_for as $subitem_name) {
              if ( isset($item[$subitem_name]) ) {
                foreach ($item[$subitem_name] as $subitem) {
                  foreach ($subitem as $key => $value) {
                    foreach ($subfields_to_aggregate as $subfield) {
                      if (isset($value[ $subfield ])) {
                        $all_body .= sanitize_text_field( wp_strip_all_tags( $value[ $subfield ]) ) . ' ';
                      }
                    }
                  }
                }
              }
            }


          }
        }
        $data['post_content'] = sanitize_text_field( $all_body );
      }

      // for cpt module (parent only)
      if ( isset($postarr['lessons']) ) {
        $all_body = '';
        $lessons  = $postarr['lessons'];
        foreach ($lessons as $lsn) {
          foreach ($lsn as $l) {
            if (isset($l['body'])) {
              $all_body .= sanitize_text_field( wp_strip_all_tags( $l['body']) ) . ' ';
            }
          }
        }
        $data['post_content'] = sanitize_text_field( $all_body );
      }

    }
  }
  return $data;
  //wp_die( print_r($data) );
}


/**
 * Get all post_meta with post_id as $k and meta as $v
 *
 * @param array $data Array of post IDs
 * Data array originates at function get_all_lessons in inc/custom-fm-build.php
 *
 * @return array
 */
function fbsafety_get_all_module_meta( $data=array() ) {
  $response = array();
  if ( ! empty($data) ) {
    foreach($data as $d) {
      $post_id            = explode('__', $d)[0];
      $response[$post_id] = get_post_meta($post_id, 'lessons');
    }
  }
  return $response;
}


/**
 * Produce an array with lesson name as $k and post_id as $v
 *
 * @param array $data Array of post IDs
 * Data array originates at function get_all_lessons in inc/custom-fm-build.php
 *
 * @return array
 */
function fbsafety_get_the_lesson_names( $data=array() ) {
  $response = array();
  if ( ! empty($data) ) {
    foreach($data as $d) {
      $post_id         = explode('__', $d)[0];
      $uqid            = explode('__', $d)[1];
      $response[$uqid] = $post_id;
    }
  }
  return $response;
}


/**
 * Produce an array with all lesson ids for one module
 *
 * @param integer $post_id 
 * Data array originates at function get_all_lessons in inc/custom-fm-build.php
 *
 * @return array
 */
function get_all_lesson_ids($post_id) {
  $response = array();
  $lesson_data = get_post_meta( $post_id, 'lessons' );
  if ( ! empty($lesson_data) ) {
    foreach ($lesson_data as $data) {
      foreach ($data as $d){
        if ( isset($d['which_subgroup']) && ('lesson' === $d['which_subgroup']) ) {
          if ( isset($d['lesson']['lesson_id']) ) {
            $response[] = intval( $d['lesson']['lesson_id'] );
          }
        }
      }
    }
  }
  return $response;
}


/**
 * Display front end for Featured Lessons Section
 * Used in: global-templates/submodules/featured_lessons.php
 *
 * @param array $data Array of post IDs
 * Data array originates at function get_all_lessons in inc/custom-fm-build.php
 * @param string $which Either 'all' or a specified post_id
 *
 * @return array
 */
function fbsafety_display_featured_lessons( $lessons=array(), $which='' ) {

  if ( !empty($lessons) && !empty($which) ) {
  
    $the_default_image = get_stylesheet_directory_uri() .'/img/placeholder440.jpg';

    foreach ($lessons as $lsn) {
      $lsn_exp         = explode('__', $lsn);
      $pid             = intval( $lsn_exp[1] );
      $pid_status      = get_post_status( $pid );
      $module_id       = get_post_meta($pid, 'module_id', true);
      $module_title    = get_the_title($module_id);
      $module_key      = sanitize_key($module_title);
      $lesson_title    = get_the_title($pid);
      $lesson_summary  = get_the_excerpt($pid);
      $lesson_link     = get_permalink($pid);
      $lesson_image_id = get_post_thumbnail_id($pid);
      $lesson_image    = $the_default_image;
      if ( ! empty($lesson_image_id) ) {
        $lesson_image = wp_get_attachment_image_src( intval($lesson_image_id), 'full' )[0];
      }
      if ( ('publish' === $pid_status) && ( ('all' === $which) || (intval($module_id) === intval($which)) ) ) {
?>
            <!--featured-carousel-col-->  
            <div class="featured-carousel-col a-featured-lesson <?php echo esc_attr( $module_key ); ?>" data-num="<?php echo esc_attr( $i ); ?>" data-which="<?php echo esc_attr( $module_key ); ?>">
              
              <div class="featured-carousel-col-image">
                <img src="<?php echo esc_url( $lesson_image ); ?>" alt="">
              </div>
                
              <div class="featured-carousel-col-desc">
                <div class="featured-carousel-col-cat">
                  <?php echo esc_html( $module_title ); ?>
                </div>
                <h4>
                  <?php echo esc_html( $lesson_title ); ?>
                </h4>
                <p>
                  <?php echo esc_html( $lesson_summary ); ?>
                </p>
                <a href="<?php echo esc_url( $lesson_link ); ?>" class="cta-arrow">View Page</a>
              </div>
                 
              <a href="<?php echo esc_url( $lesson_link ); ?>" class="featured-carousel-col-link"></a> 
                
            </div>
            <!--featured-carousel-col-->
<?php
      }
    }
  }
}


/**
 * Data for Featured Lessons Grid Section
 * Used in: global-templates/submodules/featured_lessons_grid.php
 *
 * @param integer $module_id - The ID of the module post that holds the lesson
 * @param string $lesson_key - The key for that specific lesson
 *
 * @return array
 */
function fbsafety_find_lesson_meta( $module_id='', $lesson_key='' ) {

  $the_meta = array();

  if ( !empty($module_id) && !empty($lesson_key) ) {

    $all_lessons_meta = get_post_meta( $module_id, 'lessons' );

    foreach ( $all_lessons_meta as $subs ) {
      foreach ( $subs as $sub ) {
        if ( isset($sub['which_subgroup']) && ('lesson' === $sub['which_subgroup']) ) {
          $lsn = $sub['lesson'];
          if ( isset($lsn['uqid']) && ($lesson_key === $lsn['uqid']) ) {
            $the_meta = $lsn;
          }
        }
      }
    }

  }

  return $the_meta;

}

