<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wethinkdigital2022
 */

?>
<footer>
	<div class="container-fluid bgFooter">
		<div class="container TopBottomPadding50">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2022/05/meta-logo.png" class="footerLogo float-left" />
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
						<?php /*?><ul class="nav navbar marginZero paddingZero float-right">
							<li class="nav-item fontTxt noPadding">
								<a class="nav-link font14 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="<?php echo esc_url( get_site_url() ); ?>/about-us/" >About Us</a>
                            </li>
							<li class="nav-item fontTxt noPadding">
								<a class="nav-link font14 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="#" >Resources</a>
                            </li>
							<li class="nav-item fontTxt noPadding">
								<a class="nav-link font14 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="<?php echo esc_url( get_site_url() ); ?>/partners/" >Partners</a>
                            </li>
						</ul><?php */?>
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
                    <?php /*?><ul class="nav navbar marginZero paddingZero float-right">
						<li class="nav-item fontTxt noPadding">
							<a class="nav-link font12 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="https://www.facebook.com/legal/terms" target="_blank" >Terms</a>
						</li>
                        <li class="nav-item fontTxt noPadding">
							<a class="nav-link font12 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="https://www.facebook.com/policies/cookies/" target="_blank" >Cookies</a>
						</li>
                        <li class="nav-item fontTxt noPadding">
							<a class="nav-link font12 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="https://www.facebook.com/policy.php" target="_blank" >Data Policy</a>
						</li>
                        <li class="nav-item fontTxt noPadding">
							<a class="nav-link font12 fontTxt txtGrey LeftRightPadding30 TopBottomPadding15" href="https://about.facebook.com/" target="_blank" >Meta</a>
						</li>
					</ul><?php */?>
				</div>
			
            </div>
		</div>
	</div>
</footer>




<?php wp_footer(); ?>

</body>
</html>
