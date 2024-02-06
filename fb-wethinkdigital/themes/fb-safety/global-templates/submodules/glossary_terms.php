<?php
/**
 * Submodule: GLOSSARY TERMS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $glossary_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $glossary_toggle) :
  	$the_terms      = fbsafety_fm_get_data($sub_fields, 'content');
  	$divider_toggle = fbsafety_fm_get_data($sub_fields, 'divider_toggle');
  	$the_title      = fbsafety_fm_get_data($sub_fields, 'title');
?>

<div class="container small">
  <div class="row">

		<div class="faq-content desktop">

		<?php
			if ('1' === $divider_toggle) :
		?>
			<hr>
		<?php
			endif;
		?>

			<h2>
				<?php echo esc_html( $the_title) ; ?>
			</h2>

		<?php
			if ( ! empty($the_terms) ) :
				foreach($the_terms as $each_term) :
					$the_term = fbsafety_fm_get_data($each_term, 'a_term');
					$term_t   = fbsafety_fm_get_data($the_term, 'term');
					$term_d   = fbsafety_fm_get_data($the_term, 'definition');
					if ( !empty($term_t) && !empty($term_d) ) :
		?>

			<h4>
				<?php echo esc_html( $term_t ); ?>
			</h4>
			<?php 
				echo wp_kses( $term_d, allowed_html_tags() );
			?>

		<?php
					endif;
				endforeach;
			endif;
		?>

		</div><!--..desktop-->

		<div class="faq-content mobile">

			<div class="acc_trigger_three accordion_2 active">
				<h2>
					<?php echo esc_html( $the_title) ; ?>
				</h2>
			</div>

			<div class="acc_container_three panel_2 show">

		<?php
			if ( ! empty($the_terms) ) :
				foreach($the_terms as $each_term) :
					$the_term = fbsafety_fm_get_data($each_term, 'a_term');
					$term_t   = fbsafety_fm_get_data($the_term, 'term');
					$term_d   = fbsafety_fm_get_data($the_term, 'definition');
					if ( !empty($term_t) && !empty($term_d) ) :
		?>

			<h4>
				<?php echo esc_html( $term_t ); ?>
			</h4>
			<?php 
				echo wp_kses( $term_d, allowed_html_tags() );
			?>

		<?php
					endif;
				endforeach;
			endif;
		?>

			</div>

		</div><!--..mobile-->

  </div>
</div>

<?php
  endif;//toggle
endif;//sub_fields
