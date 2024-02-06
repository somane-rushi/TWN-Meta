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
            <h4><?php esc_html_e( 'Cette page n’est pas disponible', 'facebook-initiatives' ); ?></h4>
            <p><?php esc_html_e( 'Le lien que vous avez suivi est peut-être rompu, ou la page a été supprimée.', 'facebook-initiatives' ); ?></p>

        </div><!-- .page-content -->

    </div><!-- #primary -->

<?php
get_footer();
