<?php
/**
 * The template for displaying resource archive pages
 */

get_header();
?>
<?php fbiamdigital_the_archive_masthead( 'resource' ); ?>

<?php $resources_archive_fields = get_option( 'archive_resource' ); ?>
	<section class="c-home-section c-home-section--resources u-animated u-animated--btm-top">
		<div class="o-wrap">
			<div class="o-box o-media c-home-section__media">
				<form class="o-media__body c-home-section__body" action="<?php echo esc_url( get_post_type_archive_link( 'resource' ) ); ?>">
					<?php if ( ! empty( $resources_archive_fields['filter_heading'] ) ): ?>
						<h2 class="c-home-section__heading c-heading2"><?php echo esc_html( $resources_archive_fields['filter_heading'] ); ?></h2>
					<?php endif; ?>
					<div class="c-home-section__description">
						<?php if ( ! empty( $resources_archive_fields['filter_description'] ) ): ?>
							<p>
								<?php echo wp_kses( $resources_archive_fields['filter_description'], array(
									'br' => array(
										'class' => array()
									),
								) ); ?>
							</p>
						<?php endif; ?>
						<p class="u-lh-1/6">
							<?php fbiamdigital_the_resources_filter_options(); ?>
						</p>
					</div>
					<button class="c-btn" type="submit"><?php esc_html_e( 'Search', 'fbiamdigital' ); ?> <i class="fas fa-chevron-right"></i></button>
				</form>
				<div class="o-media__img c-home-section__img u-d-none u-d-block@md" style="background: url(<?php echo esc_url( get_theme_file_uri( 'images/home-resources.png' ) ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
			</div>
		</div>
	</section>
    <?php 
	if ( ! empty( $resources_archive_fields['kidresource'] ) ) { $fields = $resources_archive_fields['kidresource'];
		$kidbg = wp_get_attachment_url($fields['kidres_bg']);
		if(! empty($kidbg) )
		{
	?>
    <section class="jumbotron o-wrap u-animated u-animated--btm-top u-animated--animate" style="transition-delay: 0ms;">
		<div class="jumbotron__bg-wrapper" style="background: url(<?php echo esc_url( $kidbg ); ?>) 50% 50% no-repeat; background-size: cover;">
			<div class="jumbotron__body kid-body">
            	<?php if ( ! empty( $fields['kidres_heading'] ) ) { ?>
            	<h3 class="jumbotron__heading"><?php echo wp_kses_post($fields['kidres_heading']);?></h3>
                <?php } ?>
                <?php if ( ! empty( $fields['kidres_description'] ) ) { ?>
                <div class="jumbotron__description">
					<p>
                    	<?php echo wp_kses( $fields['kidres_description'], array(
							'br' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
							'strong' => array(),
						) ); ?>
                    </p>
				</div>
                <?php } ?>
                <?php if ( ! empty( $fields['kidres_button_text'] ) ) { ?>
				<a class="jumbotron__cta" href="<?php echo esc_url( $fields['kidres_button_link'] ); ?>" target="_blank" rel="noopener" download=""><?php echo wp_kses_post($fields['kidres_button_text']);?></a>
                <?php } ?>
			</div>
		</div>
	</section>
    <?php } } ?>
    <?php
    $query = get_KidResources();
    	if ( $query->have_posts() ) { 
		
		?>
    <section class="c-listing c-listing--resources kid-res">
		<div class="o-wrap">
			<div class="o-layout o-layout--stretch">
            	<?php
					while ( $query->have_posts() ) : $query->the_post();
					$kid_attachment = get_post_meta( get_the_ID(), 'resource_detail' , true );
					$kidimg = $kidbg = wp_get_attachment_url($kid_attachment['rimage']);
					$kidvd = $kidbg = wp_get_attachment_url($kid_attachment['file']);
				 ?>
            	<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
                	<div class="o-box c-listing-item ">
                    	<span class="c-listing-item__ribbon"><?php esc_html_e( 'Featured', 'fbiamdigital' ); ?></span>
                        <div class="c-listing-item__img" data-preview-img="<?php echo esc_url( $kidimg ); ?>">
                        	<div style="background:url(<?php echo esc_url( $kidimg ); ?>) no-repeat 50% 50%; background-size: cover;"></div>
                            
                            <span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--spinner">
                                <div class="o-spinner o-spinner--bbounce">
                                    <div class="o-spinner__doodad-1"></div>
                                    <div class="o-spinner__doodad-2"></div>
                                    <div class="o-spinner__doodad-3"></div>
                                </div>
                            </span>
                        </div>
                       <div class="c-listing-item__body">
                       		<?php if ( ! empty( $kid_attachment['subtitle'] ) ): ?>
                            <div class="c-listing-item__meta">
                             	<span class="c-listing-item__cat"><?php echo wp_kses_post($kid_attachment['subtitle']); ?></span> 
                            </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $kid_attachment['welcome_content'] ) ): ?>
                            <p class="c-listing-item__description c-listing-item__description--resource">
                            	<?php echo wp_kses( $kid_attachment['welcome_content'], array( 
										'br' => array('class' => array() ),
										'a' => array( 'href' => array(), 'title' => array() ),
										'strong' => array(),
								) ); ?>
                            </p>
                            <?php endif; ?>
                            <p class="c-listing-item__cta">
                            	<a class="c-listing-item--resources" href="#" target="_blank" rel="noopener" data-video-src="<?php echo esc_url( $kidvd ); ?>">
                            	<span> <?php echo wp_kses_post($kid_attachment['boxvideo_text']); ?> </span><i class="far fa-video"></i></a> &nbsp;
                                <a href="<?php echo esc_url( $kidvd ); ?>" download target="_blank"> 
								<?php echo wp_kses_post($kid_attachment['boxdwnload_text']);?> 
                                <i class="far fa-arrow-to-bottom"></i></a> &nbsp;
                                <a onclick="myCopyText('<?php echo get_the_ID(); ?>','<?php echo esc_url($kidvd); ?>')">
                                <i class="fas fa-copy" ></i> </a>
                                <!--<a href="#" target="_blank"><i class="fas fa-share-alt"></i></a>-->
                                
                            </p>
                            
                        </div>
                        <div class="copiediv" style="height:30px;padding-top:5px;" id="myCopyp<?php echo get_the_ID(); ?>"></div>
                    </div>
                    
                </div>
                 <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php } ?>
    
    

<?php if ( ! empty( $resources_archive_fields['jumbotron'] ) ) {
	fbiamdigital_the_jumbotron( $resources_archive_fields['jumbotron'] );
}; ?>

<?php if ( have_posts() ) : ?>
	<section class="c-listing c-listing--resources">
		<div class="o-wrap">
			<div id="content" class="o-layout o-layout--stretch">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div>
		</div>
	</section>
<?php else:
	// If user searched for something that didn't exist
	if ( ! empty( get_query_var( 'topic' ) ) || ! empty( get_query_var( 'audience' ) ) ):
		$suggested_resources_query = fbiamdigital_get_suggested_resources();
		if ( $suggested_resources_query->have_posts() ) : ?>

			<section class="c-no-results">
				<div class="o-wrap">
					<h2 class="c-no-results__heading c-heading2 u-tac">
						<?php esc_html_e( 'We\'re working on adding more resources in this section.', 'fbiamdigital' ); ?>
					</h2>
					<div class="c-no-results__description u-tac">
						<p>
							<?php esc_html_e( 'Explore other popular resources today.', 'fbiamdigital' ); ?>
						</p>
					</div>
				</div>
			</section>

			<section class="c-listing c-listing--resources">
				<div class="o-wrap">
					<div class="o-layout o-layout--stretch">
						<?php
						while ( $suggested_resources_query->have_posts() ) : $suggested_resources_query->the_post();

							get_template_part( 'template-parts/content', 'resource' );

						endwhile;

						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>

		<?php else:

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

	<?php else:

		get_template_part( 'template-parts/content', 'none' );

	endif;

endif; ?>

	<div class="c-doodad-footer-resources">
		<div></div>
		<div></div>
		<div></div>
	</div>

	<div class="c-resources-video-player">
		<div class="c-resources-video-player__content">
			<video controls controlsList="nodownload" preload="metadata" playsinline></video>
			<button class="c-resources-video-player__btn-close"><i class="fal fa-times"></i></button>
		</div>
	</div>

<?php
get_footer();
?>

<script>
function myCopyText(vid,ulink){
	var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = ulink;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
	
	jQuery('#myCopyp'+vid).fadeIn();
	jQuery('#myCopyp'+vid).text('Link Copied');
	setTimeout(function() {
		jQuery('#myCopyp'+vid).fadeOut('fast');
	}, 1000); 
	
}


</script>