<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package myanmar
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

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
	<div class="container-fluid bgWhite TopBottomPadding15 LeftRightPadding0" >
		<div class="w-100 header-menu">
			<div class="row verticalAlign">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                	<a href="<?php echo esc_url(get_site_url()); ?>" target="_self">
						<img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" alt="Meta" class="metaLogo" />
                    </a>
				</div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
					<div class="float-right">
                    	<div class="float-right">
                        <?php
							$siteurl = esc_url(get_site_url());
							$expurl = explode('/',$siteurl);
							if( !empty($expurl[3]) ){
								if( $expurl[3] ==='br' ){ 
								$enurl=$expurl[0].'//'.$expurl[2];		
								?>
									<ul class="nav navbar marginZero paddingZero">
                                    	<li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle fontTxt txtGrey font16 padding15 menuTxt" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Myanmar</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item fontTxt txtGrey font16" href="<?php echo esc_url($enurl); ?>">English</a>
                                            </div>
                                        </li>
									</ul>
                                    <?php
								}
							}
							else
							{
								?>
                                <ul class="nav navbar marginZero paddingZero">
                                	<li class="nav-item dropdown">
                                    	<a class="nav-link dropdown-toggle fontTxt txtGrey font16 padding15 menuTxt" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">English</a>
                                        <div class="dropdown-menu">
											<a class="dropdown-item fontTxt txtGrey font16" href="<?php echo esc_url(get_site_url().'/br'); ?>">Myanmar</a>
                                        </div>
									</li>
								</ul>
                                <?php
							}
						?>
                        </div>
					</div>
				</div>	
			</div>
		</div>
	</div>

	<div class="container-fluid bgWhite TopBottomPadding15 d-xl-none d-lg-none d-md-block d-sm-block LeftRightPadding0" style="background: none;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
                	<a class="font24 txtGrey fontDisplay wtdLogo navbar-brand" href="<?php echo esc_url(get_site_url()); ?>" target="_self">
                    	<img src="<?php echo esc_url( get_theme_file_uri( 'images/myanmar-logo-grey.png' ) ); ?>" alt="we Think Digital" class="logoImg" />
					</a>					
				</div>
                <div class="col-md-6 col-sm-6">
					<div class="text-right paddingTB15 menuBox">
						<button class="navbar-toggler toggler-example paddingZero btnBlock" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
							<img src="<?php echo esc_url( get_theme_file_uri( 'images/menu.png' ) ); ?>" alt="Myanmar" class="menuIcon" />
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
				<div class="w-100 header-menu">
					<div class="row alignItemsCenter">
						<div class="col-xl-2 col-lg-2 col-md-8 col-sm-10 float-left">
							<a class="marginZero paddingZero" href="<?php echo esc_url(get_site_url()); ?>" target="_self">
                           		<?php /*?><img src="<?php echo esc_url( get_theme_file_uri( 'images/we-think-digital-logo.png' ) ); ?>" alt="we Think Digital" class="logoImg" /><?php */?>
                                <?php the_custom_logo(); ?>
                            </a>
							<!--font24 txtWhite fontDisplay wtdLogo navbar-brand-->
						</div>                               
                        <div class="col-xl-10 col-lg-10 col-md-4 col-sm-2 float-right d-xl-none d-lg-none">					
							<div class="text-right paddingTB15">
								<button class="navbar-toggler toggler-example paddingZero" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
								<img src="<?php echo esc_url( get_theme_file_uri( 'images/menu.png' ) ); ?>" alt="Myanmar" class="menuIcon" />
								</button>							
							</div>
						</div>
                        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
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
