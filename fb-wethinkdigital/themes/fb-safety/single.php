<?php
/**
 * The template for displaying all single posts.
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="container" id="single-wrapper" tabindex="-1">

	<div class="row">

		<div class="site-main page-interior twelve columns" id="content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'loop-templates/content', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->

	</div><!-- .row -->

</div><!-- #content -->

<?php
get_footer();
