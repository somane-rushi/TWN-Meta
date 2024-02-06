<?php
/*
Template Name: Topic Template
*/

get_header();
?>
<?php 
$cateid=''; $bnrimg=''; $bimg=''; $ttime=''; $tdesc=''; $termcat='';
if(isset($_GET['id'])){ $cateid = sanitize_key($_GET['id']); } 
$termcat = get_term_by( 'id', $cateid, 'course_category' );    
$ttime = get_term_meta($cateid, 'cat_time', true );
$tdesc = get_term_meta( $cateid, 'cat_description', true );
$bimg = get_term_meta( $cateid, 'catbnr_image', true );
$bnrimg = wp_get_attachment_url( $bimg['bnimage'] );
$tcre = get_term_meta($cateid, 'cat_credits', true );

?>
<section>
	<div class="container-full padding-top-lg padding-bottom-lg"></div>
</section>
<section>
	<div class="container-full" style="display: block;">
		<div class="divFullFlex">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12 sidePanelGrey padding-left-no padding-right-no padding-bottom-no">
            	<?php include get_template_directory().'/page-templates/sidebar-portal.php'; ?>
			</div>
            
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-xx-12 bgwhite padding-left-no padding-right-no">
				<div class="div100 padding-bottom">
					
					<div class="dispBlock">
						<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 col-xx-12">
							<div class="moduleBanner">
								<?php if( !empty ($bnrimg) ){
									echo '<img src="'.esc_url( $bnrimg ).'" class="imgFull margin-bottom" />';
								} ?>
							</div><!--Module Banner-->
						</div>
					</div>
					
					<div class="padding-left padding-right dispContainerFlex">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12">

							<div class="dispFlexTitle">			
								<div class="" >
									<h1 class="fontXtraLight txtDarkGrey margin-bottom-sm margin-top text-left">
										<?php echo esc_html( $termcat->name ); ?>
									</h1><!--Title h1-->
									<?php echo wp_kses($tdesc['cat_desc'], array(
											'sup' => array(), 'br' => array(), 'p' => array( 'class' => array() ), 
											'span' => array( 'class' => array() ), 'strong' => array(),
											'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ), 
											'style' => array(),
											'a'   => array(
												'href'   => array(), 'title'  => array(), 'target' => array( '_blank' ),
											),
									) ); ?><!--Sub Title p tag-->
								</div>
								<div class="titleSpacerDiv" >
									<div class="titleSpacer hidden-xs hidden-xx"></div>										
									<div class="titleSpacerMob hidden-lg hidden-md hidden-sm"></div>										
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12 padding-left-no padding-right-no">
									<div class="margin-top margin-bottom whiteBoxFlex">
                                    	<?php if ( ! empty( $tcre['catcreadits'] ) ): ?>
										<div class="dispContainerFlex">
											<img src="https://realitylabsacademy.fb.com/wp-content/uploads/2022/01/credits-grey.png" alt="Credits" class="iconImgSmall margin-left margin-right" />
											<p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font16">
                                            <?php echo esc_html( $tcre['catcreadits']).' Credits'; ?> </p>
										</div>
                                        <?php endif; ?>
										<?php if ( ! empty( $ttime['cattime'] ) ): ?>
										<div class="dispContainerFlex">
											<img src="https://realitylabsacademy.fb.com/wp-content/uploads/2022/01/clock-grey.png" alt="Clock" class="iconImgSmall margin-left margin-right" />
											<p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font16"><?php echo esc_html( $ttime['cattime']); ?></p>
										</div>
                                        <?php endif; ?>
									</div>
								</div>
							</div>
						</div>
						
					</div><!--title and info-->
                                        
                    <div class="padding-left padding-right dispBlock">
						<div class="margin-bottom-lg">
							
                        <?php 
							global $post; $i=1;
							$scourse = course_post($cateid); 
							while ( $scourse->have_posts() ) : $scourse->the_post();
								$ctime = get_post_meta( get_the_ID(), 'courses', true ); 
								$cdata = get_post_meta( get_the_ID(), 'courseslist', true );
								$cimg = wp_get_attachment_url( $cdata['slistimage'] );
								if($i===1){
						?>
								<div class="row">
                            	<?php } ?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-xx-12">
									<h4 class="fontTxt titlePatch txtGrey text-center margin-bottom margin-top margin-left-no margin-right-no">
										<?php echo wp_kses($cdata['ctitle'], array(
											'sup' => array(), 'br' => array(), 
											'span' => array( 'class' => array() ), 'strong' => array(),
											'style' => array(),										
										) ); ?>
									</h4><!--Topic Title-->
									<div class="dispTitleFlex margin-bottom margin-top">
										<div class="contWidthDiv font14 txtDarkGrey fontXtraLight margin-bottom-no margin-top-no">
											<!--<p class="font18 txtDarkGrey fontXtraLight margin-bottom margin-top">-->
												<!--Subtitle 'p' tag-->
												<?php echo wp_kses($cdata['slistdesc'], array(
														'sup' => array(), 'br' => array(), 'p' => array( 'class' => array() ), 
														'span' => array( 'class' => array() ), 'strong' => array(),
														'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ), 
														'style' => array(),
														'a'   => array(
															'href'   => array(), 'title'  => array(), 'target' => array( '_blank' ),
														),
												) ); ?>
											<!--</p>-->
										</div>								
									</div><!--Topic Content-->
									<div class=""><!--tilter-->
										<a href="<?php echo esc_url( get_site_url() ); ?>/course/<?php echo esc_html($post->post_name); ?>">
											<img src="<?php echo esc_url( $cimg ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="img90 margin-bottom thumbBoxShadow" />
										</a>
									</div><!--Tilt class removed-->
									<div class="dispTitleFlex margin-bottom">
										<div class="contWidth80Div">
                                        	<?php if ( ! empty( $ctime['vdtime'] ) ): ?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
                                            
												<img src="https://realitylabsacademy.fb.com/wp-content/uploads/2022/01/clock-grey.png" style="Clock" class="iconImgSmall" />
												<p class="text-center txtGrey margin-bottom-sm margin-top-sm"><?php echo esc_html( $ctime['vdtime'] ); ?></p>
											</div>
                                            <?php endif; ?>
											<?php if ( ! empty( $ctime['vdcredits'] ) ): ?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
												<img src="https://realitylabsacademy.fb.com/wp-content/uploads/2022/01/credits-grey.png" style="Credits" class="iconImgSmall" />
												<p class="text-center txtGrey margin-bottom-sm margin-top-sm"><?php echo esc_html( $ctime['vdcredits']).' Credits'; ?></p>
											</div>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $ctime['vdprogress'] ) ): ?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 padding-left-no padding-right-no">
												<div class="progress progress-brand">
													<div class="progress-bar" style="width: <?php echo esc_html( $ctime['vdprogress']).'%'; ?>"></div>
												</div>
												<p class="text-center txtGrey margin-bottom-sm margin-top-sm"><?php echo esc_html( $ctime['vdprogress']).'%'; ?></p>
											</div>
                                            <?php endif; ?>
										</div>								
									</div><!--Credits, Duration and Progress-->									
								</div>
                            <?php if($i===3){ $i=0; ?>
							</div><!--End of row Added-->	
                            <div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs hidden-xx">
									<div class="margin-bottom margin-top topicDivider"></div>
								</div>	
							</div>
                            <?php } ?>
                            <?php $i++; endwhile; ?>
                           	
						</div><!--End of Unfinished Topics-->
					</div><!--More Topics-->
					<div class="padding-left padding-right dispBlock padding-bottom-no">
						<div class="div100">
							<div class="container-full">
								<div class="dotPatternContainer">
								</div>
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
