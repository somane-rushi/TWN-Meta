<?php
/* Template Name: Thailand DG Citizenship */
get_header();
?>
<?php $sectionone = get_post_meta( get_the_ID(), 'sectionone', true ); ?>
<?php
    if ( ! empty( $sectionone['file'] ) ): ?>
<section class="vid-full-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 videoBoxFull">
                <div class="row">
                    <?php
                        $vimg = wp_get_attachment_url($sectionone['videoimage']);
                        $video = wp_get_attachment_url($sectionone['file']);
                        ?>
                    <video controls autoplay muted poster="<?php echo esc_url($vimg) ?>">
                        <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $sectiontwo = get_post_meta( get_the_ID(), 'sectiontwo', true );
    if ( ! empty( $sectiontwo['heading'] ) || ! empty( $sectiontwo['description'] ) ): ?>
<section class="full-txt bgWhite ">
    <div class="container txtSectionFullRed ">
        <div class="div80">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <?php if ( ! empty( $sectiontwo['heading'] ) ): ?>
                    <h1 class="txtGrey"><?php echo wp_kses_post( $sectiontwo['heading'] ); ?></h1>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 txtGrey">
                    <?php if ( ! empty( $sectiontwo['description'] ) ): ?>
                    <?php echo wp_kses( $sectiontwo['description'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectiontwo['btntext'] ) ): ?>
                    <p class="txtGrey2">
                        <a target="_blank" href="<?php echo esc_url( $sectiontwo['btnlink']  ); ?>" class="txtGrey"><span class="fa fa-arrow-right txtGrey"></span><?php echo wp_kses_post( $sectiontwo['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>
<?php endif; ?>
<?php $sectionthree = get_post_meta( get_the_ID(), 'sectionthree', true ); 
$secthimage = wp_get_attachment_url($sectionthree['image']);
if( !empty( $sectionthree['heading'] ) || !empty( $sectionthree['image'] ) || !empty( $sectionthree['description'] ) ):
?>
<section class="img-txt-section">
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" style="background-image:url('<?php echo esc_url($secthimage); ?>');"></div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightPink mediaBox">
				<div class="div70">
                	<?php if ( ! empty( $sectionthree['heading'] ) ): ?>
						<h1 class="txtRed"><?php echo wp_kses_post( $sectionthree['heading'] ); ?></h1>
                    <?php endif; ?>
					<div class="scrollBoxVideo">
						<?php if ( ! empty( $sectionthree['description'] ) ): ?>
							<?php echo wp_kses( $sectionthree['description'], array(
                                'br' => array( 'class' => array() ),
                                'strong' => array(),
                                'p' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                ) ); ?>
                        <?php endif; ?>
					</div>
                    <?php if ( ! empty( $sectionthree['btntext'] ) ): ?>
                    <p class="txtRed2">
                        <a target="_blank" href="<?php echo esc_url( $sectionthree['btnlink'] ); ?>" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $sectionthree['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $secfr = get_post_meta( get_the_ID(), 'sectionfour', true ); 
    if(!empty($secfr['titlepone'])){ ?>
<section class="four-boxes-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12 boxes-block">
                <div class="boxes-main-content" id="bOne">
                    <?php if(!empty($secfr['titlepone'])){ ?>
                    <div class="boxes-txt" style="background:#e69600;">
                        <h2><?php echo wp_kses( $secfr['titlepone'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); ?></h2>
                    </div>
                    <?php }
                        if ( ! empty( $secfr['pillarimagepone'] ) ): $pone = wp_get_attachment_url($secfr['pillarimagepone']); ?>
                    <div class="boxes-img boxDigiOne">
                        <img src="<?php echo esc_url($pone) ?>" alt="Thailand">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 fullwidth-boxes boxDigiOneInner" id="social-sec">
                    <div class="fullboxes-content ">
                        <?php if ( ! empty( $secfr['fullimagepone'] ) ): 
                            $pfone = wp_get_attachment_url($secfr['fullimagepone']); ?>
                        <div class="fullimage"><img src="<?php echo esc_url($pfone) ?>" alt="Thailand"></div>
                        <?php endif; ?>
                        <div class="main-content">
                            <div class="leftside-ecoLarge">
                                <?php if ( ! empty( $secfr['titlepone'] ) ): ?>
                                <h2><?php echo wp_kses( $secfr['titlepone'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array()),
								) ); ?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $secfr['descriptionpone'] ) ): ?>
                                <?php echo wp_kses( $secfr['descriptionpone'], array(
                                    'br' => array( 'class' => array() ),
                                    'strong' => array(),
                                    'span' => array( 'class' => array() ),
                                    'h3' => array(),
                                    'h4' => array(),
                                    'p' => array( 'class' => array() ),
                                    'ul' => array( 'class' => array() ),
                                    'li' => array( 'class' => array() ),
                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                    ) ); ?>
                                <?php endif; ?>      
                            </div>
                            <div class="middleside-eco"></div>
                        </div>
                        <div class="rightside-eco" id="social-btn">
                            <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                            <a>Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 boxes-block">
                <div class="boxes-main-content" id="bTwo">
                    <?php if(!empty($secfr['titleptwo'])){ ?>
                    <div class="boxes-txt" style="background:#692d00;">
                        <h2><?php echo wp_kses( $secfr['titleptwo'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
							) ); ?></h2>
                    </div>
                    <?php }
                        if ( ! empty( $secfr['pillarimageptwo'] ) ): $ptwo = wp_get_attachment_url($secfr['pillarimageptwo']); ?>
                    <div class="boxes-img boxDigiTwo">
                        <img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 fullwidth-boxes boxDigiTwoInner" id="economic-sec">
                    <div class="fullboxes-content">
                        <?php if ( ! empty( $secfr['fullimageptwo'] ) ): 
                            $pftwo = wp_get_attachment_url($secfr['fullimageptwo']); ?>
                        <div class="fullimage "><img src="<?php echo esc_url($pftwo) ?>" alt="Thailand"></div>
                        <?php endif; ?>
                        <div class="main-content">
                            <div class="leftside-ecoLarge">
                                <?php if(!empty($secfr['titleptwo'])){ ?>
                                <h2><?php echo wp_kses( $secfr['titleptwo'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array() ),
									) ); ?></h2>
                                <?php } ?>
                                <?php if ( ! empty( $secfr['descriptionptwo'] ) ): ?>
                                <?php echo wp_kses( $secfr['descriptionptwo'], array(
                                    'br' => array( 'class' => array() ),
                                    'strong' => array(), 'span' => array( 'class' => array() ),
                                    'h3' => array(),
                                    'h4' => array(),
                                    'p' => array( 'class' => array() ),
                                    'ul' => array( 'class' => array() ),
                                    'li' => array( 'class' => array() ),
                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                    ) ); endif; ?>
                            </div>
                            <div class="middleside-eco"></div>
                        </div>
                        <div class="rightside-eco" id="economic-btn">
                            <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                            <a>Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 boxes-block">
                <div class="boxes-main-content" id="bThree">
                    <?php if(!empty($secfr['titlepthree'])){ ?>
                    <div class="boxes-txt" style="background:#d27805;">
                        <h2><?php echo wp_kses( $secfr['titlepthree'], array(
								'br' => array( 'class' => array() ),
								'strong' => array(), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
							) ); ?>
                         </h2>
                    </div>
                    <?php }
                        if ( ! empty( $secfr['pillarimagepthree'] ) ): 
                        	$pthr = wp_get_attachment_url($secfr['pillarimagepthree']); ?>
                            <div class="boxes-img boxDigiThree">
                                <img src="<?php echo esc_url($pthr); ?>" alt="Thailand">
                            </div>
                    <?php endif; ?>
                </div>
                
                <div class="col-xs-12 fullwidth-boxes boxDigiThreeInner" id="digital-sec">
                    <div class="fullboxes-content ">
                        <?php if ( ! empty( $secfr['fullimagepthree'] ) ): 
                            $pfthr = wp_get_attachment_url($secfr['fullimagepthree']); ?>
                        <div class="fullimage "><img src="<?php echo esc_url($pfthr); ?>" alt="Thailand"></div>
                        <?php endif; ?>
                        <div class="main-content">
                            <div class="leftside-ecoLarge">
                                <?php if(!empty($secfr['titlepthree'])){ ?>
                                <h2><?php echo wp_kses_post( $secfr['titlepthree'] ); ?></h2>
                                <?php } ?>
                                <?php if ( ! empty( $secfr['descriptionpthree'] ) ): ?>
                                <?php echo wp_kses( $secfr['descriptionpthree'], array(
                                    'br' => array( 'class' => array() ),
                                    'strong' => array(), 'span' => array( 'class' => array() ),
                                    'h3' => array(),
                                    'h4' => array(),
                                    'p' => array( 'class' => array() ),
                                    'ul' => array( 'class' => array() ),
                                    'li' => array( 'class' => array() ),
                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                    ) ); 
                                    endif; ?>
                            </div>
                            <div class="middleside-eco"></div>
                        </div>
                        <div class="rightside-eco" id="digital-btn">
                            <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                            <a>Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>


<?php $sectionfive = get_post_meta( get_the_ID(), 'sectionfive', true ); 
    if ( ! empty( $sectionfive['file'] ) || ! empty( $sectionfive['heading'] ) || ! empty( $sectionfive['description'] ) || ! empty( $sectionfive['bgimage'] ) ): 
	?>
		<section class="img-txt-section">
			<div class="container-fluid">
				<div class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightPink mediaBox">
						<div class="div70">
                        	<?php if ( ! empty( $sectionfive['heading'] ) ): ?>
                                <h1 class="txtRed"><?php echo wp_kses_post( $sectionfive['heading'] ); ?></h1>
                            <?php endif; ?>
                            <?php if ( ! empty( $sectionfive['description'] ) ): ?>
                                <div class="scrollBoxVideo">
                                	<?php echo wp_kses( $sectionfive['description'], array(
										'br' => array( 'class' => array() ), 'strong' => array(),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
										) ); ?>
                                </div>
							<?php endif; ?>
                            <?php if ( ! empty( $sectionfive['btntext'] ) ): ?>
                                <p class="txtRed2">  
                                    <a href="<?php echo esc_url( $sectionfive['btnlink'] ); ?>" class="txtRed" target="_blank"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $sectionfive['btntext'] ); ?></a>
                                </p>
                    		<?php endif; ?>
                        </div>
					</div>
                    <?php
						if ( ! empty( $sectionfive['bgimage'] ) ){
							$leftsideimage = wp_get_attachment_url($sectionfive['bgimage']);
							?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" 
                                style="background-image: url('<?php echo esc_url($leftsideimage) ?>')")></div>
                            <?php } elseif(! empty( $sectionfive['file'] ) ){ ?>		
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox">
                                <div class="row">
                                    <?php
                                        if ( ! empty( $sectionfive['file'] ) ):
                                            $vimg = wp_get_attachment_url($sectionfive['videoimage']);
                                            $video = wp_get_attachment_url($sectionfive['file']);
                                        ?>
                                    <video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                                        <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                    </video>
                                    <?php endif; ?>
                                </div>
                            </div>
					<?php } ?>
                        
				</div>
			</div>
		</section>	
<?php endif; ?>
<?php $sectioneg = get_post_meta( get_the_ID(), 'sectioneight', true ); ?>           
<?php if ( ! empty( $sectioneg['heading'] ) || ! empty( $sectioneg['description']) || ! empty( $sectioneg['file'] ) || ! empty( $sectioneg['bgimage'] ) ): ?>

	<section class="img-txt-section">
		<div class="container-fluid">
			<div class="row">
				<?php
					if ( ! empty( $sectioneg['bgimage'] ) ){
					$leftsideimage = wp_get_attachment_url($sectioneg['bgimage']);
					?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')")></div>
                <?php } elseif(! empty( $sectioneg['file'] )){ 
                      $vimg = wp_get_attachment_url($sectioneg['videoimage']);
                      $video = wp_get_attachment_url($sectioneg['file']); ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox">
                            <div class="row">
                                <video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                                    <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                </video>
                            </div>
                        </div>
				<?php } ?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage mediaBox">
					<div class="div70">
                    	<?php if ( ! empty( $sectioneg['heading'] ) ): ?>
							<h1 class="txtRed"><?php echo wp_kses_post( $sectioneg['heading'] ); ?></h1>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectioneg['description'] ) ): ?>
                            <div class="scrollBoxVideo">
                                <?php echo wp_kses( $sectioneg['description'], array(
									'br' => array( 'class' => array() ),'strong' => array(),
									'p' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
									) ); ?></p>
								<?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectioneg['btntext'] ) ): ?>
                            <p class="txtRed2">
                                <a href="<?php echo esc_url( $sectioneg['btnlink'] ); ?>" target="_blank" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $sectioneg['btntext'] ); ?></a>
                            </p>
                    	<?php endif; ?>
					</div>
				</div>
			
            </div>
		</div>
	</section>	

<?php $secslider = get_post_meta( get_the_ID(), 'body', true ); 
    if(! empty ($secslider) ):
    ?>
<section class="testi">
    <div class="container-fluid">
        <div class="row">
            <div class="testimonial-block">
                <div class="testimonial-carousel owl-carousel owl-theme">
                    <?php foreach($secslider as $sl){ ?>
                    <div class="testi-full container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightRed" style="">
                                <div class="testimonial-right">
                                    <div>
                                        <?php if ( ! empty( $sl['heading'] ) ): ?>
                                        <h1 class="text-left txtRed"><?php echo wp_kses_post( $sl['heading'] ); ?></h1>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $sl['component_text_fields'] ) ): ?>
                                        <?php echo wp_kses( $sl['component_text_fields'], array(
                                            'br' => array( 'class' => array() ),'strong' => array(),
                                            'p' => array( 'class' => array() ),
                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                            ) ); ?>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $sl['buttontext'] ) ): ?>
                                        <p>
                                            <a target="_blank" href="<?php echo esc_url( $sl['buttonlink']  ); ?>"><span class="fa fa-arrow-right"></span><?php echo wp_kses_post( $sl['buttontext'] ); ?></a>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if ( ! empty( $sl['bgimage'] ) ): 
                                	$bgimg = wp_get_attachment_url($sl['bgimage']);
                                ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 digiSlideTwo" style="background:url(<?php echo esc_url($bgimg ); ?>)">
                                <div class="testimonial-left"></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $quotestitle = get_post_meta( get_the_ID(), 'quotestitle', true ); ?> 
<?php if ( ! empty( $quotestitle['heading'] ) ): ?>
<section class="full-title-section bgWhite">
	<div class="container titleSectionFull ">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1 class="text-center txtBlueGrey"><?php echo wp_kses_post( $quotestitle['heading'] ); ?></h1>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $secquotes = get_post_meta( get_the_ID(), 'quotes', true ); 
    if(! empty ($secquotes) ): ?>
        <section class="full-txt bgWhite">
            <div class="container-fluid">
                <div class="row">
                    <div class="quoteCarousel owl-carousel owl-theme">
                    <?php foreach($secquotes as $qt){ $qtimg = wp_get_attachment_url($qt['image']); 
						if(!empty($qtimg)){ ?>
                        <div class="item">
                            <img src="<?php echo esc_url($qtimg ); ?>" alt="Quote" class="quoteImg" />
                        </div>
                    <?php } } ?>
                    </div>
                </div>
            </div>
        </section>
<?php endif; ?>

<?php $secseven = get_post_meta( get_the_ID(), 'sectionsix', true );
    if ( ! empty( $secseven['heading'] ) || ! empty( $secseven['description'] ) ): ?>
<section class="full-txt bgWhite ">
    <div class="container txtSectionFull">
        <div class="div80">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php if ( ! empty( $secseven['heading'] ) ): ?>
                    <h1 class="text-left txtGreen"><?php echo wp_kses_post( $secseven['heading'] ); ?></h1>
                    <?php endif; ?>
                    <?php if ( ! empty( $secseven['description'] ) ): ?>
                    <p class="text-left txtGreen2 font18"><?php echo wp_kses( $secseven['description'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
    $query = get_DigitalLogo();
    	if ( $query->have_posts() ) { ?>
<section class="full-txt bgWhite partnerSection">
    <div class="container-fluid ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="div100">
                <div class="divRow">
                    <?php
                        while ( $query->have_posts() ) : $query->the_post();
                        $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full");
                        $logourl = get_post_meta( get_the_ID(), 'digilogo' , true );
                        ?>
                    <div class="divCol">
                        <?php if( ! empty( $logourl['logourl'] ) ){ ?>
                        	<a href="<?php echo esc_url($logourl['logourl']); ?>" target="_blank" >
                        <?php } ?>
                            <img src="<?php echo esc_url($imgsrc[0]); ?>" alt="<?php echo wp_kses_post( get_the_title() ); ?>" class="partnerLogo" />
                            <p class="txtBlack text-center"><?php echo wp_kses_post( get_the_title() ); ?></p>
                        <?php if( ! empty( $logourl['logourl'] ) ){ ?>
                        </a>
                        <?php } ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php
get_footer();