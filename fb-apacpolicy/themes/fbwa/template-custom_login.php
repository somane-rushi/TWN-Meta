<?php
/**
 * Template Name: Custom Login
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

get_header();
$theme_options = get_option('repo_fbapac');
$hero_content  = $theme_options['latest_hero_content'];


/* if failed */

// Hotfix see: https://wordpressvip.zendesk.com/tickets/115966
if ( isset( $_REQUEST['fail_ip'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
    $fail_ip = ( filter_var( $_REQUEST['fail_ip'], FILTER_VALIDATE_IP ) ) ? wp_kses( $_REQUEST['fail_ip'], array() ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.NonceVerification.Recommended

}
?>
    
    <?php while ( have_posts() ) : the_post(); ?>
    
    
     <!--"container-wrapper-->
    <div class="container-wrapper" id="top">
        
        <!--banner-wrapper-->
        <div class="page-banner-wrapper shorter-hero" style="background-image:url();">
               <div class="wrapper">
                <div class="page-banner-desc">
                                 <h4>Login</h4>

                </div>
            </div> 
        </div>
        <!--banner-wrapper-->

        <!--list-post-wrap-->
        <div class="list-post-wrap">
            <div class="wrapper" id="loadmore-content">



<BR><BR>

<?php if(!empty($_GET['login']) && strtolower($_GET['login']) == "failed"){
    echo '<p class="login-error"><strong>ERROR:</strong> Invalid username and/or password.</p>';
}
?>

<div class="custom-registration-inputs">

<?php if(isset($_GET['action']) == 'lostpassword'){  ?>

    <form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url(wp_lostpassword_url()); ?>" method="post">
    <p>
        <label>Username or E-mail:<br>
        <input type="text" name="user_login" id="user_login" class="input" value="" size="20" tabindex="10"></label>
    </p>
    <input type="hidden" name="redirect_to" value="<?php echo esc_url(get_permalink('login')); ?>">
    <p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Get New Password" tabindex="100"></p>
</form>

<?php }else {
$args = array(
'redirect' => home_url(),
'label_username' => 'Email Address',
'remember' => false
);
wp_login_form( $args ); 
}




?>
</div>



<BR><BR><BR>


            
                
            </div>    
        </div>
        <!--list-post-wrap-->
  
        
    </div>
    <!--container-wrapper-->
    
    
    <?php endwhile; ?>

<?php
get_footer();
