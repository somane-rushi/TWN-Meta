<?php
/**
 * The template for displaying story archive pages
 */

get_header();
?>

<?php fbiamdigital_the_archive_masthead( 'story' ); ?>

<?php if ( have_posts() ) : ?>

	<?php $story_terms = fbiamdigital_get_terms( array(
		'taxonomy' => 'story_category',
	) ); ?>
	<?php if ( ! empty( $story_terms ) ): ?>
		<div class="c-listing-filter">
			<div class="o-wrap">
				<form class="c-listing-filter__inner o-box" action="<?php echo esc_url( get_post_type_archive_link( 'story' ) ); ?>">
					<div class="lang-direction-horizontal">
						<span><?php echo esc_html_x( 'I want to learn more about', 'Filter', 'fbiamdigital' ); ?></span><br>
						<?php $category_query_var_name = 'category'; ?>
						<select name="<?php echo esc_attr( $category_query_var_name ); ?>" class="c-select" data-onchangesubmit="true">
							<option value=""><?php echo esc_html_x( 'all categories', 'Filter', 'fbiamdigital' ); ?></option>
							<?php foreach ( $story_terms as $story_term ): ?>
								<option <?php selected( $story_term->slug, get_query_var( $category_query_var_name ), true ); ?> value="<?php echo esc_attr( $story_term->slug ); ?>"><?php echo esc_html( strtolower( $story_term->name ) ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</form>
			</div>
		</div>
	<?php endif; ?>

	<section class="c-listing">
		<div class="o-wrap">

			<div id="content" class="o-layout o-layout--stretch">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
				?>
			</div>

			<?php fbiamdigital_the_infinite_load_button(); ?>
		</div>
	</section>
<?php else:

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();