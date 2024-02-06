<?php
/**
 * Template Name: Register
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
                                 <h4><?php the_title(); ?></h4>

                </div>
            </div> 
        </div>
        <!--banner-wrapper-->

        <!--list-post-wrap-->
        <div class="list-post-wrap">
            <div class="wrapper" id="loadmore-content">



<BR><BR>

<div class="custom-registration-inputs">
<?php 
if(is_page('facebook-employee-form')) {
    custom_fb_employee_function(); 
}elseif(is_page('external-request-form')) {
    custom_external_request_function(); 
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
