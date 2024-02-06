<?php
/**
 * Template part = Single Lookback Region, Conclusion
 * Displayed on content-lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$conclude_toggle = false;
$conclusion      = get_post_meta( get_the_ID(), 'cptlr_conclusion', true );
if ( ! empty($conclusion) ) {
	$conclude_toggle = fbapac_fm_get_data($conclusion, 'toggle');
}
if ('1' === $conclude_toggle) :
	$c__color      = fbapac_fm_get_data($conclusion, 'bg_color');
	$c__bg_color   = $c__color . '-bg';
	$c__main_color = strtok($c__color, '-');
	$c__title      = fbapac_fm_get_data($conclusion, 'title');
	$c__content    = fbapac_fm_get_data($conclusion, 'content');
?>

<section class="two-column-heading-content <?php echo esc_attr($c__bg_color); ?>">
	<div class="container">
		<div class="tchc-row">
			<div class="tc-heading">
				<h2><?php echo esc_html($c__title); ?></h2>
			</div>
			<div class="tc-content">
				<p>
					<?php echo esc_html($c__content); ?>
				</p>
			</div>
		</div>
		<div class="tchc-row">
			<div class="tc-heading">
			</div>
			<div class="tc-content pt80">
			<?php 
				if ( function_exists('wpcom_vip_get_adjacent_post') ) {
					$prev_post = wpcom_vip_get_adjacent_post( false, '', true);
					$next_post = wpcom_vip_get_adjacent_post( false, '', false);
				} else {
					$prev_post = get_adjacent_post( false, '', true);
					$next_post = get_adjacent_post( false, '', false);
				}
				if ( ! empty($prev_post) ) :
					$prev_link = get_permalink($prev_post->ID);
			?>
				<a class="arrow-btn <?php echo esc_attr($c__main_color); ?>" href="<?php echo esc_url($prev_link); ?>" title="Next Country"><span class="nextprevious">Previous Country</span></a>
			<?php
				endif;
			?>
			<?php 
				if ( ! empty($next_post) ) :
					$next_link = get_permalink($next_post->ID);
			?>
				<a class="arrow-btn <?php echo esc_attr($c__main_color); ?>" href="<?php echo esc_url($next_link); ?>" title="Next Country"><span class="nextprevious right">Next Country</span></a>
			<?php
				endif;
			?>
			</div>
		</div>
	</div>
</section>

<?php 
endif;//toggle
