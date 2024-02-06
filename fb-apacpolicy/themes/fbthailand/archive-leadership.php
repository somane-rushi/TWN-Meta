<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thailand
 */

get_header();
?>
<?php $fields = get_option( "archive_leadership", array() );
$headbg = wp_get_attachment_url($fields['bg_image']); 
if( ! empty($headbg) ):
?>
<section class="blog-section">
	<div class="container-fluid">
		<div class="row">
        	<div class="blogDiv" style="background:url(<?php echo esc_url( $headbg ); ?>);background-size: cover; background-position: top center; background-attachment: fixed;)" >
            	<?php if ( ! empty( $fields['heading'] ) ): ?>
				<h1 class="txtWhite text-left"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>		
<?php endif; ?>
<section>
	<div class="conatiner-fluid">

<?php if ( have_posts() ) : ?>

<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
?>
</div>
</section>



<?php
get_footer();
