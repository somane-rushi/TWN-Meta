<?php 
$allowed_html = fb_allowed_tags(); 
?>

<section class="container-fluid section section-startups-grid-container">
	<div class="container">
		<?php if ( '' !== $heading ) : ?>
			<div class="col-12 text-center">
				<h3><?php echo wp_kses( $heading, $allowed_html ); ?></h3>
			</div>
		<?php endif; ?>

		<div class="row align-items-center">
			<?php foreach ( $grid_items as $key => $grid_item ) : ?>
				<div class="col-12 col-lg-4">
					<a href="#" data-toggle="modal" data-target="#startupsGridModal-<?php echo esc_attr( $block_id ); ?>" data-slide="<?php echo esc_attr( $key ); ?>">
						<img src="<?php echo esc_url( wp_get_attachment_image_src( $grid_item['grid_item']['grid_image'], 'full' )[0] ); ?>" alt=""/>
					</a>
				</div>
			<?php endforeach; ?>

		</div>
	</div>

	<div class="modal fade startupsGridModal" data-slider=".startupsGridModal-<?php echo esc_attr( $block_id ); ?>" id="startupsGridModal-<?php echo esc_attr( $block_id ); ?>" tabindex="-1" role="dialog" aria-labelledby="startupsGridModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-close"></div>
			<div class="modal-content">
				<div class="meet-startups-modal-slider">
					<?php foreach ( $grid_items as $grid_item ) : ?>
						<div class="meet-startups-slider-item">
							<div class="meet-startups-slider-item-container row">
								<div class="col-12 col-lg-6 video-container">
									<?php if ( '' !== $grid_item['grid_item']['video_url'] ) : ?>
										<div class="media">
											<?php 
												// This output uses wpcom_vip_wp_oembed_get() in plugins/startup-garage-block-manager
												// which produces a chunk of HTML from a list of trusted providers. As such, the result
												// is not escaped here, but is considered safe.
												echo $grid_item['grid_item']['video_embed']; // @codingStandardsIgnoreLine
											?>
										</div>
									<?php else : ?>
										<img src="
										<?php
										if ( isset( $grid_item['grid_item']['image'] ) ) {
											echo esc_url( wp_get_attachment_image_src( $grid_item['grid_item']['image'], 'full' )[0] );
										}
										?>
										" alt=""/>
									<?php endif; ?>
								</div>
								<div class="col-12 col-lg-6 copy-container">
									<?php if ( '' !== $grid_item['grid_item']['sector'] ) : ?>
										<p class="blue-primary"><?php echo esc_html( $grid_item['grid_item']['sector'] ); ?></p>
										<hr class="underscore small js-in-viewport--grow-line-from-left" />
									<?php endif; ?>
									<img class="startup-logo" src="<?php echo esc_url( wp_get_attachment_image_src( $grid_item['grid_item']['logo'], 'full' )[0] ); ?>" alt=""/>
									<p class="grey-dark"><?php echo esc_html( $grid_item['grid_item']['body'] ); ?></p>

									<div class="slide-footer-links blue-secondary">

										<?php
										foreach ( $grid_item['grid_item']['cleaned_links'] as $link ) :
										?>
											<a href="<?php echo esc_url( $link['link_url'] ); ?>" target="_blank">
												<?php echo esc_html( $link['link_text'] ); ?>
											</a>
										<?php
										endforeach;
										?>

									</div>

								</div>
							</div>
						</div>
					<?php endforeach; ?>
					
				</div>
			</div>
		</div>
	</div>
</section>
