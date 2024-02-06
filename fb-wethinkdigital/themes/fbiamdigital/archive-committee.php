<?php
/**
 * The template for displaying story archive pages
 */

get_header();
?>

<?php fbiamdigital_the_archive_masthead( 'committee' ); ?>

<?php $committee_archive_fields = get_option( 'archive_committee' ); ?>

<?php if ( have_posts() ) : ?>

	<section class="o-wrap c-committee-intro">
		<?php if ( ! empty( $committee_archive_fields['intro_heading'] ) ): ?>
			<h2 class="c-heading2 c-committee-intro__heading u-tac"><?php echo esc_html( $committee_archive_fields['intro_heading'] ); ?></h2>
		<?php endif; ?>
		<?php if ( ! empty( $committee_archive_fields['intro_description'] ) ): ?>
			<div class="intro c-committee-intro__description u-tac">
				<?php echo wp_kses( $committee_archive_fields['intro_description'], array(
					'p'      => array(),
					'br'     => array(),
					'em'     => array(),
					'strong' => array(),
				) ); ?>
			</div>
		<?php endif; ?>
	</section>

	<section class="c-listing c-committee-listing">
		<div class="o-wrap c-committee-listing__wrap">

			<div id="content" class="o-layout o-layout--stretch c-committee-listing__layout">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
				?>
			</div>

			
		</div>
	</section>
<?php else:

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
