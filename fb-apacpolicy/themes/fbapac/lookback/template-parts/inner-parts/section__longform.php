<?php
/**
 * Reusable section: longform-content
 * Used for custom post type = lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$lf_bgcolor = $main__color . '-deep-bg';
if ( ! empty(fbapac_fm_get_data($long_form, 'lf_bgcolor')) ) {
	$lf_bgcolor = fbapac_fm_get_data($long_form, 'lf_bgcolor'). '-bg';
}
?>

<section id="longform-<?php echo esc_attr($identifier); ?>" class="two-column-heading-content longform-content <?php echo esc_attr($lf_bgcolor); ?>">
	<div class="container">
		<div class="tchc-row">
			<div class="tc-heading">
				<h6 class="uc"><?php echo esc_html( fbapac_fm_get_data($long_form, 'lf_subtitle') ); ?></h6>
				<h2>
					<?php echo esc_html( fbapac_fm_get_data($long_form, 'lf_title') ); ?>
				</h2>
			</div>
			<div class="tc-content">
				<div class="content-scroll" data-howmany="1">
					
					<div class="carousel-content">
						<p>
							<?php echo esc_html( fbapac_fm_get_data($long_form, 'lf_content') ); ?>
						</p>
					</div>

				</div>
				
			</div>
		</div>
	</div>
</section>
