<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage facebook-initiatives
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	
	<div class="down">
		<!-- <div class="discover__text">
			<?php esc_html_e( 'Discover More', 'facebook-initiatives' ); ?>
		</div> -->
	</div>

<?php get_template_part( 'content', 'stories' ); ?>

<?php

$cat_args   = array(
	'meta_key' => 'cat_position',
	'orderby'  => 'meta_value_num',
	'order'    => 'ASC',
);
$categories = get_categories( $cat_args );

// Loop through categories - our themes
$categories_count = 0;
foreach ( $categories as $category ) {
	// Iterate the category_count - used in css to detect which level of the theme are we in.
	$story_title = get_term_meta( $category->term_id, 'story_title', true );
	$categories_count ++;
	// Get the category title from the formatted field or fall back to the category title in plain text
	if ( '' !== $story_title ) {
		$category_title = nl2br( $story_title );
	} else {
		$category_title = get_cat_name( $category->term_id );
	}
	
	$the_query = new WP_Query( array(
		'cat'                 => $category->term_id, // this is the category SLUG
		'posts_per_page'      => 6,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	) );
	if ( $the_query->have_posts() ) {
		//using an include so we have access to variables in this scope
		include( locate_template( 'template-parts/content-stories-intro-section.php' ) );
		
	} // End Posts if
} // End Categories loop

get_template_part( 'template-parts/content', 'about-us' );


get_footer();

