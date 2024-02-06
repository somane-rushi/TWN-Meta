<?php
/**
 * Submodule: THREE COLUMNS, TEXT & LINKS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset( $args['sub_fields'] ) && ! empty( $args['sub_fields'] ) ) :
	$sub_fields       = $args['sub_fields'];
	$section_group    = fbsafety_fm_get_data( $sub_fields, 'section_group' );
?>

	<!--three-columns-cta-wrap-->
	<div class="columns-cta-wrap ">
		<div class="container">
			<div class="row">
			<?php
					$section_group      = fbsafety_fm_get_data( $sub_fields, 'section_group' );
					?>
				<div class="columns-cta-content">
						<?php
						$main_text_1 = fbsafety_fm_get_data( $section_group, 'main_text_1' );
						echo wp_kses( $main_text_1, allowed_html_tags() );
						$btn_group_1 = fbsafety_fm_get_data( $section_group, 'btn_group_1' );
						$btn_args_1  = array(
							'btn_toggle' => fbsafety_fm_get_data( $section_group, 'btn_toggle_1' ),
							'btn_text'   => fbsafety_fm_get_data( $btn_group_1, 'btn_text' ),
							'btn_link'   => fbsafety_fm_get_data( $btn_group_1, 'btn_link' ),
							'btn_target' => fbsafety_fm_get_data( $btn_group_1, 'btn_target_blank' ),
						);
						get_template_part( 'global-templates/submodules/parts/button', null, $btn_args_1 );
						?>
				</div>
				<div class="columns-cta-content">
						<?php
						$main_text_2 = fbsafety_fm_get_data( $section_group, 'main_text_2' );
						echo wp_kses( $main_text_2, allowed_html_tags() );
						$btn_group_2 = fbsafety_fm_get_data( $section_group, 'btn_group_2' );
						$btn_args_2  = array(
							'btn_toggle' => fbsafety_fm_get_data( $section_group, 'btn_toggle_2' ),
							'btn_text'   => fbsafety_fm_get_data( $btn_group_2, 'btn_text' ),
							'btn_link'   => fbsafety_fm_get_data( $btn_group_2, 'btn_link' ),
							'btn_target' => fbsafety_fm_get_data( $btn_group_2, 'btn_target_blank' ),
						);
						get_template_part( 'global-templates/submodules/parts/button', null, $btn_args_2 );
						?>
				</div>
				<div class="columns-cta-content">
						<?php
						$main_text_3 = fbsafety_fm_get_data( $section_group, 'main_text_3' );
						echo wp_kses( $main_text_3, allowed_html_tags() ); 
						$btn_group_3 = fbsafety_fm_get_data( $section_group, 'btn_group_3' );
						$btn_args_3  = array(
							'btn_toggle' => fbsafety_fm_get_data( $section_group, 'btn_toggle_3' ),
							'btn_text'   => fbsafety_fm_get_data( $btn_group_3, 'btn_text' ),
							'btn_link'   => fbsafety_fm_get_data( $btn_group_3, 'btn_link' ),
							'btn_target' => fbsafety_fm_get_data( $btn_group_3, 'btn_target_blank' ),
						);
						get_template_part( 'global-templates/submodules/parts/button', null, $btn_args_3 );
						?>
				</div>
			</div>
		</div>
	</div>
	<!--three-columns-cta-wrap-->

<?php

endif; // sub_fields.
