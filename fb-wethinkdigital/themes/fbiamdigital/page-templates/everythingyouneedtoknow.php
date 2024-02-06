<?php
/*
Template Name: Everything Know
*/

get_header();
$content = get_post_meta( get_the_ID(), 'banner', true );
$pdf = wp_get_attachment_url( $content['file'] ); 
?>

	<section class="o-wrap c-committee-intro u-animated u-animated--btm-top">
		<div class="" style="margin: 135px 0px;">
        	<?php if ( ! empty( $content['description'] ) ): ?>
			<div class="intro c-committee-intro__description u-tac">
				<?php echo wp_kses($content['description'], array(
						'sup' => array(),
						'span' => array(),
						'p' => array(),
						'br' => array(),
						'a'   => array(
							'href'   => array(),
							'title'  => array(),
							'target' => array( '_blank' ),
						),
					) ); ?>
			</div>
            <?php endif; ?>
			<?php ?>
				<img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/10/everything-pdf-img.jpg" alt="" class="" style="max-width: 275px; width: 100%; margin: 1em auto; display: block;" />
			<?php ?>
            <?php if ( ! empty( $content['button_title'] ) &&  ! empty( $content['file'] ) ): ?>
            <div class="intro c-committee-intro__description u-tac">
                <a class="o-media__img c-home-section__btn c-btn" href="<?php echo esc_url( $pdf ); ?>" download> <?php echo esc_html( $content['button_title'] ); ?> <i class="fas fa-chevron-right"></i></a>
			</div>
            <?php endif; ?>
           
		</div>    
	</section>               
    <div class="c-doodad-footer-resources">
		<div></div><div></div><div></div>
	</div>
                
</div>


<?php
get_footer();
