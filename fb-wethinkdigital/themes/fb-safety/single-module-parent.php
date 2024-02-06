<?php
/**
 * The template for CUSTOM POST TYPE MODULE [PARENT]
 * This parent template is used for the main module page
 * Includes Overview (if used)
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$the_pid  = get_the_ID();
$fbs_coun = fbsafety_which_country_language()[0];
$fbs_lang = fbsafety_which_country_language()[1];

$which_part = 'cpt-module-parent';

$module_id          = $the_pid;
$module_title       = get_the_title();
$module_number      = intval( get_post_meta( $module_id, 'module_number', true ) );
$module_num_display = ($module_number < 10) ? str_pad($module_number, 2, '0', STR_PAD_LEFT) : $module_number;
$all_module_lessons = get_post_meta( $the_pid, 'lessons' );

// display mobile nav menu
$mobnav_args  = array(
	'which_part' => $which_part,
	'the_pid'    => $the_pid,
);
get_template_part( 'global-templates/submodules/parts/module-nav-mobile', null, $mobnav_args );

// this should always be 0 for the parent (module overview page)
$this_part_order_num = intval( fbsafety_generate_lesson_order_number( $module_id, $the_pid ) );

if ( class_exists('FieldManagerCustomRender') ) :

	$cfm__render  = new FieldManagerCustomRender();

	// top fields
	$group1 = 'mainfields';
	$cfm__render->display( intval($the_pid), sanitize_key($group1), sanitize_key($fbs_lang) );
?>

<!--two-column-content-->
<section class="module-overview">
	<div class="container">
		<div class="row">

			<h2>
				<?php //echo esc_html( $module_num_display ); ?> 
				<?php echo esc_html( $module_title ); ?>
			</h2>

			<div class="module-overview-row">

				<div class="module-overview-sidebar" id="a-module-sidebar-contain">
          <div id="a-module-sidebar">
					<?php
						// display sidebar
						$sidebar_args = array(
							'the_pid'     => $the_pid,
							'which_part'  => $which_part, 
							'module_data' => array(
								'module_id'     => $module_id,
								'module_title'  => $module_title,
								'module_number' => $module_number,
							),
							'lesson_data' => $all_module_lessons
						);
						get_template_part( 'global-templates/submodules/sidebar', null, $sidebar_args );
					?>
					</div>
				</div><!--..module-overview-sidebar-->

				<div class="module-overview-content">

					<?php
						// lesson fields
						$group2 = 'lessons';
						$cfm__render->display( intval($the_pid), sanitize_key($group2), sanitize_key($fbs_lang) );
					?>

				</div>
			</div>

		</div>
	</div>
</section>
<!--two-column-content-->

<?php
	
	// bottom fields
	$group3 = 'bottomfields';
	$cfm__render->display( intval($the_pid), sanitize_key($group3), sanitize_key($fbs_lang) );

endif;

get_footer();
