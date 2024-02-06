<?php
/**
 * The template for displaying resource archive pages
 */

get_header();
?>
<?php fbiamdigital_the_archive_masthead( 'partner' ); ?>

<?php
	global $wp_query;
	$fields = get_option( "archive_partner", array() );
	$category_query_var_name = 'country';
	$param_country = get_query_var( $category_query_var_name );

	if(!empty($fields['enable_enhancement_sort']) && $fields['enable_enhancement_sort']) {
		$wp_query = get_partners_enhancement_sort($param_country);
	}
?>

<?php if ( have_posts() ) : ?>
	<?php $partner_country_terms = fbiamdigital_get_terms( array(
		'taxonomy' => 'country',
	) ); ?>
	<?php if ( ! empty( $partner_country_terms ) ): ?>
		<div class="c-listing-filter">
			<div class="o-wrap">
				<form class="c-listing-filter__inner o-box" action="<?php echo esc_url( get_post_type_archive_link( 'partner' ) ); ?>">
					<div class="lang-direction-horizontal">
						<span><?php echo esc_html_x( 'Our partners from', 'Filter', 'fbiamdigital' ); ?></span><br>
						<select name="<?php echo esc_attr( $category_query_var_name ); ?>" class="c-select" data-onchangesubmit="true">
							<option value=""><?php echo esc_html_x( 'around the world', 'Filter', 'fbiamdigital' ); ?></option>
							<?php foreach ( $partner_country_terms as $partner_country_term ): ?>
								<option <?php selected( $partner_country_term->slug, $param_country, true ); ?> value="<?php echo esc_attr( $partner_country_term->slug ); ?>"><?php echo esc_html( $partner_country_term->name ); ?></option>
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
				
				<?php fbiamdigital_the_infinite_load_button(); ?>
			</div>

			
		</div>
	</section>

<?php else:

	get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();
