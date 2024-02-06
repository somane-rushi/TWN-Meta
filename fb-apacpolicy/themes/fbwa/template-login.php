<?php
/**
 * Template Name: FB Login
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
?>
    
    <?php while ( have_posts() ) : the_post(); ?>
    
    
     <!--"container-wrapper-->
    <div class="container-wrapper" id="top">
        
        <!--banner-wrapper-->
        <div class="page-banner-wrapper shorter-hero" style="background-image:url();">
               <div class="wrapper">
                <div class="page-banner-desc">
                                 <h4>VPN Authentication.</h4>
<?php
                                 if(!empty($_GET['fb-registration']) && strtolower($_GET['fb-registration']) == "yes"){
    echo '<p class="message">Thanks. You have registered and your access is pending approval.
        </p>';
}
else{
        ?>
<p style="color:#f55257;">If you are a Facebook Employee, please switch on your VPN to gain access. 
</p>

<?php
}
?>
                </div>
            </div> 
        </div>
        <!--banner-wrapper-->

        <!--list-post-wrap-->
        <div class="list-post-wrap">
            <div class="wrapper" id="loadmore-content">



<BR><BR>
<?php 
if(!empty($_GET['fb-registration']) && strtolower($_GET['fb-registration']) == "yes"){
    
    } else { ?>
        <div class="reg-form-buttons">
            Still having trouble? Please click below.<BR><BR>
            <a href="/facebook-employee-form/" style="padding: 28px 51px;"> I am a Facebook Employee</a>
            <a href="/external-request-form/" style="padding: 28px 51px;"> I am an External Contractor  </a>
        </div>
        <?php
        // echo do_shortcode('[fbl_login_button redirect="" hide_if_logged="" size="large" type="continue_with" show_face="true"]');
        } ?>


<BR><BR><BR>


            
                
            </div>    
        </div>
        <!--list-post-wrap-->
  
        
    </div>
    <!--container-wrapper-->
    
    
    <?php endwhile; ?>

<?php
get_footer();
