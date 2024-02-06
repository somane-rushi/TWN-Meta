<?php
/*
Template Name: Home Page
*/

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
?>
     
    <?php /*?><section class="c-masthead c-masthead--home"> 
		<div class="c-masthead__content o-wrap">
			<?php
			$head1     = get_post_meta( get_the_ID(), 'heading', true );
			?>
			<?php if ( ! empty( $head1 ) ): ?>
				<h1 class="c-masthead__heading u-animated u-animated--left-right">
                	<?php echo wp_kses( $head1, 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							 'class' => array() ) ); ?> 
                </h1>
			<?php endif; ?>
			
		</div>
	</section><?php */?>
    
    
    <?php
		$banner = get_post_meta( get_the_ID(), 'wtdbanner', true );
		$bimg='';
		if ( ! empty( $banner['banner'] ) ) :
			$bimg = wp_get_attachment_url($banner['banner']);
		endif; ?>
<section>
	<div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url(<?php echo esc_url( $bimg ); ?>);">
		<div class="container dirRTL">
			<div class="newRow">
            	<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
            	<?php if ( ! empty( $banner['namehead'] ) ) : ?>
            	<div class="headerTitle padding15 ">
					<h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                    	<?php echo wp_kses( $banner['namehead'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) ); ?>                
					</h1>
				</div>
                <?php endif; ?>
                <?php if ( ! empty( $banner['nameheadmbl'] ) ) : ?>
                <div class="headerTitleMob padding15">
                	<h3 class="txtWhite fontDisplay padding15 MarginBottomZero">
                    	<?php echo wp_kses( $banner['nameheadmbl'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) ); ?>
                    </h3>
                </div>
                 <?php endif; ?>
                 </div>
			</div>
		</div>
        <?php if ( ! empty( $banner['wel_btn_text'] ) && ! empty( $banner['wel_btn_link'] ) ) : ?>
        <div class="container-fluid paddingZero ">
        	<a href="<?php echo esc_url( $banner['wel_btn_link'] ); ?>" class="txtWhite fontDisplay">
			<div class="exploreBox padding25 bgBlue">                        
				<img src="<?php echo esc_url( get_theme_file_uri( 'images/header-play-icon.png' ) ); ?>" alt="wtd" class="playIcon" />
                	<?php if ( ! empty( $banner['wel_btn_text'] ) ) : ?>
					<p class="fontDisplay txtWhite marginZero font20 dirRTL"><?php echo esc_html( $banner['wel_btn_text'] ); ?></p>
                    <?php endif; ?>
			</div>
            </a>
		</div>
        <?php endif; ?>
	</div>
</section>
<?php $desc = get_post_meta( get_the_ID(), 'welcome', true ); 
if ( ! empty( $desc['desc'] ) ): ?>
<section>
	<div class="container-fluid bgWhite LeftRightPadding0">
		<div class="container">  
			<div class="padding40">
				<div class="fontTxt marginZero PaddingBottom45 font16 txtGrey dirRTL">
					<?php echo wp_kses( $desc['desc'], 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) ); ?>
				</div>
				<?php if ( ! empty( $desc['btn_link'] ) && ! empty( $desc['btn_text'] ) ) : ?>
				<p class="textCenter marginZero PaddingBottom5 dirRTL">
					<a href="<?php echo esc_url( $desc['btn_link'] ); ?>" class="bgGrey txtWhite fontTxt btnLink font16"><?php echo esc_html( $desc['btn_text'] ); ?></a>
				</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $dig = get_post_meta( get_the_ID(), 'section_dc', true ); ?>
	<section >
            <div class="container-fluid bgLightGrey paddingZero">
                <div class="container">
					<div class="padding40">
						<?php if ( ! empty( $dig['mainheading'] ) ) : ?>
						<h1 class="fontDisplay txtDarkBlue dirRTL PaddingBottom40 marginZero"><?php echo esc_html( $dig['mainheading'] ); ?></h1>
						<!--<h1 class="fontDisplay txtDarkBlue textCenter TopBottomPadding15 marginZero"><?php echo esc_html( $dig['mainheading'] ); ?></h1>-->
						<!---->
						<?php endif; 
						if ( ! empty( $dig['desc'] ) ) :
								echo wp_kses( $dig['desc'], 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) );
						endif; ?>
						<!---->
						<?php if ( ! empty( $dig['slide'] ) ): ?>
						<div id="digCit" class="owl-carousel owl-theme PaddingZero ">
							<?php foreach($dig['slide'] as $box)
							{ 
								$simage = wp_get_attachment_url($box['simage']); ?>
								<div class="item">
									<?php
										if ( ! empty( $box['sdesc'] ) ) :
											echo wp_kses( $box['sdesc'], 
											array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
											'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
											'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
											'h4' => array( 'class' => array() ), 'h5' => array( 'class' => array() ),
											'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
											'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
											'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
											'strong' => array(), 'class' => array() ) );
									endif; 
									if ( ! empty( $simage ) ) : ?>
									<img class="img100 paddingZero marginZero carousel-Img" src="<?php echo esc_url( $simage ); ?>" alt="WTD" />                            	
									<?php endif; ?>
								</div>
							<?php } ?>
						</div>
						<!---->
						<?php endif;
						if ( ! empty( $dig['descbot'] ) ) :
								echo wp_kses( $dig['descbot'], 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) );
						endif; ?>
					</div>	
                </div>                
            </div>
	</section>

<?php $res = get_post_meta( get_the_ID(), 'section_res', true ); ?>
<section>
	<div class="container-fluid bgWhite paddingZero">
    	<?php if ( ! empty( $res['mainheading'] ) || ! empty( $res['desc'] ) ): ?>
		<div class="container">  
			<div class="padding40">			
				<?php if ( ! empty( $res['mainheading'] ) ): ?>
				<h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL"><?php echo esc_html( $res['mainheading'] ); ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $res['desc'] ) || ! empty( $res['btntext'] ) ) : ?>
				<div class="paddingZero dirRTL">
					<?php if ( ! empty( $res['desc'] )):
							echo wp_kses( $res['desc'], 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) ); 
						endif;		
						if ( ! empty( $res['btntext'] )) : ?>
							<p class="textCenter marginZero PaddingBottom5">
								<a href="<?php echo esc_url($res['btnlink']); ?>" class="bgGrey txtWhite fontTxt btnLink font16 dirRTL"><?php echo esc_html( $res['btntext'] ); ?></a>
							</p>
						<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
        <?php endif;
        if ( ! empty( $res['resources'] ) ): ?>
        <div class="container-fluid">
			<div class="row BottomPadding25 TopPaddingZero LeftRightPadding15 flip-justify-center flip-res">
            <?php $i=1;
            	foreach($res['resources'] as $box)
				{ 
					$boximage = wp_get_attachment_url($box['boximage']);
				?>
                    <div class="col col1 col-lg-2 col-md-6 col-sm-12 MarginBottom25">
                        <div class="digBox flipBox">
                            <div class="flipBox-inner">
                                <div class="flipBox-front bgGrey">
                                    <img src="<?php echo esc_url( $boximage ); ?>" class="img100 flipImg" />
                                    <p class="textCenter marginZero TopBottomPadding25 bgGrey txtWhite fontDisplay font18 dirRTL">
										<?php echo esc_html( $box['heading'] ); ?>
                                    </p>
                                </div>
                                <div class="flipBox-back bgGrey">
                                    <div class="txtWhite padding25 text-left fontTxt font14">
                                        <div class="fontTxt font14 dirRTL">
											<?php echo wp_kses( $box['description'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
												'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
												'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
												'strong' => array(), 'class' => array() ) );
												?>
                                        </div>
                                        <?php
										if ( ! empty( $box['btn_text'] ) ): ?>
                                           		<a class="txtWhiteLink text-left fontTxt TopBottomMargin15" data-toggle="modal" data-target="#modalPop<?php echo esc_html($i); ?>" ><?php echo esc_html( $box['btn_text'] ); ?></a>
                                       <?php endif; ?> 
                                            
                                    </div>                                    
                                </div>
                            </div>                                
                        </div>
                    </div>
                    
                   <div class="modal fade aboutmodal" id="modalPop<?php echo esc_html($i); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body bgLightGrey">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="container">
                                    <div class="BottomPadding15">
                                    	<?php if ( ! empty( $box['popheading'] ) ): ?>
                                        	<h2 class="fontDisplay txtDarkBlue TopBottomPadding15 marginZero">
												<?php echo esc_html( $box['popheading'] ); ?></h2>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $box['popdes'] ) ): ?>
                                        	<?php echo wp_kses( $box['popdes'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
												'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
												'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
												'strong' => array(), 'class' => array() ) );
											?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
			<?php $i++; } ?>
				
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $quize = get_post_meta( get_the_ID(), 'quizzes', true );
if ( ! empty( $quize['qheading'] ) || ! empty( $quize['desc'] ) ): 
$qimg = wp_get_attachment_url($quize['image']);
?>
<section>
	<div class="container-fluid bgLightGrey paddingZero">
		<div class="row marginZero verticalAlignCenter">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 homeQuiz" style="background-image: url(<?php echo esc_url( $qimg ); ?>);"></div>
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
				<div class="padding40-home dirRTL">
                	<?php if ( ! empty( $quize['qheading'] )) : ?>
					<h1 class="fontDisplay txtDarkBlue PaddingBottom40 marginZero dirRTL">
                    	<?php echo wp_kses( $quize['qheading'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'b' => array( 'class' => array() ),'strong' => array(), 'class' => array() ) );
						?>
                    </h1>
                    <?php endif;
					if ( ! empty( $quize['desc'] )) : ?>
                    	<?php echo wp_kses( $quize['desc'], 
							array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
							'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
							'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
							'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
							'strong' => array(), 'class' => array() ) );
						?>
                    <?php endif; 
					if ( ! empty( $quize['btn_text'] )) : ?> 
                        <p class=" marginZero PaddingBottom5 dirRTL">
                            <a href="<?php echo esc_url( $quize['btn_link'] ); ?>" class="bgGrey txtWhite fontTxt btnLink font16">
							<?php echo esc_html( $quize['btn_text'] ); ?></a>
                        </p>
                    <?php endif; ?>
				</div>                        
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $resdt = get_post_meta( get_the_ID(), 'section_counter', true ); 
if ( ! empty( $resdt['mainheading'] ) && ! empty( $resdt['countbox'] ) ):
?>
<section class="dirRTL">
	<div class="container-fluid bgWhite">
		<div class="container TopBottomPadding50">
        	<?php if ( ! empty( $resdt['mainheading'] ) || ! empty( $resdt['note'] ) ): ?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    	<?php if ( ! empty( $resdt['mainheading'] )) : ?>
                        <h1 class="fontDisplay txtDarkBlue textCenter TopBottomPadding15 marginZero">
                        <?php echo esc_html( $resdt['mainheading'] ); ?></h1>
                        <?php endif; if ( ! empty( $resdt['note'] )) : ?>
                        <p class="fontTxt txtGrey textCenter PaddingBottom25 marginZero"><?php echo esc_html( $resdt['note'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; 
			if ( ! empty( $resdt['countbox'] ) ):
			?>
            <div class="row counnumbers">
            	<?php
					foreach($resdt['countbox'] as $cbox)
					{ 
						$boxicon = wp_get_attachment_url($cbox['boxicon']);
					?> 
                    	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <img src="<?php echo esc_url( $boxicon ); ?>" class=" imgIcon" />
                            <?php if ( ! empty( $cbox['number'] ) ): ?>
                            	<h1 class="fontTxt txtDarkBlue textCenter TopBottomPadding15 marginZero tkrTxt"><span class="counter-count"><?php echo esc_html( $cbox['number'] ); ?></span><?php echo esc_html( $cbox['numberpre'] ); ?></h1>
                            <?php endif; ?>
                            <?php if ( ! empty( $cbox['title'] ) ): ?>
                            	<p class="fontTxt txtGrey textCenter marginZero"><?php echo esc_html( $cbox['title'] ); ?></p>
                            <?php endif; ?>
                        </div>
                <?php } ?>
			</div> 
            <?php endif; ?>                   
		</div>
	</div>
</section>
<?php endif; ?>

<?php endwhile; ?>
<?php
get_footer();
