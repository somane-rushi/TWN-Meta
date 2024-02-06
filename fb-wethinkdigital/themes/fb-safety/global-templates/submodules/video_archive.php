<?php
/**
 * Submodule: VIDEO ARCHIVE
 * This section displays a video archive, videos selected in the block
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $video_archive_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $video_archive_toggle) :
	  $the_title       = fbsafety_fm_get_data($sub_fields, 'title');
	  $the_subtitle    = fbsafety_fm_get_data($sub_fields, 'subtitle');
	  $the_description = fbsafety_fm_get_data($sub_fields, 'description');
	  $the_videos      = fbsafety_fm_get_data($sub_fields, 'the_videos');
	  $default_vid_img = get_template_directory_uri() . '/img/video-thumb-default.png';
?>

<div class="container small content-main">
	<div class="row">
		<div class="main-content">

		<?php if ( ! empty($the_title) ) : ?>
      <h2>
        <?php echo esc_html( $the_title ); ?>
      </h2>
    <?php endif; ?>
			
		<?php if ( ! empty($the_subtitle) ) : ?>
      <h3>
        <?php echo esc_html( $the_subtitle ); ?>
      </h3>
    <?php endif; ?>

    <?php if ( ! empty($the_description) ) : ?>
      <p>
        <?php echo esc_html( $the_description ); ?>
      </p>
    <?php endif; ?>

    <?php if ( ! empty($the_videos) ) : ?>
    	<div class="the--videos">

   	<?php foreach($the_videos as $video) : 
   		$vid_arr       = fbsafety_fm_get_data($video, 'a_video');
   		$vid           = intval( fbsafety_fm_get_data($vid_arr, 'video') );
   		$video_title   = get_the_title($vid);
   		$video_link    = get_permalink($vid);
   		$video_img_id  = get_post_thumbnail_id($vid);
      $video_image   = $default_vid_img;
      if ( ! empty($video_img_id) ) {
        $video_image = wp_get_attachment_image_src( intval($video_img_id), 'large' )[0];
      }
      $video_excerpt = get_the_excerpt($vid);
      if ( empty($video_excerpt ) ) {
      	$video_excerpt = 'This video is lacking an excerpt. It is in need of a short description.';
      }
   	?>

   			<div class="a--video">
   				<a href="<?php echo esc_url($video_link); ?>">
   					<div class="img-contain">
	   					<img src="<?php echo esc_url($video_image); ?>" alt="<?php echo esc_attr($video_title); ?>" />
	   				</div>
	   				<h4>
	   					<?php echo esc_html($video_title); ?>
	   				</h4>
	   				<p>
	   					<?php echo esc_html($video_excerpt); ?>
	   				</p>
	   			</a>
   			</div>


    <?php endforeach; ?>

    	</div>
    <?php endif; ?>
		</div>
	</div>
</div>

<?php
  endif;//toggle
endif;//sub_fields
