<?php
$allowed_html = fb_allowed_tags();
?>

<section class="container-fluid section section-objectives-benefits-container" id="community-workspace">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-lg-6 left-container">
				<div>
					<?php if ( '' !== $heading ) : ?>
						<h2 class="js-in-viewport--move-left-fade-in">
							<?php echo wp_kses( $heading, $allowed_html ); ?>
						</h2>
						<hr class="underscore js-in-viewport--grow-line-from-left" />
					<?php endif; ?>

					<?php if ( '' !== $subheading ) : ?>
					<h4 class="js-in-viewport--fade-in">
						<?php echo esc_html( $subheading ); ?>
					</h4>
					<?php endif; ?>

					<?php if ( '' !== $body ) : ?>
						<p class="js-in-viewport--fade-in">
							<?php echo nl2br( esc_html( $body ) ); ?>
						</p>
					<?php endif; ?>

				</div>
			</div>
			
			<div class="col-12 col-lg-6 right-container">
				<ul>

				<?php foreach ( $bullets as $bullet ) : ?>
					<li>
						<?php if ( '' !== $bullet['bullet']['bullet_heading'] ) : ?>
							<h4 class="js-in-viewport--fade-in"><?php echo esc_html( $bullet['bullet']['bullet_heading'] ); ?></h4>
						<?php endif; ?>
						<?php if ( '' !== $bullet['bullet']['bullet_text'] ) : ?>
							<p class="js-in-viewport--fade-in"><?php echo esc_html( $bullet['bullet']['bullet_text'] ); ?></p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>

				</ul>
			</div>
		</div>
	</div>
</section>
