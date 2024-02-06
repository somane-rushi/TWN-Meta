<?php
/**
 * Template part = Lookback, Pillars
 * Displayed on page-lookback
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$pillars_toggle = false;
$pillars_array  = array();
$lookback_page_pillars = get_post_meta( get_the_ID(), 'lookback_page_pillars', true );
if (! empty($lookback_page_pillars) ) {
	$pillars_toggle  = fbapac_fm_get_data($lookback_page_pillars, 'toggle');
	$pillars_title   = fbapac_fm_get_data($lookback_page_pillars, 'section_title');
	$pillars_array[] = fbapac_fm_get_data($lookback_page_pillars, 'pillar_1');
	$pillars_array[] = fbapac_fm_get_data($lookback_page_pillars, 'pillar_2');
	$pillars_array[] = fbapac_fm_get_data($lookback_page_pillars, 'pillar_3');
	$pillars_array[] = fbapac_fm_get_data($lookback_page_pillars, 'pillar_4');
}
if ('1' === $pillars_toggle) :
?>

<section class="boxes--section pillar--section colored-boxes desktop" id="pillars">
	<div class="container">
		<h2><?php echo esc_html( $pillars_title ); ?></h2>
		<div class="box-grid">
		
		<?php 
			if ( ! empty($pillars_array) ) : 
				$i = 0;
				foreach ($pillars_array as $p) :
					$i++;
					$color       = fbapac_fm_get_data($p, 'color');
					$bg_color    = $color . '-bg';
					$color_shade = substr($color, strpos($color, '-') + 1) ?: '';
					$arrow_color = strtok($color, '-');
					if ( in_array( $color_shade, array('core', 'deep'), true ) ) {
						$arrow_color = $arrow_color . '-light';
					}
		?>
			<div class="box-column">
				<div class="box-column-inner">
					<div class="color-box <?php echo esc_attr( $bg_color ); ?>" data-num="<?php echo esc_attr($i); ?>">
						<span class="arrow-icon <?php echo esc_attr( $arrow_color ); ?>"></span>
						<h4><?php echo esc_html( fbapac_fm_get_data($p, 'title') ); ?></h4>
					</div>
					<div class="inner-content <?php echo esc_attr( $bg_color ); ?>" id="pillar-inner-<?php echo esc_attr($i); ?>">
						<?php echo esc_html( fbapac_fm_get_data($p, 'content') ); ?>
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

<section class="pillar--section piller-content mob">
	<div class="container">
		<h2><?php echo esc_html( $pillars_title ); ?></h2>

	<?php 
		if ( ! empty($pillars_array) ) : 
			foreach ($pillars_array as $p) :
	?>
		<div class="content-module">
			<p>
				<?php echo esc_html( fbapac_fm_get_data($p, 'content') ); ?>
			</p>
		</div>
	<?php 
			endforeach;
		endif; 
	?>

	</div>
</section>

<?php
endif;//toggle
