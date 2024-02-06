<?php
/*
Template Name: Foundation Template
*/

get_header();
?>

<section>
	<div class="container-full padding-top-lg padding-bottom-lg"></div>
</section>
<?php $secone = get_post_meta( get_the_ID(), 'secone', true ); 
if ( ! empty( $secone['one_image'] ) &&  ! empty( $secone['one_title'] ) ): ?>
    <section>
        <div class="container-full dotPatternLeft margin-bottom-no">
            <div class="container foundationContainerTop">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if ( ! empty( $secone['one_image'] ) ): 
                                $img = wp_get_attachment_url( $secone['one_image'] ); ?>
                                <img src="<?php echo esc_url( $img ); ?>" alt="Foundation 101+" class="foundationImage" />
                        <?php endif; ?>
                        <?php if ( ! empty( $secone['one_title'] ) ): ?>
                            <h1 class="fontXtraLight txtNavBlue margin-bottom-lg margin-top-lg text-center">
							<?php echo wp_kses( $secone['one_title'], array(
                                       	'br' => array(),
							) ); ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $sectwo = get_post_meta( get_the_ID(), 'sectwo', true ); 
if ( ! empty( $sectwo['two_title'] ) &&  ! empty( $sectwo['two_desc'] ) ): ?>
<section>
	<div class="container-full">
		<div class="container">
			<div class="row dispContainerFlex">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="contWidth80Div">
                    	<?php if ( ! empty( $sectwo['two_title'] ) ): ?>
							<h2 class="fontXtraLight txtDarkGrey margin-top-no margin-bottom text-center"><?php echo esc_html( $sectwo['two_title'] ); ?></h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectwo['two_desc'] ) ): ?>
							<p class="fontXtraLight txtGrey margin-bottom margin-top font18 text-center">
                            	<?php echo wp_kses( $sectwo['two_desc'], array(
										'sup' => array(),
                                        'br' => array(),
                                        'strong' => array(),
										'span' => array(),
                                        'style' => array(),
                                        'a'   => array(
                                            'href'   => array(),
                                            'title'  => array(),
                                        	'target' => array( '_blank' ),
                                        ),
                                ) ); ?>
                            </p>
                        <?php endif; ?>
						<p class="text-center margin-top-lg margin-bottom-lg"></p>
					</div>
				</div>						
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $secthree = get_post_meta( get_the_ID(), 'secthree', true ); 
if ( ! empty( $secthree['three_image'] ) &&  ! empty( $secthree['three_title'] ) &&  ! empty( $secthree['three_desc'] ) ): ?>
<section class="img-sec">
	<div class="container-full margin-bottom-lg">
		<div class="container dotPatternContainerTwo">
			<div class="row dispContainerFlex">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 dis-image">
                	<?php if ( ! empty( $secthree['three_image'] ) ): 
                    	$imgthr = wp_get_attachment_url( $secthree['three_image'] ); ?>
                        <div class="tilter">
                            <img src="<?php echo esc_url( $imgthr ); ?>" alt="<?php echo esc_attr( $secthree['three_title'] ); ?>" class="img90 margin-bottom margin-top" />
                        </div>
                    <?php endif; ?>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="contWidth80Div">
                    	<?php if ( ! empty( $secthree['three_title'] ) ):  ?>
							<h2 class="fontXtraLight txtDarkGrey margin-top margin-bottom"><?php echo esc_html( $secthree['three_title'] ); ?></h2>
						<?php endif; ?>
                        <?php if ( ! empty( $secthree['three_desc'] ) ):  ?>
							<?php echo wp_kses( $secthree['three_desc'], array(
										'sup' => array(), 'br' => array(), 'p' => array( 'class' => array() ), 
										'span' => array( 'class' => array() ), 'strong' => array(),
										'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ), 
										'style' => array(),
                                        'a'   => array(
                                            'href'   => array(), 'title'  => array(), 'target' => array( '_blank' ),
                                        ),
                                ) ); ?>
                        <?php endif; ?>				
					</div>		
				</div>						
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $secfor = get_post_meta( get_the_ID(), 'secfor', true ); 
if ( ! empty( $secfor['for_title'] ) &&  ! empty( $secfor['for_image'] ) ): ?>
<section class="img-sec">
	<div class="container-full margin-bottom-lg">
		<div class="container dotPatternContainerCenter">
			<div class="row dispContainerFlex">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="tilter">
                    	<?php if ( ! empty( $secfor['for_image'] ) ): 
                    		$imgfor = wp_get_attachment_url( $secfor['for_image'] ); ?>
							<img src="<?php echo esc_url( $imgfor ); ?>" alt="<?php echo esc_attr( $secfor['for_title'] ); ?>" class="img90 margin-bottom margin-top hidden-lg hidden-md hidden-sm" />
                        <?php endif; ?>
					</div>
                    <?php if ( ! empty( $secfor['for_title'] ) ):  ?>
						<h2 class="fontXtraLight txtDarkGrey margin-top margin-bottom"><?php echo esc_html( $secfor['for_title'] ); ?></h2>
                    <?php endif; ?>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 dis-image">
                	<?php if ( ! empty( $secfor['for_image'] ) ): 
                    	$imgfor = wp_get_attachment_url( $secfor['for_image'] ); ?>
                        <div class="tilter">
                            <img src="<?php echo esc_url( $imgfor ); ?>" alt="<?php echo esc_attr( $secfor['for_title'] ); ?>" class="img90 margin-bottom margin-top hidden-xs hidden-xx" />
                        </div>
                    <?php endif; ?>
				</div>						
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $course = course_category();
if( !empty( $course ) ) :
?>
<section class="divcourse">
	<div class="container-full margin-bottom-lg">
		<div class="container">
			<div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">
            	<?php foreach ( $course as $cou ) { 
					$ctime = get_term_meta( $cou->term_id, 'cat_time', true );
					$ccred = get_term_meta( $cou->term_id, 'cat_credits', true );
					$cdesc = get_term_meta( $cou->term_id, 'cat_sdesc', true );
					$cimage = get_term_meta( $cou->term_id, 'cat_image', true );
					$cimg = wp_get_attachment_url( $cimage['cimage'] );
				?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12 dis-image">
                        <div class="dispTitleFlex margin-bottom">
                            <h3 class="fontXtraLight text-center txtDarkGrey margin-bottom-sm margin-top-sm margin-left margin-right">
							<?php echo esc_html( $cou->name ); ?></h3>
                        </div>
                        <div class="tilter">
                            <img src="<?php echo esc_url( $cimg ); ?>" alt="<?php echo esc_attr( $cou->name ); ?>" class="img80 margin-bottom" />
                        </div>
                        <div class="dispTitleFlex margin-bottom-no">
                            <div class="contWidth80">
                            	<?php if( !empty( $ctime['cattime']) ){ ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6">
                                        <img src="https://realitylabsacademy.fb.com/wp-content/uploads/2022/01/clock-grey.png" style="Clock" class="iconImgSmall" />
                                        <p class="text-center txtGrey margin-bottom-sm margin-top-sm"><?php echo esc_html( $ctime['cattime']); ?></p>
                                    </div>
                                <?php } ?>
                                <?php if( !empty( $ccred['catcreadits']) ){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6">
                                    <img src="https://realitylabsacademy.fb.com/wp-content/uploads/2022/01/credits-grey.png" style="Credits" class="iconImgSmall" />
                                    <p class="text-center txtGrey margin-bottom-sm margin-top-sm"><?php echo esc_html( $ccred['catcreadits']).' Credits'; ?></p>
                                </div>
                                <?php } ?>
                            </div>								
                        </div>
                        <div class="contWidth80">
                            <p class="fontXtraLight txtGrey margin-bottom margin-top-xs font18 text-center">
                                <?php echo wp_kses($cdesc['cat_sdetail'], array(
										'span' => array( 'class' => array() ), 'strong' => array(),
										'style' => array(),'br' => array(),
                                ) ); ?>
                            </p>
                            <p class="text-center margin-bottom-lg">
                            	<a href="<?php echo esc_url( get_site_url() ); ?>/topic/?id='<?php echo sanitize_key($cou->term_id); ?>" 
                                class="btn btnGrey waves-attach waves-light padding-left padding-right font14 fontTxt">Launch Module</a>
                            </p>	
                        </div>							
                    </div>
                <?php } ?>
                
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
get_footer();
