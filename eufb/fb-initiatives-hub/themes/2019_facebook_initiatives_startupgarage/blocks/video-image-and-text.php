<?php
$allowed_html = fb_allowed_tags();

if ( 'right' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
} else {
	$alignment_class = '';
}

?>

<section class="container-fluid section section-startups-container"  <?php if($background_color){echo "style='background:".esc_attr($background_color)."' ";} ?> >
    <div class="container video-and-image">
        <div class="row <?php echo esc_attr( $alignment_class ); ?>">
            <div class="col-12 col-lg-6 media-col">
                <div class="media">
					<?php if ( '' !== $video_url ) : ?>
						<?php
						// This output uses wpcom_vip_wp_oembed_get() in plugins/startup-garage-block-manager
						// which produces a chunk of HTML from a list of trusted providers. As such, the result
						// is not escaped here, but is considered safe.
						echo $video_embed; // @codingStandardsIgnoreLine
						?>
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
            <div class="col-12 col-lg-6 text-col">
                <div class="section-copy">
                    <h2 <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
						<?php echo wp_kses( $heading, $allowed_html ); ?>
                    </h2>
                    <div class="grey-dark startups-copy" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
                        <p> <?php echo wp_kses(  nl2br($body), $allowed_html   ); ?></p>
                    </div>
					
					<?php
					if ( '' !== $button_text ) :
						?>

                        <a <?php if($text_color){echo "style='".($background_color?"color:".esc_attr($background_color).';':'')."background:".esc_attr($text_color)."' ";} ?>  href="<?php echo esc_url( $button_url ); ?>" class="btn-cta d-sm-inline-block"><?php echo esc_html( $button_text ); ?>
                            <span class="arrow">&#8594;</span>
                        </a>
					
					<?php
					endif;
					?>
                </div>
            </div>

        </div>
    </div>
</section>
