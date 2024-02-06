<?php
/**
 * Template Name: FAQ
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

get_header();
$theme_options      = get_option('repo_fbapac');
$hero_content       = $theme_options['faq_hero_content'];
$search_faq_title   = $theme_options['search_faq_title'];
$search_faq_content = $theme_options['search_faq_content'];
$site_faq_title     = $theme_options['site_faq_title'];
$site_faq_content   = $theme_options['site_faq_content'];
?>
    
    <?php while ( have_posts() ) : the_post(); ?>
    
     <!--"container-wrapper-->
    <div class="container-wrapper" id="top">
        
        <!--banner-wrapper-->
        <div class="page-banner-wrapper" style="background-image:url();">
            <div class="wrapper">
                <div class="page-banner-desc">
                    <?php echo wp_kses( $hero_content, array( 'h1' => array() , 'h2' => array() , 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(), 'p' => array('id' => array(),'class' => array()), 'span' => array('id' => array(),'class' => array()), 'a' => array('href' => array(),'title' => array()), 'strong' => array(), 'br' => array() ) ); ?>
                </div>
            </div> 
        </div>
        <!--banner-wrapper-->

        <div class="faq-container">

            <div class="row">

                <div class="left">
                    <h5><?php echo esc_attr($search_faq_title); ?></h5>
                </div>


                <div class="right">
                    <?php echo wp_kses( $search_faq_content, array( 'h1' => array() , 'h2' => array() , 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(), 'p' => array('id' => array(),'class' => array()), 'span' => array('id' => array(),'class' => array()), 'a' => array('href' => array(),'title' => array()), 'strong' => array() ) ); ?>
                </div>

            </div>

            <div class="row">

                <div class="left">
                    <h5><?php echo esc_attr($site_faq_title); ?></h5>
                </div>


                <div class="right">
                    <?php echo wp_kses( $site_faq_content, array( 'h1' => array() , 'h2' => array() , 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(), 'p' => array('id' => array(),'class' => array()), 'span' => array('id' => array(),'class' => array()), 'a' => array('href' => array(),'title' => array()), 'strong' => array() ) ); ?>
                </div>

            </div>

        </div>
        <!--faq-container-->
        
    </div>
    <!--container-wrapper-->
    
    
    <?php endwhile; ?>

<?php
get_footer();
