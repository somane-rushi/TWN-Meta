<?php
/**
 * Submodule: FEATURED MODULE
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
	$sub_fields = $args['sub_fields'];
	$featured_module_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
	if ('1' === $featured_module_toggle) :
		$fmod_color = fbsafety_fm_get_data($sub_fields, 'bg_color');
		$fmod_id    = fbsafety_fm_get_data($sub_fields, 'module_id');
		if ( ! empty($fmod_id) ) :
		  $fmod_title   = get_the_title($fmod_id);
		  $fmod_link    = get_permalink($fmod_id);
		  $fmod_excerpt = get_the_excerpt($fmod_id);
		  $fmod_image   = wp_get_attachment_url( get_post_thumbnail_id($fmod_id) );
		  $lessons      = get_all_lesson_ids( $fmod_id );
?>

    <div class="feature-module-wrap">
    	<div class="container">
        	<div class="feature-module-main">
            
            	<!--feature-module-image-->
                    <div class="feature-module-image" style="background-image:url('<?php echo esc_url( $fmod_image ); ?>');">
                        <img src="<?php echo esc_url( $fmod_image ); ?>" alt="<?php echo esc_attr( $fmod_title ); ?>">
                    </div>
                <!--feature-module-image-->
                
                <!--feature-module-desc-->
                <div class="feature-module-desc <?php echo esc_attr($fmod_color); ?>">
                	<div class="feature-module-desc-inner">
                    	<h2>
                    		<?php echo esc_html( $fmod_title ); ?>
                    	</h2>
                        <p>
                        	<?php echo esc_html( $fmod_excerpt ); ?>
                        </p>
                        <?php
                          $btn_group = fbsafety_fm_get_data( $sub_fields, 'btn_group' );
                          $btn_text  = fbsafety_fm_get_data( $btn_group, 'btn_text' );
                          if ( empty($btn_text) ) {
                            $btn_text = 'View the Module';
                          }
                          $btn_args  = array(
                            'btn_toggle' => fbsafety_fm_get_data( $sub_fields, 'btn_toggle' ),
                            'btn_text'   => $btn_text,
                            'btn_link'   => $fmod_link,
                            'btn_target' => ''
                          );
                          get_template_part( 'global-templates/submodules/parts/button', null, $btn_args );
                        ?>
                        <ul>
                      <?php
                        $show_lessons_toggle = fbsafety_fm_get_data($sub_fields, 'show_lessons_toggle');
                        if ('1' === $show_lessons_toggle) :
                          if ( ! empty($lessons) ) :
                            foreach ($lessons as $alesson) :
                              $lesson_id = intval($alesson);
                      ?>
                        	<li><a href="<?php echo esc_url( get_permalink($lesson_id) ); ?>"><?php echo esc_html( get_the_title($lesson_id) ); ?></a></li>
                      <?php
                        		endforeach;
                        	endif;
                        endif;
                      ?>
                        </ul>
                    </div>
                </div>
                <!--feature-module-desc-->
                
            </div>
        </div>
    </div>

<?php
		endif;//fmod_id
	endif;//toggle
endif;//sub_fields
