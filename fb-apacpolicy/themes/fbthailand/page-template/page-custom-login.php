<?php
/*
Template Name: Login Custom Page
*/

get_header();
?>
<!--"container-wrapper-->
    <div class="container-wrapper" id="top">
		<div class="page-banner-wrapper shorter-hero" style="background-image:url();">
			<div class="wrapper">
				<div class="page-banner-desc">
					<h4>Login</h4>
                    <BR><BR>

					<?php if(!empty($_GET['login']) && strtolower($_GET['login']) == "failed"){
                        echo '<p class="login-error"><strong>ERROR:</strong> Invalid username and/or password.</p>';
                    }
                    ?>
                    <?php if(isset($_GET['action']) == 'lostpassword'){  ?>
                    
                    <?php }else {
						$args = array(
						'redirect' => home_url(),
						'label_username' => 'Email Address',
						'remember' => false
						);
						wp_login_form( $args ); 
					} ?>
                    
                </div>
            </div> 
        </div>
        <!--banner-wrapper-->
	</div>
<?php
get_footer();
