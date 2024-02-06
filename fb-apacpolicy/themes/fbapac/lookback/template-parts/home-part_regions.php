<?php
/**
 * Template part = Lookback, Regions
 * Displayed on page-lookback
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$regions_toggle = false;
$lookback_page_regions = get_post_meta( get_the_ID(), 'lookback_page_regions', true );
if (! empty($lookback_page_regions) ) {
	$regions_toggle = fbapac_fm_get_data($lookback_page_regions, 'toggle');
	$regions_title  = fbapac_fm_get_data($lookback_page_regions, 'section_title');
}
if ('1' === $regions_toggle) :
	if ( empty($regions__array) ) {
		include( locate_template( 'lookback/template-parts/data-part_regions.php') );
	}
?>

<section class="boxes--section colored-boxes" id="regions">
	<div class="container">
		<h2><?php echo esc_html( $regions_title ); ?></h2>
		<div class="box-grid">
			
		<?php 
			if ( ! empty($regions__array) ) : 
				$i = 0;
				foreach ($regions__array as $r) :
					$i++;
					$r_title  = fbapac_fm_get_data($r, 'title');
					$r_link   = fbapac_fm_get_data($r, 'link');
					$r_image  = fbapac_fm_get_data($r, 'image');
					$r_color  = fbapac_fm_get_data($r, 'color');
					if (empty($r_color)) {
						$r_color = 'blue-light';
					}
					$r_bg_color     = $r_color . '-bg';
					$r_bg_color_rev = str_replace(array('light','pale'), array('deep','deep'), $r_bg_color);
					$r_main_color   = strtok($r_color, '-');
		?>			
			<div class="box-column">
				<div class="box-column-inner">
					<div class="color-box <?php echo esc_attr( $r_bg_color ); ?>" data-num="<?php echo esc_attr($i); ?>" style="background-image:url('<?php echo esc_url( $r_image ); ?>');">
						<a href="<?php echo esc_url( $r_link ); ?>" class="mobile-link mob"></a>
						<div class="box-overlay"></div>
						<span class="arrow-icon <?php echo esc_attr( $r_main_color ); ?>"></span>
						<h4 class="<?php echo esc_attr( $r_color ); ?>"><?php echo esc_html( $r_title ); ?></h4>
					</div>
					<div class="inner-content full-width <?php echo esc_attr( $r_bg_color ); ?>" id="region-inner-<?php echo esc_attr($i); ?>">
						<a href="<?php echo esc_url( $r_link ); ?>" class="lookback-button <?php echo esc_attr( $r_bg_color_rev ); ?>">
							View Country
						</a>
					</div>
				</div>
			</div>
		<?php 
				endforeach;
			endif; 
		?>

		</div>
	</div>
</section>

<?php
endif;//toggle
