<?php
/**
 * Template part = Single Lookback Region, Quotes
 * Displayed on content-lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */
$quotes_toggle = false;
$quotes_array  = array();
$quotes = get_post_meta( get_the_ID(), 'cptlr_quotes', true );
if ( ! empty($quotes) ) {
	$quotes_toggle = fbapac_fm_get_data($quotes, 'toggle');
}
if ('1' === $quotes_toggle) :
	$quotes_array = fbapac_fm_get_data($quotes, 'quotes');
	$quotes_count = intval( count($quotes_array) );
	if ( ! empty($quotes_array) ) :
		$owl_classes = 'owl-carousel fbcarousel';
?>

<section class="testimonial-section">
	<div class="testimonial-wrap">
		<h2 class="testimonial-section-title-h2">Advocacy</h2>
		<div class="testimonial-scroll<?php echo ($quotes_count > 1) ? ' ' . esc_attr($owl_classes) : ''; ?>">

		<?php
			foreach ($quotes_array as $quote) :
				$q = $quote['quote_item'];
				$q_img_id = fbapac_fm_get_data($q, 'quote_image');
				$q_image  = '';
				if ( ! empty($q_img_id) ) {
					$q_image  = wp_get_attachment_image_src( $q_img_id, 'thumbnail' )[0];
				}
				$q_body   = fbapac_fm_get_data($q, 'quote_body');
				$q_name   = fbapac_fm_get_data($q, 'quote_name');
				$q_title  = fbapac_fm_get_data($q, 'quote_title');
				$q_fsize  = fbapac_fm_get_data($q, 'quote_font_size');
				$no_image = 'no--image';
		?>
			<div class="testimoni-slide <?php echo esc_attr($q_fsize); ?>">
				<div class="author-info<?php echo empty($q_image) ? ' ' . esc_attr($no_image) : ''; ?>">
				<?php if ( ! empty($q_image) ) : ?>
					<img src="<?php echo esc_url($q_image); ?>" alt="<?php echo esc_attr($q_name); ?>" />
				<?php endif; ?>
				</div>
				<p>
					<?php echo esc_html($q_body); ?>
				</p>
				<span class="name-tag"><?php echo esc_html($q_name); ?></span>
				<span class="name-tag"><?php echo esc_html($q_title); ?></span>
			</div>
		<?php
			endforeach;
		?>

		</div>
	</div>
</section>

<?php 
	endif;//empty
endif;//toggle
