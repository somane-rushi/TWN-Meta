<?php
/*
Template Name: Regions Page
*/

get_header();
?>

<?php while ( have_posts() ) : the_post(); 
	$sec_banner = get_post_meta( get_the_ID(), 'sec_banner', true );
	$vdbanner = wp_get_attachment_url($sec_banner['overview_vd']);
	if ( ! empty( $vdbanner ) ):
?>
	<section id="topsec">
        <div class="container-fluid pad-0">
            <video id="topvideo" width="100%" controls autoplay muted>
                <source src="<?php echo esc_url( $vdbanner ); ?>" type="video/mp4">Your browser does not support HTML video.
            </video>
        </div>
    </section>
<?php endif; ?>
<?php $secslider = get_post_meta( get_the_ID(), 'sec_slider', true ); 
	if ( ! empty( $secslider['add_slide'] ) ): ?>
    <section id="topsec">
        <div class="container-fluid pad-0">
            <div id="owl-carousel" class="owl-carousel owl-theme">
            	<?php
            	foreach($secslider['add_slide'] as $slide)
				{ 
					$imagesrc = wp_get_attachment_url($slide['slide_image']);
					$vdsrc = wp_get_attachment_url($slide['slide_vd']);
				?>
                	<div class="item"> 
                    	<a class="popup-youtube" href="<?php echo esc_url( $imagesrc ); ?>">
                        	<img src="<?php echo esc_url( $vdsrc ); ?>" alt="Shemb"  /> </a> 
                    </div>
				<?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php 
	$sec_tag = get_post_meta( get_the_ID(), 'sec_tagline', true ); 
	if ( ! empty( $sec_tag['wel_btn_text'] ) || ! empty ($sec_tag['wel_heading'] ) ): ?>
        <section class="storiesback">
            <div class="container-fluid emparea"> 
            	<div class="row">
                	<div class="col-lg-8 col-md-8 col-12">
                    	<?php  if ( ! empty( $sec_tag['wel_heading'] ) ): ?>
                    		<p class="mt-30">
                            	<?php echo wp_kses( $sec_tag['wel_heading'], 
									array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
									'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
									'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
									'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
									'strong' => array(), 'class' => array() ) ); ?>
									</p>
						<?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                    <a href="<?php echo esc_url( $sec_tag['wel_btn_link'] ); ?>" class="stories-btn" >
                    <?php echo esc_html( $sec_tag['wel_btn_text'] ); ?> </a>
                    </div>
                </div>
            </div>
        </section>
<?php endif; ?>
<?php 
	$sec_two = get_post_meta( get_the_ID(), 'two_content', true ); 
	if ( ! empty( $sec_two['rtitle'] )  && ! empty( $sec_two['rsubtitle'] ) && ! empty( $sec_two['rdesc'] ) ) : ?>
        <section>
            <div class="container-fluid emparea">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="big-heading-area">
                        	<?php if ( ! empty( $sec_two['rsubtitle'] ) ): ?>
                           		<h6 class="sm-heading-b"><?php echo esc_html( $sec_two['rsubtitle'] ); ?> </h6>
                            <?php endif; ?>
                            <?php if ( ! empty( $sec_two['rtitle'] ) ): ?>
                            	<h1 class="big-heading-b"><?php echo esc_html( $sec_two['rtitle'] ); ?> </h1>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8 col-xs-12">
                    	<?php if ( ! empty( $sec_two['rdesc'] ) ): ?>
                            <h4 class="emp-ab-txt">
                                <?php echo wp_kses( $sec_two['rdesc'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ),'strong' => array(), 'class' => array() ) ); ?>
                            </h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php endif; ?>

<?php 
	$sec_light = get_post_meta( get_the_ID(), 'thr_content', true ); 
	$hbgimage = wp_get_attachment_url($sec_light['hbgimage']);
	?>
<section class="sec-highlight" style="background-image: url(<?php echo esc_url( $hbgimage ); ?>);">
	<div class="container">
		<div class="row">
        	<?php if ( ! empty( $sec_light['htitle'] ) ): ?>
				<div class="col-lg-12">
					<h3 class="success-big-con"><?php echo esc_html( $sec_light['htitle'] ); ?> </h3>
				</div>
            <?php endif; ?>
			<div class="col-12">
				<div class="sucess-slider owl-carousel wow fadeInUp" data-wow-delay="0.4s">
                	<?php $cnt=1;
					foreach($sec_light['add_highlights'] as $high)
					{ 
					//print_r($sec_light['add_highlights']); 
					if( ! empty( $high['high_title']) && ! empty( $high['high_desc'] ) ) :
					?>
					<div class="item" data-dot="<span><?php echo sprintf("%02d", $cnt); ?></span>">
						<div class="success-block">
							<div class="success-leftmain_txt">
                            	<?php if ( ! empty( $high['high_title'] ) ): ?>
									<h2><?php echo esc_html( $high['high_title'] ); ?></h2>
                                <?php endif; ?>
							</div>
                            <div class="success-rightmain_txt">
                            	<?php if ( ! empty( $high['high_desc'] ) ): ?>
                                <?php echo wp_kses( $high['high_desc'], 
										array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
										'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
										'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
										'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
										'strong' => array(), 'class' => array() ) ); ?>
                                <?php endif; ?>
                            </div>
						</div>
                        
					</div>
                    
                    <?php $cnt++; endif; } ?>
				</div>
                <?php $i=1;
					foreach($sec_light['add_highlights'] as $high)
					{ ?>
                		<?php if($i===1){ ?>
                            <div id="example" class="horizontal-slider">
                                <div class="frame">
                                    <ul class="">
                                    <?php
                                    foreach($high['hig_images'] as $highimg)
                                    { 
                                        $highimg = wp_get_attachment_url($highimg['himg']);
                                    ?>
                                        <li>
                                            <img src="<?php echo esc_url( $highimg ); ?>" alt="Shemb">
                                        </li>
                                    <?php } ?>   
                                    </ul>
                                </div>
                                <div class="scrollbar">
                                    <div class="handle">
                                        <div class="mousearea"></div>
                                    </div>
                                </div>
                            </div>
                            <?php } 
							$i++;
					} ?>
                    
                
                
				
			</div>
		</div>
	</div>
</section>



<?php 
	$sec_thr = get_post_meta( get_the_ID(), 'two_col_irtl', true ); 
	if ( ! empty( $sec_thr['title'] )  && ! empty( $sec_thr['desc'] ) && ! empty( $sec_thr['image'] ) ) : 
		$thrimg = wp_get_attachment_url($sec_thr['image']);
	?>  
    <section class="successstoriesarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12 ">
                    <div class="ssrealativearea">
                    	<?php if ( ! empty( $sec_thr['title'] ) ): ?>
                        	<h1 class="ssheading"><?php echo esc_html( $sec_thr['title'] ); ?></h1>
                        <?php endif; ?>
                        <?php if ( ! empty( $sec_thr['desc'] ) ): ?>
                            <div class="ssabpara">
                                <?php echo wp_kses( $sec_thr['desc'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $sec_thr['btn_text'] ) && ! empty( $sec_thr['btn_link'] ) ): ?>
                            <a class="dbnbtnss" href="<?php echo esc_url( $sec_thr['btn_link'] ); ?>"> 
                            <i class="far fa-arrow-alt-circle-right"></i>
                            <span class="dbnbtntxt"><?php echo esc_html( $sec_thr['btn_text'] ); ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-12 p-0">
                	<?php if ( ! empty( $thrimg ) ): ?>
                    <img src="<?php echo esc_url( $thrimg ); ?>" class="successimg" alt="Shemb" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $secbox = get_post_meta( get_the_ID(), 'four_content', true ); 
	if ( ! empty( $secbox['add_box'] ) ): 
	$count = count($secbox['add_box']);  $cls='';
	if($count===1){ $cls='col-lg-12 col-md-12'; }
	else if($count===2){ $cls='col-lg-6 col-md-6'; }
	else if($count===3){ $cls='col-lg-4 col-md-4'; }
	else if($count===4){ $cls='col-lg-3 col-md-3'; }
	else{ $cls='col-lg-4 col-md-4'; }
	?>
    
    <section class="entrprenure-area">
        <div class="container-fluid">
        	<div class="row">
        	<?php
            	foreach($secbox['add_box'] as $box)
				{ 
					$boximg = wp_get_attachment_url($box['box_image']);
				?>
                    <div class="<?php echo $cls; ?> col-12">
                        <div class="entimgarea">
                            <img src="<?php echo esc_url( $boximg ); ?>" alt="Shemb" />
                            <?php if ( ! empty( $box['box_title'] ) ): ?>
                            <h1 class="entpretxt_ab"> 
                            	<a href="<?php echo esc_url( $box['box_link'] ); ?>">
                                	<?php echo wp_kses( $box['box_title'], 
									array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
									'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
									'b' => array( 'class' => array() ), 'strong' => array(), 'class' => array() ) ); ?>
                                </a>
                            </h1>
                            <?php endif; ?>
                        </div>
                    </div>
			<?php } ?>
            </div>
		</div>
	</section>
    
<?php endif; ?>

<?php 
	$sec_four = get_post_meta( get_the_ID(), 'one_col_text', true ); 
	if ( ! empty( $sec_four['desc'] )  ) : 
	?> 
    <section class="updated-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo wp_kses( $sec_four['desc'], 
                          array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                          'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
                          'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                          'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                          'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                          'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                          'strong' => array(), 'class' => array() ) ); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

    
<?php endwhile; ?>
<?php
get_footer();
