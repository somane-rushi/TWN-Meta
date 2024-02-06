<?php
/**
 * Submodule: VIDEO
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $video_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $video_toggle) :
  	$video_url = fbsafety_fm_get_data($sub_fields, 'video_url');
    if ( ! empty($video_url) ) :
?>

<section class="a-video">
  <div class="video-container">
    <div class="video-inner">
      <iframe
        class="video-iframe" 
        src="<?php echo esc_url($video_url); ?>" 
      ></iframe>
    </div>
  </div>
</section>

<?php
    endif;
  endif;//toggle
endif;//sub_fields
