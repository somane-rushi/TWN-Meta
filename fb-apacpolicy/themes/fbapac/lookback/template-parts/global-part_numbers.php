<?php
/**
 * Template part = Lookback, By The Numbers
 * Displayed on page-lookback
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$numbers_toggle = false;
$numbers_array  = array();

// custom post type: lookback_region
if ( is_singular('lookback_region') ) {
	$numbers_fields = get_post_meta( $post->ID, 'cptlr_numbers', true );
}
// page-lookback
if ( is_page_template('lookback/page-lookback.php') ) {
	$numbers_fields = get_post_meta( get_the_ID(), 'lookback_page_numbers', true );
}

if ( ! empty($numbers_fields) ) {
	$numbers_toggle = fbapac_fm_get_data($numbers_fields, 'toggle');
}

if ('1' === $numbers_toggle) :
	$numbers_title   = fbapac_fm_get_data($numbers_fields, 'section_title');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_1');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_2');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_3');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_4');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_5');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_6');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_7');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_8');
	$numbers_array[] = fbapac_fm_get_data($numbers_fields, 'number_9');
?>

<section class="number-container" id="by-the-numbers">
	<div class="container">

		<h2><?php echo esc_html( $numbers_title); ?></h2>

		<div class="tab-container">

			<div class="tab-icon-set">

				<ul class="tabs">

			<?php 
				$i = 0;
				foreach ($numbers_array as $n) :
					$toggle = fbapac_fm_get_data($n, 'toggle');
					if ('1' === $toggle) :
						$i++;
						$icon   = ( !empty(fbapac_fm_get_data($n, 'icon')) ) ? fbapac_fm_get_data($n, 'icon') : 'default'; 
						$number = fbapac_fm_get_data($n, 'number');
			?>
					<li class="tab-link<?php echo (1 == $i) ? ' current' : ''; ?>" data-tab="tab-<?php echo esc_attr($i); ?>">
						<span class="icon-holder">
						<img class="normal-state" src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/icons-numbers/grey/' . $icon . '.svg' ); ?>" alt="Number: <?php echo esc_attr($number); ?>">
						<img class="hover-state" src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/icons-numbers/teal/' . $icon . '.svg' ); ?>" alt="Number (active): <?php echo esc_attr($number); ?>">	
						</span>
					</li>
			<?php
					endif;//toggle
				endforeach;
			?>

				</ul>
			</div>

			<div class="tab-content-preview tab-content-preview-desktop">
				<div class="tab-content-preview-inner">

			<?php 
				$i = 0;
				foreach ($numbers_array as $n) :
					$toggle = fbapac_fm_get_data($n, 'toggle');
					if ('1' === $toggle) :
						$i++;
						$icon        = ( !empty(fbapac_fm_get_data($n, 'icon')) ) ? fbapac_fm_get_data($n, 'icon') : 'default'; 
						$number      = fbapac_fm_get_data($n, 'number');
						$description = fbapac_fm_get_data($n, 'description');
			?>
				<div id="tab-<?php echo esc_attr($i); ?>" class="tab-content-desktop tab-content<?php echo (1 == $i) ? ' current' : ''; ?>">
					<div class="icon-preview"><img class="hover-state" src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/icons-numbers/teal/' . $icon . '.svg' ); ?>" alt="Number (detail): <?php echo esc_attr($number); ?>"></div>
					<h2><?php echo esc_html($number); ?></h2>
					<p><?php echo esc_html($description); ?></p>
				</div>
			<?php
					endif;//toggle
				endforeach;
			?>

				</div>
			</div>

		</div>

		<div class="mobile-tab-scroller mob">
			<div class="tab-content-preview owl-carousel fbcarousel">

			<?php 
				$i = 0;
				foreach ($numbers_array as $n) :
					$toggle = fbapac_fm_get_data($n, 'toggle');
					if ('1' === $toggle) :
						$i++;
						$icon        = ( !empty(fbapac_fm_get_data($n, 'icon')) ) ? fbapac_fm_get_data($n, 'icon') : 'default'; 
						$number      = fbapac_fm_get_data($n, 'number');
						$description = fbapac_fm_get_data($n, 'description');
			?>
				<div id="tab-<?php echo esc_attr($i); ?>" class="tab-content">
					<div class="icon-preview">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/icons-numbers/teal/' . $icon . '.svg' ); ?>" alt="Number (mobile): <?php echo esc_attr($number); ?>">
					</div>
					<h2><?php echo esc_html($number); ?></h2>
					<p><?php echo esc_html($description); ?></p>
				</div>
			<?php
					endif;//toggle
				endforeach;
			?>

			</div>
		</div>

	</div>
</section>

<?php
endif;//toggle
