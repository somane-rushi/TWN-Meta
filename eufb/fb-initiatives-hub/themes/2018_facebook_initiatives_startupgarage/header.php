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
</head>
<body <?php body_class(); ?>>

<?php do_action( 'after_body' ); ?>
<header class="header container-fluid">
	<?php if ( has_nav_menu( 'menu-languages' ) ) { ?>
		<div class="language-bar d-none d-lg-block">
			<div class="container">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-languages',
						'menu_id'        => 'menu-languages',
						'fallback_cb'    => false,
						'menu_class'     => 'language-selector d-flex justify-content-end',
					)
				);
				?>
			</div>
		</div>
	<?php } ?>


	<nav class="navbar navbar-expand-lg container navbar-light">
		<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
			<?php
			$logo           = get_theme_file_uri( 'assets/images/en/logo.png' );
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
				 alt="<?php bloginfo( 'name' ); ?>"/>
		</a>
		<button class="navbar-menu-btn d-block d-lg-none">
			<img src="<?php facebook_image_include( 'assets/images/en/menu-icon.svg' ); ?>" alt="">
		</button>

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
	<div class="navbar-offcanvas">
		<button class="navbar-offcanvas-close">
			<img src="<?php facebook_image_include( 'assets/images/en/close-icon.svg' ); ?>" alt="">
		</button>


		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-mobile',
				'menu_id'        => 'menu-mobile',
				'fallback_cb'    => false,
				'container'      => false,
				'menu_class'     => 'navbar-nav text-right',
			)
		);
		?>


		<hr class="underscore small"/>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'menu-mobile-2',
				'menu_id'         => 'menu-mobile-2',
				'fallback_cb'     => false,
				'container_class' => '"language-selector d-flex justify-content-end',
			)
		);
		?>


		<hr class="underscore small"/>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-mobile-3',
				'menu_id'        => 'menu-mobile-3',
				'fallback_cb'    => false,
			)
		);
		?>
	</div>
