<?php
/**
 * The header for our theme
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="https://gmpg.org/xfn/11"/>
	<?php wp_head(); ?>
	<?php do_action('fbiamdigital_fb_fixel_script'); ?>
</head>

<body <?php body_class(); ?>>
<?php fbiamdigital_the_gtm_code_noscript(); ?>
<?php fbiamdigital_the_fb_jdsdk(); ?>
<div class="c-site-header__wrap o-wrap header_pad" id="topmetamenu">
    	<a class="c-site-header__logo c-site-logo" href="#">
        <img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" alt="Meta" class="metaLogo" />
        </a>
        <div class="c-site-header__i18n">
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
<header class="c-site-header">
	<?php /*?><div class="c-site-header__wrap o-wrap">
    	<a class="c-site-header__logo c-site-logo" href="#">
        <img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" alt="Meta" class="metaLogo" />
        </a>
        <div class="c-site-header__i18n">
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
    </div><?php */?>
	<div class="c-site-header__wrap o-wrap">
		<div class="c-site-header__nav-toggle"><span></span></div>
        <?php
			if(isset($_SERVER['REQUEST_URI'])){
				if($_SERVER['REQUEST_URI'] === (string)'/sg/en-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/sg/ch-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/sg/ms-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/sg/ta-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/ph/tl-ph/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/ph/en-ph/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/jp/en-jp/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/pc/en-us/iamdigital/' || $_SERVER['REQUEST_URI'] === (string)'/pk/ur-pk/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/lk/ta-lk/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/lk/si-lk/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/th/en-th/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/bd/en-bd/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/id/en-id/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/vn/en-vn/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/as-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/bn-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/gu-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/hi-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/kn-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/mr-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/ta-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/te-in/stayingsafeonline/' )
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					$finalurl = $expurl[0].'//'.$expurl[2];
					?>
                    <a class="c-site-header__logo c-site-logo" href="<?php echo esc_url($finalurl); ?>">

                       <?php /*?> <img class="c-site-logo__fb" width="118" height="13" src="<?php echo esc_url( add_query_arg( 'v', '2', get_theme_file_uri( '/images/logo-fb.svg' ) ) ); ?>" alt="Facebook"><?php */?>
                       <?php fbiamdigital_the_custom_logo(); ?>
                       
                    </a>
                    <?php
				}
				else
				{ ?>
                	<a class="c-site-header__logo c-site-logo" href="<?php echo esc_url( get_site_url() ); ?>">
                        <?php /*?><img class="c-site-logo__fb" width="118" height="13" src="<?php echo esc_url( add_query_arg( 'v', '2', get_theme_file_uri( '/images/logo-fb.svg' ) ) ); ?>" alt="Facebook"><?php */?>
                        <?php fbiamdigital_the_custom_logo(); ?>
                    </a>
                    <?php
				}
			}
		?>
		
		<div class="c-site-header__nav">
			<div class="c-site-header__nav-inner">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'main_nav',
						'container'       => 'nav',
						'container_class' => 'c-site-nav',
						'item_spacing'    => 'discard',
					)
				);
				?>
			</div>
		</div>
		<?php /*?><div class="c-site-header__i18n">
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
		</div><?php */?>
	</div>
</header>
<div class="main-content">
	<div class="page-content">
