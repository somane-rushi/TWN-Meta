<?php
/**
 * Submodule Part: SIDEBAR, MAIN DOWNLOADS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['all_module_downloads']) ) :

	$all_module_downloads = fbsafety_fm_get_data($args, 'all_module_downloads');

	if ( ! empty($all_module_downloads) ) :
		$module_download = fbsafety_fm_get_data($all_module_downloads, 'module_download');
		$guide_download  = fbsafety_fm_get_data($all_module_downloads, 'guide_download');
?>

<div class="download-links desktop">
<?php
		if ( ! empty($module_download) ) :
?>
	<a 
		href="<?php echo esc_url( fbsafety_fm_get_data($module_download, 'link') ); ?>" 
		download
	>
		<?php echo esc_html( fbsafety_fm_get_data($module_download, 'text') ); ?>
	</a>
<?php
		endif;//module_download
		if ( ! empty($guide_download) ) :
?>
	<a 
		href="<?php echo esc_url( fbsafety_fm_get_data($guide_download, 'link') ); ?>" 
		download
	>
		<?php echo esc_html( fbsafety_fm_get_data($guide_download, 'text') ); ?>
	</a>
<?php
		endif;//guide_download
?>
</div><!--../desktop-->

<?php
		// don't show mobile links on resources pages
		if ( isset($args['which_part']) && 'cpt-module-child' !== $args['which_part'] ) :
?>
<div class="download-links mobile">
<?php 
			if ( ! empty($module_download) ) :
?>
	<a 
		href="<?php echo esc_url( fbsafety_fm_get_data($module_download, 'link') ); ?>" 
		download
	>
		<?php echo esc_html( fbsafety_fm_get_data($module_download, 'text') ); ?>
	</a>
	<?php
			endif;//$module_download
			if ( ! empty($guide_download) ) :
?>
	<a 
		href="<?php echo esc_url( fbsafety_fm_get_data($guide_download, 'link') ); ?>" 
		download
	>
		<?php echo esc_html( fbsafety_fm_get_data($guide_download, 'text') ); ?>
	</a>
<?php
			endif;//guide_download
?>
</div><!--../mobile-->
<?php
		endif;
?>

<?php
	endif;//all_module_downloads	

endif;//args
