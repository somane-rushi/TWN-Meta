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
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page__wrap" class="page__wrap">
<div id="page">

<section id="header" class="header">
	<a class="header__home_button" id="header__home_button">
		<div class="header__logo">
			<?php
			//default images
			$logo_image       = facebook_image_url( '/assets/images/header__logo.png');
			$logo_light_image = facebook_image_url('/assets/images/header__logo--light.png');

			if (function_exists( 'the_custom_logo' ) ) {
				// Get both versions of the theme logo
				$custom_logo_id       = get_theme_mod( 'custom_logo' );
				$custom_logo_light_image = get_theme_mod( 'custom_logo_light' );

				if ( is_integer( $custom_logo_id ) ) {
					$temp_logo_image = wp_get_attachment_image_src( $custom_logo_id, array( '406', '46' ) );
					$temp_logo_image = $temp_logo_image[0]; // Based on the official Theme Logo guidelines https://codex.wordpress.org/Theme_Logo

					if($temp_logo_image)
					{
						$logo_image=$temp_logo_image;
					}
				}

				if(! empty( $custom_logo_light_image ))
				{
					$logo_light_image = $custom_logo_light_image;
				}
			}
			?>
			<img class="logo logo--dark" src="<?php echo esc_url( $logo_image  ); ?>" />
		</div>
	</a>
	<button id="menu__button" class="menu__button" data-menu-button>
		<div class="menu__burger">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</button>
</section>

<nav id="navigation__dot">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-2',
				'container'      => false,
				'fallback_cb'    => false,
				'walker'         => new Initiatives_Dot_Menu(),
			)
		);
	?>
</nav>

<nav id="navigation__panel">
	<nav class="menu">
		<div class="menu__lang">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-3',
						'menu_class'     => 'menu__list',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
			?>

			<button id="menu__button--panel" class="menu__button menu__button--panel" data-menu-button>
				<div class="menu__burger">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</button>

		</div>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-2',
				'menu_class'     => 'menu__list',
				'container'      => false,
				'fallback_cb'    => false,
				'walker'         => new Initiatives_Expand_Menu(),
			)
		);
		?>

	</nav>
</nav>
