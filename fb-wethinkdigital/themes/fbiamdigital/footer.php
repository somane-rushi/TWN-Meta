<?php
/**
 * The template for displaying the footer
 */
?></div>
<footer class="main-content__c-site-footer c-site-footer">
	<div class="o-wrap">
		<div class="c-site-footer__partners c-site-footer-partners">
			<div class="c-site-footer-partners__heading"><?php esc_html_e( 'In collaboration with', 'fbiamdigital' ); ?></div>
			<div class="c-site-footer-partners__list"></div>
		</div>
		<div class="c-site-footer__colophon c-site-colophon">
        	<a class="c-site-header__logo c-site-logo" href="<?php echo esc_url(site_url()); ?>">
            <img src="<?php echo esc_url( get_theme_file_uri( 'images/meta-logo.png' ) ); ?>" alt="Meta" class="metaLogo" />
            </a>
			<nav class="c-site-colophon__links footertop">
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'tfooter_nav',
					'menu_id'         => 'footer-menu',
					'container'       => 'nav',
					'container_class' => 'c-site-colophon__links',
				) );
				?>
			</nav>
			<?php /*?><ul class="c-site-colophon__links-secondary">
				<li>Facebook &copy; 2022</li>
				<li><?php echo vip_powered_wpcom(); ?></li>
			</ul><?php */?>
            
		</div>
        <div class="c-site-footer__colophon c-site-colophon footerbrd footerbottom">
        	<a class="nav-link font14 fontDisplay txtGrey footerMeta" href="<?php echo esc_url(site_url()); ?>">Meta <?php echo esc_html( gmdate( 'Y' ) ); ?></a>
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'footer_nav',
					'menu_id'         => 'footer-menu',
					'container'       => 'nav',
					'container_class' => 'c-site-colophon__links',
				) );
				?>
		</div>
	</div>
</footer>
</div>
<?php  if(is_page(1791)){?>
	<script src="<?php echo get_template_directory_uri(); ?>/scripts/jquery.js"></script>
<script>
$(document).ready(function() {
    console.log('inside document ready script js');
    $("#bOne").click(function() {
    console.log('inside document ready #bOne script js');

        $("#social-sec").addClass("boxes-effect");
    });
    $("#social-btn").click(function() {
        $("#social-sec").removeClass("boxes-effect");
    });
    $("#bTwo").click(function() {
        $("#economic-sec").addClass("boxes-effect");
    });
    $("#economic-btn").click(function() {
        $("#economic-sec").removeClass("boxes-effect");
    });
    $("#bThree").click(function() {
        $("#digital-sec").addClass("boxes-effect");
    });
    $("#digital-btn").click(function() {
        $("#digital-sec").removeClass("boxes-effect");
    });
    $("#bFour").click(function() {
        $("#politics-sec").addClass("boxes-effect");
    });
    $("#politics-btn").click(function() {
        $("#politics-sec").removeClass("boxes-effect");
    });
});

</script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>