<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wethinkdigital2022
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <?php 
		$sitepc=get_site_url();
		$expurlpc = explode('/',$sitepc);
		if($expurlpc[3]==='pc')
		{ ?>
        	<!-- Facebook Pixel Code -->
			<script>
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){
                    n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; 
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window,document,'script', 'https://connect.facebook.net/en_US/fbevents.js');
                    fbq('init', '3236915149896679');
                    fbq('track', 'PageView');
            </script>
            <noscript>
				<img height="1" width="1" src="https://www.facebook.com/tr?id=3236915149896679&ev=PageView &noscript=1"/>
			</noscript>
			<!-- End Facebook Pixel Code -->
			
	<?php } 
	
	if(is_page( 'responsible-digital-citizens' )) {?>
		<!-- Facebook Pixel Code -->
			<script>
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window,document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '3621029028036209'); 
			fbq('track', 'PageView');
			</script>
			<noscript>
			<img height="1" width="1" 
			src="https://www.facebook.com/tr?id=3621029028036209&ev=PageView
			&noscript=1"/>
			</noscript>
		<!-- End Facebook Pixel Code -->

	<?php } ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
	<div class="container-fluid bgWhite TopBottomPadding15 LeftRightPadding0" >
		<div class="container">
			<div class="row verticalAlign">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-5">
                <?php $finalurl = get_site_url();
                	if(isset($_SERVER['REQUEST_URI'])){
						if($_SERVER['REQUEST_URI'] === (string)'/sg/en-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/sg/ch-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/sg/ms-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/sg/ta-sg/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/ph/tl-ph/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/jp/en-jp/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/lk/ta-lk/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/lk/si-lk/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/th/en-th/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/vn/en-vn/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/as-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/bn-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/gu-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/hi-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/kn-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/mr-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/ta-in/stayingsafeonline/' || $_SERVER['REQUEST_URI'] === (string)'/in/te-in/stayingsafeonline/' )
						{
							$siteurl = esc_url(get_site_url());
							$expurl = explode('/',$siteurl);
							$finalurl = $expurl[0].'//'.$expurl[2];
						}
					}
					?>
                	<a href="<?php echo esc_url( $finalurl ); ?>" target="_self">
						<img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" alt="Meta" 
                        class="metaLogo" />
                    </a>
				</div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-7">
					<div class="float-right">
                    	<?php
							wethinkdigital2022_the_site_selector(true);
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
			</div>
		</div>
	</div><!--for Meta Logo-->
	<div class="container-fluid bgWhite TopBottomPadding15 d-xl-none d-lg-none d-md-block d-sm-block LeftRightPadding0" style="background: none;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
                	<a class="font24 txtGrey fontDisplay wtdLogo navbar-brand" href="<?php echo esc_url($finalurl); ?>" target="_self">
                    	<?php
						$mob_logo_id =get_theme_mod( 'mobile_header_logo' ); 
						if(!empty($mob_logo_id)) { ?>
							<img src="<?php echo esc_url( $mob_logo_id ); ?>" alt="we Think Digital" class="logoImg" />
                        <?php } else { ?>
                        	<img src="<?php echo esc_url( get_theme_file_uri( 'images/we-think-digital-logo-grey.webp' ) ); ?>" alt="We Think Digital" class="logoImg" />
                        <?php } ?>
					</a>					
				</div>
                <div class="col-md-6 col-sm-6">
					<div class="text-right paddingTB15 menuBox">
						<button class="navbar-toggler toggler-example paddingZero btnBlock" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
							<!--<span class="txtDarkBlue bgBlue"><i class="fas  fa-bars fa-1x"></i></span>-->
							<img src="<?php echo esc_url( get_theme_file_uri( 'images/menu.png' ) ); ?>" alt="WTD" class="menuIcon" />
						</button>							
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
                    <div class="floatNav txtNav floatRight ">
						<div class="collapse navbar-collapse text-right TopBottomPadding15" id="mainNav">
                        	<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'main_nav',
										'container'       => 'ul',
										'container_class' => '',
										'item_spacing'    => 'discard',
										'menu_class'      => 'navbar-nav ms-auto pb-sm-3 pt-sm-3',
									)
								);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--end of Mobile Menu-->

	<div class="container-fluid bgWhite TopBottomPadding0 d-xl-block d-lg-block d-md-none d-sm-none mobDispNone LeftRightPadding0">
		<nav class="navbar navbar-expand-lg paddingZero marginZero">
			<div class="container-fluid marginZero LeftRightPadding0">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-8 col-sm-10 float-left">
							<a class="font24 txtWhite fontDisplay wtdLogo navbar-brand" href="<?php echo esc_url($finalurl); ?>" target="_self">
                            	<?php
									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
									if(!empty($custom_logo_id)) { ?>
                           				<img src="<?php echo esc_url( $logo[0] ); ?>" alt="We Think Digital" class="logoImg" /> 
                                    <?php } else { ?>
                                    	<img src="<?php echo esc_url( get_theme_file_uri( 'images/we-think-digital-logo.webp' ) ); ?>" alt="we Think Digital" class="logoImg" /> 
                                    <?php } ?>
                            </a>
						</div>                               
                        <div class="col-xl-8 col-lg-8 col-md-4 col-sm-2 float-right d-xl-none d-lg-none">					
							<div class="text-right paddingTB15">
								<button class="navbar-toggler toggler-example paddingZero" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <!--<span class="txtDarkBlue bgBlue"><i class="fas  fa-bars fa-1x"></i></span>-->
								<img src="<?php echo esc_url( get_theme_file_uri( 'images/menu.png' ) ); ?>" alt="WTD" class="menuIcon" />
								</button>							
							</div>
						</div>
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
							<div class="floatNav txtNav floatRight mainNav font16">
                            	<?php
									wp_nav_menu(
										array(
											'theme_location'  => 'main_nav',
											'container'       => 'ul',
											'container_class' => '',
											'item_spacing'    => 'discard',
											'menu_class'      => 'navbar-nav ms-auto pb-sm-3 pt-sm-3',
										)
									);
								?>
							</div>
						</div>
					</div>                            
				</div>                        
			</div><!-- container-fluid.// -->
		</nav>
	</div><!--End of Normal Menu-->
</header>
