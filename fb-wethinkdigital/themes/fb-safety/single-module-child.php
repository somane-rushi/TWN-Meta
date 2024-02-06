<?php
/**
 * The template for CUSTOM POST TYPE MODULE [CHILD]
 * This child template is only used for the resources subpage of an individual module
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$the_pid  = get_the_ID();
$fbs_coun = fbsafety_which_country_language()[0];
$fbs_lang = fbsafety_which_country_language()[1];

$which_part = 'cpt-module-child';

// use module ID for overall data
$module_id          = wp_get_post_parent_id( $the_pid );
$module_title       = get_the_title( $module_id );

$module_number      = intval( get_post_meta( $module_id, 'module_number', true ) );
$module_num_display = ($module_number < 10) ? str_pad($module_number, 2, '0', STR_PAD_LEFT) : $module_number;
$all_module_lessons = get_post_meta( $module_id, 'lessons' );

// display mobile nav menu
$mobnav_args  = array(
	'which_part' => $which_part,
	'the_pid'    => $the_pid,
);
get_template_part( 'global-templates/submodules/parts/module-nav-mobile', null, $mobnav_args );

// use module ID for top sections
if ( class_exists('FieldManagerCustomRender') ) :
	$cfm__render = new FieldManagerCustomRender();
	$group1      = 'mainfields';
	$cfm__render->display( intval($module_id), sanitize_key($group1), sanitize_key($fbs_lang) );
endif;
// ..use module ID for top sections

// this should always be last for 'resources child'
$this_part_order_num = intval( fbsafety_generate_lesson_order_number( $module_id, $the_pid ) );
?>

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

				<div class="module-overview-content resources-content">
					<p style="position:relative;">
						<a style="position:absolute; top:-100px;" id="<?php echo esc_attr( 'anchor-' . $module_number . '.' . $this_part_order_num ); ?>"></a>
					</p>
					<h3>
					<?php
						//echo esc_html( $module_number . '.' . $this_part_order_num . ' ' . get_the_title() );
						echo esc_html( get_the_title() );
					?>
					</h3>

					<span class="resources-content-main">
					<?php
						the_content();
					?>
					</span>

					<?php
						// display all resources for this module
						$sidebar_args = array(
							'the_pid'     => $the_pid,
							'which_part'  => 'cpt-module-child',
						);
						get_template_part( 'global-templates/submodules/parts/all_resources_guidelines', null, $sidebar_args );
					?>

					<?php
						$global_fields        = get_option('global_fields');
						$finished_module_text = fbsafety_fm_get_data($global_fields, 'finished_module_text');
						if ( ! empty($finished_module_text) ) :
					?>
					<!--
					<div class="last-lesson-banner">
						<?php //echo esc_html($finished_module_text); ?>
					</div>
					-->
					<?php
						endif;
					?>

					<?php
						// prev & next links
						$prev_next_args = array(
							'lesson_data'  => $all_module_lessons, 
							'module_id'    => $module_id,
							'order_num'    => $this_part_order_num,
							'the_pid'      => $the_pid,
							'is_resources' => true
						);
						get_template_part( 'global-templates/submodules/parts/prev_next', null, $prev_next_args );
					?>

				</div>
			</div>

		</div>
	</div>
</section>

<?php
// use module ID for bottom sections
if ( class_exists('FieldManagerCustomRender') ) :
	$cfm__render = new FieldManagerCustomRender();
	$group2      = 'bottomfields';
	$cfm__render->display( intval($module_id), sanitize_key($group2), sanitize_key($fbs_lang) );
endif;
// ..use module ID for bottom sections

get_footer();
