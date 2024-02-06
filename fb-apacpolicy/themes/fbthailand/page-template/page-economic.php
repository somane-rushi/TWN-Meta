<?php
/*
Template Name: Economic Opportunity Page
*/
get_header();
?>
<?php $sectionfirst = get_post_meta( get_the_ID(), 'sectionfirst', true ); 
if ( ! empty( $sectionfirst['bgimage'] ) ):
	$bgimg = wp_get_attachment_url($sectionfirst['bgimage']); ?>
    <section class="thai-main-section">
        <div class="container-fluid">
            <div class="row">
                <div class="eco-emp" style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                	<?php if ( ! empty( $sectionfirst['heading'] ) ): ?>
                    	<h1 class="txtWhite text-left"><?php echo wp_kses_post( $sectionfirst['heading'] ); ?></h1>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectionfirst['description'] ) ): ?>
                    	<h4 class="txtWhite text-left"><?php echo wp_kses( $sectionfirst['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
                        ) ); ?></h4>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectionfirst['btntext'] ) ): ?>
                    	<p> <a href="<?php echo esc_url( $sectionfirst['btnlink'] ); ?>" target="_blank"><span class="fa fa-arrow-right"></span><?php echo wp_kses_post( $sectionfirst['btntext'] ); ?></a> </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $sectwo = get_post_meta( get_the_ID(), 'sectiontwo', true ); 
if ( ! empty( $sectwo['file'] ) || ! empty( $sectwo['heading'] ) || ! empty( $sectwo['description'] ) ): ?>
<section class="vid-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox bgBlack">
				<div class="row">
                <?php
                if ( ! empty( $sectwo['file'] ) ):
					$vimg = wp_get_attachment_url($sectwo['videoimage']);
					$video = wp_get_attachment_url($sectwo['file']);
					?>
                	<video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
						<source src="<?php echo esc_url($video) ?>" type="video/mp4">
                    </video>
                 <?php endif; ?>
				</div>
			</div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage videoBox2">
				<div class="div70">
                	<?php if ( ! empty( $sectwo['heading'] ) ): ?>
						<h1 class="txtRed"><?php echo wp_kses_post( $sectwo['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="scrollBoxVideo">
	                    <?php if ( ! empty( $sectwo['description'] ) ): ?>
							<p class="txtRed"><?php echo wp_kses( $sectwo['description'], array(
	                            'br' => array( 'class' => array() ),
	                            'strong' => array(),
								'p' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
	                        ) ); ?></p>
	                    <?php endif; ?>
                    </div><!--New Edit-->
                    <?php if ( ! empty( $sectwo['btntext'] ) ): ?>
					<p class="txtRed2">                       					
						<a href="<?php echo esc_url( $sectwo['btnlink'] ); ?>" target="_blank" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $sectwo['btntext'] ); ?></a>
					</p>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $secthr = get_post_meta( get_the_ID(), 'sectionthree', true ); 
if ( ! empty( $secthr['heading'] ) || ! empty( $secthr['description'] ) ): ?>
<section class="full-txt bgWhite">
	<div class="container txtSectionFull">
		<div class="div80">
			
            <div class="row">
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 redLink ">
                <?php if ( ! empty( $secthr['heading'] ) ): ?>
					<h1 class="txtGrey"><?php echo wp_kses_post( $secthr['heading'] ); ?></h1>
                <?php endif; ?>
				</div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 txtGrey">
                	<?php if ( ! empty( $secthr['description'] ) ): ?>
					<?php echo wp_kses( $secthr['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
							'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
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
				<div class="col-md-6 col-sm-6 col-xs-12 boxes-block">
					<div class="boxes-main-content" id="bOne">
                    	 <?php if(!empty($secfr['titlepone'])){ ?>
                            <div class="boxes-txt" style="background:#f58c28;">
                                <h2><?php echo wp_kses( $secfr['titlepone'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); ?></h2>
                            </div>
                        <?php }
                        if ( ! empty( $secfr['pillarimagepone'] ) ): $pone = wp_get_attachment_url($secfr['pillarimagepone']); ?>
                        <div class="boxes-img boxEcoOne">
							<img src="<?php echo esc_url($pone) ?>" alt="Thailand">
						</div>
                        <?php endif; ?>
					</div>
                    <div class="col-xs-12 fullwidth-boxes boxEcoOneInner" id="social-sec">
						<div class="fullboxes-content ">
							<?php if ( ! empty( $secfr['fullimagepone'] ) ): 
								$pfone = wp_get_attachment_url($secfr['fullimagepone']); ?>
                            <div class="fullimage "><img src="<?php echo esc_url($pfone) ?>" alt="Thailand"></div>
                            <?php endif; ?>
							<div class="main-content">
								<div class="leftside-ecoLarge">
									<?php if ( ! empty( $secfr['titlepone'] ) ): ?>
                                    	<h2><?php echo wp_kses( $secfr['titlepone'], array(
													'br' => array( 'class' => array() ),
													'strong' => array(), 'span' => array( 'class' => array() ),
													'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
											) ); ?></h2>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $secfr['descriptionpone'] ) ): ?>
                                    	<?php echo wp_kses( $secfr['descriptionpone'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(),
										'span' => array( 'class' => array() ),
										'h3' => array( 'class' => array() ),
										'h4' => array( 'class' => array() ),
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
                <div class="col-md-6 col-sm-6 col-xs-12 boxes-block">
					<div class="boxes-main-content" id="bTwo">
						<?php if(!empty($secfr['titleptwo'])){ ?>
							<div class="boxes-txt" style="background:#e84e1b;">
								<h2><?php echo wp_kses( $secfr['titleptwo'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
									) ); ?></h2>
							</div>
						<?php }
						if ( ! empty( $secfr['pillarimageptwo'] ) ): $ptwo = wp_get_attachment_url($secfr['pillarimageptwo']); ?>
							<div class="boxes-img boxEcoTwo ">
								<img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
							</div>
						<?php endif; ?>
					</div>
                    <div class="col-xs-12 fullwidth-boxes boxEcoTwoInner " id="economic-sec">
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
														'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
												) ); ?></h2>
										<?php } ?>
										<?php if ( ! empty( $secfr['descriptionptwo'] ) ): ?>
												<?php echo wp_kses( $secfr['descriptionptwo'], array(
                                                'br' => array( 'class' => array() ),
                                                'strong' => array(), 'span' => array( 'class' => array() ),
                                                'h3' => array( 'class' => array() ),
												'h4' => array( 'class' => array() ),
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
                    
				</div>
			</div>
	</section>

<?php } ?>

<?php $secegi = get_post_meta( get_the_ID(), 'sectioneight', true ); 
	if(!empty($secegi['heading']) || ! empty( $secegi['image'] ) ){ ?>
		<section class="img-txt-section">
			<div class="container-fluid">
				<div class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightPink mediaBox">
						<div class="div70">
                        	<?php if ( ! empty( $secegi['heading'] ) ): ?>
                                <h1 class="txtRed"><?php echo wp_kses_post( $secegi['heading'] ); ?></h1>
                            <?php endif; ?>
                            <?php if ( ! empty( $secegi['description'] ) ): ?>
                                	<?php echo wp_kses( $secegi['description'], array(
										'br' => array( 'class' => array() ), 'strong' => array(),
										'p' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
										) ); ?>
							<?php endif; ?>
                            <?php if ( ! empty( $secegi['btntext'] ) ): ?>
                                <p class="txtRed2">  
                                    <a href="<?php echo esc_url( $secegi['btnlink'] ); ?>" class="txtRed" target="_blank"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secegi['btntext'] ); ?></a>
                                </p>
                    		<?php endif; ?>
                        </div>
					</div>
                    <?php
						if ( ! empty( $secegi['image'] ) ){
							$leftsideimage = wp_get_attachment_url($secegi['image']);
							?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" 
                                style="background-image: url('<?php echo esc_url($leftsideimage) ?>')")></div>
					<?php } ?>
                        
				</div>
			</div>
		</section>	
<?php } ?>

<?php $secfive = get_post_meta( get_the_ID(), 'sectionfive', true ); 
if ( ! empty( $secfive['heading'] ) || ! empty( $secfive['description'] ) ): ?>
	<section class="img-txt-section">
		<div class="container-fluid">
			<div class="row">
            <?php
            if ( ! empty( $secfive['image'] )){ $bgimg = wp_get_attachment_url($secfive['image']); ?>
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" style="background-image:url('<?php echo esc_url($bgimg) ?>');"></div>
            <?php }elseif(! empty( $secfive['file'] )){ 
				$vimg = wp_get_attachment_url($secfive['videoimage']); 
				$video = wp_get_attachment_url($secfive['file']);
			?>
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox">
                	<video controls preload="none" poster="<?php echo esc_url($vimg); ?>">
						<source src="<?php echo esc_url($video); ?>" type="video/mp4">
                    </video>
                </div>
            <?php } ?> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage mediaBox ">
					<div class="div70">
                    	<?php if ( ! empty( $secfive['heading'] ) ): ?>
                        	<h1 class="txtRed"><?php echo wp_kses_post( $secfive['heading'] ); ?></h1>
                        <?php endif; ?>
                        <div class="scrollBoxVideo">
                        	<?php if ( ! empty( $secfive['description'] ) ): ?>
								<?php echo wp_kses( $secfive['description'], array(
                                    'br' => array( 'class' => array() ),
                                    'strong' => array(), 'h4' => array( 'class' => array() ),
                                    'h3' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                    'p' => array( 'class' => array() ),
                                    'ul' => array( 'class' => array() ),
                                    'li' => array( 'class' => array() ),
                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                ) ); ?>
                            <?php endif; ?>
						</div> 
                        <?php if ( ! empty( $secfive['btntext'] ) ): ?>
                        <p class="txtRed2">                     					
                            <a href="<?php echo esc_url( $secfive['btnlink']  ); ?>" target="_blank" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secfive['btntext'] ); ?></a>
                        </p>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php $secsix = get_post_meta( get_the_ID(), 'sectionsix', true );
if ( ! empty( $secsix['heading'] ) ): ?>
	<section class="full-title-section bgWhite">
		<div class="container titleSectionFull ">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="text-center txtBlueGrey"><?php echo wp_kses_post( $secsix['heading'] ); ?></h1>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php if ( ! empty( $secsix['boxoneheading'] ) || ! empty( $secsix['boxtwoheading'] ) ): 
$flipone = wp_get_attachment_url($secsix['boxoneimage']); 
$fliptwo = wp_get_attachment_url($secsix['boxtwoimage']); 
?>
<section class="flip-section econ">
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxLeft">
            	<div class="flip-card">
                	<div class="flip-card-inner">
                    	<div class="flip-card-front" style="background-image:url('<?php echo esc_url($flipone); ?>');">
                        <?php if ( ! empty( $secsix['boxoneheading'] ) ): ?>
                        	<h1 class="txtWhite2"><a href="#" class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
                            <br/><?php echo wp_kses_post( $secsix['boxoneheading'] ); ?></a></h1>
                        <?php endif; ?>
						</div>
                        <div class="flip-card-back flipEconLeft">
							<?php if ( ! empty( $secsix['boxonedescription'] ) ): ?>
                            	<?php echo wp_kses( $secsix['boxonedescription'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(),
									'h3' => array(), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'ul' => array( 'class' => array() ),
									'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); ?>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxRight ">
				<div class="flip-card">
					<div class="flip-card-inner">
						<div class="flip-card-front" style="background-image:url('<?php echo esc_url($fliptwo); ?>');">
                        <?php if ( ! empty( $secsix['boxtwoheading'] ) ): ?>
                        	<h1 class="txtWhite2"><a href="#" class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
                            <br/><?php echo wp_kses_post( $secsix['boxtwoheading'] ); ?></a></h1>
                        <?php endif; ?>
						</div>
                        <div class="flip-card-back flipEconRight">
							<?php if ( ! empty( $secsix['boxtwodescription'] ) ): ?>
                            	<?php echo wp_kses( $secsix['boxtwodescription'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(),
									'h3' => array(), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'ul' => array( 'class' => array() ),
									'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); ?>
                            <?php endif; ?>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $secsev = get_post_meta( get_the_ID(), 'sectionseven', true );
if ( ! empty( $secsev['heading'] ) || ! empty( $secsev['bgimage'] )): 
$bgimg = wp_get_attachment_url($secsev['bgimage']);
?>
<section class="thai-tourism-section thai-tourism-green" id="tourism">
	<div class="container-fluid ">
		<div class="row">
			<div class="thai-tourism" style="background-image: url('<?php echo esc_url($bgimg) ?>')" >
            	<?php if ( ! empty( $secsev['heading'] ) ): ?>
					<h1><?php echo wp_kses_post( $secsev['heading'] ); ?></h1>
                <?php endif; ?>
                <?php if ( ! empty( $secsev['description'] ) ): ?>
					<h4 class="txtWhite"><?php echo wp_kses( $secsev['description'], array(
						'br' => array( 'class' => array() ),
						'strong' => array(),
						'h3' => array(), 'span' => array( 'class' => array() ),
						'p' => array( 'class' => array() ),
						'ul' => array( 'class' => array() ),
						'li' => array( 'class' => array() ),
						'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
					) ); ?></h4>
                <?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php
get_footer();
