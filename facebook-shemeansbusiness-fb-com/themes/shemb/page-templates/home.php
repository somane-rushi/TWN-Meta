<?php
/*
Template Name: Home Page
*/

get_header();
?>
<!--<div class="container-fluid">
	<h1> Coming Soon </h1>
</div>-->
<?php
while ( have_posts() ) :
	the_post();
	$sec_banner = get_post_meta( get_the_ID(), 'home_content', true );
	$vdbanner = wp_get_attachment_url($sec_banner['overview_vd']);
	?>
    <?php if ( ! empty( $vdbanner ) ): ?>
	<section class="videoBanner noPadding">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                    <video autoplay controls muted class="vidContainer">
                        <source src="<?php echo esc_url( $vdbanner ); ?>" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section><!--banner Video-->
    <?php endif; ?>
	<?php 
	$sec_slide = get_post_meta( get_the_ID(), 'home_slider', true );
	if ( ! empty( $sec_slide['sliderblocks'] ) ): 
	?>
    <section class="homvideobanarea noPadding">
		<div id="homebancrousel" class="owl-carousel owl-theme">
        	<?php foreach ( $sec_slide['sliderblocks'] as $sec ) {
				if(@$sec['sec_type']==='video')
				{ 
					$vd = wp_get_attachment_url( $sec['sec_video_fields']['slidevd'] );
					if ( ! empty( $vd ) ):
				?>
                    <div class="item">
                        <video class="video-item hombanit" muted loop autoplay controls>
                            <source src="<?php echo esc_url( $vd ); ?>" type="video/mp4">
                        </video>
                    </div>
			<?php endif; } 
				if(@$sec['sec_type']==='image')
				{ $img = wp_get_attachment_url( $sec['sec_image_fields']['slideimage'] ); 
					if ( ! empty( $img ) ):
				?>
                    <div class="item">
                        <a href="<?php echo esc_url( $sec['sec_image_fields']['slide_link']); ?>">
                        <img src="<?php echo esc_url( $img ); ?>" /></a>
                    </div>
            <?php endif;  } ?>
            <?php } ?>
		</div>
	</section>
    <?php endif; ?>
    <?php if ( ! empty( $sec_banner['wel_btn_text'] ) && ! empty( $sec_banner['wel_btn_link'] ) ): ?>
    <section class="noPadding greenBG">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding ">
                    
                        <p class="text-right viewButton">
                            <a href="<?php echo esc_url( $sec_banner['wel_btn_link'] ); ?>" class="darkGreenButton fontOptLight"><?php echo esc_html( $sec_banner['wel_btn_text'] ); ?></a>
                        </p>
                    
                    </div>
                </div>
            </div>
        </div>
    </section><!--view Stories-->
    <?php endif; ?>
    <?php 
	$sec_two = get_post_meta( get_the_ID(), 'home_sec_two', true );
	$sectwoimg = wp_get_attachment_url($sec_two['overview_image']);
	if ( ! empty( $sec_two['overview_heading'] )) :
	?>
    <section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sec_two['overview_heading'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
    <?php endif;
    if ( ! empty( $sec_two['overview_image'] ) && ! empty( $sec_two['overview_description'] ) ): ?>
    <section class="noPadding lightGreenBG">
        <div class="container-fluid darkGreenBG">
            <div class="row valign">
                <div class="col-5 col-xl-5 col-lg-5 col-md-12 col-sm-12 noPadding">
                <?php if ( ! empty( $sectwoimg )) : ?>
                    <div class="progOverviewBG" style="background-image: url(<?php echo esc_url( $sectwoimg ); ?>)"></div>  
                <?php endif; ?>      
                </div>
                <div class="col-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 padding35">
                	<?php if ( ! empty( $sec_two['overview_description'] )) : ?>
					<div class="font16 text-white fontOptLight noMargin">
                    	<?php echo wp_kses( $sec_two['overview_description'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
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
    </section><!--Program Overview-->
    <?php endif; ?>
    <?php $secvd = get_post_meta( get_the_ID(), 'home_sec_thr', true ); 
	if ( ! empty( $secvd['jumbotron'] ) ): ?>
    <section class="noPadding greenBG">
        <div  class="container-fluid noPadding">
            <div class="container paddTop25 paddBottom50">
                <div class="row">
                	<?php $i=1;
                	foreach($secvd['jumbotron'] as $vddata)
					{ 
						$imagesrc = wp_get_attachment_url($vddata['vd_image']);
						$vdsrc = wp_get_attachment_url($vddata['vd_file']);
						$vdimg = wp_get_attachment_url($vddata['vd_image']);
						if ( ! empty( $imagesrc ) ) :
					?>
                        <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        	<?php if ( ! empty( $vddata['vd_heading'] ) ) : ?>
                                <h3 class="txtDarkGreen fontOptLight text-center marginTB25">
                                    <?php echo esc_html( $vddata['vd_heading'] ); ?>
                                </h3>
                            <?php endif; ?>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#vidMod<?php echo esc_html($i); ?>" >
                                <img src="<?php echo esc_url( $imagesrc ); ?>" class="img100 boxShadow2" alt="Shemb" />
                            </a>
                        </div>
                        <?php if ( ! empty( $vdsrc ) ) : ?>
                        <div class="modal fade" id="vidMod<?php echo esc_html($i); ?>" style="padding: 0px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">  
                                <div class="modal-content ">
                                    <div class="modal-body darkGreenBG">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                                                    <video controls muted class="vidContainer" poster="<?php echo esc_url( $vdimg ); ?>">
                                                        <source src="<?php echo esc_url( $vdsrc ); ?>" type="video/mp4">
                                                    </video>
                                                </div>						
                                            </div>
                                        </div>
                                    </div>					
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                    	<?php endif; ?>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </section><!--videos Pop-Up-->
    <?php endif; ?>
    <?php include get_template_directory().'/template-parts/content-testimonial.php'; ?>
    
    <?php $secflip = get_post_meta( get_the_ID(), 'home_sec_four', true ); 
	if ( ! empty( $secflip['filp_circle'] ) ): ?>
    <section class="noPadding lightGreenBG">
        <div class="container-fluid">
	        <div class="container paddBottom35 paddTop50">
	            <div class="row flip-row">
                	<?php $i=1;
                	foreach($secflip['filp_circle'] as $flip)
					{ 
						$flipfront = wp_get_attachment_url($flip['flip_image']);
						$flipback = wp_get_attachment_url($flip['flip_backimage']);
						if ( ! empty( $flipfront ) ) :
					?>
                        <div class="col-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="flipCircle paddBottom15">
                                <div class="flipCirlce-inner">
                                    <div class="flipCirlce-front">
                                        <img src="<?php echo esc_url( $flipfront ); ?>" class="img100" alt="Shemb">                                  	
                                    </div>
                                    <div class="flipCirlce-back">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#flipCircle<?php echo esc_html($i); ?>"	>
                                            <img src="<?php echo esc_url( $flipback ); ?>" class="img100" alt="Shemb">
                                        </a>									
                                    </div>	
                                </div>
                            </div><!--1-->
                        </div>
                        <!--Flip Modals-->
                        <div class="modal fade" id="flipCircle<?php echo esc_html($i); ?>" style="padding: 0px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">  
                                <div class="modal-content">
                                    <div class="modal-header">
                                    	<?php if ( ! empty( $flip['flip_title'] ) ) : ?>
                                        <h3 class="modal-title txtDarkGreen fontOptLight" id="flipOne">
                                        	<?php echo esc_html( $flip['flip_title'] ); ?>
                                        </h3>
                                        <?php endif; ?>
                                        <button type="button txtDarkGreen fontOptLight" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                                                	<?php if ( ! empty( $flip['flip_desc'] ) ) : ?>
                                                    <?php echo wp_kses( $flip['flip_desc'], 
														array( 'br' => array( 'class' => array() ),
														'span' => array( 'class' => array() ),
														'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
														'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
														'h4' => array( 'class' => array() ),
														'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
														'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
														'b' => array( 'class' => array() ),
														'img' => array( 'class' => array(),'src' => array(),'alt' => array() ),
														'div' => array( 'class' => array() ),
														'strong' => array(), 'class' => array() ) ); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>					
                                </div>
                            </div>
                        </div><!--Flip Modal 1-->
                    <?php endif; ?>
                    <?php $i++; } ?>
					
				</div>
			</div>
		</div>
	</section><!--Flip Section-->
    <?php endif; ?>
    <?php $sectime = get_post_meta( get_the_ID(), 'home_sec_timeline', true ); 
	if ( ! empty( $sectime['time_title'] ) ): ?>
    <section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sectime['time_title'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
	<?php endif; 
	$time_bg = wp_get_attachment_url($sectime['time_bgimage']); ?>
	
    <section class="globalJourneyDiv" style="background: url(<?php echo esc_url( $time_bg ); ?>);">
			<div class="container-fluid noPadding">
				<div class="container">
					<div class="row">
                    	<?php if ( ! empty( $sectime['time_subtitle'] ) ): ?>
						<div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
							<h3 class="text-white fontOptLight text-center marginBottom35"><?php echo esc_html( $sectime['time_subtitle'] ); ?></h3>
						</div>
                        <?php endif;
                        if ( ! empty( $sectime['add_timeline'] ) ): ?>
						<div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding ">
							<ul class="nav nav-pills gjNav marginBottom25" id="pills-tab" role="tablist">
                            <?php $i=1;
								foreach($sectime['add_timeline'] as $timeln)
								{ ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($i===1){ echo 'active'; } ?> linkTab noPadding" id="j2016" data-toggle="pill" href="#y<?php echo esc_html($i); ?>" role="tab" aria-controls="pills-<?php echo esc_html( $i ); ?>" aria-selected="true">
                                            <?php echo esc_html( $timeln['time_year'] ); ?>
                                            <span class="dot"  ></span>
                                        </a>
                                    </li>
							<?php $i++; } ?>
							</ul>
                            <!---->
                            <div class="navDash"></div>
                            <!--Dashed line-->
							<div class="tab-content" id="pills-tabContent">
                            	<?php $t=1;
								foreach($sectime['add_timeline'] as $timeln)
								{ 
									$timg = wp_get_attachment_url($timeln['time_image']);
								?>
								<div class="tab-pane fade <?php if($t===1){ echo 'show active'; } ?>" id="y<?php echo esc_html($t); ?>" role="tabpanel" aria-labelledby="timeline<?php echo esc_html($t); ?>">
									<div class="row">
                                    	<?php if ( ! empty( $timeln['time_stitle'] ) ): ?>
										<div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
											<p class="fontOptLight font14 text-center text-white marginBottom15">
                                            	<?php echo esc_html( $timeln['time_stitle'] ); ?>
                                            </p>
										</div>
                                        <?php endif; ?>									
										<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <?php if ( ! empty( $sectime['add_timeline'] ) ): ?>
											<img src="<?php echo esc_url( $timg ); ?>" alt="shemb" class="img100 marginBottom15" />
										<?php endif; ?>
										</div>
										<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 gjBlock">
                                        	<?php if ( ! empty( $timeln['time_desc'] ) ): ?>
                                        	<?php echo wp_kses( $timeln['time_desc'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
												'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
												'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ),
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
												'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
												'strong' => array(),'div' => array( 'class' => array() ), 'class' => array() )); ?>
											<?php endif; ?>
										</div>
									</div>									
								</div>
                                <?php $t++; } ?>
								
							</div>
						</div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</section>
    
    
    <?php $sec_six = get_post_meta( get_the_ID(), 'home_sec_six', true ); 
	if ( ! empty( $sec_six['train_heading'] ) ): ?>
    <section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sec_six['train_heading'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
    <?php endif; 
	if ( ! empty( $sec_six['train_image'] ) && ! empty( $sec_six['train_description'] ) ): 
		$siximg = wp_get_attachment_url($sec_six['train_image']);
	?>
	<section class="noPadding greenBG">
        <div  class="container-fluid noPadding">
            <div class="container paddTop50 paddBottom35">
                <div class="row valign">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    	<?php if( !empty ($siximg) ) : ?>
                        	<img src="<?php echo esc_url( $siximg ); ?>" class="img100 marginBottom15" alt="Shemb" />
                        <?php endif; ?>
                    </div>
                    <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="txtDarkGreen fontOptLight text-left marginBottom25 font16 marginTB15">
							<?php echo wp_kses( $sec_six['train_description'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'download' => array(), 'title' => array(),'target' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) ); ?>
						</div>
						
                    </div>
                </div>
            </div>
        </div>
    </section><!--DM Training-->
    <?php endif; 
	$sec_seven = get_post_meta( get_the_ID(), 'home_sec_seven', true ); 
	if ( ! empty( $sec_seven['learn_head'] ) ):
	?>
	<section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sec_seven['learn_head'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
	<?php endif; 
	$learnimg = wp_get_attachment_url($sec_seven['learn_bgimage']);
	?>
    <section class="learnModDiv" style="background: url(<?php echo esc_url( $learnimg ); ?>);">
			<div class="container-fluid noPadding">
				<div class="container">
					<div class="row">
						<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 lmDiv">
                        	<?php if ( ! empty( $sec_seven['learn_title'] ) ): ?>
                            <h4 class="text-white fontOptLight text-left marginBottom35"><?php echo esc_html( $sec_seven['learn_title'] ); ?></h4>
                            <?php endif; ?>
                            <?php if ( ! empty( $sec_seven['add_learnmodule'] ) ):  ?>
							<ul class="nav nav-pills lmNav marginBottom25" id="pills-tab" role="tablist" style="">
                            <?php $i=1;
								foreach($sec_seven['add_learnmodule'] as $learn)
								{
									$lernicon = wp_get_attachment_url($learn['lea_icon']);
									?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($i===1){ echo 'active'; } ?> fontOptLight txtGreen noPadding" id="lm<?php echo esc_html( $i ); ?>" data-toggle="pill" href="#lmod<?php echo esc_html( $i ); ?>" role="tab" aria-controls="lm<?php echo esc_html( $i ); ?>" aria-selected="true">
                                        	<?php if ( ! empty( $lernicon ) ): ?>
                                            <img src="<?php echo esc_url( $lernicon ); ?>" alt="Shemb" class="lmIcon" />
                                            <?php endif;
											if ( ! empty( $learn['lea_title'] ) ):
                                            	echo esc_html( $learn['lea_title'] ); 
											endif; ?>									
                                        </a>
                                    </li>
							<?php $i++; } ?>
							</ul>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 lmDiv">
							<div class="tab-content marginTB25" id="pills-tabContent">
                            	<?php $i=1;
								foreach($sec_seven['add_learnmodule'] as $lrn)
								{ 
									$lernimg = wp_get_attachment_url($lrn['lea_image']);
								?>
								<div class="tab-pane fade <?php if($i===1){ echo 'show active'; } ?>" id="lmod<?php echo esc_html( $i ); ?>" role="tabpanel" aria-labelledby="lm<?php echo esc_html( $i ); ?>">
									<div class="row">
										<div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        	<?php if ( ! empty( $lrn['lea_title'] ) ): ?>
											<h2 class="fontOptLight text-white text-center marginBottom15">
                                            <?php echo esc_html( $lrn['lea_title'] ); ?></h2>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $lernimg ) ): ?>
											<img src="<?php echo esc_url( $lernimg ); ?>" alt="Shemb" class="img80 marginBottom15" />
                                            <?php endif; ?>
                                            <?php if ( ! empty( $lrn['lea_desc'] ) ): ?>
											<?php echo wp_kses( $lrn['lea_desc'], 
														array( 'br' => array( 'class' => array() ),
														'span' => array( 'class' => array() ),
														'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
														'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
														'h4' => array( 'class' => array() ),
														'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
														'a' => array( 'href' => array(), 'title' => array(), 'download' => array(), 'target' => array() ),
														'b' => array( 'class' => array() ),
														'img' => array( 'class' => array(),'src' => array(),'alt' => array() ),
														'div' => array( 'class' => array() ),
														'strong' => array(), 'class' => array() ) ); ?>
                                            <?php endif; ?>
										</div>
									</div>									
								</div>
                                <?php $i++; } ?>
								
							</div>
						</div>
                        <div class="col-sm-12 lmDiv2 noPadding">
                            <h2 class="fontOptLight text-white text-center marginBottom15">Digital Marketing</h2>
							
                            <!--7-->
                        </div>
                        <?php if ( ! empty( $sec_seven['learn_button'] ) && ! empty( $sec_seven['learn_blink'] ) ): ?>
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-center font16 fontOptLight marginTB25"><a href="<?php echo esc_url( $sec_seven['learn_blink'] ); ?>" target="_blank" class="lmLink"><?php echo esc_html( $sec_seven['learn_button'] ); ?></a> </p>
                        </div>
                         <?php endif; ?>
					</div>
				</div>
			</div>
		</section>
    
    
    
    <?php
	$sec_eight = get_post_meta( get_the_ID(), 'home_sec_eight', true ); 
	if ( ! empty( $sec_eight['heading'] ) ): ?>
    <section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 paddTop35 paddBottom35">
                    <h1 class="txtDarkGreen fontOptLight text-center noMargin"><?php echo esc_html( $sec_eight['heading'] ); ?></h1>
                </div>
            </div>    
        </div>
    </section><!--Title Section-->
	<?php endif; ?>
	<section class="noPadding whiteBG">
        <div class="container-fluid">
            <div class="row">
            <?php $imgeight = wp_get_attachment_url($sec_eight['bgimage']); ?>
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding brMod" style="background-image: url('<?php echo esc_url( $imgeight ); ?>');"> 
                <?php if ( ! empty( $sec_eight['description'] ) ): ?>
					<div class="brModInner darkGreenBG">
                    	<?php echo wp_kses( $sec_eight['description'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'download' => array(), 'target' => array() ),
							'strong' => array(), 'class' => array() )  ); ?>
					</div>
                <?php endif; ?>
                </div>
            </div>    
        </div>
    </section><!--Business Resiliency Training-->
    <?php
	$sec_nine = get_post_meta( get_the_ID(), 'home_sec_nine', true ); 
	if ( ! empty( $sec_nine['image'] ) && ! empty( $sec_nine['description'] ) ): ?>
	<section class="noPadding greenBG">
        <div  class="container-fluid noPadding">
            <div class="container paddTop50 paddBottom35">
                <div class="row valign">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                    	<?php $imgnine = wp_get_attachment_url($sec_nine['image']); 
						if ( ! empty( $imgnine ) ): ?>
                        	<img src="<?php echo esc_url( $imgnine ); ?>" class="img100 marginBottom15" alt="Shemb" />
                        <?php endif; ?>
                    </div>
                    <div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                    	 <?php if ( ! empty( $sec_nine['description'] ) ): ?>
                        <div class="txtDarkGreen fontOptLight text-left marginBottom25 font16 marginTB15">
							<?php echo wp_kses( $sec_nine['description'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ), 
							'b' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
							'strong' => array(), 'class' => array() )  ); ?>
						</div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Business Resiliency Training-->
	<?php endif; ?>
    <?php
	$sec_ten = get_post_meta( get_the_ID(), 'home_sec_ten', true ); 
	if ( ! empty( $sec_ten['heading'] ) || ! empty( $sec_ten['image'] ) || ! empty( $sec_ten['content'] ) ): ?>
	<section class="noPadding lightGreenBG">
        <div class="container-fluid lightGreenBG">
            <div class="row valign">
                <div class="col-7 col-xl-7 col-lg-7 col-md-6 col-sm-12 noPadding">
                	<?php $imgten = wp_get_attachment_url($sec_ten['image']);  
						if ( ! empty( $imgten )) : ?>
                    	<div class="learnAboutDivBg" style="background-image: url(<?php echo esc_url( $imgten ); ?>);"></div> 
                    <?php endif; ?>       
                </div>
                <div class="col-5 col-xl-5 col-lg-5 col-md-6 col-sm-12 padding25 learnAboutDiv">
					<div class="row">
						<div class="col-12">
                        	<?php $imgicon = wp_get_attachment_url($sec_ten['icon']);  
								if ( ! empty( $imgicon )) : ?>
								<img src="<?php echo esc_url( $imgicon ); ?>" class="learnIcon" alt="Shemb" />
                            <?php endif; ?>
                            <?php if ( ! empty( $sec_ten['heading'] )) : ?>
								<p class="fontOptRegular font20 txtDarkGreen text-center marginTB25">
								<?php echo esc_html( $sec_ten['heading'] ); ?></p>
                            <?php endif; ?>
						</div>
					</div>
                    <?php if ( ! empty( $sec_ten['content'] )) : ?>
                    	<?php echo wp_kses( $sec_ten['content'] , 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ),
							'div' => array( 'class' => array() ), 'b' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(), 'download' => array(), 'target' => array() ),
							'strong' => array(), 'class' => array() )  ); ?>
					<?php endif; ?>
					
                </div>
            </div>
        </div>
    </section>
	<?php endif; ?>
	<?php include get_template_directory().'/template-parts/content-learningcapsules.php'; ?>  
<?php endwhile; ?>
<?php
get_footer();
