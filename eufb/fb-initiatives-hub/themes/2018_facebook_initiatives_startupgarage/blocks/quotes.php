<?php $allowed_html = fb_allowed_tags(); ?>

<section class="container-fluid section section-quotes-container">
	<div class="container">
		<div class="row text-center">
			<div class="col-12">
				<h3 class="js-in-viewport--move_up_fade_in">
					<?php echo wp_kses( $heading, $allowed_html ); ?>
				</h3>

				<hr class="underscore">

				<div class="quotes-wrapper js-in-viewport--move_up_fade_in">
					<div class="quotes-slider slider-for">

						<?php foreach ( $quotes as $quote ) : ?>
							<div class="quotes-slider-item">
								<div class="quotes-slider-item-container d-flex justify-content-center flex-column align-items-center">
									<blockquote class="grey-dark">“<?php echo esc_html( $quote['quote']['quote_body'] ); ?>”</blockquote>
									<p class="blue-primary"><?php echo esc_html( $quote['quote']['quote_quotee'] ); ?></p>
									<p class="blue-secondary"><?php echo esc_html( $quote['quote']['quote_quotee_title'] ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
						
					</div>

					<div class="arrow-down"></div>

					<div class="quotes-slider-nav">

					<?php foreach ( $quotes as $quote ) : ?>
						<div class="quotes-slider-nav-item">
							<div class="quotes-slider-nav-item-container">
								<img src="
									<?php
									if ( isset( $quote['quote']['quote_quotee_image'] ) ) {
										echo esc_url( wp_get_attachment_image_src( $quote['quote']['quote_quotee_image'], 'full' )[0] );
									}
									?>
									"
									alt=""/>
								<p><?php echo esc_html( $quote['quote']['quote_quotee'] ); ?></p>
								<hr class="underscore small" />
							</div>
						</div>
					<?php endforeach; ?>

					</div>
				</div>

			</div>
		</div>
	</div>
</section>
