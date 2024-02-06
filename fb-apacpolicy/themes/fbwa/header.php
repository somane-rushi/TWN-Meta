<?php
/**
 * The header for our theme
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */
  nocache_headers();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
     <meta http-equiv="cache-control" content="no-cache" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="shortcut icon" href="<?php echo esc_url(get_stylesheet_directory_uri(). '/images/favicon.ico'); ?>" >
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'fb_file_repository'); ?></a>

    <?php
    if ( is_page('latest') || is_page('faq') ) {
        $addheaderClass = ' page-header';
    } elseif (is_front_page()) {
            $addheaderClass = ' front-page';
    } else {
        $addheaderClass = '';
    }    
    ?>
        
    <!--header-wrap-->
        <div class="header-wrap site-header<?php echo esc_attr($addheaderClass); ?>" id="masthead">
            <div class="wrapper">
                <!--logo-->
                    <div class="logo desktop"><a href="<?php echo esc_url(home_url('/')); ?>"> <span><span class=logo_text>WhatsApp</span> Policy Resource Hub</span></a></div>
                <!--logo-->
                
                <!--logo-->
                    <div class="logo mobile"><a href="<?php echo esc_url(home_url('/')); ?>"> <img src="<?php echo esc_url(get_stylesheet_directory_uri() .'/images/Logo_mobile.png'); ?>" alt="logo" > <span>Policy Research Hub</span></a></div>
                <!--logo-->
                
                <!--header-right-->
                    <div class="header-right">
                        <!--header-nav-->
                        <div class="header-nav">
                            <ul>
             
                                <?php if ( is_front_page() ) : ?>
                                                       <li><a href="https://docs.google.com/forms/d/1IYAAuJ5DH87AKLFgkkXZTjLrTPnadvaXFQPUOGLW5Y8/edit" target="_blank">New Asset Submission</a></li>
                                <li><a href="/latest/">Latest</a></li>
                                <li><a href="/faq/">FAQ</a></li>
                                <?php endif; ?>
                                <?php if ( is_page('latest') ) : ?>
                                                       <li><a href="https://docs.google.com/forms/d/1IYAAuJ5DH87AKLFgkkXZTjLrTPnadvaXFQPUOGLW5Y8/edit" target="_blank">New Asset Submission</a></li>
                                <li><a href="/">Advanced Search</a></li>
                                <li><a href="/faq/">FAQ</a></li>
                                <?php endif; ?>
                                <?php if ( is_page('faq') ) : ?>
                                                       <li><a href="https://docs.google.com/forms/d/1IYAAuJ5DH87AKLFgkkXZTjLrTPnadvaXFQPUOGLW5Y8/edit" target="_blank">New Asset Submission</a></li>
                                <li><a href="/">Advanced Search</a></li>
                                <li><a href="/latest/">Latest</a></li>
                                <?php endif; ?>
                                  <?php if (is_user_logged_in()) : ?>
                                <li><a href="<?php echo esc_url(wp_logout_url('/login-page/')); ?>">Logout</a></li>
                                <?php endif; ?>
                                <?php if (is_page('login-page') || is_page('facebook-employee-form')  || is_page('external-request-form')) : ?>
                                <li><a href="/login/">login</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!--header-nav-->
                    </div>
                <!--header-right-->
            </div>
        </div>
    <!--header-wrap--> 
