<?php
/*
Template Name: Page Builder
*/
get_header();
?>

<?php
	$components = get_post_meta( get_the_ID(), 'body', true );
	if ( ! empty( $components ) ): 
		foreach ( $components as $component ):
			$field_name = 'component_' . $component['component_type'];
			if ( empty( $component[ $field_name ] ) ) {
				continue;
			}
			$fields = $component[ $field_name ];
			switch ( $component['component_type'] ):
				case 'banimage':
					if ( ! empty( $fields['image'] ) ):
					$bgimg = wp_get_attachment_url($fields['image']);
					?>
                        <section>
                            <div class="container-fluid paddingZero bgWhite headerBanner verticalAlign" style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                                <div class="container">                    
                                    <div class="row marginZero">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 paddingZero">                        
                                            <div class="headerTitle padding15 ">
                                            	<?php if ( ! empty( $fields['title'] ) ): ?>
                                                    <h1 class="txtWhite fontDisplay txtWhite marginZero">
													<?php echo wp_kses_post( $fields['title'] ); ?></h1>
                                                <?php endif; ?>
                                            </div>                       
                                        </div>    
                                    </div>
                                </div>                
                            </div>
                        </section>
                    <?php
					endif;
				break;
				case 'fullsectxt': 
					if ( ! empty( $fields['content'] ) ):?>
						<section>
							<div class="container-fluid bgLightGrey LeftRightPadding0">
								<div class="container">
									<div class="row marginZero">
										<div class="col-12">  
											<div class="paddingTB40">
												<div class="fontTxt marginZero paddingZero font16 txtGrey textLeft">
													<?php echo wp_kses($fields['content'], array(
														'br' => array( 'class' => array() ), 'strong' => array(),
														'p' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 
														'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),

													));
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section><!--2-->
			    <?php endif;
				break;
				case 'ltri': 
					
						if ( ! empty( $fields['boxalign']) ){ 
							if ( $fields['boxalign']==='homeBoxTop' ){ $boxaligncls='homeBoxTop'; }
							elseif ( $fields['boxalign']==='homeBoxLeftImage' ){ $boxaligncls='homeBoxLeftImage';  }
							elseif ( $fields['boxalign']==='homeBoxRightImage' ){ $boxaligncls='homeBoxRightImage';  }
							else { $boxaligncls='homeBoxBottom'; }
						}
				?>
					<section>
						<div class="container-fluid bgWhite TopBottomPadding40 LeftRightPadding0">
                            <div class="row paddingZero <?php echo esc_attr($boxaligncls); ?>">
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 paddingZero">
                                    <div  class="padding40">
                                        <div class="padding40">
                                            <?php if ( ! empty( $fields['title_ltri'] ) ): ?>
                                            <h1 class="fontTxt MarginBottom25 paddingZero txtGrey textLeft"><?php echo wp_kses_post( $fields['title_ltri'] ); ?></h1>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $fields['description_ltri'] ) ): ?>
                                                <?php echo wp_kses( $fields['description_ltri'], array(
                                                        'br' => array( 'class' => array() ), 'strong' => array(),
                                                        'p' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 
                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array(),'class' => array() ),
                                                ) ); ?>
                                            <?php endif; ?>
											<?php if(!empty($fields['btntext_ltri'])){ ?>
											<a href="<?php echo esc_url($fields['btnlink_ltri']); ?>" class="fontTxt PaddingBottom5 MarginBottom25 font16 textLeft txtMetaBlue" target="_blank">
												<?php echo esc_html(($fields['btntext_ltri'])); ?> 
											</a>
											<?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 paddingZero">
                                    <?php if ( ! empty( $fields['file_ltri'] ) ){
                                        $image_ltri = wp_get_attachment_url($fields['file_ltri']);?>
                                        <img src="<?php echo esc_url($image_ltri)  ?>" class="img100 MarginBottom25" alt="Myanmar" />
                                    <?php } ?>
                                </div>
                            </div>
						</div>
					</section>
            	<?php break;
				case 'lirt': 
					if ( ! empty( $fields['boxalign']) ){ 
						if ( $fields['boxalign']==='homeBoxTop' ){ $boxaligncls='homeBoxTop'; }
						elseif ( $fields['boxalign']==='homeBoxLeftImage' ){ $boxaligncls='homeBoxLeftImage';  }
						elseif ( $fields['boxalign']==='homeBoxRightImage' ){ $boxaligncls='homeBoxRightImage';  }
						else { $boxaligncls='homeBoxBottom'; }
					}
					if ( ! empty( $fields['image_lirt'])) {
						$bgimg = wp_get_attachment_url($fields['image_lirt']);
					}
				?>
                	<section>
						<div class="container-fluid bgWhite TopBottomPadding40 LeftRightPadding0">
                            <div class="row paddingZero <?php echo esc_attr($boxaligncls); ?>">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 paddingZero">
                                    <?php if ( ! empty( $fields['image_lirt'])) { ?>
                                        <img src="<?php echo esc_url($bgimg); ?>" class="img100 MarginBottom25" alt="Myanmar" /> 
                                    <?php } ?>
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 paddingZero">
                                    <div class="padding40">
                                        <div class="padding40">
                                            <?php if(!empty($fields['title_lirt'])): ?>
                                                <h1 class="fontTxt MarginBottom25 paddingZero txtGrey textLeft"><?php echo wp_kses_post( $fields['title_lirt'] ); ?></h1>
                                            <?php endif; ?>
                                            <?php echo wp_kses( $fields['description_lirt'], array(
                                                'br' => array( 'class' => array() ),
                                                'strong' => array(),
                                                'p' => array( 'class' => array() ),
                                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array(),'class' => array() ),
                                            ) ); ?>
											<?php if(!empty($fields['btntext_lirt'])){ ?>
											<a href="<?php echo esc_url($fields['btnlink_lirt']); ?>" class="fontTxt PaddingBottom5 MarginBottom25 font16 textLeft txtMetaBlue" target="_blank">
												<?php echo esc_html(($fields['btntext_lirt'])); ?> 
											</a>
											<?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</section>
			    <?php break; 
			 	case 'homenews': 
					if ( ! empty( $fields['is_display'] )) {
						if($fields['is_display'] === 'yes')
						{
							$news_home = getnews_post_home(); 
							if ( $news_home->have_posts() ) { $i=1;
							?>
                            	<section>
                                    <div class="container-fluid bgWhite paddingZero">
                                        <div class="container">
                                            <div class="padding40">
                                            	<?php if(!empty($fields['title_blog'])): ?>
                                                	<h1 class="fontDisplay txtDarkBlue textLeft PaddingBottom40 marginZero">
                                                	<?php echo wp_kses_post( $fields['title_blog'] ); ?> </h1>
                                                <?php endif; ?>
                                                <div id="homeCarousel" class="owl-carousel owl-theme PaddingBottom40 LeftRightPadding0">
                                                <?php
												while ( $news_home->have_posts() )
												{
													$news_home->the_post();
													$news_cf = get_post_meta( get_the_ID(), 'newsup' , true );
													$newsimg='';
													$newsimg = wp_get_attachment_url($news_cf['simage']);
													$rurl = get_site_url().'/myanmar-update/#news'.get_the_ID();
													?>
                                                    <div class="item">
														<a href="<?php echo esc_url($rurl); ?>">
															<div class="homeCarouselDiv bgLightGrey paddingZero marginZero">
																<div class="padding25">
																	<div class="bgBlue MarginBottom25">
																	<?php if ( ! empty( $newsimg ) ): ?>
																		<img src="<?php echo esc_url( $newsimg ); ?>" alt="myanmar" class="carouselIcon" />
																	<?php endif; ?>
																	</div>
																	<p class="fontTxt marginZero PaddingBottom25 font20 txtGrey textLeft"><?php echo wp_kses_post(the_title()); ?></p>
																	<?php /*?><?php 
																		if ( ! empty( $news_cf['sdeschome'] ) ):
																		echo wp_kses( $news_cf['sdeschome'], 
																			array( 'br' => array( 'class' => array() ), 
																			'span' => array( 'class' => array() ), 
																			'h2' => array( 'class' => array() ), 
																			'h3' => array( 'class' => array() ), 
																			'ul' => array( 'class' => array() ), 
																			'li' => array( 'class' => array() ), 
																			'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
																			'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),'strong' => array(), 'p' => array( 'class' => array() ), 'class' => array() ) );
																		endif;
																	if ( ! empty( $news_cf['btntext'] ) ): 
																		$rurl = get_site_url().'/myanmar-update/#news'.get_the_ID();
																	?>
																		<a href="<?php echo esc_url($rurl); ?>" class="fontTxt PaddingBottom5 MarginBottom25 font16 textLeft txtMetaBlue"><?php echo wp_kses_post($news_cf['btntext']); ?></a>
																	<?php endif; */?>
																</div>
															</div>
														</a>
                                                    </div>
                                                    
                                                    <?php
													$i++;
												}wp_reset_postdata();
												?>
                                                </div>
											</div>
                                        </div>
                                    </div>
                                </section> 
                                <?php 
							}
						}
					}
				?>
                
            <?php break; ?>
				    
			<?php		
			endswitch;			  
		endforeach;
	endif;
?>

<?php
get_footer();