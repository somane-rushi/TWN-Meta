<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					?>
				</header><!-- .page-header -->

				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					the_title();
				endwhile;

				// If no content, include the "No posts found" template.

			endif;
			?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
