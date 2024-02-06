<?php
$allowed_html = fb_allowed_tags();

if ( 'right' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
	$mediaalign = 'media-right';
} else {
	$alignment_class = '';
	$mediaalign = 'media-left';
}

if($text_color){
	$btntextcol = 'style="color: ' . $text_color . '"';
	$btnarrowcol = 'style="color:' . $text_color . '; border-color: ' . $text_color . ';"';
}else{
	$btntextcol = '';
	$btnarrowcol = '';
}

?>
<?php if($text_color): ?>
<style type="text/css">
.section-startups-container .arrow-btn { color: <?php echo esc_attr($text_color); ?>; }
</style>
<?php endif; ?>

<section class="container-fluid section section-startups-container <?php echo esc_attr( $mediaalign ); ?>"  <?php if($background_color){echo "style='background:".esc_attr($background_color)."' ";} ?> >


	<div class="hulf-media-container">
    	
    	<div id="youtubeVideo" class="media">
			<?php if ( '' !== $video_url ) : ?>
				<?php
				// This output uses wpcom_vip_wp_oembed_get() in plugins/startup-garage-block-manager
				// which produces a chunk of HTML from a list of trusted providers. As such, the result
				// is not escaped here, but is considered safe.
				echo $video_embed; // @codingStandardsIgnoreLine
				?>

				<?php if($video_img): ?>
					<div class="video-cover" style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $video_img )); ?>);"></div>
				<?php endif; ?>	

			<?php else : ?>
				<?php if (count($images) > 1) : ?>
                    <div class="js-image-slider image-slider">
						<?php foreach ( $images as $image ) : ?>
                            <div class="image-slider__item">
                                <img class="image-slider__image" src="<?php echo esc_url( wp_get_attachment_image_src( $image['image']['image_image'], 'full' )[0] ); ?>" />
                            </div>
						<?php endforeach; ?>
                    </div>
				<?php else : ?>
					<?php foreach ( $images as $image ) : ?>
                        <img alt="" src="<?php echo esc_url( wp_get_attachment_image_src( $image['image']['image_image'], 'full' )[0] ); ?>" />
					<?php endforeach; ?>
				<?php endif; ?>
			
			<?php endif; ?>
        </div>

    </div>

	
    <div class="container video-and-image">
        <div class="row <?php echo esc_attr( $alignment_class ); ?>">
            <div class="col-12 col-lg-6 media-col">
                <?php if($video_img): ?>
            	<div class="video-caption">
            		<h2><?php echo wp_kses( $video_caption, $allowed_html ); ?></h2>
            		<a class="vid-play" href="javascript:void(0);"><span><i class="fas fa-caret-right"></i></span>Watch the Video</a>
            	</div>
            	<?php endif; ?>
            </div>
            <div class="col-12 col-lg-6 text-col">
                <div class="section-copy">
                    <h2 <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
						<?php echo wp_kses( $heading, $allowed_html ); ?>
                    </h2>
                    <div class="grey-dark startups-copy" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
                        
                        <?php echo esc_html(apply_filters('the_content', $body )); ?>
                    </div>
					
					<?php
					if ( '' !== $button_text ) :
						?>

                        <a <?php echo esc_attr($btntextcol); ?> href="<?php echo esc_url( $button_url ); ?>" class="arrow-btn">
                        	<span <?php echo esc_attr($btnarrowcol); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span><?php echo esc_html( $button_text ); ?>
                        </a>
					
					<?php
					endif;
					?>
                </div>
            </div>

        </div>
    </div>

    
</section>
