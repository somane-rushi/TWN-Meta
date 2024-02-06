<section class="container-fluid section section-startup-logo-bar">
	<div class="logo-slider">
		<?php foreach ( $logos as $logo ) : ?>
			<div class="logo-slider-item">
				<img src="<?php echo esc_url( wp_get_attachment_image_src( $logo['logo']['logo_image'], 'full' )[0] ); ?>" />
			</div>
		<?php endforeach; ?>
	</div>
</section>
