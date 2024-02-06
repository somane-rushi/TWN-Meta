<?php
/**
 * Template part for displaying Events
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$ev_attachment = get_post_meta( get_the_ID(), 'events_detail' , true );
				$evimage = wp_get_attachment_url($ev_attachment['evimage']);
				if($i%2!=0){
		?>
        		<section class="c-home-section c-home-section--partners u-animated u-animated--btm-top u-animated--animate" style="transition-delay: 0ms;">
                    <div class="o-wrap">
                        <div class="o-box o-media o-media--reverse c-home-section__media">
                            <div class="o-media__body c-home-section__body">
                            	<?php if ( ! empty( get_the_title() ) ): ?>
                                <h2 class="c-home-section__heading c-heading2"><?php echo wp_kses_post(get_the_title()); ?></h2>
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
                                	<a class="c-btn" href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>">
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
                                <h2 class="c-home-section__heading c-heading2"><?php echo wp_kses_post(get_the_title()); ?></h2>
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
                                	<a class="c-btn" href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>">
										<?php echo wp_kses_post($ev_attachment['button_text']); ?>
                                        <i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
                            </div>
                       
                        </div>
                    </div>
                </section>
                <?php }  $i++;