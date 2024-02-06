<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shemb
 */

?>

	<footer>
    	<div class="container-fluid">
        	<div class="container text-center paddingTB20 ">
        		<p class="noPadding noMargin font14 fontOptLight txtDarkGreen">Copyright © <?php echo esc_html(gmdate("Y")); ?> #SheMeansBusiness. All rights reserved.</p>
        	</div>
        </div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>