<?php
/**
 * Template Name: Main Blocks Template
 *
 * @package WordPress
 */

get_header();

while ( have_posts() ) :
	the_post();

	if ( is_front_page() ) :
	?>

	<section class="container-fluid section section-home-hero-container" 
		style="background-image: url(
			<?php
			if ( jetpack_is_mobile() ) {
				$mobile_featured_image = get_post_meta( $post->ID, 'after_title_fm_fields', true );

				if ( ! empty( $mobile_featured_image['mobile_featured_image'] ) ) {
					echo esc_url( wp_get_attachment_image_src( $mobile_featured_image['mobile_featured_image'], 'full' )[0] );
				} else {
					if ( has_post_thumbnail() ) {
						the_post_thumbnail_url( 'full' );
					}
				}
			} else {
				if ( has_post_thumbnail() ) {
					the_post_thumbnail_url( 'full' );
				}
			}
			?>
		)">
		<div class= "hero__overlay hero__overlay--primary"></div>
		<div class="container">
			<div class="row align-items-center">
				<div class="col col-lg-8">
					<?php
					$subtitle = get_post_meta( $post->ID, 'after_title_fm_fields', true );

					if ( is_array( $subtitle ) ) :
					?>
						<h1 class="js-in-viewport--move_up_fade_in">
							<?php
								echo wp_kses( $subtitle['page_heading'], array(
									'span'   => array(
										'class' => array(),
									),
								) );
							?>
						</h1>
					<?php
					endif;
					?>
					<div class="col col-lg-12 section-hero-copy">
						<div class="js-in-viewport--move_up_fade_in">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	else :
	?>

	<section class="container-fluid section section-page-hero-container"
		style="background-image: url(
			<?php
			if ( jetpack_is_mobile() ) {
				$mobile_featured_image = get_post_meta( $post->ID, 'after_title_fm_fields', true );
				echo esc_url( wp_get_attachment_image_src( $mobile_featured_image['mobile_featured_image'], 'full' )[0] );
			} else {
				if ( has_post_thumbnail() ) {
					the_post_thumbnail_url( 'full' );
				}
			}
			?>
		)">

		<?php
		$heading_colour = get_post_meta( $post->ID, 'after_title_fm_fields', true );
		if ( '' !== $heading_colour['header_colour'] && 'light-blue' === $heading_colour['header_colour'] ) :
		?>
			<div class= "hero__overlay hero__overlay--light"></div>
		<?php
		elseif ( '' !== $heading_colour['header_colour'] && 'dark-blue' === $heading_colour['header_colour'] ) :
		?>
			<div class= "hero__overlay hero__overlay--primary"></div>
		<?php
		endif;
		?>

		<div class="container">
			<div class="row align-items-center">
				<div class="col col-lg-6">
					<h1 class="js-in-viewport--move_up_fade_in">
						<?php
						$subtitle = get_post_meta( $post->ID, 'after_title_fm_fields', true );
						if ( '' !== $subtitle['page_heading'] ) {
							echo wp_kses( $subtitle['page_heading'], array(
								'span'   => array(
									'class' => array(),
								),
							) );
						}
						?>
					</h1>
				</div>
			</div>

			<?php
			if ( '' !== $heading_colour['header_colour'] && 'light-blue' === $heading_colour['header_colour'] ) :
			?>
				<div class="caption-block caption-block--light objectives-caption-block">
			<?php
			elseif ( '' !== $heading_colour['header_colour'] && 'dark-blue' === $heading_colour['header_colour'] ) :
			?>
				<div class="caption-block caption-block--primary objectives-caption-block">
			<?php
			endif;
			?>

				<div class="container">
					<div class="row align-items-center">
						<div class="col col-lg-5 section-hero-copy">
							<div class="js-in-viewport--move_up_fade_in">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php

	endif;

	$id = get_the_ID();
	$block_manager->render_blocks( $id );

endwhile;
wp_reset_query();

get_footer();
