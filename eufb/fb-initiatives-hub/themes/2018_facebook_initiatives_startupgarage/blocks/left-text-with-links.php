<?php $allowed_html = fb_allowed_tags(); ?>

<section class="container-fluid section section-resources-container <?php echo esc_attr( $colour ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-5">
				<h2 class="js-in-viewport--move-left-fade-in">
					<?php echo wp_kses( $heading, $allowed_html ); ?>
				</h2>
				<hr class="underscore js-in-viewport--grow-line-from-left" />
				<p class="grey-dark resources-copy js-in-viewport--fade-in">
					<?php echo wp_kses( $body, $allowed_html ); ?>
				</p>
			</div>
			<div class="col-12 col-lg-7 resources js-in-viewport--fade-in">

				<?php foreach ( $links as $link ) : ?>
					<div class="resources-block d-flex">
						<div class="resources-block-img">
							<img src="<?php echo esc_url( wp_get_attachment_image_src( $link['link']['link_image'], 'full' )[0] ); ?>"
								alt=""/>
						</div>
						<div class="resources-block-content">
							<h4 class="blue-secondary">
								<?php echo esc_html( $link['link']['link_text'] ); ?>
							</h4>
							<h4 class="blue-primary">
								<?php
								echo esc_html( $link['link']['link_attribute'] );
								?>
							</h4>
							<hr class="underscore small js-in-viewport--grow-line-from-left" />
							<a class="blue-secondary" href="<?php echo esc_url( $link['link']['button_url'] ); ?>" target="_blank">
								<?php echo esc_html( $link['link']['button_text'] ); ?>
							</a>
						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
	</div>
</section>
