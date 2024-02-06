<?php
/**
 * The template for displaying events archive pages
 */

get_header();
?>
<?php $fields = get_option( "archive_events", array() ); ?>
<?php if ( ! empty( $fields['heading'] ) &&  ! empty( $fields['bg_content'] ) ) { 
	$headbg = wp_get_attachment_url($fields['bg_image']);
?>
    <section class="c-masthead c-masthead--resource-security c-masthead-security" style="background: url(<?php echo esc_url( $headbg ); ?>);">
        <div class="c-masthead__content o-wrap">
            <?php if ( ! empty( $fields['heading'] ) ): ?>
                <h1 class="c-masthead__heading u-animated u-animated--left-right"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
            <?php endif; ?>
            <?php if ( ! empty( $fields['bg_content'] ) ): ?>
                <div class="c-masthead__description u-animated u-animated--left-right">
                    <?php echo wp_kses_post( $fields['bg_content'], array(
                            'br' => array(
                                'class' => array()
                            ),
                        ) ); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    
<?php } ?>

<?php $resources_archive_fields = get_option( 'archive_events' ); ?>	
	<section class="c-listing c-listing--resources">
		<div class="o-wrap">
			<div id="content" class="o-layout o-layout--stretch">
<?php if ( have_posts() ) : ?>
		<?php $i=0;
			while ( have_posts() ) : the_post(); 
				$ev_attachment = get_post_meta( get_the_ID(), 'events_detail' , true );
				$evimage = wp_get_attachment_url($ev_attachment['evimage']);
				
				if($i%2!=0){
		?>
        		<section class="c-home-section c-home-section--partners u-animated u-animated--btm-top u-animated--animate" style="transition-delay: 0ms;">
                    <div class="o-wrap">
                        <div class="o-box o-media o-media--reverse c-home-section__media">
                            <div class="o-media__body c-home-section__body">
                            	<?php if ( ! empty( get_the_title() ) ): ?>
                                <h2 class="c-home-section__heading c-heading2"><?php echo wp_kses_post(get_the_title());?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['welcome_content'] ) ): ?>
                                    <p class="c-home-section__description">
                                        <?php echo wp_kses( $ev_attachment['welcome_content'], array( 
                                            'br' => array('class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array() ),
                                            'strong' => array(),
                                        ) ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['button_text'] ) ): ?>
                                	<a class="c-btn" target="_blank" href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>">
										<?php echo wp_kses_post($ev_attachment['button_text']); ?>
                                        <i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
                            </div>
                        <div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( $evimage ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
                        </div>
                    </div>
                </section>
                <?php } else { ?>
                <section class="c-home-section c-home-section--partners u-animated u-animated--btm-top u-animated--animate" style="transition-delay: 0ms;">
                    <div class="o-wrap">
                        <div class="o-box o-media o-media--reverse c-home-section__media">
                        	 <div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( $evimage ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
                            <div class="o-media__body c-home-section__body">
                            	<?php if ( ! empty( get_the_title() ) ): ?>
                                <h2 class="c-home-section__heading c-heading2"><?php echo wp_kses_post(get_the_title());?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['welcome_content'] ) ): ?>
                                    <p class="c-home-section__description">
                                        <?php echo wp_kses( $ev_attachment['welcome_content'], array( 
                                            'br' => array('class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array() ),
                                            'strong' => array(),
                                        ) ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['button_text'] ) ): ?>
                                	<a class="c-btn" target="_blank" href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>">
										<?php echo wp_kses_post($ev_attachment['button_text']); ?>
                                        <i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
                            </div>
                       
                        </div>
                    </div>
                </section>
                <?php }  $i++;
			endwhile; wp_reset_postdata();
			
		?>
        	</div>
		</div>
	</section>
<?php endif; ?>

	<div class="c-doodad-footer-resources">
		<div></div>
		<div></div>
		<div></div>
	</div>

	<div class="c-resources-video-player">
		<div class="c-resources-video-player__content">
			<video controls controlsList="nodownload" preload="metadata" playsinline></video>
			<button class="c-resources-video-player__btn-close"><i class="fal fa-times"></i></button>
		</div>
	</div>

<?php
	get_footer();
?>
