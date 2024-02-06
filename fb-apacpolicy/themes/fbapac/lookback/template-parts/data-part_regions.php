<?php
/**
 * Data part = Lookback Regions
 * Used on page-lookback
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$regions__array = array();
$regions_query = new WP_Query( array( 'post_type' => 'lookback_region', 'post_status' => 'publish', 'posts_per_page' => 30 ) );
if ( $regions_query->have_posts() ) :
	while ( $regions_query->have_posts() ) : $regions_query->the_post();
		$ID       = get_the_ID();
		$r_title  = get_the_title($ID);
		$r_link   = get_permalink($ID);
		$r_image  = '';
		$r_color  = '';
		$r_fields = get_post_meta( $ID, 'cptlr_main', true ) ?: array();
		if ( ! empty($r_fields) ) {
			$r_color  = fbapac_fm_get_data( $r_fields, 'main_color' );
			$r_img_id = fbapac_fm_get_data( $r_fields, 'image_square' );
			if ( ! empty($r_img_id) ) {
				$r_image = wp_get_attachment_image_src( $r_img_id, 'square-large' )[0];
			}
		}
		$regions__array[ sanitize_key( get_the_title() ) ] = array( "ID" => $ID, "title" => $r_title, "color" => $r_color, "link" => $r_link, "image" => $r_image );
	endwhile; 
endif;

// alphabetical order
ksort($regions__array);

wp_reset_postdata();
