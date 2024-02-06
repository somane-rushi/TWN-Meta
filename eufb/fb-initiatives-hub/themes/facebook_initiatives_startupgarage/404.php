<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package facebook-initiatives
 */

get_header(); ?>

    <div class="container">
        <header class="page-header">
            <h2 class="page-title"><?php esc_html_e( 'Error 404', 'facebook-initiatives' ); ?></h2>
        </header><!-- .page-header -->

        <div class="page-content">
            <h4><?php esc_html_e( 'This page isn\'t available.', 'facebook-initiatives' ); ?></h4>
            <p><?php esc_html_e( 'The link you followed may be broken, or the page may have been removed.', 'facebook-initiatives' ); ?></p>

        </div><!-- .page-content -->

    </div><!-- #primary -->

<?php
get_footer();