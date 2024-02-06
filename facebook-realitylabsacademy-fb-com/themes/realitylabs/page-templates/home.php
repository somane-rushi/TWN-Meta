<?php
/*
Template Name: Home Template
*/

get_header();
?>
<section>
	<div class="container-full padding-top-lg padding-bottom-lg">
	</div>
</section>
<?php $secone = get_post_meta( get_the_ID(), 'secone', true ); ?>
<section class="img-sec">
	<div class="container-full dotPatternLeft">
		<div class="container">
			<div class="row dispContainerFlex">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xx-12">
					<div class="contWidth80Div">
                    	<?php if ( ! empty( $secone['one_title'] ) ): ?>
						<h2 class="fontXtraLight txtDarkGrey margin-top margin-bottom">
							<?php echo wp_kses( $secone['one_title'], array(
									'sup' => array(),
									'br' => array(),
									'strong' => array(),
									'style' => array(),
									'span' => array('class' => array()),
									'ul' => array('class' => array() ),
									'li' => array('class' => array() ),
									'a'   => array(
										'href'   => array(),
										'title'  => array(),
										'target' => array( '_blank' ),
									),
							) ); ?>
                        </h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $secone['one_description'] ) ): ?>
						<p class="fontXtraLight txtGrey margin-bottom margin-top font18">
							<?php echo wp_kses( $secone['one_description'], array(
									'sup' => array(),
									'br' => array(),
									'strong' => array(),
									'style' => array(),
									'span' => array('class' => array()),
									'ul' => array('class' => array() ),
									'li' => array('class' => array() ),
									'a'   => array(
										'href'   => array(),
										'title'  => array(),
										'target' => array( '_blank' ),
									),
							) ); ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $secone['one_btn_text'] ) ): ?>
                        	<a href="<?php echo esc_url( $secone['one_btn_link'] ); ?>" class="btn btnBlue waves-attach waves-light padding-left padding-right font16 fontTxt"><?php echo esc_html( $secone['one_btn_text'] ); ?></a>
                        <?php endif; ?>
					</div>
				</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xx-12 dis-image">
					<div class="tilter">
                    	<?php if ( ! empty( $secone['one_image'] ) ): 
							 $img = wp_get_attachment_url( $secone['one_image'] ); ?>
							<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_html( $secone['one_title'] ); ?>" class="img90 margin-bottom-lg margin-top-lg" />
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $sectwo = get_post_meta( get_the_ID(), 'sectwo', true ); ?>
<section class="img-sec">
	<div class="container-full dotPatternRight margin-bottom-lg">
		<div class="container">
			<div class="row dispContainerFlex">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xx-12 dis-image">
					<div class="tilter">
                    	<?php if ( ! empty( $sectwo['two_image'] ) ): 
							$image = wp_get_attachment_url( $sectwo['two_image'] ); ?>
							<img src="<?php echo esc_url( $image ); ?>" alt="" class="img90 margin-bottom-lg margin-top-lg" />
                        <?php endif; ?>
					</div>
				</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xx-12">
                	<?php if ( ! empty( $sectwo['add_carousel'] ) ): ?>
					<div class="owl_4 owl-carousel owl-theme govtest">
                    	<?php foreach ( $sectwo['add_carousel'] as $slide ): ?>
                        	<?php if ( ! empty( $slide['caro_title'] ) && ! empty( $slide['caro_desc'] ) ): ?>
                                <div class="item">
                                    <div class="contWidthCarousel margin-bottom-lg">
                                        <?php if ( ! empty( $slide['caro_title'] ) ): ?>
                                        <h2 class="fontXtraLight txtDarkGrey margin-top margin-bottom"><?php echo esc_html( $slide['caro_title'] ); ?></h2>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $slide['caro_desc'] ) ): ?>
                                        <p class="fontXtraLight txtGrey margin-bottom margin-top font18">
                                            <?php echo wp_kses( $slide['caro_desc'], array(
                                                'sup' => array(),
                                                'br' => array(),
                                                'strong' => array(),
												'span' => array('class' => array()),
                                                'style' => array(),
												'ul' => array('class' => array() ),
												'li' => array('class' => array() ),
                                                'a'   => array(
                                                    'href'   => array(),
                                                    'title'  => array(),
                                                    'target' => array( '_blank' ),
                                                ),
                                            ) ); ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                             <?php endif; ?>
                        <?php endforeach; ?>
                   
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $secthr = get_post_meta( get_the_ID(), 'secthree', true ); ?>
<?php if ( ! empty( $secthr['add_feature'] ) ): ?>
<section class="img-sec">
	<div class="container-full">
		<div class="container">
			<div class="row">
            	<?php foreach ( $secthr['add_feature'] as $feature ): ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-xx-12 dis-image">
					<div class="dispTitleFlex margin-bottom">
                    	<?php if ( ! empty( $feature['feat_icon'] ) ): 
							$ficon = wp_get_attachment_url( $feature['feat_icon'] ); ?>
							<img src="<?php echo esc_url( $ficon ); ?>" alt="<?php echo esc_html( $feature['feat_title'] ); ?>" class="iconImg" />
                        <?php endif; ?>
                        <?php if ( ! empty( $feature['feat_title'] ) ): ?>
							<h3 class="fontXtraLight txtDarkGrey margin-bottom-sm margin-top-sm margin-left margin-right">
                            	<?php echo esc_html( $feature['feat_title'] ); ?></h3>
                        <?php endif; ?>
					</div>
                    <div class="tilter">
                    	<?php if ( ! empty( $feature['feat_image'] ) ): 
							$fimg = wp_get_attachment_url( $feature['feat_image'] ); ?>
							<img src="<?php echo esc_url( $fimg ); ?>" alt="<?php echo esc_html( $feature['feat_title'] ); ?>" class="img80 margin-bottom" />
                        <?php endif; ?>
					</div>
                    <?php if ( ! empty( $feature['feat_desc'] ) ): ?>
                    	<p class="fontXtraLight txtGrey margin-bottom margin-top font18 text-center">
                        	<?php echo wp_kses( $feature['feat_desc'], array(
                                       	'sup' => array(),
                                        'br' => array(),
                                        'strong' => array(),
                                        'style' => array(),
										'span' => array('class' => array()),
										'ul' => array('class' => array() ),
										'li' => array('class' => array() ),
                                        'a'   => array(
                                        	'href'   => array(),
                                            'title'  => array(),
                                            'target' => array( '_blank' ),
										),
									) ); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( ! empty( $feature['feat_btntext'] ) ): ?>
                    	<p class="text-center margin-bottom-lg">
                        	<a class="btn btnGrey waves-attach waves-light padding-left padding-right font14 fontTxt" 
                            href="<?php echo esc_url( $feature['feat_btnlink'] ); ?>"><?php echo esc_html( $feature['feat_btntext'] ); ?></a></p>
                    <?php endif; ?>
				</div>
                <?php endforeach; ?>
               
                
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<section>
	<div class="container-full">
		<div class="container dotPatternContainer"></div>
	</div>
</section>


<?php
get_footer();
