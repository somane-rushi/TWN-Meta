<?php
/*
Template Name: Login Page
*/

get_header();
?>
<!--"container-wrapper-->
    <div class="container-wrapper" id="top">
		<div class="page-banner-wrapper shorter-hero" style="background-image:url();">
			<div class="wrapper">
				<div class="page-banner-desc">
					<h4>VPN Authentication.</h4>
					<?php
						if(!empty($_GET['fb-registration']) && strtolower($_GET['fb-registration']) == "yes"){
							echo '<p class="message">Thanks. You have registered and your access is pending approval.</p>';
						}
						else{ ?>
        				<p style="color:#9c2b2e;">If you are a Facebook Employee, please switch on your VPN to gain access. </p>
                        <?php } ?>
                </div>
            </div> 
        </div>
        <!--banner-wrapper-->
	</div>
<?php
get_footer();
