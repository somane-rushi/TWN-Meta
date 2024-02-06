<section id="<?php echo esc_attr( $category->slug ); ?>" class="theme">

	<a name="<?php echo esc_attr( $category->slug ); ?>" data-scroll-anchor
	data-theme-colour="<?php echo esc_attr( get_term_meta( $category->term_id, 'border_colour', true ) ); ?>"></a>

	<?php
	// Only show stats and the flexend header layout on the first story
	if ( 1 === $categories_count ) {
		?>
		<div id="sections_wrapper">
			<div id="section_<?php echo esc_attr( $category->slug ); ?>_heading" class="section__headings theme-stats">
				<div class="container">
					<div class="panels panels--flexend">
						<div class="panels__panel">
							<div class="heading">
								<h1 class="section__heading">
									<?php
									// Display the Story title including the new lines and strong tags to allow for the blue highlighting
									echo wp_kses( $category_title, array(
										'br'     => array(),
										'strong' => array(),
										'span'   => array(),
									) );
									?>
								</h1>
								<h4 class="section__subheading"><?php echo esc_html( strip_tags( category_description( $category->term_id ) ) ); ?></h4>
								<?php
								// Get the page set up as the front-page in WordPress options - we use this to get the stats quote
								if ( have_posts() ) {
									the_post();
									
									// Get the stats quote
									$stats_quote = get_term_meta( $category->term_id, 'quote_two', true );
									if ( '' !== $stats_quote['quote'] ) {
									?>
									
									<blockquote class="quote quote-one">
										<h4 class="quote__quote"><?php echo esc_html( $stats_quote['quote'] ); ?></h4>
										<span
											class="quote__attribute"><?php echo esc_html( $stats_quote['quote_author'] ); ?></span>
										<span
											class="quote__company"><?php echo esc_html( $stats_quote['quote_author_job_title'] ); ?></span>
									</blockquote>

									<?php
									}
								}
								?>
							</div>
						</div>
						<div class="panels__panel">
							<?php
							$quote = get_term_meta( $category->term_id, 'quote_one', true );
							if ( isset( $quote['quote'] ) && ! empty( $quote['quote'] ) ) {
								//make quote vailable to template
								set_query_var( 'quote', $quote );
								get_template_part( 'template-parts/content-stories', 'quote' );
							}
							?>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			// Add the custom background image or default to the orignal
			$image = get_term_meta( $category->term_id, 'featured_images', true );

			$desktop_background_url = ( isset( $image['featured_image_desktop'] ) )
				? wp_get_attachment_url( $image['featured_image_desktop'] )
				: facebook_image_url( '/assets/images/default_theme_background--desktop.jpg' );

			$mobile_background_url = ( isset( $image['featured_image_mobile'] ) )
				? wp_get_attachment_url( $image['featured_image_mobile'] )
				: facebook_image_url( '/assets/images/default_theme_background--mobile.jpg' );
			?>

			<div class="section__header section__header--desktop"
				style="background-image: url(
					<?php echo esc_url( $desktop_background_url ); ?>
				)">
			</div>
			<div class="section__header section__header--mobile"
				style="background-image: url(
					<?php echo esc_url( $mobile_background_url ); ?>
				)">
			</div>

			<div id="section_<?php echo esc_attr( $category->slug ); ?>_stats" class="section__content">
				<div class="panels">
					<div class="panels__panel panels__panel--white">
						<h3 class="stats__heading"><?php esc_html_e( 'The story in India', 'facebook-initiatives' ); ?></h3>
						<?php
						// Add the custom background image or default to the theme css
						if ( is_active_sidebar( 'headline-stat-area' ) ) {
							?>
							<div class="stats">
								<?php dynamic_sidebar( 'headline-stat-area' ); ?>
							</div>
							<?php
						}
						?>
						<?php
						// Show the stats
						if ( is_active_sidebar( 'stats-area' ) ) {
						?>
						<div class="stats">
							<div class="stats__carousel">
								<?php dynamic_sidebar( 'stats-area' ); ?>
								<?php
								}
								?>
							</div>
							<div class="stats__carousel--nav"></div>
						</div>
					</div>
				</div>
			</div>

			<?php
			//included so we have access to variables in this scope
			include( locate_template( 'template-parts/content-stories-posts-section.php' ) );
			?>
		</div>
		<?php
	} else { // Show the flexstart header view for subsequent headers
		?>
		<div id="sections_wrapper">
			<div id="section_<?php echo esc_attr( $category->slug ); ?>_heading" class="section__headings theme-no-stats">
				<div class="container">
					<div class="panels panels--flexend">
						<div class="panels__panel">
							<div class="heading">
								<h1 class="section__heading">
									<?php
									// Display the Story title including the new lines and strong tags to allow for the blue highlighting
									echo wp_kses( $category_title, array(
										'br'     => array(),
										'strong' => array(),
										'span'   => array(),
									) );
									?>
								</h1>
								<h4 class="section__subheading"><?php echo esc_html( strip_tags( category_description( $category->term_id ) ) ); ?></h4>
							</div>
						</div>
						<div class="panels__panel">
							<?php
							$quote = get_term_meta( $category->term_id, 'quote_one', true );
							if ( isset( $quote['quote'] ) && ! empty( $quote['quote'] ) ) {
								set_query_var( 'quote', $quote );
								get_template_part( 'template-parts/content-stories', 'quote' );
							}
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
			// Add the custom background image or default to the orignal
			$image = get_term_meta( $category->term_id, 'featured_images', true );

			$desktop_background_url = ( isset( $image['featured_image_desktop'] ) )
				? wp_get_attachment_url( $image['featured_image_desktop'] )
				: facebook_image_url( '/assets/images/default_theme_background--desktop.jpg' );

			$mobile_background_url = ( isset( $image['featured_image_mobile'] ) )
				? wp_get_attachment_url( $image['featured_image_mobile'] )
				: facebook_image_url( '/assets/images/default_theme_background--mobile.jpg' );
			?>

			<div class="section__header section__header--desktop"
				style="background-image: url(
					<?php echo esc_url( $desktop_background_url ); ?>
				)">
			</div>
			<div class="section__header section__header--mobile"
				style="background-image: url(
					<?php echo esc_url( $mobile_background_url ); ?>
				)">
			</div>


			<?php
			//included so we have access to variables in this scope
			include( locate_template( 'template-parts/content-stories-posts-section.php' ) );
			?>
			
		</div>

	<?php
	} // End stats if else
	?>

</section>

