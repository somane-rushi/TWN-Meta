<?php
/**
 * Template part = Single Lookback Region, SOCIAL IMPACT
 * Displayed on lookback/content-lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$identifier  = 'social';
$main__color = 'blue';
$current     = get_post_meta( get_the_ID(), 'cptlr_social_impact', true );

$shade_array    = array( 'core', 'deep', 'light', 'light', 'deep', 'core');
$current_toggle = false;
$current_array  = array();
$current_image  = '';

if ( ! empty($current) ) {
	$current_toggle = fbapac_fm_get_data($current, 'toggle');
}

if ('1' === $current_toggle) :

	$current_title_1 = fbapac_fm_get_data($current, 'section_title_1');
	$current_title_2 = fbapac_fm_get_data($current, 'section_title_2');
	$current_imgid   = fbapac_fm_get_data($current, 'bg_image');
	if ( ! empty($current_imgid) ) {
		$current_image = wp_get_attachment_image_src( $current_imgid, 'full' )[0];
	}

	$current_array = fbapac_fm_get_data($current, 'cards');
	if ( ! empty($current_array) ) :
		shuffle($current_array);
		include( locate_template( 'lookback/template-parts/inner-parts/section__geometric.php' ) );
	endif;

	$long_form = fbapac_fm_get_data($current, 'long_form');
	if ( ! empty($long_form ) ) :
		$lf_toggle = fbapac_fm_get_data($long_form, 'toggle');
		if ('1' === $lf_toggle) :
			include( locate_template( 'lookback/template-parts/inner-parts/section__longform.php' ) );
		endif;
	endif;
	
endif;//toggle
