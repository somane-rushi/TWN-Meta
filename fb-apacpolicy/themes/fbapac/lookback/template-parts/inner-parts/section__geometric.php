<?php
/**
 * Reusable section: geometric-square-area
 * Used for custom post type = lookback_region
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$allowed_ctypes = array(
	'empty',
	'data',
	'info',
	'quote'
);
$six = range(0,5);
shuffle($six);
?>

<section id="geometric-<?php echo esc_attr($identifier); ?>" class="geometric-square-area <?php echo esc_attr($main__color); ?>-deep-bg" style="background-image: url(<?php echo esc_url($current_image); ?>);">
	<div class="container">
		<div class="special-title">
			<img src="<?php echo esc_url($current_image); ?>" alt="<?php echo esc_attr($current_title_1); ?> <?php echo esc_attr($current_title_2); ?>">
			<div class="img-overlay"></div>
			<h2 class="<?php echo esc_attr($main__color); ?>-light"><?php echo esc_html($current_title_1); ?><br /><?php echo esc_html($current_title_2); ?></h2>
		</div>
		<div class="box-grid gs-row desktop">
			
			<div class="box-column"></div>
			<div class="box-column"></div>			

		<?php
			if ( isset( $current_array[intval($six[0])] ) ) {
				$num    = intval(1);
				$shade  = $shade_array[0];
				$screen = 'desktop';
				$card   = $current_array[intval($six[0])]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			} else {
				get_template_part( 'lookback/template-parts/inner-parts/card__empty' );
			}
		?>

		<?php
			if ( isset( $current_array[intval($six[1])] ) ) {
				$num    = intval(2);
				$shade  = $shade_array[1];
				$screen = 'desktop';
				$card   = $current_array[intval($six[1])]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			} else {
				get_template_part( 'lookback/template-parts/inner-parts/card__empty' );
			}
		?>

			<div class="box-column"></div>

		<?php
			if ( isset( $current_array[intval($six[2])] ) ) {
				$num    = intval(3);
				$shade  = $shade_array[2];
				$screen = 'desktop';
				$card   = $current_array[intval($six[2])]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			} else {
				get_template_part( 'lookback/template-parts/inner-parts/card__empty' );
			}
		?>

			<div class="box-column"></div>

		<?php
			if ( isset( $current_array[intval($six[3])] ) ) {
				$num    = intval(4);
				$shade  = $shade_array[3];
				$screen = 'desktop';
				$card   = $current_array[intval($six[3])]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			} else {
				get_template_part( 'lookback/template-parts/inner-parts/card__empty' );
			}
		?>

		<?php
			if ( isset( $current_array[intval($six[4])] ) ) {
				$num    = intval(5);
				$shade  = $shade_array[4];
				$screen = 'desktop';
				$card   = $current_array[intval($six[4])]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			} else {
				get_template_part( 'lookback/template-parts/inner-parts/card__empty' );
			}
		?>

			<div class="box-column"></div>

		<?php
			if ( isset( $current_array[intval($six[5])] ) ) {
				$num    = intval(6);
				$shade  = $shade_array[5];
				$screen = 'desktop';
				$card   = $current_array[intval($six[5])]['card_item'];	
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			} else {
				get_template_part( 'lookback/template-parts/inner-parts/card__empty' );
			}
		?>

			<div class="box-column"></div>

		</div>


		<div class="box-grid gs-row mob owl-carousel fbcarousel">
					
		<?php
			if ( isset($current_array[0]) ) :
				$num    = intval(1);
				$shade  = $shade_array[0];
				$screen = 'mobile';
				$card   = $current_array[0]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			endif;
		?>

		<?php
			if ( isset($current_array[1]) ) :
				$num    = intval(2);
				$shade  = $shade_array[1];
				$screen = 'mobile';
				$card   = $current_array[1]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			endif;
		?>

		<?php
			if ( isset($current_array[2]) ) :
				$num    = intval(3);
				$shade  = $shade_array[2];
				$screen = 'mobile';
				$card   = $current_array[2]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			endif;
		?>

		<?php
			if ( isset($current_array[3]) ) :
				$num    = intval(4);
				$shade  = $shade_array[3];
				$screen = 'mobile';
				$card   = $current_array[3]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			endif;
		?>

		<?php
			if ( isset($current_array[4]) ) :
				$num    = intval(5);
				$shade  = $shade_array[4];
				$screen = 'mobile';
				$card   = $current_array[4]['card_item'];
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			endif;
		?>

		<?php
			if ( isset($current_array[5]) ) :
				$num    = intval(6);
				$shade  = $shade_array[5];
				$screen = 'mobile';
				$card   = $current_array[5]['card_item'];	
				$ctype  = (!empty($card['card_type'])) ? $card['card_type'] : 'empty';
				$ctype  = sanitize_key($ctype);
				if ( in_array($ctype, $allowed_ctypes, true) ) {
					include( locate_template( 'lookback/template-parts/inner-parts/card__' . esc_attr($ctype) . '.php' ) );
				}
			endif;
		?>
			
		</div>

	</div>
</section>