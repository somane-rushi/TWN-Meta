<?php
/**
 * Card part = INFO
 * Used for custom post type = lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$arrow__color = 'white';
if ( in_array( $shade, array('light', 'pale'), true ) ) {
	$arrow__color = $main__color;
}

$card_front  = fbapac_fm_get_data($card, 'card_front');
$card_back   = fbapac_fm_get_data($card, 'card_back');
$card_person = fbapac_fm_get_data($card, 'card_person');
$card_imgid  = fbapac_fm_get_data($card, 'card_image');
$card_image  = '';
if ( ! empty($card_imgid) ) {
	$current_image = wp_get_attachment_image_src( $card_imgid, 'square-large' )[0];
}
?>

			<div class="box-column" data-identifier="<?php echo esc_attr($identifier); ?>" data-num="<?php echo esc_attr($num); ?>" data-screen="<?php echo esc_attr($screen); ?>">
				<div class="box-column-inner">
					<div class="color-box <?php echo esc_attr($main__color); ?>-<?php echo esc_attr($shade); ?>-bg">
						<span class="arrow-icon <?php echo esc_attr($arrow__color); ?>"></span>
						<div class="more-content">
							<p>
								<?php echo esc_html($card_front); ?>
							</p>
						</div>
					</div>
					<div class="inner-content <?php echo esc_attr($main__color); ?>-<?php echo esc_attr($shade); ?>-bg" id="<?php echo esc_attr($identifier); ?>-<?php echo esc_attr($num); ?>">
						<p>
							<?php echo esc_html($card_back); ?>
						</p>
					</div>
				</div>
			</div>