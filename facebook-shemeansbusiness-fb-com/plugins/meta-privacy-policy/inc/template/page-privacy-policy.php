<?php

/**
 * Template Name: Privacy Policy Plugin
 * Needs to have Privacy Policy Generator Plugin Active
 * @package WordPress
 */

get_header();

?>

<?php
while (have_posts()) : the_post(); ?>
	<?php echo do_shortcode('[privacy-policy]'); ?>
<?php
endwhile; // End of the loop.
?>

<?php
get_footer();
