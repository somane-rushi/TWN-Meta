<div>
	<div class="slider-container">
		<div class="flexbox-slider" style="background-image: url(
		<?php
			$image = get_term_meta( $category->term_id, 'featured_images', true );

			$desktop_background_url = ( isset( $image['featured_image_desktop'] ) )
				? wp_get_attachment_url( $image['featured_image_desktop'] )
				: facebook_image_url( '/assets/images/default_theme_background--desktop.jpg' );

			echo esc_url( $desktop_background_url );
		?>
		);">
			<?php
			while ( $the_query->have_posts() ) {
			$the_query->the_post();

			// Add the custom background image or default to the orignal
			if ( get_the_post_thumbnail_url( get_the_ID() ) ) {
			?>
			<div class="flexbox-slide"
				data-image-src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>">
				<?php
				} else {
				?>
				<div class="flexbox-slide"
					data-image-src="<?php echo esc_url( facebook_image_include( '/assets/images/section_1__background.jpg' ) ); ?>">
				<?php
				}
				?>	
					<img class="flexbox-slide__background" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>"/>
					<div class="slide__rotated">
						<span><?php the_title(); ?></span>
					</div>
					<div class="slide__outer">
						<h3 class="heading--large"><?php the_title(); ?></h3>
						<h4 class="heading--roll"><?php echo esc_html( get_post_meta( get_the_ID(), 'post_subtitle', true ) ); ?></h4>
						<button class="cta"><?php esc_html_e( 'See More', 'facebook-initiatives' ); ?></button>
					</div>
					<div class="slide__inner-container">

						<div class="slide__inner-container-scroll">
							<div class="slide__inner-close"></div>
							<div class="slide__inner">

								<?php
								if ( '' !== get_post_meta( get_the_ID(), 'facebook_video_url', true ) || ! empty( get_post_meta( get_the_ID(), 'inner_image', true ) ) ) :
								?>

								<div class="slide__inner_media">

									<?php
									if ( '' !== get_post_meta( get_the_ID(), 'facebook_video_url', true ) ) {
										$video_url   = get_post_meta( get_the_ID(), 'facebook_video_url', true );
										$video_embed = wp_oembed_get( $video_url, array( 'width' => '1000' ) );
										$parsed_url  = wp_parse_url( $video_url );

										if ( isset( $parsed_url['host'] ) && 'vimeo.com' === $parsed_url['host'] ) {
											//add playsinline option to vimeo videos
											$video_embed = str_replace( '<iframe', '<iframe playsinline="0" width="100%"', $video_embed );
										}
										?>

										<div id="<?php esc_attr( the_ID() ); ?>" class="video">
											<?php echo $video_embed; ?>
										</div>

									<?php } elseif ( ! empty( get_post_meta( get_the_ID(), 'inner_image', true ) ) ) { ?>
										<img src="
										<?php
											echo esc_url( wp_get_attachment_image_src( get_post_meta( get_the_ID(), 'inner_image', true ), 'medium_large' )[0] );
										?>
										" />
									<?php }; ?>

								</div>

								<?php
								endif;
								?>

								<h4><?php echo esc_html( get_post_meta( get_the_ID(), 'post_subtitle', true ) ); ?></h4>
								<h2><?php the_title(); ?></h2>
								<div class="text">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				} // End posts loop
				?>
		</div><!-- End flexbox-slider -->
	</div><!-- End slider-container -->
</div>

<div id="section_<?php echo esc_attr( $category->slug ); ?>_programs" class="programs-mobile" style="background-image: url(
		<?php
			$image = get_term_meta( $category->term_id, 'featured_images', true );

			$mobile_background_url = ( isset( $image['featured_image_mobile'] ) )
				? wp_get_attachment_url( $image['featured_image_mobile'] )
				: facebook_image_url( '/assets/images/default_theme_background--mobile.jpg' );

			echo esc_url( $mobile_background_url );
		?>
		);">
<?php
$index = 0;
while ( $the_query->have_posts() ) {
	$index ++;
	$the_query->the_post();
?>

	<div class="program" id="<?php echo $index ?>">
		<div class="program__title">
			<div class="program__title_text">
				<?php the_title(); ?>
			</div>
		</div>
		<div class="program__toggle">
			<img class="program__toggle_more" src="<?php facebook_image_include( '/assets/images/icons/arrow_right--blue.svg' ); ?>" alt="See More" />
		</div>
	</div>

	<div class="program__content">
		<div class="wrap">
			<div class="program__toggle">
				<div class="program__toggle_wrap">
					<img class="program__toggle_close" src="<?php facebook_image_include( '/assets/images/icons/accordian__close-icon.svg' ); ?>" alt="Close" />
				</div>
			</div>

			<h2 class="program__content_title"><?php the_title(); ?></h2>
			<h4 class="program__content_subtitle"><?php echo esc_html( get_post_meta( get_the_ID(), 'post_subtitle', true ) ); ?></h4>

			<?php
			if ( '' !== get_post_meta( get_the_ID(), 'facebook_video_url', true ) || ! empty( get_post_meta( get_the_ID(), 'inner_image', true ) ) ) :
			?>
			
			<div class="program__media">
				<?php
				if ( '' !== get_post_meta( get_the_ID(), 'facebook_video_url', true ) ) {
					$video_url   = get_post_meta( get_the_ID(), 'facebook_video_url', true );
					$video_embed = wp_oembed_get( $video_url, array( 'width' => '1000' ) );
					$parsed_url  = wp_parse_url( $video_url );

					if ( isset( $parsed_url['host'] ) && 'vimeo.com' === $parsed_url['host'] ) {
						//add playsinline option to vimeo videos
						$video_embed = str_replace( '<iframe', '<iframe playsinline="0" width="100%"', $video_embed );
					}
				?>

				<div id="<?php esc_attr( the_ID() ); ?>" class="video">
					<?php echo $video_embed; ?>
				</div>

				<?php } elseif ( ! empty( get_post_meta( get_the_ID(), 'inner_image', true ) ) ) { ?>
					<img src="
					<?php
						echo esc_url( wp_get_attachment_image_src( get_post_meta( get_the_ID(), 'inner_image', true ), 'medium_large' )[0] );
					?>
					" />
				<?php }; ?>

			</div>

			<?php
			endif;
			?>

			<?php the_content(); ?>
		</div>
	</div>

<?php
}
?>

</div>
