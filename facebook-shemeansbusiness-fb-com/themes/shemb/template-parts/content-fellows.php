<?php
/**
 * Template part for displaying fellows posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shemb
 */
$fellow = getFellows(); 
?>
<section>
<h3 class="hl-text-heading">Meet the #SheMeansBusiness Fellows </h3>
<div class="container">
	<div class="row">
		<div class="flxbxrow">
        	<?php $i=1; $pid ='';
				while ( $fellow->have_posts() ): $fellow->the_post();
				$fel = get_post_meta( get_the_ID(), 'fellow', true);
				$felimg = wp_get_attachment_url( $fel['simage'] );
				$pid=get_the_ID();
        	?>
                <div class="flxbxstart">
                    <div class="storyA">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <div class="storyBox">
                                        <div>
											<?php echo wp_kses( $fel['sname'], array(
													'br' => array( 'class' => array() ),
													'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
													'strong' => array(),
													'style' => array(),
											) ); ?></div>
                                        <img src="<?php echo esc_url( $felimg ); ?>">
                                        <div>
                                        	<?php echo wp_kses( $fel['sbusiness'], array(
												'br' => array( 'class' => array() ),
												'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
												'strong' => array(),'style' => array(),
											) ); ?>
                                        </div>
                                        <div>Read More</div>
                                    </div>
                                </div>
                                <div class="flip-card-back" data-toggle="modal" data-target="#allsmodal<?php echo wp_kses_post($pid); ?>">
                                    <div class="contentWrapper">
                                        <?php echo wp_kses( $fel['sdescription'], array(
											'br' => array( 'class' => array() ),
											'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
											'strong' => array(), 'style' => array(),
										) ); ?><br /><br />
										<span>Click for detailed story</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="allsmodal<?php echo wp_kses_post($pid); ?>" tabindex="-1" role="dialog" aria-labelledby="ShembLongTitle" aria-hidden="true">
                	<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
                            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body text-center pad-0">
                            	<?php
									$strpop = get_post_meta( wp_kses_post($pid), 'storypopup', true);
								?>
								<div class="col-lg-12 main0">
                                	<?php if( !empty( $strpop['smtitle'] ) ) { ?>
										<h1><?php echo wp_kses_post($strpop['smtitle']); ?></h1>
									<?php } if( !empty(get_the_title()) ) { ?>
										<h2>
                                        	<?php echo wp_kses( $fel['sbusiness'], array(
												'br' => array( 'class' => array() ),
												'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
												'strong' => array(),'style' => array(),
											) ); ?>
                                        </h2>
									<?php } if( !empty( $strpop['smloc'] ) ) { ?>
										<h2><?php echo wp_kses_post($strpop['smloc']); ?></h2>
                                    <?php } ?>
								</div>
                                <?php
									foreach($strpop['popupblocks'] as $block)
									{ 
                                    	if($block['sec_type']==='fullheading')
										{ 
											if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) { ?>
												<div class="col-lg-12 storypopfullheading">
													<h2>
                                                    	<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?> </h2>
												</div>
											<?php } 
										}
										if($block['sec_type']==='fulltext')
										{ 
											if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) { ?>
												<div class="col-lg-12 para1">
													<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
												</div>
                                                <?php 
										} }
										if($block['sec_type']==='singleimg')
										{ 
											if( !empty( $block['sec_twocol_img_fields']['singimage'] ) ) { 
											$sinimg = wp_get_attachment_url( $block['sec_twocol_img_fields']['singimage'] ); 
											?>
												<div class="col-lg-12 storypopfullheading">
													<img src="<?php echo esc_url( $sinimg ); ?>" />
												</div>
											<?php } 
										}
										if($block['sec_type']==='twocol_iltr')
										{ 
											$ritimg = wp_get_attachment_url($block['sec_twocol_iltr_fields']['poplimage']); 
											if( !empty( $block['sec_twocol_iltr_fields']['poprightttext']) && !empty($ritimg) ) {
											?>
                                            <div class="main1">
                                            	<div class="col-sm-8 col-lg-8 img-main pad-0">
													<img src="<?php echo esc_url( $ritimg ); ?>" />
												</div>
                                                <div class="col-sm-4 col-sm-4 head1">
                                                	<h2>
                                                    	<?php echo wp_kses( $block['sec_twocol_iltr_fields']['poprightttext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
													</h2>
												</div>
											</div>
                                            <?php
										} }
										if($block['sec_type']==='twocol_irtl')
										{ 
											$lfimg = wp_get_attachment_url($block['sec_twocol_irtl_fields']['poprimage']); 
											if( !empty( $block['sec_twocol_irtl_fields']['poplefttext']) && !empty($lfimg) ) {
											?>
                                                <div class="main2">
                                                    <div class="col-sm-4 col-lg-4 head1">
                                                        <h2>
                                                        <?php echo wp_kses( $block['sec_twocol_irtl_fields']['poplefttext'] , array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
                                                        </h2>
                                                    </div>
                                                    <div class="col-sm-8 col-sm-4 img-main pad-0">
                                                        <img src="<?php echo esc_url( $lfimg ); ?>" />
                                                    </div>
                                                </div>
                                            <?php
											}
										}
                                		if($block['sec_type']==='social')
										{  
											$soclink = $block['sec_twocol_social_fields']['weblink'];
											$fb = $block['sec_twocol_social_fields']['fb'];
											$insta = $block['sec_twocol_social_fields']['insta'];
											if( !empty( $link ) || !empty( $fb ) || !empty( $insta ) ) {
										?>
                                        	<div class="col-lg-12 para1">
                                                <ul class="social-link">
                                                    <?php if( !empty( $soclink ) ){ ?>
                                                    <li> <a href="<?php echo esc_url( $soclink ); ?>" target="_blank"> 
                                                        <i class="fas fa-link"></i> </a></li>
                                                    <?php } if( !empty( $fb ) ){ ?>
                                                    <li> <a href="<?php echo esc_url( $fb ); ?>" target="_blank"> 
                                                        <i class="fab fa-facebook-f"></i> </a></li>
                                                    <?php } if( !empty( $insta ) ){ ?>
                                                    <li> <a href="<?php echo esc_url( $insta ); ?>" target="_blank">
                                                        <i class="fab fa-instagram"></i> </a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        <?php
											}
										}
                                } ?>
                                
                                
                            </div>
						</div>
					</div>
                </div>
                
            <?php $i++; endwhile; wp_reset_postdata(); ?>
			
            

		</div>
	</div>
</div>
</section>


