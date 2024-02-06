<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/0af1aab5de.js" crossorigin="anonymous"></script>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'after_body' ); ?>
<?php
$logo           = get_theme_file_uri( 'images/new-logo.png' );
$dark_logo= get_theme_file_uri( 'images/new-logo.png' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
if ( $custom_logo_id ) {
	$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	if ( $image ) {
		$logo = array_shift( $image );
	}
}
?>


<!--Mobile-slide-menu-start-->
<nav class="slide-menu" id="mobile-menu">
     
  <div class="controls clear">     	
   	
        <div class="logo">
			<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
	            <img class="slide-menu-logo-logo"
	                 src="<?php echo esc_url( $dark_logo ); ?>"
	                 alt="<?php bloginfo( 'name' ); ?>"/>
	        </a>
        </div>
    
  	 <!--hamburger-menu-->
            	
        <a href="#" data-action="close" class="hamburger-link slide-menu__control slide-menu-close">
            <img src="<?php echo esc_url(get_theme_file_uri( 'images/close-icon.svg' )); ?>" alt="">
        </a>
            
    <!--hamburger-menu-->
  </div>
  
  <?php
	wp_nav_menu(
		array(
			'theme_location' => 'menu-mobile',
			'menu_id'        => 'menu-mobile',
			'fallback_cb'    => false,
			'container'      => false,
			'menu_class'     => 'slide-navi',
		)
	);
	?>

</nav>
<!--Mobile-slide-menu-end-->




<header class="header container-fluid active">
    <nav class="navbar navbar-expand-lg container navbar-light">
        <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
            <img class="header__logo dark_logo"
                 src="<?php echo esc_url( $dark_logo ); ?>"
                 alt="<?php bloginfo( 'name' ); ?>"/>
        </a>
       <a class="burder-menu slide-menu__control" href="javascript:void(0);" data-target="mobile-menu" data-action="toggle">
			<span></span>
			<span></span>
			<span></span>
		</a>
		<?php if ( has_nav_menu( 'menu-main' ) ) { ?>
			
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'menu-main',
					'menu_id'         => 'menu-main',
					'fallback_cb'     => false,
					'container_class' => 'collapse navbar-collapse',
					'menu_class'      => 'navbar-nav ml-auto mt-2 mt-lg-0',
				)
			);
			?>
		
		<?php } ?>
    </nav>
</header>
<main class="content-wrapper">
    
