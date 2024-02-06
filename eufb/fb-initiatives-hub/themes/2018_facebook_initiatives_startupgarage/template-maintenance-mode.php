<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<style type="text/css">
		.holding {
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			height: 80vh;
			margin: 50px 20px 0px;
		}
		.holding img {
			max-width: 100%;
		}
	</style>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'after_body' ); ?>

<div class="holding">
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
	<img
			src="<?php echo esc_url( $logo ); ?>"
			alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> "/>
</div>

<?php wp_footer(); ?>
</body>
</html>
