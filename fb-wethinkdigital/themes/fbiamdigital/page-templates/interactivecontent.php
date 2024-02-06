<?php
/*
Template Name: Interactive Content Page
*/

get_header();

?>
<?php $banner = get_post_meta( get_the_ID(), 'banner', true ); 
	
	if ( ! empty( $banner['banner_image'] ) && ! empty( $banner['banner_title'] ) ):
		$banner_img = wp_get_attachment_url( $banner['banner_image'] );
	?>
        <section class="c-masthead c-masthead--resource-security" style="background: url(<?php echo esc_url( $banner_img ); ?>);">
            <div class="c-masthead__content o-wrap">
                <?php if ( ! empty( $banner['banner_title'] ) ): ?>
                <h1 class="c-masthead__heading_security u-animated u-animated--left-right intrac-head" ><?php echo wp_kses_post( $banner['banner_title'] ); ?></h1>
                <?php endif; ?>
                
            </div>
        </section>
    <?php endif; ?>
    
<?php $arch = get_post_meta( get_the_ID(), 'videoarchive', true ); 
	if ( ! empty( $arch['page_title'] ) && ! empty( $arch['description'] ) ):
?>
    <section class="o-wrap c-committee-intro" id="vdarch">
        <div class="intro c-committee-intro__description u-tac">
        	<?php if ( ! empty( $arch['page_title'] ) ): ?>
            	<h2 class="c-home-section__heading c-heading2 "><?php echo wp_kses_post( $arch['page_title'] ); ?></h2>
            <?php endif; ?>
            <?php if ( ! empty( $arch['description'] ) ): ?>
            	<?php echo wp_kses( $arch['description'], array(
						'br' => array( 'class' => array() ),
						'p' => array( 'class' => array() ),
					) ); ?>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
	$queryvd = get_Video();
	if ( $queryvd->have_posts() ) { ?>
        <section id="videolist" class="p-10">
            <div class="container videoarea">
                <div class="row">
                    <?php
						while ( $queryvd->have_posts() ) : $queryvd->the_post();
							$vd_field = get_post_meta( get_the_ID(), 'resource_attachment' , true );
							$video_url = $vd_field['video_url'];
							$vid = get_the_ID();
							$vdimg = wp_get_attachment_image_src( get_post_thumbnail_id( $vid ), 'full' );
							?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            	<a data-fancybox data-type="iframe" class="iframe" href="javascript:;" data-src="<?php echo esc_url($video_url); ?>">
                                    <div class="img-contain">
                                        <img src="<?php echo esc_url( $vdimg[0] ); ?>" alt="<?php echo wp_kses_post( get_the_title() ); ?>" class="img-responsive" >
                                    </div>
                                    <h3 class="c-listing-item__title"> <?php echo wp_kses_post( get_the_title() ); ?></h3>
                                    <p class="c-listing-item__description c-listing-item__description--resource">
                                        <?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?>
                                    </p>
                                </a>
                                
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
<?php } ?>	
				


<?php
get_footer();
