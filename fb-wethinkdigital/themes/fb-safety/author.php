<?php
/**
 * The template for displaying the author pages.
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="container" id="page-wrapper" tabindex="-1">

	<div class="row">

		<div class="site-main page-interior twelve columns" id="content">

			<header class="page-header default-page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'loop-templates/content' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->

	</div><!-- .row -->

</div><!-- #content -->


<?php 
	get_footer();
