<?php
function pp_admin_preview()
{
	global $pagenow;
	if ($pagenow == 'options-general.php') {
?>
		<div id="myModal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<?php echo do_shortcode('[privacy-policy]'); ?>
			</div>
		</div>;
<?php
	}
}
add_action('admin_footer', 'pp_admin_preview');
