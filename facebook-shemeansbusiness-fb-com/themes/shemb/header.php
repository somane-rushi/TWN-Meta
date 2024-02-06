<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shemb
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<meta property="og:title" content="Meta - SheMeansBusiness">
	<meta property="og:type" content="article" />
	<meta property="og:image" content="https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/SheMB-share-img.jpg">
	<meta property="og:url" content="https://shemeansbusiness.fb.com/">
	<meta name="twitter:card" content="Meta - SheMeansBusiness">
	<meta property="og:description" content="Meta launched #SheMeansBusiness in 2016, as its long-term commitment to women's economic empowerment.">
	<meta property="og:site_name" content="Meta - SheMeansBusiness">
	<meta name="twitter:image:alt" content="Meta - SheMeansBusiness">
	<meta name="twitter:image" content="https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/SheMB-share-img.jpg" />
   
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); 
	global $post;
    $post_slug = $post->post_name;
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'shemb' ); ?></a>

	<header>
		<div class="container-fluid paddingTB20 noMargin whiteBG">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<img src="https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/meta-logo.png" alt="Meta" class="metaLogo" />
			</div>			
		</div><!--for Meta Logo-->
		<div class="container-fluid noPadding noMargin boxShadow greenBG">
			<nav class="navbar navbar-expand-lg noPadding">
				<div class="container-fluid headconaj">
				
					<div class="col-xl-4 col-lg-4 col-md-8 col-sm-10 float-left">
                    	<a class="navbar-brand font18 logoGreen fontOptRegular paddingTB15" href="<?php echo esc_url( get_site_url() ); ?>">#SheMeansBusiness
                        <?php
                        if($post->post_type==='page'){
							$finaltxt='';
							$logotxt = $post->post_name;
							if($logotxt==='hongkong'){ $finaltxt = 'Hong Kong'; }
							if($logotxt==='india'){ $finaltxt = 'India'; }
							if($logotxt==='indonesia'){ $finaltxt = 'Indonesia'; }
							if($logotxt==='indonesia-bahasa'){ $finaltxt = 'Indonesia'; }
							if($logotxt==='pakistan'){ $finaltxt = 'Pakistan'; }
							if($logotxt==='philippines'){ $finaltxt = 'Philippines'; }
							if($logotxt==='taiwan-2'){ $finaltxt = 'Taiwan'; }
							if($logotxt==='vietnam'){ $finaltxt = 'Vietnam'; }
							if($logotxt==='uk'){ $finaltxt = 'UK'; }
							if($logotxt==='latin-america'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-eng'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-eng-digital-skills'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-eng-whatsapp'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-por'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-por-digital-skills'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-por-whatsapp'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-esp'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-esp-digital-skills'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='training-hub-esp-whatsapp'){ $finaltxt = 'for the Americas'; }
							if($logotxt==='sub-saharan-africa'){ $finaltxt = 'Sub-Saharan Africa'; }
							echo esc_html( $finaltxt );
						}
                        ?>
                        </a>
                    </div>
                   
                    <div class="col-xl-8 col-lg-8 col-md-4 col-sm-2 float-right d-xl-none d-lg-none">					
                    	<div class="text-right paddingTB15">
							<button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span></button>							
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
						<div class="floatNav txtNav">
							<div class="collapse navbar-collapse" id="mainNav">
								<ul class="navbar-nav ms-auto pb-sm-3 pt-sm-3 paddingTB1">
									<li class="nav-item fontOptLight noPadding"><a class="nav-link font16 mainLink marginLR paddingTB15" href="<?php echo esc_url( get_site_url() ); ?>" >Global Homepage</a></li>
									<li class="nav-item dropdown fontOptLight">
										<a class="nav-link font16 dropdown-toggle mainLink marginLR paddingTB15" href="#" data-bs-toggle="dropdown">Regions&nbsp;</a>
										<ul class="dropdown-menu dropdown-menu-left">
											<li>
                                            	<a class="dropdown-item mainLink font16" href="#">Asia Pacific &rsaquo; </a>
												<ul class="submenu submenu-right dropdown-menu">
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/hongkong/">Hong Kong</a></li>
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/india/">India</a></li>
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/indonesia/">Indonesia</a></li>
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/pakistan/">Pakistan</a></li>
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/philippines/">Philippines</a></li>
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/taiwan-2/">Taiwan</a></li>
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/vietnam/">Vietnam</a></li>
												</ul>
											</li>
											<li>
                                            	<a class="dropdown-item mainLink font16" href="#">Europe &rsaquo; </a>
												<ul class="submenu submenu-right dropdown-menu">
													<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/uk/">United Kingdom</a></li>
												</ul>
											</li>
		                                    <li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/latin-america/">Latin America</a></li>
											<li><a class="dropdown-item mainLink font16" href="https://www.facebook.com/business/small-business/women-small-medium-business-resources" target="_blank">North America</a></li>
		                                    <li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/sub-saharan-africa/">Sub-Saharan Africa</a></li>
										</ul>
									</li>
									<li class="nav-item fontOptLight"><a class="nav-link mainLink marginLR paddingTB15" href="<?php echo esc_url( get_site_url() ); ?>/stories/" >Stories</a></li>
                                    <li class="nav-item fontOptLight"><a class="nav-link mainLink marginLR paddingTB15" href="<?php echo esc_url( get_site_url() ); ?>/partners/" >Partners</a></li>
                                    <?php if($post_slug==='hongkong' || $post_slug==='hk-fellowship-program'){ ?>
                                    	<li class="nav-item fontOptLight"><a class="nav-link mainLink marginLR paddingTB15" href="<?php echo esc_url( get_site_url() ); ?>/hk-fellowship-program/" >Fellowship Program</a></li>
                                    <?php } ?>
                                    <?php if($post_slug==='latin-america' || $post_slug==='training-hub-eng' || $post_slug==='training-hub-por' || $post_slug==='training-hub-esp' || $post_slug==='training-hub-eng-digital-skills' || $post_slug==='training-hub-eng-whatsapp' || $post_slug==='training-hub-por-digital-skills' || $post_slug==='training-hub-por-whatsapp' || $post_slug==='training-hub-esp-whatsapp' || $post_slug==='training-hub-esp-digital-skills' ){ ?>
                                    <li class="nav-item dropdown fontOptLight">
										<a class="nav-link font16  dropdown-toggle mainLink marginLR paddingTB15" href="#" data-bs-toggle="dropdown" >Training Hub&nbsp;</a>
										<ul class="dropdown-menu dropdown-menu-left">
											<li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/training-hub-eng/">English</a></li>
                                            <li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/training-hub-por/">Português</a></li>
                                            <li><a class="dropdown-item mainLink font16" href="<?php echo esc_url( get_site_url() ); ?>/training-hub-esp/">Español</a></li>
                                        </ul>
									</li>
                                    <?php } ?>
                                    <li class="nav-item fontOptLight"><a class="nav-link mainLink marginLR paddingTB15" href="<?php echo esc_url( get_site_url() ); ?>/buyfromher/" >Buy From Her</a></li>
                                    
								</ul>
							</div>
						</div>
					</div>
				</div>
                <!-- container-fluid.// -->
			</nav>
		</div>
	</header>
    
    
    
