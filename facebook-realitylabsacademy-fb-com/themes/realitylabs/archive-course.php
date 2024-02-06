<?php
/**
 * The template for displaying course archive pages
 */

get_header();
global $wp_query;
$cat_id='';
if(isset($_GET['course'])){ $cat_id = sanitize_key($_GET['course']); }


$argsp = array(
		'name'   => $cat_id,
        'post_type'   => 'course',
        'numberposts' => 1,
        'fields'      => 'ids',
);


$the_query = new WP_Query( $argsp );

$posts1 = get_posts(array(
            'name' => 'creating-a-portal',
            'posts_per_page' => 1,
            'post_type' => 'course',
            'post_status' => 'publish'
    ));
print_r($posts1);
?>

<section>
	<div class="container-full padding-top-lg padding-bottom-lg">
	</div>
</section>
<section>
	<div class="container-full" style="display: block;">
		<div class="divFullFlex">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12 sidePanelGrey padding-left-no padding-right-no padding-bottom-no">
            	<?php include('sidebar-portal.php'); ?>
			</div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-xx-12 bgwhite padding-left-no padding-right-no">
				<div class="div100 padding-bottom">
                	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$couredata = get_post_meta( get_the_ID(), 'courses' , true );
						$bannerimg = wp_get_attachment_url( $couredata['bimage'] );
					?>
                        <div class="moduleBanner">
                            <img src="<?php echo esc_url( $bannerimg ); ?>" class="imgFull margin-bottom" alt="<?php echo esc_html( get_the_title() ); ?>" />
                        </div><!--Module Banner-->
                        <div class="padding-left padding-right dispContainerFlex">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xx-12">
                                <h1 class="fontXtraLight txtDarkGrey margin-bottom-lg margin-top-lg text-left">
                                <?php echo esc_html( get_the_title() ); ?></h1>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                                <div class="margin-top margin-bottom whiteBoxFlex" style="">
                                    <div class="dispContainerFlex">
                                        <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/credits-icon.png" alt="<?php echo esc_html( get_the_title() ); ?>" class="iconImgSmall margin-left margin-right" />
                                        <p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font16">7 Credits</p>
                                    </div>
                                    <div class="dispContainerFlex">
                                        <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/clock-icon.png" alt="<?php echo esc_html( get_the_title() ); ?>" class="iconImgSmall margin-left margin-right" />
                                        <p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font16">
                                        <?php echo esc_html( $couredata['vdtime'] ); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div><!--title and info-->
                        <div class="padding-left padding-right dispContainerFlex">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xx-12">
                                <video controls poster="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/videocover.jpg" class="margin-bottom margin-top">
                                    <source src="vid/sample.mp4" type="video/mp4">
                                </video>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                                <div class="margin-top-no margin-bottom whiteBoxBlock2">
                                    <div class="dispContainerFlex">
                                        <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/take-test-icon.png" alt="" class="iconImgSmall margin-left margin-right" />
                                        <p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font18">Take test to earn credits</p>
                                    </div>
                                    <div class="dispBlock divFull">
                                        <p class="margin-bottom-sm margin-top-sm txtGrey margin-left margin-right text-left fontXtraLight font12">Make sure you complete the test associated with this topic so as to learn the credits allocated to it.</p>
                                        <p class="text-right margin-left margin-right "><a class="btn btnGrey waves-attach waves-light padding-left padding-right font12 fontTxt">Start Test</a></p>	
                                    </div>										
                                </div><!--1-->
                                <div class="margin-top-no margin-bottom whiteBoxBlock2">
                                    <div class="dispContainerFlex">
                                        <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/download-pdf-icon.png" alt="" class="iconImgSmall margin-left margin-right" />
                                        <p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font18">Download/Print the PDF</p>
                                    </div>
                                    <div class="dispBlock divFull">
                                        <p class="margin-bottom-sm margin-top-sm txtGrey margin-left margin-right text-left fontXtraLight font12">For this topic for ease of use when you are actually working on Spark AR</p>
                                        <p class="text-right margin-left margin-right "><a class="btn btnGrey waves-attach waves-light padding-left padding-right font12 fontTxt">Download</a></p>	
                                    </div>										
                                </div><!--2-->
                            </div>
                        </div><!--video and other info-->
                        <div class="padding-left padding-right dispBlock">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12">
                                <h3 class="text-left txtDarkGrey fontXtraLight margin-bottom margin-top">Expert Tips</h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12">
                                <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/expert-img-icon.png" alt="" class="margin-top expertIcon" style="" />
                                <p class="text-center margin-bottom-sm margin-top-sm txtGrey fontXtraLight font16">John Kung</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12">
                                <p class="text-left margin-bottom-lg margin-top-lg txtGrey fontXtraLight font16">Learn John’s expert tips to navigate Spark AR better</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                                <div class="tilter">
                                    <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/expert-tip-1.png" alt="" class="imgFull margin-bottom-sm margin-top-no" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12">
                                <div class="tilter">
                                    <img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/expert-tip-2.png" alt="" class="imgFull margin-bottom-sm margin-top-no" />
                                </div>
                            </div>
                        </div><!--Expert Tips-->
                    <?php endwhile; ?>
                    <div class="padding-left padding-right dispBlock">
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
            
            
            

<?php get_footer(); ?>