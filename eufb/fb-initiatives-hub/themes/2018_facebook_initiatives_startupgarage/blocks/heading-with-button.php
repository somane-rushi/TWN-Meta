<?php
$allowed_html = fb_allowed_tags();
?>

<section class="container-fluid section section-apply-container">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-12 col-md-6">
				<?php if ( $heading ) : ?>
					<h2 class="js-in-viewport--move-left-fade-in">
						<?php echo wp_kses( $heading, $allowed_html ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $subheading ) : ?>
					<h2 class="js-in-viewport--move-left-fade-in">
						<?php echo esc_html( $subheading ); ?>
					</h2>
				<?php endif; ?>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="apply-cta d-lg-block js-in-viewport--move_up_fade_in">
					<a href="<?php echo esc_url( $button_link ); ?>" target="_blank" class="btn-cta btn-apply-cta">
						<?php echo esc_html( $button_text ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
