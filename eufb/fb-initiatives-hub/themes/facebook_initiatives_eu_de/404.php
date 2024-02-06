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
            <h4><?php esc_html_e( 'Diese Seite ist nicht verfügbar.', 'facebook-initiatives' ); ?></h4>
            <p><?php esc_html_e( 'Entweder funktioniert der von dir angeklickte Link nicht oder die Seite wurde entfernt.', 'facebook-initiatives' ); ?></p>

        </div><!-- .page-content -->

    </div><!-- #primary -->

<?php
get_footer();
