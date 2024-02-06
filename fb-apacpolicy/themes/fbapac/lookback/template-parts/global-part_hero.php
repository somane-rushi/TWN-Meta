<?php
/**
 * Template part = Lookback, Hero
 * Displayed on page-lookback
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$hero_toggle = false;

// custom post type: lookback_region
if ( is_singular('lookback_region') ) {
	$hero_fields = get_post_meta( $post->ID, 'cptlr_main', true );
}
// page-lookback
if ( is_page_template('lookback/page-lookback.php') ) {
	$hero_fields = get_post_meta( get_the_ID(), 'lookback_page_main', true );
}

$hero_title  = '';
$hero_img    = '';

if ( ! empty($hero_fields) ) {
	$hero_toggle     = fbapac_fm_get_data($hero_fields, 'hero_toggle');
	$hero_title      = fbapac_fm_get_data($hero_fields, 'hero_title');
	$hero_text_color = fbapac_fm_get_data($hero_fields, 'hero_text_color');
	$hero_main_color = strtok($hero_text_color, '-');
	$hero_img_id     = fbapac_fm_get_data($hero_fields, 'hero_image');
	$hero_img_id_mob = fbapac_fm_get_data($hero_fields, 'hero_image_mob');
	if ( ! empty($hero_img_id) ) {
		$hero_img = wp_get_attachment_image_src( $hero_img_id, 'full' )[0];
	}
	$hero_img_mob = $hero_img;
	if ( ! empty($hero_img_id_mob) ) {
		$hero_img_mob = wp_get_attachment_image_src( $hero_img_id_mob, 'full' )[0];
	}
	$hero_video = '';
	$hero_vidid = fbapac_fm_get_data($hero_fields, 'hero_video');
	if ( ! empty($hero_vidid) ) {
		$hero_video = wp_get_attachment_url( $hero_vidid );
	}
	$hero_video_link_toggle     = fbapac_fm_get_data($hero_fields, 'hero_video_link_toggle');
	$hero_video_link_toggle_ext = fbapac_fm_get_data($hero_fields, 'hero_video_ext_toggle');
	$hero_video_ext_link        = fbapac_fm_get_data($hero_fields, 'hero_video_ext_link');
}

if ('1' === $hero_toggle) :
?>

<section class="hero" style="background-image:url('<?php echo esc_url( $hero_img ); ?>');" data-desktop="<?php echo esc_url( $hero_img ); ?>" data-mobile="<?php echo esc_url( $hero_img_mob ); ?>">
	<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" />
	<div class="hero-overlay">
		<div class="hero-content-pos">
			<div class="container">
				<div class="hero-caption">
					<h1 class="<?php echo esc_attr($hero_text_color); ?>">
						<?php echo esc_attr( $hero_title ); ?>	
					</h1>
				<?php 
					if ( '1' === $hero_video_link_toggle ) :
						if ( '1' === $hero_video_link_toggle_ext ) :
					?>
						<a href="<?php echo esc_url($hero_video_ext_link); ?>" target="_blank" class="hero-btn <?php echo esc_attr($hero_main_color); ?>-btn <?php echo esc_attr($hero_text_color); ?>" id="external-hero-video">Play the Video</a>
				<?php 
						else :
					?>		
						<a href="javascript:void(0)" class="hero-btn <?php echo esc_attr($hero_main_color); ?>-btn <?php echo esc_attr($hero_text_color); ?>" id="play-hero-video" data-video="<?php echo esc_url($hero_video); ?>">Play the Video</a>
					<?php
						endif;
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
<?php 
	if ( ('1' === $hero_video_link_toggle) && ('1' !== $hero_video_link_toggle_ext) ) :
?>
<div id="hero-video-modal">
	<div id="close-video-modal" role="button" aria-label="Close this video"></div>
	<div class="hero-video-modal-inner">
		<video id="the-hero-video" controls>
		  <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
		  Your browser does not support the video tag.
		</video>
	</div>
</div>
<?php
	endif;
?>
</section>

<?php
endif;//toggle
