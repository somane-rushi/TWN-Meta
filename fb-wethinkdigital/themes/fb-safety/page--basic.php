<?php
/**
 * Template Name: Basic Page
 * The template for displaying all pages
 *
 * @package bedrock
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="page-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main page-interior col-10 offset-1 ten columns offset-by-one" id="main">

				<?php 
					while ( have_posts() ) : the_post();
						get_template_part( 'loop-templates/content', 'page' );
					endwhile;
				?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php 
	get_footer();
