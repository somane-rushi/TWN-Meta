<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $background_position ) {
	$background_position_class = 'section__overlay--left-light';
} elseif ( 'right' === $background_position ) {
	$background_position_class = 'section__overlay--right-light';
} else {
	$background_position_class = '';
}
?>

<section class="container-fluid section section-grow-your-container <?php echo esc_attr( $colour ); ?>">
	<div class="section__overlay <?php echo esc_attr( $background_position_class ); ?> rellax" data-rellax-speed="1" data-rellax-zindex="1"></div>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-lg-6">
				<?php if ( $heading_one ) : ?>
					<h2 class="js-in-viewport--move-left-fade-in">
						<?php echo wp_kses( $heading_one, $allowed_html ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $heading_two ) : ?>
					<h2 class="blue-primary js-in-viewport--move-left-fade-in">
						<?php echo wp_kses( $heading_two, $allowed_html ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $heading_three ) : ?>
					<h2 class="blue-secondary js-in-viewport--move-left-fade-in">
						<?php echo wp_kses( $heading_three, $allowed_html ); ?>
					</h2>
				<?php endif; ?>
				
				<hr class="underscore js-in-viewport--grow-line-from-left" />
			</div>
			<div class="col-12 col-lg-6 right-container">
				<div>
					<h4 class="blue-primary js-in-viewport--fade-in"><?php echo esc_html( $subheading ); ?></h4>
					<p class="js-in-viewport--fade-in"><?php echo nl2br( esc_html( $body ) ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
