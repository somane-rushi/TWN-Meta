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

<section class="container-fluid section section-benefits-container">
	<div class="section__overlay <?php echo esc_attr( $background_position_class ); ?> rellax" data-rellax-speed="1" data-rellax-zindex="-1"></div>
	<div class="container">
			<div class="row objective-blocks no-gutters js-in-viewport--blocks-animate-in">

				<?php
				foreach ( $link_cards as $card ) {
				?>
					<div class="objective-block">
						<a class="d-flex flex-lg-column flex-row-reverse" 
							href="<?php echo esc_url( get_permalink( $card['link_page'] ) ); ?>"
						>
							<div class="objective-block-content 
								<?php 
								if ( count( $link_cards ) > 3 ) {
									echo 'objective-block-content--small';
								}
								?>
								">
								<h4><span class="blue-primary">
									<?php echo esc_html( $card['link_text'] ); ?>
								</span></h4>
							</div>
							<div class="objective-block-img-wrap">	
								<div class="objective-block-img" style="
									background-image: url(<?php echo esc_url( wp_get_attachment_image_src( $card['link_image'], 'full' )[0] ); ?>)">
								</div>
							</div>
						</a>
					</div>
				<?php } ?>

			</div>
			
			<?php
			if ( isset( $button_link ) ) {
			?>
				<a href="<?php echo esc_url( get_permalink( $button_link ) ); ?>" class="btn-cta"><?php echo esc_html( $button_text ); ?> <img
						src="<?php facebook_image_include( '/assets/images/en/arrow-right.svg' ); ?>" alt=""/>
				</a>
			<?php
			}
			?>
		</div>
	</div>
</section>