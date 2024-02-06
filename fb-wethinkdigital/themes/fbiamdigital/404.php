<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header();
?>

	<section class="o-wrap c-error-404">
		<div class="o-layout">
			<div class="o-layout__item u-1/2@xl u-1/2@md u-1/1">
				<div class="c-error-404__img"><img src="<?php echo esc_url( get_theme_file_uri( 'images/error-404.png' ) ); ?>" alt="Page not found"></div>
			</div>
			<div class="o-layout__item u-1/2@xl u-1/2@md u-1/1">
				<div class="c-error-404__body">
					<h1><?php esc_html_e( 'Sorry. This page isn’t available.', 'fbiamdigital' ); ?></h1>
					<p><?php esc_html_e( 'It looks like the link you followed may be broken, or the page has been removed.', 'fbiamdigital' ); ?></p>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();
