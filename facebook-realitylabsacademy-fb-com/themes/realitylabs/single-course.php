<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
<section>
	<div class="container-full padding-top-lg padding-bottom-lg">
	</div>
</section>
<section>
	<div class="container-full" style="display: block;">
		<div class="divFullFlex">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12 sidePanelGrey padding-left-no padding-right-no padding-bottom-no">
            	<?php include get_template_directory().'/page-templates/sidebar-portal.php'; ?>
			</div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-xx-12 bgwhite padding-left-no padding-right-no">
				<div class="div100 padding-bottom padding-top">
					<?php
                    while ( have_posts() ) : the_post(); 
						$couredata = get_post_meta( get_the_ID(), 'courses' , true );
						$bannerimg = wp_get_attachment_url( $couredata['bimage'] );
						$vdimg = wp_get_attachment_url( $couredata['vimage'] );
						$video = wp_get_attachment_url( $couredata['video'] );
						$readonlydata = get_post_meta( get_the_ID(), 'readonlysec' , true );
					?>
                        <?php  
						if ( ! empty( $readonlydata['rsubtitle'] ) || ! empty( $readonlydata['rdesc'] ) ) { ?>
                        
                        	<div class="padding-left padding-right dispBlock">
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12 col-xx-12">
                                    <div class="dispBlock">
                                        <h1 class="fontXtraLight txtRed margin-bottom margin-top text-left"><?php echo esc_html( get_the_title() ); ?></h1>
                                        <h2 class="fontXtraLight txtDarkGrey margin-bottom margin-top text-left">
                                        	<?php echo esc_html( $readonlydata['rsubtitle'] ); ?>
                                        </h2>
                                    </div>
                                    <div class="dispBlock margin-bottom margin-top">
                                        <?php echo wp_kses( $readonlydata['rdesc'], array(
												'sup' => array(), 'br' => array(), 'strong' => array(),
												'span' => array( 'class' => array() ), 'style' => array(),
												'p' => array( 'class' => array() ),
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ), 
												'a'   => array(
													'href'   => array(),
													'title'  => array(),
													'target' => array( '_blank' ),
													'class' => array(),
												),
										) ); ?>    
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
						<div class="padding-left padding-right dispBlock margin-bottom margin-top">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12">
								<div class="dispFlexTitle">			
									<div class="" >
										<h1 class="fontXtraLight txtDarkGrey margin-bottom margin-top text-left">
										<?php echo esc_html( get_the_title() ); ?></h1>
									</div>
									<div class="titleSpacerDiv" >
										<div class="titleSpacer hidden-xs hidden-xx"></div>										
										<div class="titleSpacerMob hidden-lg hidden-md hidden-sm"></div>										
									</div>
                                    <?php if ( ! empty( $couredata['vdcredits'] ) || ! empty( $couredata['vdtime'] )  ): ?>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12 padding-left-no padding-right-no">
										<div class="margin-top margin-bottom whiteBoxFlex">
                                        	<?php if ( ! empty( $couredata['vdcredits'] ) ): ?>
											<div class="dispContainerFlex">
												<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/credits-grey.png" alt="Credits" class="iconImgSmallicons margin-left-no margin-right" />
												<p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font18">
                                                <?php echo esc_html( $couredata['vdcredits'] ).' Credits'; ?></p> 
											</div>
                                            <?php endif; ?>
											<?php if ( ! empty( $couredata['vdtime'] ) ): ?>
											<div class="dispContainerFlex">
												<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/clock-grey.png" alt="Clock" class="iconImgSmallicons margin-left margin-right" />
												<p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font18">
												<?php echo esc_html( $couredata['vdtime'] ); ?></p>
											</div>
											<?php endif; ?>
										</div>
									</div>
                                    <?php endif; ?>
								</div>
                            </div>                            
                        </div><!--title and info 2-->						
                        
                        <div class="padding-left padding-right dispContainerFlexTop">
							<!--dispContainerFlexTop-->
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xx-12">
                            	<?php if ( ! empty( $video ) ): ?>
                                    <video controls poster="<?php echo esc_url( $vdimg ); ?>" class="margin-bottom margin-top-no">
                                        <source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
                                    </video>
                                <?php endif; ?>
								<!--New Content Only Section-->
                                <?php if ( ! empty( $couredata['cdesc'] ) ): ?>
								<div class="div100 margin-bottom margin-top">
									<?php echo wp_kses( $couredata['cdesc'], array(
										'sup' => array(),
                                        'br' => array(),
                                        'strong' => array(),
										'span' => array('class' => array()),
                                        'style' => array(),
										'h3' => array('class' => array()),
										'h4' => array('class' => array()),
										'p' => array('class' => array()),
										'img' => array( 'class' => array(), 'style' => array(),'src' => array() ),
                                        'a'   => array(
                                            'href'   => array(),
                                            'title'  => array(),
                                        	'target' => array( '_blank' ),
											'class' => array(),
                                        ),
                                ) ); ?>	
								</div>
                               <?php endif; ?>
								<!--New Content Only Section-->
                            </div>
							<!--Video Section-->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                            	
                                <?php $downlod = get_post_meta( get_the_ID(), 'downloadtest' , true ); 
									$dwpdf = wp_get_attachment_url( $downlod['dw_file'] );
								?>
                                <?php if ( ! empty( $downlod['dwtitle'] ) ||! empty( $downlod['dwdesc'] ) || ! empty( $downlod['dwbtn_text'] ) ): ?>
                                <div class="margin-top-no margin-bottom whiteBoxBlock2">
                                    <div class="dispContainerFlexTwo">
                                    	<?php if ( ! empty( $downlod['dwtitle'] ) ): ?>
                                        	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/download-pdf-grey.png" alt="" class="iconImgSmall margin-left margin-right" />
                                        	<p class="margin-bottom margin-top txtDarkGrey fontXtraLight font20">
                                        	<?php echo esc_html( $downlod['dwtitle'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dispBlock divFull">
                                    	<?php if ( ! empty( $downlod['dwdesc'] ) ): ?>
                                        	<p class="margin-bottom margin-top-sm txtGrey margin-left margin-right text-left fontXtraLight font16"><?php echo esc_html( $downlod['dwdesc'] ); ?></p>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $downlod['dwbtn_text'] ) ): ?>
                                        	<p class="text-right margin-left margin-right">
                                        		<a class="btn btnTestDownload waves-attach waves-light padding-left padding-right font14 fontTxt" href="<?php echo esc_url( $dwpdf ); ?>" download><?php echo esc_html( $downlod['dwbtn_text'] ); ?></a></p>	
                                        <?php endif; ?>
                                    </div>										
                                </div><!--2-->
                                <?php endif; ?>
								<?php /*?><?php $downlodas = get_post_meta( get_the_ID(), 'downloadassets' , true ); 
									$dwafile = wp_get_attachment_url( $downlodas['dwa_file'] );
									if ( ! empty( $downlodas['dwatitle'] ) || ! empty( $downlodas['dwabtn_text'] ) || ! empty( $dwafile ) ):
								?>
								<!--Download Assets Section-->
								<div class="margin-top-no margin-bottom whiteBoxBlock2">
                                    <div class="dispContainerFlexTwo">
                                    	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/download-assets.png" alt="" class="iconImgSmall margin-left margin-right">
                                        <p class="margin-bottom margin-top txtDarkGrey fontXtraLight font18">
                                        	<?php 
												if ( ! empty( $downlodas['dwatitle'] ) ) {
											echo esc_html( $downlodas['dwatitle'] ); }
											if ( ! empty( $downlodas['dwabtn_text'] ) ) {
											 ?> 
                                            <a href="<?php echo esc_url( $dwafile ); ?>" target="_blank" style="text-decoration: underline;" class="txtRed">
                                                <?php echo esc_html( $downlodas['dwabtn_text'] ); ?>
                                            </a>
                                            <?php }?>
										</p>
                                    </div>                                    
                                </div>
                                <?php endif; ?><?php */?>
                                <div class="margin-top-no margin-bottom whiteBoxBlock2">
                                    <div class="dispContainerFlexTwo">
                                    	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/download-assets.png" alt="" class="iconImgSmall margin-left margin-right">
                                        <p class="margin-bottom margin-top txtDarkGrey fontXtraLight font18">
                                        	Download all assets
                                            <a href="https://drive.google.com/drive/folders/15ZEzS--3Yqf6Yd1SqebsZGVk03N_6Qqu" target="_blank" style="text-decoration: underline;" class="txtRed">
                                               here 
                                            </a>
										</p>
                                    </div>                                    
                                </div>
                                
								<!--End of Download Assets-->
                            </div>
							<!--Download PDF Section-->
                        </div><!--video and Download PDF-->

						<div class="padding-left padding-right dispContainerFlexTop">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xx-12">
								<?php $starttest = get_post_meta( get_the_ID(), 'starttest' , true ); ?>
                                <?php if ( ! empty( $starttest['sttitle'] ) || ! empty( $starttest['stdesc'] ) || ! empty( $starttest['btn_text'] ) ): ?>
                                <div class="margin-top margin-bottom whiteBoxBlock2">
                                    <div class="dispContainerFlexTwo">
                                    	<?php if ( ! empty( $starttest['sttitle'] ) ): ?>
                                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/take-test-grey.png" alt="" class="iconImgSmall margin-left margin-right" />
                                        <p class="margin-bottom margin-top txtDarkGrey fontXtraLight font20">
										<?php echo esc_html( $starttest['sttitle'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dispBlock divFull">
                                    	<?php if ( ! empty( $starttest['stdesc'] ) ): ?>
                                        	<p class="margin-bottom margin-top-sm txtGrey margin-left margin-right text-left fontXtraLight font16"><?php echo esc_html( $starttest['stdesc'] ); ?></p>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $starttest['btn_text'] ) ): ?>
                                            <p class="text-right margin-left margin-right ">
                                                <a href="<?php echo esc_url( $starttest['btn_link'] ); ?>" class="btn btnTestDownload waves-attach waves-light padding-left padding-right font14 fontTxt"><?php echo esc_html( $starttest['btn_text'] ); ?></a>
                                            </p>
                                        <?php endif; ?>	
                                    </div>										
                                </div><!--Test Section Inner-->
                                <?php endif; ?>	
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                            </div>
                        </div><!--Test Section-->

						<div class="padding-left padding-right dispContainerFlexTop">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xx-12">
								<?php $tips = get_post_meta( get_the_ID(), 'tips' , true ); 
									$expimg = wp_get_attachment_url( $tips['exp_image'] );
								?>
								<div class="margin-top margin-bottom dispBlock">
									
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
										
										<?php if ( ! empty( $tips['tips_head'] ) ): ?>
											<h3 class="text-left txtDarkGrey fontXtraLight margin-bottom margin-top-sm"><?php echo esc_html( $tips['tips_head'] ); ?></h3>											
										<?php endif; ?>
										<!--<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12">
											<?php /*if ( ! empty( $expimg ) ): ?>
												<img src="<?php echo esc_url( $expimg ); ?>" alt="<?php echo esc_attr( $tips['exp_name'] ); ?>" class="margin-top expertIcon" />
											<?php endif; ?>
											<?php if ( ! empty( $tips['exp_name'] ) ): ?>
												<p class="text-center margin-bottom-sm margin-top-sm txtGrey fontXtraLight font16">
													<?php echo esc_html( $tips['exp_name'] ); ?>
												</p>
											<?php endif; */?>
										</div>-->
										
										<?php if ( ! empty( $tips['exp_desc'] ) ): ?>
											<p class="text-left margin-bottom margin-top txtGrey fontXtraLight font16">
												<?php echo esc_html( $tips['exp_desc'] ); ?>
											</p>
										<?php endif; ?>
									</div>
									<?php if ( ! empty( $tips['add_tips'] ) ): $i=1; ?>
										<?php foreach ( $tips['add_tips'] as $tipimg ): 
												$timg = wp_get_attachment_url( $tipimg['tips_image'] );
												$tvd = wp_get_attachment_url( $tipimg['tips_video'] );
										?>
											<?php if ( ! empty( $timg ) ): ?>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
													<div class="tilter">
														<?php if ( ! empty( $tipimg['tips_title'] ) && ! empty( $tvd )  ){ ?>
														<a class="waves-attach" data-toggle="modal" href="#tips<?php echo esc_html($i); ?>">
															<img src="<?php echo esc_url( $timg ); ?>" alt="Tips" class="imgFull dykImg margin-bottom margin-top-no" />
														</a>
														<?php } else { ?>
															<img src="<?php echo esc_url( $timg ); ?>" alt="Tips" class="imgFull dykImg margin-bottom margin-top-no" />
														<?php } ?>
													</div>
												</div>
												<?php if ( ! empty( $tipimg['tips_title'] ) && ! empty( $tvd )  ): ?>
												<div aria-hidden="true" class="modal fade" id="tips<?php echo esc_html($i); ?>" role="dialog" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-heading">
																<a class="modal-close" data-dismiss="modal">×</a>
																<?php if ( ! empty( $tipimg['tips_title'] ) ): ?>
																	<h2 class="modal-title txtDarkGrey fontXtraLight"><?php echo esc_html($tipimg['tips_title']); ?></h2>
																<?php endif; ?>
															</div>
															<div class="modal-inner">
																<div class="container">
																	<?php if ( ! empty( $tvd ) ): ?>
																	<video controls autoplay muted class="margin-bottom margin-top">
																		<source src="<?php echo esc_url( $tvd ); ?>" type="video/mp4">
																	</video>
																	<?php endif; ?>
																</div>
															</div>
															<div class="modal-footer">
																<p class="text-right txtDarkGrey fontXtraLight"><button class="btn btn-flat btn-brand waves-attach txtDarkGrey fontXtraLight" data-dismiss="modal" type="button">Close</button></p>
															</div>
														</div>
													</div>
												</div>
												<?php endif; ?>
											<?php $i++; endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>		
										
								</div><!--Expert Tips-->
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                            </div>
                        </div><!--Expert Tips + DYK Section-->


                        
                        <?php } ?>
                    <?php
                    endwhile;
                    ?>
                    
                    <?php /*?><div class="padding-left padding-right dispBlock">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12">
							<h3 class="text-left txtDarkGrey fontXtraLight margin-bottom margin-top">More topics on this module</h3>
						</div>
						<div class="whiteBoxFlexCol margin-bottom-lg">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-xx-12">
								<p class="text-left margin-bottom margin-top txtNavBlue fontXtraLight font18">Unfinished</p>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 col-xx-12">
								<div class="tilter">
									<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/box-1.png" alt="" class="img90 margin-bottom" />
								</div>
								<div class="dispTitleFlex margin-bottom">
									<div class="contWidth80Div">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/clock-icon.png" style="Clock" class="iconImgSmall" />
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">25 mins</p>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/credits-icon.png" style="Clock" class="iconImgSmall" />
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">7 Credits</p>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<div class="progress progress-brand">
												<div class="progress-bar" style="width: 38%"></div>
											</div>
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">38%</p>
										</div>
									</div>								
								</div><!--Unfinished Module #1-->
							</div>
                            <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 col-xx-12">
								<div class="tilter">
									<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/box-2.png" alt="" class="img90 margin-bottom" />
								</div>
								<div class="dispTitleFlex margin-bottom">
									<div class="contWidth80Div">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/clock-icon.png" style="Clock" class="iconImgSmall" />
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">47 mins</p>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/credits-icon.png" style="Clock" class="iconImgSmall" />
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">15 Credits</p>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<div class="progress progress-brand">
												<div class="progress-bar" style="width: 83%"></div>
											</div>
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">83%</p>
										</div>
									</div>								
								</div><!--Unfinished Module #1-->
							</div>
						</div><!--End of Unfinished Topics-->
                        
                        <div class="dispContainerFlex">
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-xx-12">
								<p class="text-left margin-bottom margin-top txtGrey fontXtraLight font18">Finished</p>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 col-xx-12">
								<div class="tilter">
									<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/video-box-completed.png" alt="" class="img90 margin-bottom" />
								</div>
								<div class="dispTitleFlex margin-bottom">
									<div class="contWidth80Div">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
													
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
											<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/credits-icon.png" style="Clock" class="iconImgSmall" />
											<p class="text-center txtGrey margin-bottom-sm margin-top-sm">8 Credits</p>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
										</div>
									</div>								
								</div><!--Unfinished Module #1-->
							</div>
							<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 col-xx-12">										
							</div>
						</div><!--End of Completed Topics-->
								
					</div><!--More Topics-->
                    <?php */?>
                
					<div class="padding-left padding-right dispBlock padding-bottom-no">
						<div class="div100">
							<div class="container-full">
								<div class="dotPatternContainer"> </div>
							</div>
						</div><!--end of Div100-->
					</div><!--Spacer-->
				</div><!--end of Div100-->
			
            </div><!--Dashboard Right-->
		</div>
	</div><!--container-full-->
</section><!--Full-->



            
<?php
get_footer();
