<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thailand
 */

?>
<?php
global $post;
    $post_slug = $post->post_name;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1 ">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	
	
	<?php if($post_slug == 'rediscover-thailand'){ ?>
		
		<!-- Meta Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '640961670865453');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=640961670865453&ev=PageView&noscript=1"
		/></noscript>
<!-- End Meta Pixel Code -->
		
<?php 	}?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="main-wrapper">
	<header class="header-section sticky">
        <div class="container-fluid bgWhite mainhead testclass chkchk">			
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-8">
                <div class="header-logo">
                    <a href="<?php echo esc_url( home_url( ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" alt="Meta Logo"></a>
                </div><!--header Logo-->
            </div><!--col-->
            <div class="col-lg-10 col-md-8 col-sm-6 col-xs-4">
				<?php if ( is_page('login-page') || is_page('facebook-employee-form') || is_page('login') ) { ?>						
						<a href="<?php echo esc_url( home_url().'/login/' ); ?>" style="float:right;" > Login </a> 
						
				<?php } else { ?>
					<div class="site-nav hidden-sm hidden-xs">
						<ul>
							<li><a style="margin:0 0 0 10px;" class="txtNavGrey font16" href="<?php echo esc_url( $mainURL.'/thailand/' ); ?>">EN</a></li>
							<li><a style="margin:0 5px;" class="txtNavGrey">/</a></li>
							<li><a style="margin:0 10px 0 0;" class="txtNavGrey font16" href="<?php echo esc_url( $mainURL.'/thailand-th/' ); ?>">TH</a></li>	
						</ul>
					</div><!--div-->
					<nav class="navbar navbar-default hidden-lg hidden-md visible-sm visible-xs">								
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navDropDown" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</nav><!---->
					<!--nav-->
				<?php } ?>
            </div><!--col-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-lg hidden-md">
			    <div class="collapse navbar-collapse" id="navDropDown">
                    <?php
						wp_nav_menu(
							array(
								'theme_location'  => 'menu-1',
								'container'       => 'ul',
								'container_class' => '',
								'item_spacing'    => 'discard',
								'menu_class'      => 'nav navbar-nav',
							)
						);
					?>
                    
					<ul>
						<li style="display: inline-block;"><a class="font16 txtlightGrey txtfontopt" style="margin:0px; text-decoration: none;" href="<?php echo esc_url( $mainURL.'/thailand/' ); ?>">EN</a></li>
						<li style="display: inline-block;"><a style="margin:0px; text-decoration: none;" class="txtlightGrey txtfontopt">/</a></li>
						<li style="display: inline-block;"><a class="font16 txtlightGrey txtfontopt" style="margin:0px; text-decoration: none;" href="<?php echo esc_url( $mainURL.'/thailand-th/' ); ?>">TH</a></li>	
					</ul>                            
			    </div><!--For Mobile-->
            </div><!--col-->
        </div><!--container Fluid-->
		<div class="container-fluid noBG padLR0 marTB15">
			<div class="col-lg-2 col-md-2 col-sm-6 col-xs-8 ">
				<p class="txtlightGrey txtfontopt font20">
					<a href="<?php echo esc_url( home_url( ) ); ?>" style="text-decoration: none; border: none;" class="font20" target="_self">Thailand</a></p>	
			</div>
			<div class="col-lg-10 col-md-10 col-sm-6 col-xs-4 ">
			<?php if ( is_page('login-page') || is_page('facebook-employee-form') || is_page('login') ) { ?>						
						<a href="<?php echo esc_url( home_url().'/login/' ); ?>" style="float:right;" > Login </a> 
						
				<?php } else { ?>
					<div class="site-nav hidden-sm hidden-xs">
                        <?php
								wp_nav_menu(
									array(
										'theme_location'  => 'menu-1',
										'container'       => 'ul',
										'container_class' => '',
										'item_spacing'    => 'discard',
										'menu_class'      => '',
									)
								);
							?>
						<?php
							$siteurl = esc_url(get_site_url());
							$expurl = explode('/',$siteurl);
							$mainURL = $expurl[0].'/'.$expurl[1].'/'.$expurl[2];
						?>						
					</div><!--div-->
				<?php } ?>
			</div><!--col-->
		</div><!--container Fluid-->
	</header>