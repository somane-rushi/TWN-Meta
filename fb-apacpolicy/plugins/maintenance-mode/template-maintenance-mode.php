<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); // allow for remote-login on mapped domains ?>
	<style>
	.mm-wrapper {
		display: flex;
		width: 100vw;
		height: 100vh;
		justify-content: center;
		align-items: center;
		flex-flow: column wrap;
		font-size: 2rem;
	}
	</style>
</head>
<body>
	<div class="mm-wrapper">
		<h1><?php esc_html_e( 'Please check back soon', 'maintenance-mode' ); ?></h1>
		<p><?php esc_html_e( '', 'maintenance-mode' ); ?></p>
	</div>
	<?php wp_footer(); ?>
</body>
</html>
