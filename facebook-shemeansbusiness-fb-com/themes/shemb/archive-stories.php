<?php
/**
 * The template for displaying stories archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shemb
 */

get_header();
	
?>
<?php $fields = get_option( "archive_stories", array() ); ?>
<?php if ( ! empty( $fields['description'] ) ): ?>
<section class="top-area greenback">
	<div class="container">
		<div class="col-lg-12">
			<p class="top-para">
            	<?php echo wp_kses( $fields['description'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'class' => array() ) ); ?>
            </p>
		</div>
	</div>
</section>
<?php endif; ?>
<section id="stories_tabs">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            	<?php $mcountry = story_country('0'); 
					if ( ! empty( $mcountry ) ): ?>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                <?php foreach ( $mcountry as $cou ) { ?>
                                <a class="nav-item nav-link" id="nav-<?php echo wp_kses_post($cou->slug); ?>-tab" data-toggle="tab" href="#<?php echo wp_kses_post($cou->slug); ?>" role="tab" aria-controls="<?php echo wp_kses_post($cou->slug); ?>" aria-selected="false"><?php echo wp_kses_post($cou->name); ?></a>
                                <?php } ?>
                            </div>
                        </nav>
                <?php endif; ?>
				<div class="divder"></div>

			</div>
                
				
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
   
                <?php $mcountrytab = story_country('0'); 
					if ( ! empty( $mcountrytab ) ):
				?>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    	<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">							
                            	<?php 
                            	foreach ( $mcountrytab as $mtab ) {
									
									$subcoun = story_country($mtab->term_id);
									if ( ! empty( $subcoun ) ) {
										
										foreach ( $subcoun as $scou ) {
											$allcontent = getstory_post($scou->slug);
											$catimg = get_term_meta( wp_kses_post($scou->term_id), 'cat_image', true );
											$cimage = wp_get_attachment_url( $catimg['cimage'] );
											
											if ( $allcontent->have_posts() ) {
												echo '<div class="row valign rowcs">'; 
												if( !empty ($cimage) ) { ?>
												<div class="maparea">
                                                    	<img class="con-flag" src="<?php echo esc_url($cimage); ?>" alt="<?php echo wp_kses_post($scou->slug); ?>" />
												</div>
											<div class="flxbxrow r1">

												<?php }
												
												$pid ='';
												while ( $allcontent->have_posts() ): $allcontent->the_post();
													$story = get_post_meta( get_the_ID(), 'story', true);
													$storyimg = wp_get_attachment_url($story['simage']); 
													$pid=get_the_ID();
													?>
                                             <div class="flxbxstart">

													<div data-id="storyAP1" class="storyA">
															<div class="flip-card">
																<div class="flip-card-inner">
																	<div class="flip-card-front">
																		<div class="storyBox">
																			<div>
                                                                            	<?php echo wp_kses( $story['sname'], array(
																						'br' => array( 'class' => array() ),
																						'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																						'strong' => array(),
																						'style' => array(),
																					) ); ?>
                                                                            </div>
																			<img src="<?php echo esc_url( $storyimg ); ?>">
																			<div>
                                                                            	<?php echo wp_kses( $story['sbusiness'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																				'strong' => array(),
																				'style' => array(),
																					) ); ?>
                                                                            </div>
																			<div>Read More</div>
																		</div>
																	</div>																	
                                                                    <div class="flip-card-back" data-toggle="modal" data-target="#allsmodal<?php echo wp_kses_post($pid); ?>">
																		<div class="contentWrapper">
																			<div>
                                                                            <?php echo wp_kses( $story['sdescription'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																				'strong' => array(),
																				'style' => array(),
																			) ); ?>
																			<span>Click for detailed story</span></div>
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
                                                                            <h2><?php echo wp_kses_post(get_the_title()); ?></h2>
                                                                            <?php } if( !empty( $strpop['smloc'] ) ) { ?>
																			<h2><?php echo wp_kses_post($strpop['smloc']); ?></h2>
                                                                            <?php } ?>
																		</div>
                                                                        <?php 
																		if( !empty( $strpop['popupblocks'] ) ) {
																		foreach($strpop['popupblocks'] as $block)
																		{
																			if($block['sec_type']==='fullheading')
																			{ 
																				if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) {
																			?>
																				<div class="col-lg-12 storypopfullheading">
                                                                                	<h2>
																					<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?> </h2>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='fulltext')
																			{ 
																				if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) {
																			?>
																				<div class="col-lg-12 para1">
																					<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='twocol_iltr')
																			{ 
																				$ritimg = wp_get_attachment_url($block['sec_twocol_iltr_fields']['poplimage']); 
																			if( !empty( $block['sec_twocol_iltr_fields']['poprightttext']) && !empty($ritimg) ) {
																			
																			?>
                                                                            	<div class="main1">
                                                                                    <div class="col-sm-12 col-lg-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $ritimg ); ?>" />
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-sm-4 head1">
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
                                                                                    <div class="col-sm-12 col-md-4 head1">
                                                                                        <h2>
                                                                                        <?php echo wp_kses( $block['sec_twocol_irtl_fields']['poplefttext'] , array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																						</h2>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $lfimg ); ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            <?php
																				}
																			}
																		}
																		}
																		?>
                                                                        
																	</div>
																</div>
																	</div>
															</div>
															</div><!-- modal -->
														</div>
												    
												<?php endwhile; wp_reset_postdata();
												
												echo '</div></div>';
											}
										}
									}
									else
									{
										$allcontentm = getstory_post($mtab->slug);
										$catimg = get_term_meta( wp_kses_post($mtab->term_id), 'cat_image', true );
										$cimage = wp_get_attachment_url( $catimg['cimage'] );
										if ( $allcontentm->have_posts() ) {
											echo '<div class="row valign rowcs r2">'; 
											if( !empty ($cimage) ) { ?>
											<div class="maparea">
													<img class="con-flag" src="<?php echo esc_url($cimage); ?>" alt="<?php echo wp_kses_post($scou->slug); ?>" />
											</div>
											<div class="flxbxrow r2">

											<?php }
											$pid ='';
											while ( $allcontentm->have_posts() ): $allcontentm->the_post();
												$story = get_post_meta( get_the_ID(), 'story', true);
												$storyimg = wp_get_attachment_url($story['simage']); 
												$pid=get_the_ID(); ?>
												<div class="flxbxstart">
													<div data-id="storyAP1" class="storyA">
														<div class="flip-card">
															<div class="flip-card-inner">
																<div class="flip-card-front">
																	<div class="storyBox">
																		<div>
																		<?php echo wp_kses( $story['sname'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																				'strong' => array(),
																				'style' => array(),
																			) ); ?>
																		</div>
																		<img src="<?php echo esc_url( $storyimg ); ?>">
																		<div><?php echo wp_kses( $story['sbusiness'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																				'strong' => array(),
																				'style' => array(),
																					) ); ?></div>
																		<div>Read More</div>
																	</div>
																</div>
																<div class="flip-card-back" data-toggle="modal" data-target="#allmodal<?php echo wp_kses_post($pid); ?>">
																	<div class="contentWrapper">
																		<div>
																			<?php echo wp_kses( $story['sdescription'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																				'strong' => array(),
																				'style' => array(),
																			) ); ?>
																			<span style="font-size:12px;">
                                                                            Click for detailed story</span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
                                                        
                                                        <div class="modal fade" id="allmodal<?php echo wp_kses_post($pid); ?>" tabindex="-1" role="dialog" aria-labelledby="ShembLongTitle" aria-hidden="true">
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
                                                                            <h2><?php echo wp_kses_post(get_the_title()); ?></h2>
                                                                            <?php } if( !empty( $strpop['smloc'] ) ) { ?>
																			<h2><?php echo wp_kses_post($strpop['smloc']); ?></h2>
                                                                            <?php } ?>
																		</div>
                                                                        <?php
																		foreach($strpop['popupblocks'] as $block)
																		{
																			if($block['sec_type']==='fullheading')
																			{ 
																				if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) {
																			?>
																				<div class="col-lg-12 storypopfullheading">
                                                                                	<h2>
																					<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?> </h2>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='fulltext')
																			{ 
																				if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) {
																			?>
																				<div class="col-lg-12 para1">
																					<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='twocol_iltr')
																			{ 
																				$ritimg = wp_get_attachment_url($block['sec_twocol_iltr_fields']['poplimage']); 
																			if( !empty( $block['sec_twocol_iltr_fields']['poprightttext']) && !empty($ritimg) ) {
																			
																			?>
                                                                            	<div class="main1">
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $ritimg ); ?>" />
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-4 head1">
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
                                                                                    <div class="col-sm-12 col-md-4 head1">
                                                                                        <h2>
                                                                                        <?php echo wp_kses( $block['sec_twocol_irtl_fields']['poplefttext'] , array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																						</h2>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $lfimg ); ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            <?php
																				}
																			}
																		}
																		?>
                                                                        
																	</div>
																</div>
															</div>
                                                        </div><!-- modal -->
                                                        
													</div>
												</div>
												<?php endwhile; wp_reset_postdata();
											echo '</div></div>';
										}
									}
								} ?>
						</div> <!-- row -->
						
                    	<?php $i=1; 
						foreach ( $mcountrytab as $mtab ) { ?>
						
                        	<div class="tab-pane fade" id="<?php echo wp_kses_post($mtab->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo wp_kses_post($mtab->slug); ?>-tab">
                            	<?php $subcoun = story_country($mtab->term_id);
									if ( ! empty( $subcoun ) ) { ?>
                                    	<nav>
                  							<div class="nav nav-tabs nav-fill subnav" id="nav-tab" role="tablist">
                                            	<a class="nav-item nav-link active" id="nav-all-<?php echo wp_kses_post($mtab->slug); ?>-tab" data-toggle="tab" href="#all-<?php echo wp_kses_post($mtab->slug); ?>" role="tab" aria-controls="nav-<?php echo wp_kses_post($mtab->slug); ?>" aria-selected="true">All</a> 
                                                <?php foreach ( $subcoun as $scou ) { ?>
                                                	<a class="nav-item nav-link" id="nav-<?php echo wp_kses_post($scou->slug); ?>-tab" data-toggle="tab" data-parent="<?php echo wp_kses_post($mtab->slug); ?>" href="#<?php echo wp_kses_post($scou->slug); ?>" role="tab" aria-controls="<?php echo wp_kses_post($scou->slug); ?>" aria-selected="false"><?php echo wp_kses_post($scou->name); ?></a>
                                                <?php } ?>
                                            </div>
                                        </nav>
                                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-subtabContent">
                                        	<div class="tab-pane fade show active" id="all-<?php echo wp_kses_post($mtab->slug); ?>" role="tabpanel" aria-labelledby="nav-all-<?php echo wp_kses_post($mtab->slug); ?>-tab">
                                            	<?php
												foreach ( $subcoun as $scou ) { $c=1;
                                            	$allcontentsub = getstory_post($scou->slug);
                                                $catimg = get_term_meta( wp_kses_post($scou->term_id), 'cat_image', true );
                                                $cimage = wp_get_attachment_url( $catimg['cimage'] );
												if ( $allcontentsub->have_posts() ) {
													echo '<div class="row valign rowcs ">'; 
													if( !empty ($cimage) ) { ?>
													<div class="maparea">
															<img class="con-flag" src="<?php echo esc_url($cimage); ?>" alt="<?php echo wp_kses_post($scou->slug); ?>" />
													</div>
													<div class="flxbxrow">
	
													<?php }
													$pid ='';
													while ( $allcontentsub->have_posts() ): $allcontentsub->the_post();
														$story = get_post_meta( get_the_ID(), 'story', true);
														$storyimg = wp_get_attachment_url($story['simage']); 
														$pid=get_the_ID(); ?>
														<div class="flxbxstart">
															<div data-id="storyAP1" class="storyA">
																<div class="flip-card">
																	<div class="flip-card-inner">
																		<div class="flip-card-front">
																			<div class="storyBox">
																				<div>
																				<?php echo wp_kses( $story['sname'], array(
																						'br' => array( 'class' => array() ),
																						'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																						'strong' => array(),
																						'style' => array(),
																					) ); ?>
																				</div>
																				<img src="<?php echo esc_url( $storyimg ); ?>">
																				<div>
                                                                                	<?php echo wp_kses( $story['sbusiness'], array(
																						'br' => array( 'class' => array() ),
																						'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																						'strong' => array(),
																						'style' => array(),
																							) ); ?>
                                                                                </div>
																				<div>Read More</div>
																			</div>
																		</div>
																		<div class="flip-card-back" data-toggle="modal" data-target="#tabmodal<?php echo wp_kses_post($pid); ?>">
																			<div class="contentWrapper">
																				<div>
																					<?php echo wp_kses( $story['sdescription'], array(
																						'br' => array( 'class' => array() ),
																						'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																						'strong' => array(),
																						'style' => array(),
																					) ); ?>
                                                                                    
																					<span>Click for detailed story</span></div>
																			</div>
																		</div>
																	</div>
																</div>
                                                                
                                                                <div class="modal fade" id="tabmodal<?php echo wp_kses_post($pid); ?>" tabindex="-1" role="dialog" aria-labelledby="ShembLongTitle" aria-hidden="true">
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
                                                                            <h2><?php echo wp_kses_post(get_the_title()); ?></h2>
                                                                            <?php } if( !empty( $strpop['smloc'] ) ) { ?>
																			<h2><?php echo wp_kses_post($strpop['smloc']); ?></h2>
                                                                            <?php } ?>
																		</div>
                                                                        <?php
																		if( !empty( $strpop['popupblocks'] ) ) {
																		foreach($strpop['popupblocks'] as $block)
																		{
																			if($block['sec_type']==='fullheading')
																			{ 
																				if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) {
																			?>
																				<div class="col-lg-12 storypopfullheading">
                                                                                	<h2>
																					<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?> </h2>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='fulltext')
																			{ 
																				if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) {
																			?>
																				<div class="col-lg-12 para1">
																					<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='twocol_iltr')
																			{ 
																				$ritimg = wp_get_attachment_url($block['sec_twocol_iltr_fields']['poplimage']); 
																			if( !empty( $block['sec_twocol_iltr_fields']['poprightttext']) && !empty($ritimg) ) {
																			
																			?>
                                                                            	<div class="main1">
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $ritimg ); ?>" />
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-4 head1">
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
                                                                                    <div class="col-sm-12 col-md-4 head1">
                                                                                        <h2>
                                                                                        <?php echo wp_kses( $block['sec_twocol_irtl_fields']['poplefttext'] , array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																						</h2>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $lfimg ); ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            <?php
																				}
																			}
																		} }
																		?>
                                                                        
																	</div>
																</div>
															</div>
                                                        </div><!-- modal -->
                                                                
															</div>
														</div>
												<?php endwhile; wp_reset_postdata();
													echo '</div></div>';
												}
												}
                                                ?>
                                            </div>
                                            <?php foreach ( $subcoun as $scou ) { $c=1;  
											$catimg = get_term_meta( wp_kses_post($scou->term_id), 'cat_image', true );
											$cimage = wp_get_attachment_url( $catimg['cimage'] );
											?>
                                        	
                                            <div class="tab-pane fade" id="<?php echo wp_kses_post($scou->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo wp_kses_post($scou->slug); ?>-tab">
                                            	<div class="row valign rowcs">
													<?php if( !empty ($cimage) ) { ?>
														<div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2">
                                                    <div class="maparea">
                                                    	<img class="con-flag" src="<?php echo esc_url($cimage); ?>" alt="<?php echo wp_kses_post($scou->slug); ?>" />
													</div>
													</div>
													<div class="flxbxrow grr">

                                                    <?php } ?>
                                                    <?php 
													$tabcontent = getstory_post($scou->slug);
													if ( $tabcontent->have_posts() ) { 
														$pid ='';
														while ( $tabcontent->have_posts() ): $tabcontent->the_post();
														$story = get_post_meta( get_the_ID(), 'story', true);
														$storyimg = wp_get_attachment_url($story['simage']);
														$pid = get_the_ID();
													?>
                                                    <div class="flxbxstart">
														<div data-id="storyAP1" class="storyA">
															<div class="flip-card">
																<div class="flip-card-inner">
																	<div class="flip-card-front">
																		<div class="storyBox">
																			<div>
																				<?php 
																					if( !empty($story['sname']) ){
																					echo wp_kses( $story['sname'], array(
																						'br' => array( 'class' => array() ),
																						'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																						'strong' => array(),
																						'style' => array(),
																					) ); } ?>
																			</div>
                                                                            <?php if( !empty($storyimg) ){ ?>
																			<img src="<?php echo esc_url( $storyimg ); ?>">
                                                                            <?php } ?>
																			<div>
                                                                            <?php if( !empty($story['sbusiness']) ){ ?>
																			<?php echo wp_kses( $story['sbusiness'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																				'strong' => array(),
																				'style' => array(),
																					) );
																				} ?>
																			</div>
																			<div>Read More</div>
																		</div>
																	</div>
																	<div class="flip-card-back" data-toggle="modal" data-target="#tabsmodal<?php echo wp_kses_post($pid); ?>">
																		<div class="contentWrapper">
																			<div>
                                                                            <?php 
																				if( !empty($story['sdescription']) ){
																					echo wp_kses( $story['sdescription'], array(
																					'br' => array( 'class' => array() ),
																					'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																					'strong' => array(),
																					'style' => array(),
																					) );
																				}?>
																			<span>Click for detailed story</span></div>
                                                                        </div>
																	</div>
																</div>
															</div>
                                                            <div class="modal fade" id="tabsmodal<?php echo wp_kses_post($pid); ?>" tabindex="-1" role="dialog" aria-labelledby="ShembLongTitle" aria-hidden="true">
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
                                                                            <h2><?php echo wp_kses_post(get_the_title()); ?></h2>
                                                                            <?php } if( !empty( $strpop['smloc'] ) ) { ?>
																			<h2><?php echo wp_kses_post($strpop['smloc']); ?></h2>
                                                                            <?php } ?>
																		</div>
                                                                        <?php
																		if( !empty( $strpop['popupblocks'] ) ) {
																		foreach($strpop['popupblocks'] as $block)
																		{
																			if($block['sec_type']==='fullheading')
																			{ 
																				if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) {
																			?>
																				<div class="col-lg-12 storypopfullheading">
                                                                                	<h2>
																					<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?> </h2>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='fulltext')
																			{ 
																				if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) {
																			?>
																				<div class="col-lg-12 para1">
																					<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='twocol_iltr')
																			{ 
																				$ritimg = wp_get_attachment_url($block['sec_twocol_iltr_fields']['poplimage']); 
																			if( !empty( $block['sec_twocol_iltr_fields']['poprightttext']) && !empty($ritimg) ) {
																			
																			?>
                                                                            	<div class="main1">
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $ritimg ); ?>" />
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-4 head1">
                                                                                    	<?php if( !empty( $block['sec_twocol_iltr_fields']['poprightttext'] ) ) { ?>
                                                                                        <h2>
																						<?php echo wp_kses( $block['sec_twocol_iltr_fields']['poprightttext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																						</h2>
                                                                                        <?php } ?>
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
                                                                                    <div class="col-sm-12 col-md-4 head1">
                                                                                        <h2>
                                                                                        <?php echo wp_kses( $block['sec_twocol_irtl_fields']['poplefttext'] , array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																						</h2>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-4 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $lfimg ); ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            <?php
																				}
																			}
																		} }
																		?>
                                                                        
																	</div>
																</div>
															</div>
                                                        </div><!-- modal -->
                                                            
														</div>
                                                    </div>
                                                    <?php endwhile; wp_reset_postdata();
													} ?>
													
												
												</div>
                                                </div>
                                            </div>
                                            
                                        	<?php  } ?>
                                        </div> <!-- tab content -->
                                        
								<?php } else { 
								
									$catimg = get_term_meta( wp_kses_post($mtab->term_id), 'cat_image', true );
									$cimage = wp_get_attachment_url( $catimg['cimage'] );
								?>
                                	 <div class="row valign rowcs">
									<?php if( !empty ($cimage) ) { ?>
										<div class="maparea">
											<img class="con-flag" src="<?php echo esc_url($cimage); ?>" alt="<?php echo wp_kses_post($scou->slug); ?>" />
									</div>
									<div class="flxbxrow r3">

									<?php } ?>
                                	<?php
									$tabcontent = getstory_post($mtab->slug);
									if ( $tabcontent->have_posts() ) { 
										$pid ='';
										while ( $tabcontent->have_posts() ): $tabcontent->the_post();
											$story = get_post_meta( get_the_ID(), 'story', true);
											$storyimg = wp_get_attachment_url($story['simage']);
											$pid=get_the_ID();
										?>
											<div class="flxbxstart">
												<div data-id="storyAP1" class="storyA">
													<div class="flip-card">
														<div class="flip-card-inner">
															<div class="flip-card-front">
																<div class="storyBox">
                                                                <?php if( !empty ($story['sname']) ) { ?>
																	<div>
                                                                    	<?php echo wp_kses( $story['sname'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																				'strong' => array(),
																				'style' => array(),
																		) ); ?>
                                                                    </div>
																<?php } ?>
																	<img src="<?php echo esc_url( $storyimg ); ?>">
                                                                <?php if( !empty ($story['sbusiness']) ) { ?>
																	<div>
                                                                    	<?php echo wp_kses( $story['sbusiness'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																				'strong' => array(),
																				'style' => array(),
																					) ); ?>
                                                                    </div>
																<?php } ?>
																	<div>Read More</div>
																</div>
															</div>
															<div class="flip-card-back" data-toggle="modal" data-target="#mainmodal<?php echo wp_kses_post($pid); ?>">
																<div class="contentWrapper">
																	<div>
                                                                    	<?php 
																			if( !empty ( $story['sdescription'] ) ) {
																				echo wp_kses( $story['sdescription'], array(
																				'br' => array( 'class' => array() ),
																				'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
																				'strong' => array(),
																				'style' => array(),
																				) );
																			} ?>
																	<span>Click for detailed story</span></div>
																</div>
															</div>
														</div>
													</div>
                                                    
                                                    <div class="modal fade" id="mainmodal<?php echo wp_kses_post($pid); ?>" tabindex="-1" role="dialog" aria-labelledby="ShembLongTitle" aria-hidden="true">
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
                                                                            <h2><?php echo wp_kses_post(get_the_title()); ?></h2>
                                                                            <?php } if( !empty( $strpop['smloc'] ) ) { ?>
																			<h2><?php echo wp_kses_post($strpop['smloc']); ?></h2>
                                                                            <?php } ?>
																		</div>
                                                                        <?php if( !empty( $strpop['popupblocks'] ) ) {
																		foreach($strpop['popupblocks'] as $block)
																		{
																			if($block['sec_type']==='fullheading')
																			{ 
																				if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) {
																			?>
																				<div class="col-lg-12 storypopfullheading">
                                                                                	<h2>
																					<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?> </h2>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='fulltext')
																			{ 
																				if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) {
																			?>
																				<div class="col-lg-12 para1">
																					<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																				</div>
                                                                                <?php 
																			} }
																			if($block['sec_type']==='twocol_iltr')
																			{ 
																				$ritimg = wp_get_attachment_url($block['sec_twocol_iltr_fields']['poplimage']); 
																			if( !empty( $block['sec_twocol_iltr_fields']['poprightttext']) && !empty($ritimg) ) {
																			
																			?>
                                                                            	<div class="main1">
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $ritimg ); ?>" />
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-4 head1">
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
                                                                                    <div class="col-sm-12 col-md-4 head1">
                                                                                        <h2>
                                                                                        <?php echo wp_kses( $block['sec_twocol_irtl_fields']['poplefttext'] , array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
																						</h2>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-8 img-main pad-0">
                                                                                        <img src="<?php echo esc_url( $lfimg ); ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            <?php
																				}
																			}
																		} }
																		?>
                                                                        
																	</div>
																</div>
															</div>
                                                        </div><!-- modal -->
												</div>
											</div>
                                        
                                        <?php endwhile; wp_reset_postdata();
									}
									?>
									
								</div>
                                    </div> <!-- row -->
                                	
                                <?php } ?>
                                    
                            </div>
                        <?php
						$i++;
						} //for ?>
                    </div>
                <?php endif; ?>
			</div> <!-- 12 -->
		</div>
	</div>
</section> 
 
<?php
get_footer();
?>

