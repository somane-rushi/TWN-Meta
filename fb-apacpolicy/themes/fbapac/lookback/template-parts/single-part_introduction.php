<?php
/**
 * Template part = Single Lookback Region, Introduction
 * Displayed on content-lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$intro_toggle = false;
$introduction = get_post_meta( get_the_ID(), 'cptlr_introduction', true );
if ( ! empty($introduction) ) {
	$intro_toggle = fbapac_fm_get_data($introduction, 'toggle');
}
if ('1' === $intro_toggle) :
	$i__color    = fbapac_fm_get_data($introduction, 'bg_color');
	$i__bg_color = $i__color . '-bg';
	$i__title    = fbapac_fm_get_data($introduction, 'title');
	$i__content  = fbapac_fm_get_data($introduction, 'content');
?>

<section class="two-column-heading-content p-b-100 <?php echo esc_attr($i__bg_color); ?>">
	<div class="container">
		<div class="tchc-row">
			<div class="tc-heading">
				<h2><?php echo esc_html($i__title); ?></h2>
			</div>
			<div class="tc-content">
				<p>
					<?php echo esc_html($i__content); ?>
				</p>
			</div>
		</div>
	</div>
</section>

<?php 
endif;//toggle
