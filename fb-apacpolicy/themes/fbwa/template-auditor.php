<?php
/**
 * Template Name: Media File Auditor
 * Determine access rights before allowing to view/download
 * Get contents of media and echo to mask full path to asset
 *
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$asset_denied = true;  

if ( isset( $_GET['fid'] ) ) {

    $fid = esc_attr( sanitize_key( $_GET['fid'] ) );

    // check if hex
    if ( ctype_xdigit($fid) && (strlen($fid) % 2 === 0) ) {

        $the_post_id = intval( base64_decode( hex2bin( $fid ) ) );

        // post_id must be numeric
        if ( is_numeric($the_post_id) ) {

            $file_url = get_post_meta($the_post_id, 'asset_url', true) ?: '';

            if ( ! empty($file_url) ) {

                $asset_denied  = false;
                $asset_parse   = wp_parse_url( $file_url );
                $asset_path    = $asset_parse['path'];
                $response      = vip_safe_wp_remote_get( esc_url( home_url() . $asset_path ), false, 3, 9, 10 );

                // echo only on successful response
                if ( is_wp_error( $response ) ) {
                    wp_die( 'Asset retrieval unsuccessful.' );
                } else {
                    $file_mime = isset($response['content-type']) ? sanitize_mime_type($response['content-type']) : '';
                    header('Content-Type: ' . $file_mime);
                    echo wp_remote_retrieve_body( $response );
                }

                wp_die();

            } else {
            
                wp_die( 'Error retrieving asset.' );

            }

        }

    }


}

if (true === $asset_denied) { 
    wp_die( 'Not authorized.' );
}
    