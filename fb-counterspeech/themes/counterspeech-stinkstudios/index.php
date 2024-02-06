<?php
/**
 *
 * @package WordPress
 * @subpackage Counterspeech - Stink Studios
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
if ( have_posts() ) :
  /* Start the Loop */
  while ( have_posts() ) : the_post();
        /*
        * Include the Post-Format-specific template for the content.
        * If you want to override this in a child theme, then include a file
        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        */
        the_title();
        the_content();
  endwhile;
endif;
?>

  <?php get_footer();
