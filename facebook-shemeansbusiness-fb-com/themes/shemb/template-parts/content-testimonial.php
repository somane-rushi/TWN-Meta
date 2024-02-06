<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shemb
 */

?>
<?php $testimonial = getTestimonial(); 
if( !empty($testimonial)):
?>
    <section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin">Testimonials</h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
    <section class="noPadding greenBG">
        <div class="container-fluid">
	        <div class="container noPadding">
	            <div class="row">
	                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
	                    <div class="testimonial-carousel owl-carousel ltGreenBG" id="testiHome">
                        	<?php
                        	while ( $testimonial->have_posts() ): $testimonial->the_post(); 
								$testi = get_post_meta( get_the_ID(), 'testi', true);
							?>
	                        <div class="testi-full sidePadd25">
	                            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
	                                <div class="testiBox marginBottom25">
                                    	<?php
											$testimg = wp_get_attachment_url($testi['testi_image']);
											if ( ! empty( $testimg ) ) : ?>
                                                <div class="testiLogo">
                                                    <img src="<?php echo esc_url( $testimg ); ?>" alt="Shemb" class="paddBottom25" />
                                                </div>
                                        	<?php endif; ?>
                                        <?php if ( ! empty( $testi['description'] ) ) : ?>
                                            <div class="testiCopy">
                                                <p class="text-center txtDarkGreen fontOptLight font16 marginBottom25">
                                                    <?php echo wp_kses( $testi['description'], 
                                                    array( 'br' => array( 'class' => array() ), 
													'span' => array( 'class' => array() ), 
                                                    'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>   
                                                </p>
                                            </div>
                                        <?php endif; ?>
	                                    <div class="testiSpeaker">
	                                        <h4 class="text-center txtDarkGreen fontOptLight marginBottom25 fontItalic">
                                            	<?php the_title(); ?>
                                            </h4>
	                                        <p class="text-center txtDarkGreen fontOptLight marginBottom25 font12">
                                            	<?php 
												if( !empty($testi['testi_country']) ) :
													echo esc_html($testi['testi_position']);
												endif; 
												if( !empty($testi['testi_country']) ) :
													echo ','.esc_html($testi['testi_country']);
												endif;
												?>
	                                        </p>
	                                    </div>
	                                </div>
	                                <!--Testi Box-->
	                            </div>
	                        </div>
                            <?php endwhile; wp_reset_postdata(); ?>
	                        </div>
	                        <!--testi Full-->
	                    </div>
	                </div>
	            </div>                
	        </div>
		</div>        
    </section><!--Testimonial Section-->
<?php endif; ?>
