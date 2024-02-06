<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $background_position ) {
	$background_position_class = 'section__overlay--left';
} elseif ( 'right' === $background_position ) {
	$background_position_class = 'section__overlay--right';
} else {
	$background_position_class = '';
}
?>

<section class="container-fluid section section-meet-startups-container section-meet-startups-container--<?php echo esc_attr( $colour ); ?>">
	<div class="section__overlay <?php echo esc_attr( $background_position_class ); ?> rellax" data-rellax-speed="2" data-rellax-zindex="1"></div>
		<div class="container">
			<div class="row text-center">
				<div class="col-12">
					<h3>
						<?php echo wp_kses( $heading, $allowed_html ); ?>
					</h3>

					<hr class="underscore"/>

					<div class="meet-startups-slider">

						<?php foreach ( $carousel_items as $carousel_item ) : ?>

							<div class="meet-startups-slider-item">
								<div class="meet-startups-slider-item-container row">
									<div class="col-12 col-lg-6 video-container">
									<?php if ( '' !== $carousel_item['carousel_facebook_video'] ) : ?>
										<div class="video">
											<?php echo $carousel_item['video_embed']; ?>
										</div>
									<?php else : ?>
										<div class="image">
											<img src="
											<?php
											if ( isset( $carousel_item['carousel_main_image'] ) ) {
												echo esc_url( wp_get_attachment_image_src( $carousel_item['carousel_main_image'], 'full' )[0] );
											}
											?>
											" alt=""/>
										</div>
									<?php endif; ?>

									</div>

									<div class="col-12 col-lg-6 copy-container">

										<?php if ( '' !== $carousel_item['carousel_subheading'] ) { ?>
											<p class="blue-primary"><?php echo esc_html( $carousel_item['carousel_subheading'] ); ?></p>
											<hr class="underscore small" />
										<?php } ?>

										<?php if ( isset( $carousel_item['carousel_image'] ) ) { ?>
											<img class="startup-logo" src="<?php echo esc_url( wp_get_attachment_image_src( $carousel_item['carousel_image'], 'full' )[0] ); ?>" alt=""/>
										<?php } elseif ( '' !== $carousel_item['carousel_heading'] ) { ?>
											<h3 class="blue-primary"><?php echo esc_html( $carousel_item['carousel_heading'] ); ?></h3>
										<?php } ?>

										<p class="grey-dark"><?php echo esc_html( $carousel_item['carousel_body'] ); ?></p>
										<div class="slide-footer-links blue-secondary">

										<?php foreach ( $carousel_item['carousel_links'] as $carousel_link ) : ?>
											<a href="<?php echo esc_url( $carousel_link['carousel_item_link']['carousel_item_link_url'] ); ?>" target="_blank"><?php echo esc_html( $carousel_link['carousel_item_link']['carousel_item_link_text'] ); ?></a>
										<?php endforeach; ?>

										</div>
									</div>
								</div>
							</div>

						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
