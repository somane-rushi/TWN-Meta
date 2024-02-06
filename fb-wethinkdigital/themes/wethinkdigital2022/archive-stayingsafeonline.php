<?php
/**
 * The template for displaying stayingsafeonline archive pages
 */

get_header();
?>

<?php $fields = get_option( "archive_stayingsafeonline", array() ); 
	$banfclr=''; $txtdir='';
	if($fields['banner_fcolor']==='purple'){ $banfclr='txtPurple'; }
	else if($fields['banner_fcolor']==='light_green'){ $banfclr='txtGreen'; }
	else if($fields['banner_fcolor']==='white'){ $banfclr='txtWhite'; }
	else{ $banfclr='txtBlack'; }
	if($fields['text_direction']==='left'){ $txtdir='dirLTR'; }
	else if($fields['text_direction']==='right'){ $txtdir='dirRTL'; }
?>
<?php if ( ! empty( $fields['heading'] ) ) { 
	$headbg = wp_get_attachment_url($fields['bg_image']); ?>
	<section>
		<div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url('<?php echo esc_url( $headbg ); ?>');">
        	<div class="container dirRTL">
				<div class="newRow">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 paddingZero">                           
						<div class="headerTitle padding30">
                        	<?php if ( ! empty( $fields['heading'] ) ): ?>
							<h1 class="txtWhite fontDisplay paddingZero MarginBottomZero <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
                            <?php endif; ?>
                            <?php if ( ! empty( $fields['banner_content'] ) ): ?>
							<div class="txtWhite fontDisplay TopBottomPadding35 font18 txtWhite marginZero <?php echo wp_kses_post($txtdir); ?>">
                                <?php echo wp_kses( $fields['banner_content'], 
									array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
									'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
									'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
									'strong' => array(), 'class' => array() ) ); ?>
                            </div>
                            <?php endif; ?>
						</div>
						<div class="headerTitleMob padding30">
                        	<?php if ( ! empty( $fields['headingm'] ) ): ?>
							<h1 class="txtWhite fontDisplay txtWhite marginZero <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['headingm'] ); ?></h1>
                            <?php endif; ?>
                            <?php if ( ! empty( $fields['banner_contentm'] ) ): ?>
							<div class="txtWhite fontDisplay TopBottomPadding25 font14 txtWhite marginZero <?php echo wp_kses_post($txtdir); ?>">
                                <?php echo wp_kses( $fields['banner_contentm'], 
									array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
									'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
									'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
									'strong' => array(), 'class' => array() ) ); ?>
                            </div>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<section>
	<div class="container-fluid bgWhite paddingZero">
		<div class="container">
		<div class="padding40">
			<div class="row marginZero">
				<?php if ( ! empty( $fields['main_content'] ) ): ?>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero <?php echo wp_kses_post($txtdir); ?>">
						<div class="fontTxt marginZero paddingZero font16 txtGreydirRTL <?php echo wp_kses_post($txtdir); ?>">
                        	<?php echo wp_kses( $fields['main_content'], array(
								'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array()
							) ); ?>
						</div>
					</div>
				<?php endif; ?>
                <?php if( $fields['dispaly_scam'] === '1') {?>
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
					<select class="form-select campaignWidth fontTxt font24 txtDarkBlue padding15 resourceDrop" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" aria-label="" id="selectDrop">
                   		<?php if( ! empty(  $fields['drop_select'] ) ) { ?>
                    	<option value="" selected class="txtGrey bgWhite" ><?php echo wp_kses_post($fields['drop_select']); ?></option>
                        <?php } ?>
                        <?php $queryev = get_shopscam();
                        	if ( $queryev->have_posts() ) {
								if( ! empty(  $fields['drop_shop'] ) ) { ?>
                                	<option value="#ecomm" class="fontTxt font16 txtGrey bgWhite"><?php echo wp_kses_post($fields['drop_shop']); ?></option>
                           <?php } }
							if ( have_posts() ) { 
								if( ! empty(  $fields['drop_scamsters'] ) ) { ?>
									<option value="#scamsters" class="fontTxt font16 txtGrey bgWhite"><?php echo wp_kses_post($fields['drop_scamsters']); ?></option>
							<?php } } ?>
					</select>
				</div>
                <?php } ?>
			</div>
		</div>
		</div>
	</div>
</section>
<section id="ecomm">
	<div class="container-fluid bgWhite MarginBottom40 paddingZero">
		<div class="row verticalAlignCenter marginZero">
        	<?php if ( ! empty( $fields['shop_heading'] ) ) { ?>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero <?php echo wp_kses_post($txtdir); ?>">
				<h1 class="fontDisplay txtDarkBlue textCenter TopBottomPadding40 marginZero LeftRightPadding15">
                	<?php echo wp_kses_post( $fields['shop_heading'] ); ?>
                </h1>
			</div>
            <?php } ?>
            <?php if ( ! empty( $fields['shop_content'] ) ): 
				$shopimg = wp_get_attachment_url($fields['shop_video_image'])
			?>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6 campaignImg" style="background-image: url(<?php echo esc_url( $shopimg ); ?>);"></div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
				<div class="TopBottomPadding40 LeftRightPadding15">  
                	<div class="fontTxt TopBottomPadding25 font16 txtGrey dirRTL">
                		<?php echo wp_kses( $fields['shop_content'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) ); ?>
					</div>
				</div>
			</div>
            <?php endif; ?>
		</div>
	</div>
</section>
<?php 
$queryev = get_shopscam();
if ( $queryev->have_posts() ) { ?>
<section>
	<div class="container-fluid bgLightGrey paddingZero">
		<div class="container">                        
		<div class="padding40Stay <?php echo wp_kses_post($txtdir); ?>">
			<div class="row paddingZero marginZero <?php echo wp_kses_post($txtdir); ?>">
				<?php
					while ( $queryev->have_posts() ) : $queryev->the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile; wp_reset_postdata();
				?>
			</div>
			<!-- shop full video -->
			<?php if ( ! empty( $fields['shop_fullvideo_link'] ) ): 
						$fullvedio = wp_get_attachment_url($fields['shop_fullvideo_link']['file']);
						$fullposter = wp_get_attachment_url($fields['shop_fullvideo_poster']);
						if ( ! empty( $fullvedio ) ): ?>

                            <div class="row">
							<?php if ( ! empty( $fields['shop_fullvideo_text'] ) ) { ?>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero <?php echo wp_kses_post($txtdir); ?>">
									<h2 class="fontDisplay txtDarkBlue textCenter TopBottomPadding40 marginZero LeftRightPadding15">
										<?php echo wp_kses_post( $fields['shop_fullvideo_text'] ); ?>
									</h2>
								</div>
            				<?php } ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
                                    <div class="video-wrapper MarginBottom40">
                                        <video width="100%" poster="<?php echo esc_url( $fullposter ); ?>" preload="none" controls="">
                                            <source src="<?php echo esc_url( $fullvedio ); ?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
            <?php endif; endif; ?>
                
            <?php if ( ! empty( $fields['download_shop_link'] ) ): ?>
            <div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
					<p class="textCenter marginZero TopBottomPadding5">
						<a href="<?php echo esc_url($fields['download_shop_link']); ?>" class="bgGrey txtWhite fontTxt btnLink font16 <?php echo wp_kses_post($txtdir); ?>">
                        	<?php if ( ! empty( $fields['download_shop_text'] ) ): ?>
								<?php echo wp_kses_post( $fields['download_shop_text'] ); ?> 
                            <?php endif; ?>
                        &nbsp;&nbsp;<i class="fas fa-arrow-down"></i></a>
					</p>
				</div>
			</div>
            <?php endif; ?>
			<!-- shop partner -->
			<div class="row w-100 marginZero">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 PaddingTop40">
					<h2 class="fontDisplay txtDarkBlue textCenter TopBottomPadding40 marginZero LeftRightPadding15 <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['shop_logo_header'] ); ?></h2>
				</div>
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
					<div class="div100">
						<div class="divRow">
						<?php
						foreach($fields['shop_jumbotron'] as $plogo)
						{
							$logourl = wp_get_attachment_url($plogo['parlogo']); 
							if(!empty($logourl)) {
						?>
							<div class="divCol">
								<?php if( !empty($plogo['plogolink']) ){ ?>
								<a href="<?php echo esc_url( $plogo['plogolink'] ); ?>" target="_blank">
									<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
								</a>
								<?php }
								else
								{ ?>
									<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
								<?php } ?>
							</div>
							<?php
							}				
						} ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Shop partner -->
		</div>
		</div>
	</div>
</section>
<?php } ?>

<section id="scamsters">
	<div class="container-fluid bgWhite MarginBottom40 paddingZero">
		<div class="row verticalAlignCenter marginZero">
        	<?php if ( ! empty( $fields['security_heading'] ) ) { ?>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
				<h1 class="fontDisplay txtDarkBlue textCenter TopBottomPadding40 marginZero LeftRightPadding15 <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['security_heading'] ); ?></h1>
			</div>
            <?php } ?>
            <?php if ( ! empty( $fields['security_content'] ) ): 
				$shopimg = wp_get_attachment_url($fields['security_scam_video_image'])
			?>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6 campaignImg" style="background-image: url(<?php echo esc_url( $shopimg ); ?>);"></div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
				<div class="TopBottomPadding40 LeftRightPadding15">                            
					<div class="fontTxt TopBottomPadding25 font16 txtGrey dirRTL">
                    	<?php echo wp_kses( $fields['security_content'], array(
                                'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() )
                                ) ); ?>
                    </div>         
                    <?php if( !empty( $fields['security_scam_video_text'] ) && !empty( $fields['security_scam_video_fields'])): 
							$shopscamvedio = wp_get_attachment_url($fields['security_scam_video_fields']['file']);
					?>                   
                        <a data-toggle="modal" data-target="#modalsecurity" class="">
                            <p class="fontTxt TopBottomPadding15 font20 txtDarkBlue dirRTL">
								<?php echo wp_kses_post( $fields['security_scam_video_text'] ); ?>&nbsp;&nbsp;
                                <i class="fa fa-play font14" aria-hidden="true"></i></p>
                        </a>
                        <div class="modal fade aboutmodal modalscam" id="modalsecurity" tabindex="-1" role="dialog" aria-labelledby="Modalsecurity" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body bgLightGrey">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="container-full">
                                            <div class="TopPadding35 BottomPadding15">
                                                <video width="100%" height="auto" controls autoplay muted id="scam_video" class="resvd">
                                                    <source src="<?php echo esc_url( $shopscamvedio ); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
				</div>                        
			</div>
            <?php endif; ?>
		</div>
	</div>
</section>
<?php if ( have_posts() ) : ?>
	<section>
        <div class="container-fluid bgWhite paddingZero">
            <div class="container">                        
			<div class="padding40Stay">
                <div class="row paddingZero marginZero <?php echo wp_kses_post($txtdir); ?>">
                	<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', get_post_type() );
						endwhile;
					?>
                    <?php if ( ! empty( $fields['fullvideo_link'] ) ): 
						$fullvedio = wp_get_attachment_url($fields['fullvideo_link']['file']);
						$fullposter = wp_get_attachment_url($fields['fullvideo_poster']);
						if ( ! empty( $fullvedio ) ):
					?>
                            <div class="row">
							<?php if ( ! empty( $fields['fullvideo_text'] ) ) { ?>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero <?php echo wp_kses_post($txtdir); ?>">
									<h2 class="fontDisplay txtDarkBlue textCenter TopBottomPadding40 marginZero LeftRightPadding15">
										<?php echo wp_kses_post( $fields['fullvideo_text'] ); ?>
									</h2>
								</div>
            				<?php } ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
                                    <div class="video-wrapper MarginBottom40">
                                        <video width="100%" poster="<?php echo esc_url( $fullposter ); ?>" preload="none" controls="">
                                            <source src="<?php echo esc_url( $fullvedio ); ?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                    	<?php endif; endif; ?>
                        
                    <?php if ( ! empty( $fields['download_secure_link'] ) ): ?>
                    <div class="row w-100 marginZero">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
                            <p class="textCenter marginZero TopBottomPadding5">
                                <a href="<?php echo esc_url($fields['download_secure_link']); ?>" class="bgGrey txtWhite fontTxt btnLink font16" download>
                                	<?php if ( ! empty( $fields['download_secure_text'] ) ): ?>
										<?php echo wp_kses_post( $fields['download_secure_text'] ); ?> 
                                    <?php endif; ?>
                                &nbsp;&nbsp;<i class="fas fa-arrow-down"></i></a>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
					
					<!--scam partner-->
					<div class="row w-100 marginZero">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 PaddingTop40">
							<h2 class="fontDisplay txtDarkBlue textCenter TopBottomPadding40 marginZero LeftRightPadding15 <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['logo_header'] ); ?></h2>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
							<div class="div100">
								<div class="divRow">
								<?php
								foreach($fields['jumbotron'] as $plogo)
								{
									$logourl = wp_get_attachment_url($plogo['parlogo']); 
									if(!empty($logourl)) {
								?>
									<div class="divCol">
										<?php if( !empty($plogo['plogolink']) ){ ?>
										<a href="<?php echo esc_url( $plogo['plogolink'] ); ?>" target="_blank">
											<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
										</a>
										<?php }
										else
										{ ?>
											<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
										<?php } ?>
									</div>
									<?php
									}				
								} ?>
								</div>
							</div>
						</div>
					</div>
					<!--scam partner -->
                </div>
            </div>
			</div>
    </section>
<?php endif; ?>
<?php get_footer(); ?>
<script>
$(".modalscam").on('hidden.bs.modal', function (e) {
	$('#scam_video').get(0).pause();
});
jQuery(".aboutmodal").on('hidden.bs.modal', function (e) {
	$('video').trigger('pause');
});
</script>

