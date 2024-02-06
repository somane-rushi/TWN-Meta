<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package myanmar
 */

?>
<footer>
	<div class="container-fluid bgFooter">
		<div class="w-100 footer-menu">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" class="footerLogo float-left" />
                    	<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_nav',
										'container'       => 'ul',
										'container_class' => '',
										'item_spacing'    => 'discard',
										'menu_class'      => 'footerMain nav navbar',
									)
								);
						?>
                        </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><div class="footerLine"></div></div>
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<ul class="nav navbar marginZero paddingZero float-left">
						<li class="nav-item fontDisplay  noPadding">
							<a class="nav-link font14 fontDisplay txtGrey footerMeta" href="#" >Meta 2022</a>
                        </li>                                
					</ul>
                    <?php
						wp_nav_menu(
							array(
								'theme_location'  => 'bfooter_nav',
								'container'       => 'ul',
								'container_class' => '',
								'item_spacing'    => 'discard',
								'menu_class'      => 'footerMain nav navbar',
							)
						);
					?>
				</div>
			
            </div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
