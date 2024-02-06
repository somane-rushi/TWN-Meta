<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
} else {
	$alignment_class = '';
}

if ( 'left' === $background_position ) {
	$background_position_class = 'section__overlay--left-light';
} elseif ( 'right' === $background_position ) {
	$background_position_class = 'section__overlay--right-light';
} else {
	$background_position_class = '';
}

?>

<section class="container-fluid section section-startups-container <?php echo esc_attr( $colour ); ?>">
	<div class="section__overlay rellax <?php echo esc_attr( $background_position_class ); ?>" data-rellax-speed="2" data-rellax-zindex="1"></div>
	<div class="container">
		<div class="row <?php echo esc_attr( $alignment_class ); ?>">
			<div class="col-12 col-lg-6">
				<h2 class="js-in-viewport--move-left-fade-in">
					<?php echo wp_kses( $heading, $allowed_html ); ?>
				</h2>
				<hr class="underscore js-in-viewport--grow-line-from-left" />
				<p class="grey-dark startups-copy js-in-viewport--fade-in"><?php echo nl2br( esc_html( $body ) ); ?></p>

				<?php
				if ( '' !== $button_text ) :
				?>

				<a href="<?php echo esc_url( $button_url ); ?>" class="btn-cta d-none d-lg-inline-block js-in-viewport--fade-in"><?php echo esc_html( $button_text ); ?> <img
						src="<?php facebook_image_include( '/assets/images/en/arrow-right.svg' ); ?>" alt=""/>
				</a>

				<?php
				endif;
				?>

			</div>
			<div class="col-12 col-lg-6">
				<div class="media js-in-viewport--move_up_fade_in">
					<?php if ( '' !== $video_url ) : ?>
						<?php
							// This output uses wpcom_vip_wp_oembed_get() in plugins/startup-garage-block-manager 
							// which produces a chunk of HTML from a list of trusted providers. As such, the result
							// is not escaped here, but is considered safe.
							echo $video_embed; // @codingStandardsIgnoreLine
						?>
					<?php else : ?>
						<img src="<?php echo esc_url( wp_get_attachment_image_src( $image, 'full' )[0] ); ?>" alt=""/>
					<?php endif; ?>
				</div>

				<?php
				if ( '' !== $button_text ) :
				?>

				<a href="<?php echo esc_url( $button_url ); ?>" class="btn-cta d-lg-none js-in-viewport--fade-in"><?php echo esc_html( $button_text ); ?> <img
						src="<?php facebook_image_include( '/assets/images/en/arrow-right.svg' ); ?>" alt=""/>
				</a>

				<?php
				endif;
				?>

			</div>
		</div>
	</div>
</section>
