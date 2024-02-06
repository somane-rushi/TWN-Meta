<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thailand
 */

get_header();
?>
<?php $fields = get_option( "archive_success-story", array() ); 
	if( !empty ($fields['imagesec']['image_banner']) ){
?>
    <section class="australia-tab-section">
        <div class="container-fluid">
            <div class="row">
                <div class="australia-block " style="background-image: url(<?php echo esc_url( wp_get_attachment_url( $fields['imagesec']['image_banner'] ) ); ?>);">
                	<?php if ( ! empty( $fields['imagesec']['image_heading'] ) ): ?>
                    	<h2><?php echo wp_kses_post( $fields['imagesec']['image_heading'] ); ?></h2>
                    <?php endif; ?>
                    <?php if ( ! empty( $fields['imagesec']['image_desc'] ) ): ?>
                    		<?php echo wp_kses( $fields['imagesec']['image_desc'], array(
                            		'br' => array( 'class' => array() ),'strong' => array(),
									'h3' => array( 'class' => array() ), 'h2' => array( 'class' => array() ),
									'h1' => array( 'class' => array() ),'h4' => array( 'class' => array() ),
									'span' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
									'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array(),'class' => array() ),
							 ) ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php
	}
if( !empty ($fields['slide']) ){
?>
	<section class="full-txt bgWhite">
		<div class="container-fluid">
			<div class="row">
            	<div class="vidCarousel videoBoxFull owl-carousel owl-theme " id="homebancrousel">
            <?php foreach (  $fields['slide'] as $sec ) { 
					
				if($sec['sec_type']==='video')
				{ 
					if ( !empty( $sec['sec_video_fields']['vd_banner'] ) ) {
					?>
                    <div class="item">
                    	<video controls muted preload="none" poster="<?php echo esc_url( wp_get_attachment_url( $sec['sec_video_fields']['vimage_banner'] ) ); ?>">
                        	<source src="<?php echo esc_url( wp_get_attachment_url( $sec['sec_video_fields']['vd_banner'] ) ); ?>" type="video/mp4">
						</video>
					</div>
                    <?php
					}
				}
				if($sec['sec_type']==='image')
				{ 
					$img = wp_get_attachment_url( $sec['sec_image_fields']['image_banner'] ); 
					if ( ! empty( $img ) ):
				?>
					<div class="item">
                        <img src="<?php echo esc_url( $img ); ?>" />
                    </div>
                 <?php endif;
				}
			}
			?>
				</div>
			</div>
		</div>
	</section> 
<?php } ?> 

<?php $sregion = story_region(); 
	if ( ! empty( $sregion ) ): ?>
		<section>
            <div class="container-fluid bgWhite paddLR0">
                <div class="container paddTB50">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
							<ul class="nav nav-tabs nav-justify ssTab">
							   <li><a href="#all" class="font16 txtGrey show" data-toggle="tab">ALL</a></li>
                               <?php foreach ( $sregion as $sreg ) { ?>
									<li><a href="#<?php echo wp_kses_post($sreg->slug); ?>" class="font16 txtGrey" data-toggle="tab"><?php echo wp_kses_post($sreg->name); ?></a></li>
                               <?php } ?>
							</ul>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid bgWhite paddLR0">
                    <div class="row padLR0">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="tab-content">
							    <div class="tab-pane active" id="all">
                                	<?php
									if( !empty ($fields['alltab']) ){ ?>
                                	<div class="container-fluid">
                                        <div class="container paddBottom50">
                                            <div class="row vertCenter">
                                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
                                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                                    <img src="<?php echo esc_url( wp_get_attachment_url( $fields['alltab']['all_img'] ) ); ?>" alt="allregions" class="img80-map marginBottom25" />
                                                </div>
                                                <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="font16 txtGrey marginBottom25">
                                                    	<?php echo wp_kses( $fields['alltab']['all_desc'], array(
															'br' => array( 'class' => array() ), 'strong' => array(),
															'span' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
														'a' => array( 'href' => array(), 'title' => array(), 'target' => array(),'class' => array() ),
                                                        ) ); ?>
                                                    </div>
                                                </div>-->                                               
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                	<?php $taball = getstory_postall();  
										if ( $taball->have_posts() ) { 
									?>
                                	<div class="container">
                                        <div class="row">
                                        	<?php while ( $taball->have_posts() ): $taball->the_post();
												$storyall = get_post_meta( get_the_ID(), 'storydata', true);
												$storyimgall = wp_get_attachment_url($storyall['image']); ?>
                                                <div class="row sStoryArea" class="leadership type-leadership status-publish has-post-thumbnail hentry">
                                                    <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox blogimgarea p bgWhite " 
                                                        style="background-image:url(<?php echo esc_url( $storyimgall ); ?>)">-->
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ssaBox blogimgarea p bgWhite " >
                                                        <img src="<?php echo esc_url( $storyimgall ); ?>" class="img80-ssa" alt="" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ssaBox bgWhite">
                                                        <div class="div-ssa">
                                                            <h2 class="entry-title txtGrey "><a href="<?php echo esc_url( $storyall['btnlink'] ); ?>" rel="bookmark" target="_blank"><?php echo wp_kses_post( the_title() ); ?></a></h2>
                                                            <?php if ( ! empty( $storyall['description'] ) ): ?>
																<?php echo wp_kses( $storyall['description'], array(
                                                                        'br' => array( 'class' => array() ),
                                                                        'strong' => array(),
                                                                        'span' => array( 'class' => array() ),
                                                                        'p' => array( 'class' => array() ),
                                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array(), 'class' => array() ),
                                                             ) ); endif; ?>
                                                            <?php if ( ! empty( $storyall['btntext'] ) ): ?>
                                                            <p class="txtDarkBlue">
                                                                <a href="<?php echo esc_url( $storyall['btnlink'] ); ?>" rel="bookmark" class="txtDarkGreen" target="_blank"><span class="fa fa-arrow-right txtDarkGreen" target="_blank"></span><?php echo wp_kses_post( $storyall['btntext'] ); ?></a>

                                                            </p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div><!--1-->
									</div>
                                    <?php } ?>
                                </div> <!-- All -->
                                
                                <?php foreach ( $sregion as $sreg ) { 
									$catimg = get_term_meta( wp_kses_post($sreg->term_id), 'cat_image', true );
                                    $cimage = wp_get_attachment_url( $catimg['cimage'] );
								?>
                                	<div class="tab-pane" id="<?php echo wp_kses_post($sreg->slug); ?>">
                                    	
                                        <div class="container-fluid">
                                            <div class="container paddBottom50">
                                                <div class="row vertCenter">
                                                    <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <img src="<?php echo esc_url($cimage); ?>" alt="<?php echo wp_kses_post($sreg->name); ?>" class="img80-map marginBottom25" />
                                                    </div>
                                                    <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="font16 txtGrey marginBottom25"><?php echo wp_kses_post($sreg->description); ?></div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                            	<?php $tabcontent = getstory_post($sreg->slug); 
												if ( $tabcontent->have_posts() ) { 
													while ( $tabcontent->have_posts() ): $tabcontent->the_post();
													$story = get_post_meta( get_the_ID(), 'storydata', true);
													$storyimg = wp_get_attachment_url($story['image']);
												?>
                                                <div class="row sStoryArea" class="leadership type-leadership status-publish has-post-thumbnail hentry">
                                                    <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox blogimgarea p bgWhite" 
                                                        style="background-image:url(<?php echo esc_url( $storyimg ); ?>)">-->
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ssaBox blogimgarea p bgWhite">                                                        
                                                        <img src="<?php echo esc_url( $storyimg ); ?>" class="img80-ssa" alt="" />
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ssaBox bgWhite">
                                                        <div class="div-ssa">
                                                            <h2 class="entry-title"><a href="<?php echo esc_url( $story['btnlink'] ); ?>" rel="bookmark" target="_blank"><?php echo wp_kses_post( the_title() ); ?></a></h2>
                                                            <?php if ( ! empty( $story['description'] ) ): ?>
																<?php echo wp_kses( $story['description'], array(
                                                                        'br' => array( 'class' => array() ),
                                                                        'strong' => array(),
                                                                        'span' => array( 'class' => array() ),
                                                                        'p' => array( 'class' => array() ),
                                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array(),'class' => array() ),
                                                                    ) ); ?>
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $story['btntext'] ) ): ?>
                                                            <p class="txtDarkBlue">
                                                                <a href="<?php echo esc_url( $story['btnlink'] ); ?>" rel="bookmark" class="txtDarkGreen" target="_blank"><span class="fa fa-arrow-right txtDarkGreen"></span><?php echo wp_kses_post( $story['btntext'] ); ?></a>
                                                            </p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endwhile; wp_reset_postdata(); } ?>
                                            </div>
                                        </div>
                                        
                                        
									</div><!--pane-->
                                <?php } ?>
                                
                                
                                
							</div><!-- tab-content -->
						</div>
					</div>
				</div>
                
                
			</div>
		</section>
	<?php endif; ?>
 
<?php
get_footer();
