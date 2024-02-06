<?php
/*
Template Name: Training Hub Page
*/

get_header();
?>

<?php while ( have_posts() ) : the_post(); 
	$sec_banner = get_post_meta( get_the_ID(), 'banner', true );
	$banbgimage = wp_get_attachment_url($sec_banner['banbgimage']);
	$banimage = wp_get_attachment_url($sec_banner['banimage']);
?>
<?php if ( ! empty( $banbgimage ) && ! empty( $banimage ) && ! empty( $sec_banner['bantitle'] ) ): ?>
	<section class="noPadding whiteBG ltBanner dispFlex valign" style="background-image: url('<?php echo esc_url( $banbgimage ); ?>');">
        <div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-5 col-xl-5 col-lg-5 col-md-8 col-sm-10 valign" > 
                    	<?php if ( ! empty( $sec_banner['bantitle'] )) : ?>
						<h1 class="text-white fontOptTxt marginBottom35 text-left"><?php echo esc_html( $sec_banner['bantitle'] ); ?></h1>
                        <?php endif; if ( ! empty( $banimage )) : ?>
						<img src="<?php echo esc_url( $banimage ); ?>" alt="Shemb" class="oasLogo" />
                        <?php endif; ?>
					</div>
				</div>    
			</div>
        </div>
    </section>
<?php endif; ?>

<?php $sec_two = get_post_meta( get_the_ID(), 'sec_two', true ); 
	if ( ! empty( $sec_two['sec_desc'] )) : ?>
	<section class="noPadding greenBG">
        <div  class="container-fluid noPadding">
            <div class="container paddTop50 paddBottom35">
                <div class="row valign">
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="txtDarkGreen text-left marginBottom25 font18 marginTB15">
							<?php echo wp_kses( $sec_two['sec_desc'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'download' => array(), 'title' => array(),'target' => array(),'class' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) ); ?>
						</div>
						
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $sec_box = get_post_meta( get_the_ID(), 'learnbox', true ); 
	if ( ! empty( $sec_box['head'] )) : ?>
	<section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sec_box['head'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section>
	<?php endif; ?> 
 	<?php if ( ! empty( $sec_box['add_learnbox'] )) : ?>
	<section class="noPadding whiteBG" id="learnBox">
        <div class="container-fluid noPadding">
                <div class="row valign noMargin">
                	<?php $i=1;
                	foreach($sec_box['add_learnbox'] as $box)
					{ 
						$cls='';
						if($i%2===1){ $cls ='darkGreenBG'; } else { $cls ='lightGreenBG'; }
						$boximage = wp_get_attachment_url($box['box_image']);
					?>
                        <div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 noPadding <?php echo esc_attr($cls); ?>">
                            <div class="latamHubs text-center">
                                <a href="<?php echo esc_url( $box['box_link'] ); ?>" >
                                	<?php if ( ! empty( $box['box_title'] )) : ?>
                                    	<h4 class="text-center fontOptLight text-white marginBottom15">
										<?php echo wp_kses( $box['box_title'], 
										array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),'b' => array( 'class' => array() ),
										'strong' => array() ) ); ?>
										</h4>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $boximage )) : ?>
                                    	<img src="<?php echo esc_url( $boximage ); ?>" class="hubIcon" />
                                    <?php endif; ?>
                                </a>
                                <div class="text-left fontOptLight font14 text-white noMargin">
                                	<?php echo wp_kses( $box['box_desc'], 
										array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
										'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
										'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'download' => array(), 'title' => array(),'target' => array(),'class' => array() ),
										'b' => array( 'class' => array() ),
										'strong' => array(), 'class' => array() ) ); ?>
                                </div>
                            </div>
                        </div>
					<?php $i++; } ?>
				</div>
			</div>
		</div>
	</section>
    <?php endif; ?>
    
    <?php $sec_train = get_post_meta( get_the_ID(), 'train', true );
	if ( ! empty( $sec_train['capblocks'] )) : ?>
    <section class="noPadding greenBG ">
        <div  class="container-fluid noPadding">
            <div class="container paddTop50 paddBottom35 capsuleDiv">
                <div class="row valign ">
                	<?php $i=1;
                	foreach($sec_train['capblocks'] as $cap)
					{ 
						$capimg = wp_get_attachment_url( $cap['timage'] );
						$capvd = wp_get_attachment_url( $cap['sec_view_fields']['view_vd'] );
						if($cap['sec_type']==='view'):
					?>
                        <div class="col-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="hubBox marginBottom25 boxShadow">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#hubRes<?php echo esc_html($i); ?>" class="hubBoxLink">
                                	<?php if ( ! empty( $capimg )) : ?>
                                    	<img src="<?php echo esc_url( $capimg ); ?>" class="hubBoxImg" alt="Shemb" />
                                    <?php endif; ?>
                                    <?php if ( ! empty( $cap['title'] )) : ?>
                                        <p class="fontOptLight text-center txtDarkGreen marginBottom25 font20">
                                            <?php echo wp_kses( $cap['title'], 
                                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                            'b' => array( 'class' => array() ),'strong' => array() ) ); ?>
                                        </p>
                                    <?php endif; 
									if( !empty( $capvd ) && ! empty( $cap['buttontext'] ) ) { ?>
                                    <p class="fontOptLight text-center text-white marginBottom25 hubBoxButton">
                                    	<?php echo esc_html( $cap['buttontext'] ); ?>
                                    </p>
                                    <?php } ?>
                                </a>
                            </div>
                        </div><!--1-->
                        <?php if( !empty( $capvd ) ) { ?>
                        <div class="modal fade" id="hubRes<?php echo esc_html($i); ?>" style="padding: 0px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">  
                                <div class="modal-content ">			
                                    <div class="modal-body lightGreenBG">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                                                	<?php
													if ( ! empty( $cap['title'] )) : ?>
                                                        <h3 class="txtDarkGreen text-center whiteBG fontOptLight paddTop35 paddBottom35 noMargin">
                                                        <?php echo wp_kses( $cap['title'], 
                                                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'b' => array( 'class' => array() ),'strong' => array() ) ); ?></h3>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                                                    <video controls muted class="vidContainer" poster="">
                                                        <source src="<?php echo esc_url( $capvd ); ?>" type="video/mp4">
                                                    </video>
                                                </div>						
                                            </div>
                                        </div>
                                    </div>					
                                </div>
                            </div>
                        </div>
                    <?php } endif;
						if($cap['sec_type']==='download'): 
							$capdown = wp_get_attachment_url( $cap['sec_download_fields']['downloadlink'] );
						?>
							<div class="col-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <div class="hubBox marginBottom25 boxShadow">
                                    <a href="<?php echo esc_url( $capdown ); ?>" class="hubBoxLink" download="download">
                                    	<?php if ( ! empty( $capimg )) : ?>
                                        	<img src="<?php echo esc_url( $capimg ); ?>" alt="Shemb" class="hubBoxImg" />
                                        <?php endif; ?>
                                        <?php if ( ! empty( $cap['title'] )) : ?>
                                        <p class="fontOptLight text-center txtDarkGreen marginBottom25 font20">
                                        	<?php echo wp_kses( $cap['title'], 
                                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                            'b' => array( 'class' => array() ),'strong' => array() ) ); ?>
                                        </p>
                                        <?php endif; ?>
                                        <?php if( !empty( $cap['sec_download_fields']['downloadlink'] ) && !empty($cap['buttontext']) ) { ?>
                                        <p class="fontOptLight text-center text-white marginBottom25 hubBoxButton">
                                        	<?php echo esc_html( $cap['buttontext'] ); ?>
                                        </p>
                                    	<?php } ?>
                                    </a>
                                </div>
                            </div>
					
						<?php
						endif;
						if($cap['sec_type']==='navigate'):  ?>
							<div class="col-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <div class="hubBox marginBottom25 boxShadow">
                                    <a href="<?php echo esc_url( $cap['sec_link_fields']['linkn'] ); ?>" target="_blank" class="hubBoxLink">
                                    <?php if ( ! empty( $capimg )) : ?>
                                        <img src="<?php echo esc_url( $capimg ); ?>" alt="Shemb" class="hubBoxImg" />
                                    <?php endif; ?>
                                    <?php if ( ! empty( $cap['title'] )) : ?>
                                        <p class="fontOptLight text-center txtDarkGreen marginBottom25 font20">
                                        	<?php echo wp_kses( $cap['title'], 
                                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                            'b' => array( 'class' => array() ),'strong' => array() ) ); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if( !empty( $cap['sec_link_fields']['linkn'] ) && !empty($cap['buttontext']) ) { ?>
                                        <p class="fontOptLight text-center text-white marginBottom25 hubBoxButton">
                                        	<?php echo esc_html( $cap['buttontext'] ); ?>
                                        </p>
                                    <?php } ?>
                                    </a>
                                </div>
                            </div>
						
						<?php
						endif;
					$i++; } //for ?>
                    
                    
                    
				</div>
			</div>
		</div>
	</section>
    <?php endif; ?>
    
    
    
    <?php $sec_partner = get_post_meta( get_the_ID(), 'partners', true ); 
	if ( ! empty( $sec_partner['title'] )) : ?>    
    <section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sec_partner['title'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
    <?php endif; ?>
    
    <?php
	$pimage = wp_get_attachment_url( $sec_partner['image'] );
	if ( ! empty( $sec_partner['desc'] ) && ! empty( $pimage ) ) :
	?>
    <section class="noPadding darkGreenBG">
        <div class="container-fluid ">
            <div class="row valign">
                <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 noPadding">
                    <div class="learnAboutDivBg" style="background-image: url(<?php echo esc_url( $pimage ); ?>);"></div>        
                </div>
                <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 noPadding">
					<div class="row noMargin">
						<div class="col-12">
							<?php echo wp_kses( $sec_partner['desc'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'download' => array(), 'title' => array(),'target' => array(),'class' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) ); ?>
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>
	<?php endif; ?>
    
    
<?php endwhile; ?>
<?php
get_footer();