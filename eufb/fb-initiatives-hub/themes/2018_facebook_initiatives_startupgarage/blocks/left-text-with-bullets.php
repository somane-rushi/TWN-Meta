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

<section class="container-fluid section section-mentoring-container <?php echo esc_attr( $colour ); ?>" id="mentoring">
	<div class="section__overlay <?php echo esc_attr( $background_position_class ); ?> rellax" data-rellax-speed="2" data-rellax-zindex="1"></div>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-lg-5">
				<h2 class="js-in-viewport--move-left-fade-in">
					<?php echo wp_kses( $heading, $allowed_html ); ?>
				</h2>
				<hr class="underscore js-in-viewport--grow-line-from-left" />
				<p class="grey-dark mentoring-copy js-in-viewport--fade-in">
					<?php echo wp_kses( $body, $allowed_html ); ?>
				</p>
			</div>
			<div class="col-12 col-lg-7 mentoring-bullets">

			<?php
			$count = 1;
			foreach ( $bullets as $bullet ) :
			?>

				<div class="mentoring-bullet-item">
					<img class = "mentoring-bullet-img-<?php echo esc_attr( $count ); ?>" 
						src="<?php echo esc_url( wp_get_attachment_image_src( $bullet['bullet']['bullet_icon'], 'full' )[0] ); ?>"
						alt=""/>
					<span class="blue-primary js-in-viewport--fade-in"><?php echo esc_html( $bullet['bullet']['bullet_text'] ); ?></span>
				</div>

			<?php
			$count++;
			endforeach;
			?>

			</div>
		</div>
	</div>
</section>
