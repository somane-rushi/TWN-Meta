<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fbdigital
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body>
	<div class="main-wrapper">
        <header class="header-section">
            <div class="container-fluid">
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">
                    <div class="header-logo">
                        <a href="<?php echo site_url(); ?>"><img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/facebook-logo.png" alt="FB Digital"></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                	<?php
						fbiamdigital_the_site_selector(true);
						wp_nav_menu(
							array(
								'theme_location'  => 'lang_switcher',
								'container'       => 'nav',
								'container_class' => 'c-site-language-switcher',
								'item_spacing'    => 'discard',
								'fallback_cb'     => '__return_false',
							)
						);
					?>
                    
                    
                </div>
            </div>
        </header>