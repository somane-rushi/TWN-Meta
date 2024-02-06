<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package facebook-initiatives
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'after_body' ); ?>

<a name="home" data-scroll-anchor></a>
<header class="header">
    <div class="wrapper">
		<?php if ( has_nav_menu( 'menu-1' ) ) { ?>
            <div class="languages">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'fallback_cb'     => false,
						'container_class' => 'container',
						'menu_class'      => 'languages-menu',
					)
				);
				?>
            </div>
		<?php } ?>
        <div class="navigation">
            <div class="container">
                <a class="header__home_button" href="#home" data-smooth-scroll>
					<?php
					$logo           = get_theme_file_uri( 'assets/images/header__logo.png' );
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					if ( $custom_logo_id ) {
						$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
						if ( $image ) {
							$logo = array_shift( $image );
						}
					}
					?>
                    <img class="header__logo"
                         src="<?php echo esc_url( $logo ); ?>"
                         alt="Facebook"/>
                </a>
                <button class="menu__button" data-menu-button>
                    <div></div>
                    <div></div>
                    <div></div>
                </button>
                <nav class="menu">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'secondary-menu',
							'fallback_cb'    => false,
							'container'      => false,
							'menu_class'     => 'main-menu',
						)
					);
					?>
                </nav>
            </div>
        </div>
    </div>
</header>
