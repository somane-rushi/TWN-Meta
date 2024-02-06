<?php
/**
 * Submodule: FAQ QUESTIONS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $faq_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $faq_toggle) :
  	$the_questions  = fbsafety_fm_get_data($sub_fields, 'content');
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
			if ( ! empty($the_questions) ) :
				foreach($the_questions as $question) :
					$faq   = fbsafety_fm_get_data($question, 'a_question');
					$faq_q = fbsafety_fm_get_data($faq, 'question');
					$faq_a = fbsafety_fm_get_data($faq, 'answer');
					if ( !empty($faq_q) && !empty($faq_a) ) :
		?>

			<h4>
				<?php echo esc_html( $faq_q ); ?>
			</h4>
			<?php 
				echo wp_kses( $faq_a, allowed_html_tags() );
			?>

		<?php
					endif;
				endforeach;
			endif;
		?>

		</div><!--..desktop-->

		<div class="faq-content mobile">

			<div class="acc_trigger_three accordion active">
				<h2>
					<?php echo esc_html( $the_title) ; ?>
				</h2>
			</div>

			<div class="acc_container_three panel show">

		<?php
			if ( ! empty($the_questions) ) :
				foreach($the_questions as $question) :
					$faq   = fbsafety_fm_get_data($question, 'a_question');
					$faq_q = fbsafety_fm_get_data($faq, 'question');
					$faq_a = fbsafety_fm_get_data($faq, 'answer');
					if ( !empty($faq_q) && !empty($faq_a) ) :
		?>

			<h4>
				<?php echo esc_html( $faq_q ); ?>
			</h4>
			<?php 
				echo wp_kses( $faq_a, allowed_html_tags() );
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
