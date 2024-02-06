<?php
/**
 * Template Name: FAQ template
 *
 * @package WordPress
 */

get_header();

$args = array(
	'post_type'           => 'faqs',
	'post_status'         => 'publish',
	'no_found_rows'       => 'true',
	'ignore_sticky_posts' => 1,
);

$faqs = new WP_Query( $args );
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

<section class="container-fluid section section-faq-container">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12" role="tablist">

				<?php
				$faq_count = 1;

				while ( $faqs->have_posts() ) :
					$faqs->the_post();
				?>

					<div class="faq-card">
						<div
							class="faq-card-header"
							role="tab"
							id="faqQuestionHeading<?php echo esc_attr( $faq_count ); ?>">
							<a
								class="d-flex
								<?php
								if ( $faq_count > 1 ) {
								?>
									collapsed
								<?php
								}
								?>
								"
								data-toggle="collapse"
								href="#faqQuestion<?php echo esc_attr( $faq_count ); ?>"
								role="button"
								aria-expanded="true"
								aria-controls="faqQuestion<?php echo esc_attr( $faq_count ); ?>">
								<span class="faq-card-header__question blue-secondary p-2">
									<?php esc_html_e( 'Q.', 'facebook-startupgarage' ); ?>
								</span>
								<h4 class="faq-card-header__text p-2">
									<?php the_title(); ?>
								</h4>
								<img 
									class="faq-card-header__arrow ml-auto p-2"
									src="<?php facebook_image_include( '/assets/images/en/chevron-up.svg' ); ?>"
									alt="">
							</a>
						</div>
						<div
							id="faqQuestion<?php echo esc_attr( $faq_count ); ?>"
							class=" 
								<?php
								if ( 1 === $faq_count ) {
								?>
									show
								<?php
								} else {
								?>
									collapse
								<?php
								}
								?>
							"
							role="tabpanel"
							aria-labelledby="faqQuestionHeading<?php echo esc_attr( $faq_count ); ?>">
							<div class="faq-card-body d-flex">
								<span class="faq-card-header__question blue-secondary p-2">
									<?php esc_html_e( 'A.', 'facebook-startupgarage' ); ?>
								</span>
								<div class="faq-answer col-lg-6 p-2">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>

				<?php
					$faq_count++;
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
