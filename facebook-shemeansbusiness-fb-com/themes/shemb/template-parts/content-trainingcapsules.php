<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shemb
 */

$fields = get_option( "archive_learningcapsules", array() );
?>
<?php if ( ! empty( $fields['heading'] )) : ?>
	<section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12  paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $fields['heading'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
<?php endif; ?>    
    <section class="noPadding lightGreenBG ">
        <div  class="container-fluid noPadding">
            <div class="container paddTop50 paddBottom35 capsuleDiv">
                <?php if ( ! empty( $fields['description'] )) : ?>
                <div class="row valign">
                    <div class="col-8 offset-2 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 offset-sm-0">
                        <?php echo wp_kses( $fields['description'] , 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ),
							'div' => array( 'class' => array() ), 'b' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
							'strong' => array(), 'class' => array() )  ); ?>                        
                    </div>                    
                </div>
                <?php endif; ?>
                <?php $capsules = getLearningCapsules(); 
				if( ! empty($capsules)): ?>
                    <div class="row valign ">
                    	<?php $i=1;
                        	while ( $capsules->have_posts() ): $capsules->the_post(); 
								$learn = get_post_meta( get_the_ID(), 'capsule', true);
								$learnimg = wp_get_attachment_url( $learn['capimage'] );
								$learnvd = wp_get_attachment_url( $learn['vd_file'] );
						?>
                                <div class="col-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <div class="capsuleBox marginBottom25" style="background-image: url(<?php echo esc_url( $learnimg ); ?>);">
                                        <div class="capsuleBoxInner txtDarkGreen font16 text-center fontOptLight">
                                        	<?php if ( ! empty( $learn['captitle'] )) : ?>
                                            	<p><?php echo esc_html( $learn['captitle'] ); ?></p>
                                            <?php endif; ?>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#cap<?php echo esc_html($i); ?>">
                                                <img src="https://shemeansbusiness-fb-com-develop.go-vip.net/wp-content/uploads/2022/02/home-play-icon.png" class="playIcon" alt="Shemb" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade" id="cap<?php echo esc_html($i); ?>" style="padding: 0px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">  
                                        <div class="modal-content ">			
                                            <div class="modal-body lightGreenBG">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                    <?php if ( ! empty( $learn['captitle'] )) : ?>
                                                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                                                            <h3 class="txtDarkGreen text-center whiteBG fontOptLight paddTop35 paddBottom35 noMargin"><?php echo esc_html( $learn['captitle'] ); ?></h3>
                                                        </div>
													<?php endif; ?>
                                                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                                                            <video controls muted class="vidContainer" poster="">
                                                                <source src="<?php echo esc_url( $learnvd ); ?>" type="video/mp4">
                                                            </video>
                                                        </div>						
                                                    </div>
                                                </div>
                                            </div>					
                                        </div>
                                    </div>
                                </div>
                                
						<?php $i++; endwhile; wp_reset_postdata(); ?>
                    </div> <!-- row -->
                <?php endif; ?>
			</div>
		</div>
	</section>