<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realitylabs
 */

?>
	<section>
    	<div class="container-full bgRed">
			<p class="text-center txtWhite fontXtraLight margin-bottom-no margin-top-no padding-bottom padding-top font14">
            Copyright © 2021 Meta - Reality Labs Academy.</p>
		</div>
	</section>
    </main>
</div><!-- #page -->

<?php wp_footer(); 
	global $post; $post_slug = $post->post_name;
?>
<script>
jQuery(document).ready(function(){
	var userlogged=localStorage.getItem("fbrealitysdata");
	var wslug = '<?php echo esc_html($post_slug); ?>';
	if( (userlogged==null || userlogged == '') && wslug != 'login')
	{
		window.location="<?php echo esc_url( get_site_url() ); ?>/login/";
		return false;
	}
	
	jQuery("#logsubmit").click(function()
	{
		event.preventDefault();
		var userpwd = $("#usrpwd").val();
		var rurl = '<?php echo esc_url( get_site_url() ); ?>';
		jQuery.ajax({
			type: "post",
			url: '<?php echo esc_url( get_site_url() ); ?>/wp-admin/admin-ajax.php',
			data: {
				action: "loginCheck",
				passw: userpwd,
			},
			success: function(response) {
				if(response.trim()=='empty')
				{
					jQuery("#empty").show();
					jQuery("#fail").hide();
				}
				else if(response.trim()=='fail')
				{
					jQuery("#fail").show();
					jQuery("#empty").hide();
				}
				else if(response.trim()=='success')
				{
					localStorage.setItem("fbrealitysdata", "usertrue");
					window.location.href = rurl;
				}
			}
			
		});
	});

});
</script>

</body>
</html>
