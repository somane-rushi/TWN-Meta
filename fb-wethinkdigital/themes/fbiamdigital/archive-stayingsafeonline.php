<?php
/**
 * The template for displaying stayingsafeonline archive pages
 */

get_header();
?>

<?php $fields = get_option( "archive_stayingsafeonline", array() ); ?>
<?php if ( ! empty( $fields['heading'] ) ) { 
$headbg = wp_get_attachment_url($fields['bg_image']);
$banfclr=''; $txtdir='';
if($fields['banner_fcolor']==='purple'){ $banfclr='txtPurple'; }
else if($fields['banner_fcolor']==='light_green'){ $banfclr='txtGreen'; }
else if($fields['banner_fcolor']==='white'){ $banfclr='txtWhite'; }
else{ $banfclr='txtBlack'; }
if($fields['text_direction']==='left'){ $txtdir='dirLTR'; }
else if($fields['text_direction']==='right'){ $txtdir='dirRTL'; }

?>
<section class="c-masthead c-masthead--resource-security c-masthead-security <?php echo wp_kses_post($txtdir); ?>" style="background: url(<?php echo esc_url( $headbg ); ?>);">
	<div class="c-masthead__content o-wrap">
    	<?php if ( ! empty( $fields['heading'] ) ): ?>
		<h1 class="c-masthead__heading_security u-animated u-animated--left-right <?php echo wp_kses_post($banfclr); ?> <?php echo wp_kses_post($txtdir); ?>" ><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
        <?php endif; ?>
        <?php if ( ! empty( $fields['banner_content'] ) ): ?>
        <div class="c-masthead__description_security u-animated u-animated--left-right margin-Bottom-PointFive <?php echo wp_kses_post($banfclr) ?> <?php echo wp_kses_post($txtdir); ?>" >
        	<?php echo wp_kses( $fields['banner_content'], array(
					'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array()
				) ); ?>
		</div>
        <?php endif; ?>
        <?php if ( ! empty( $fields['video_text'] ) && ! empty( $fields['security_video_fields'] ) ): 
			$popvedio = wp_get_attachment_url($fields['security_video_fields']['file']);
		?>
        <div class="c-masthead__description_security u-animated u-animated--left-right margin-Bottom-PointFive <?php echo wp_kses_post($banfclr); ?> <?php echo wp_kses_post($txtdir); ?>" >
        	<a data-fancybox href="#myVideo" class="<?php echo wp_kses_post($banfclr) ?>">
                <?php echo wp_kses_post( $fields['video_text'] ); ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-play"></i>
            </a>
            
            <video controls id="myVideo" style="display:none;">
                <source src="<?php echo esc_url( $popvedio ); ?>" type="video/mp4">
                Your browser doesn't support HTML5 video tag.
            </video>
        </div>
        <?php endif; ?>
	</div>
</section>

<?php } ?>

	<section class="o-wrap c-committee-intro u-animated u-animated--btm-top <?php echo wp_kses_post($txtdir); ?>">
    	<?php if ( ! empty( $fields['main_content'] ) ): ?>
            <div class="intro c-committee-intro__description u-tac <?php echo wp_kses_post($txtdir); ?>">
                <?php echo wp_kses( $fields['main_content'], array(
                        'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array()
                    ) ); ?>					
            </div>
        <?php endif; ?>
        <?php if( $fields['dispaly_scam'] === '1')
		{?>
            <div class="c-listing-filter">
                <div class="o-wrap">
                    <div class="c-listing-filter__inner o-box">
                        <div style="filterBox">					
                            <select class="formSelect" name="scam1" onchange="checkscam(this.value)" style="">
                            	<?php if( ! empty(  $fields['drop_select'] ) ) { ?>
                            		<option value=""><?php echo wp_kses_post($fields['drop_select']); ?></option>
                                <?php } ?>
                                <?php $queryev = get_shopscam();
                                	if ( $queryev->have_posts() ) {
										if( ! empty(  $fields['drop_shop'] ) ) { ?>
                                			<option value="ecomm"><?php echo wp_kses_post($fields['drop_shop']); ?></option>
                                <?php } }
                                if ( have_posts() ) { 
									if( ! empty(  $fields['drop_scamsters'] ) ) { ?>
                                		<option value="scamsters"><?php echo wp_kses_post($fields['drop_scamsters']); ?></option>
                                <?php } } ?>
                            </select> 
                            
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
	</section> 
    <?php if ( ! empty( $fields['shop_heading'] ) ) { ?>
    <section class="jumbotron o-wrap u-animated u-animated--btm-top paddTop50 <?php echo wp_kses_post($txtdir); ?>" id="ecomm">
    	<?php if ( ! empty( $fields['shop_heading'] ) ): ?>
			<h2 class="c-home-section__heading c-heading2 u-animated u-animated--btm-top text-center <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['shop_heading'] ); ?></h2>
        <?php endif; ?>
	</section>
    <?php } ?>  
    <?php if ( ! empty( $fields['shop_content'] ) ): ?>
        <section class="c-home-section c-home-section--committee u-animated u-animated--btm-top" >
			<div class="o-wrap">
				<div class="o-box o-media c-home-section__media <?php echo wp_kses_post($txtdir); ?>">
                	<?php if ( ! empty( $fields['shop_content'] ) ): ?>
					<div class="o-media__body c-home-section__body <?php echo wp_kses_post($txtdir); ?>">
						<p class="<?php echo wp_kses_post($txtdir); ?>">
							<?php echo wp_kses( $fields['shop_content'], array(
                                'br' => array( 'class' => array() ),'span' => array( 'class' => array() ),
                                ) ); ?>
                        </p>
                        <?php if ( ! empty( $fields['shop_video_text'] ) && ! empty( $fields['shop_security_video_fields'] ) ): 
							$shopvedio = wp_get_attachment_url($fields['shop_security_video_fields']['file']);
						?>
						<p style="color: black;" class="<?php echo wp_kses_post($txtdir); ?>">
                        	<a style="text-decoration: none; color: black;" class="popup-vimeo" data-fancybox href="#myshopVideo">
							<?php echo wp_kses_post( $fields['shop_video_text'] ); ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-play"></i>
                            </a>
                            <video controls id="myshopVideo" style="display:none;">
                            	<source src="<?php echo esc_url( $shopvedio ); ?>" type="video/mp4">
                                Your browser doesn't support HTML5 video tag.
							</video>
                        </p>
                        <?php endif; ?>
					</div>
                    <?php endif; ?>
                    <?php if ( ! empty( $fields['shop_video_image'] ) ): 
						$shopimg = wp_get_attachment_url($fields['shop_video_image'])
					?>
                    	<div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( $shopimg ); ?>) 50% 50% no-repeat #b2caf1; background-size: cover;"></div>
                    <?php endif; ?>
				</div>
			</div>
		</section>
        <?php endif; ?>
<?php 
$queryev = get_shopscam();
if ( $queryev->have_posts() ) { ?>
	<section class="c-listing c-listing--resources">
    	<div class="o-wrap">
			<div id="content" class="o-layout o-layout--stretch <?php echo wp_kses_post($txtdir); ?>">
				<?php
					while ( $queryev->have_posts() ) : $queryev->the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile; wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php } ?>

<?php if ( ! empty( $fields['shop_fullvideo_link'] ) ): 
	$fullvedios = wp_get_attachment_url($fields['shop_fullvideo_link']['file']);
	$fullposters = wp_get_attachment_url($fields['shop_fullvideo_poster']);
	if ( ! empty( $fullvedio ) ): ?>	
        <section>
            <div class="o-wrap u-animated u-animated--btm-top">
                <h1 class="videoHeader <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['shop_fullvideo_text'] ); ?></h1>
            </div>
            <div class="o-wrap o-wrap u-animated u-animated--btm-top videoBox">
                <div class="video-wrapper">
                    <video poster="<?php echo esc_url( $fullposters ); ?>" preload="none" controls>
                        <source src="<?php echo esc_url( $fullvedios ); ?>" type="video/mp4" />
                    </video>
                </div>
                
            </div>
        </section>
	<?php endif; ?> 
<?php endif; ?>
<?php if ( ! empty( $fields['download_shop_link'] ) ): ?>
	<section class="divMargin">
		<div class="o-wrap u-animated u-animated--btm-top">
			<div class="intro c-committee-intro__description u-tac">
				<a class="o-media__img c-home-section__btn c-btn <?php echo wp_kses_post($txtdir); ?>" href="<?php echo esc_url($fields['download_shop_link']); ?>" download>
                <?php if ( ! empty( $fields['download_shop_text'] ) ): ?>
					<?php echo wp_kses_post( $fields['download_shop_text'] ); ?> 
                <?php endif; ?>
                <i class="far fa-arrow-to-bottom"></i></a>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( ! empty( $fields['shop_jumbotron'] ) ): ?>

<section class="divMargin">
	<div class="o-wrap u-animated u-animated--btm-top">
		<h1 class="videoHeader <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['shop_logo_header'] ); ?></h1>
	</div>
    <div class="o-wrap u-animated u-animated--btm-top">
		<div class="div100">
			<div class="divRow">
            <?php
			foreach($fields['shop_jumbotron'] as $plogo)
			{
				$logourl = wp_get_attachment_url($plogo['parlogo']); 
				if(!empty($logourl)) {
			?>
				<div class="divCol">
                	<?php if( !empty($plogo['plogolink']) ){ ?>
                	<a href="<?php echo esc_url( $plogo['plogolink'] ); ?>" target="_blank">
                		<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
                	</a>
                    <?php }
					else
					{ ?>
						<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
					<?php } ?>
                </div>
                <?php
				}				
			} ?>
            </div>
		</div>
	</div>
</section>
		
<?php endif; ?>
    
<?php if ( ! empty( $fields['security_heading'] ) ) { ?>
    <section class="jumbotron o-wrap u-animated u-animated--btm-top paddTop50" id="scamsters">
    	<?php if ( ! empty( $fields['security_heading'] ) ): ?>
			<h2 class="c-home-section__heading c-heading2 u-animated u-animated--btm-top text-center <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['security_heading'] ); ?></h2>
        <?php endif; ?>
	</section>
<?php } ?>  
<?php if ( ! empty( $fields['security_content'] ) ): ?>
        <section class="c-home-section c-home-section--committee u-animated u-animated--btm-top" >
			<div class="o-wrap">
				<div class="o-box o-media c-home-section__media">
                	<?php if ( ! empty( $fields['security_content'] ) ): ?>
					<div class="o-media__body c-home-section__body <?php echo wp_kses_post($txtdir); ?>">
						<p class="<?php echo wp_kses_post($txtdir); ?>">
							<?php echo wp_kses( $fields['security_content'], array(
                                'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() )
                                ) ); ?>
                        </p>
                        <?php if( !empty( $fields['security_scam_video_text'] ) && !empty( $fields['security_scam_video_fields'])): 
							$shopscamvedio = wp_get_attachment_url($fields['security_scam_video_fields']['file']);
						?>
						<p style="color: black;" class="<?php echo wp_kses_post($txtdir); ?>">
                        	<a style="text-decoration: none; color: black;" class="popup-vimeo" data-fancybox href="#mysecVideo">
							<?php echo wp_kses_post( $fields['security_scam_video_text'] ); ?> &nbsp;&nbsp;&nbsp;<i class="fas fa-play"></i>
                            </a>
                            <video controls id="mysecVideo" style="display:none;">
                            	<source src="<?php echo esc_url( $shopscamvedio ); ?>" type="video/mp4">
                                Your browser doesn't support HTML5 video tag.
							</video>
                        </p>
                        <?php endif; ?>
					</div>
                    <?php endif; ?>
                    <?php if ( ! empty( $fields['security_scam_video_image'] ) ): 
						$shopimg = wp_get_attachment_url($fields['security_scam_video_image'])
					?>
                    	<div class="o-media__img c-home-section__img <?php echo wp_kses_post($txtdir); ?>" style="background: url(<?php echo esc_url( $shopimg ); ?>) 50% 50% no-repeat #b2caf1; background-size: cover;"></div>
                    <?php endif; ?>
				</div>
			</div>
		</section>
<?php endif; ?>

<?php 
if ( have_posts() ) : ?>
	<section class="c-listing c-listing--resources">
    	<div class="o-wrap">
			<div id="content" class="o-layout o-layout--stretch <?php echo wp_kses_post($txtdir); ?>">
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $fields['fullvideo_link'] ) ): 
$fullvedio = wp_get_attachment_url($fields['fullvideo_link']['file']);
$fullposter = wp_get_attachment_url($fields['fullvideo_poster']);
	if ( ! empty( $fullvedio ) ): ?>	
        <section>
            <div class="o-wrap u-animated u-animated--btm-top">
                <h1 class="videoHeader <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['fullvideo_text'] ); ?></h1>
            </div>
            <div class="o-wrap o-wrap u-animated u-animated--btm-top videoBox" style="">
                <div class="video-wrapper">
                    <video poster="<?php echo esc_url( $fullposter ); ?>" preload="none" controls>
                        <source src="<?php echo esc_url( $fullvedio ); ?>" type="video/mp4" />
                    </video>
                </div>
                
            </div>
        </section>
	<?php endif; ?>
<?php endif; ?>
<?php if ( ! empty( $fields['download_secure_link'] ) ): ?>
	<section class="divMargin">
		<div class="o-wrap u-animated u-animated--btm-top">
			<div class="intro c-committee-intro__description u-tac <?php echo wp_kses_post($txtdir); ?>">
				<a class="o-media__img c-home-section__btn c-btn" href="<?php echo esc_url($fields['download_secure_link']); ?>" download>
                <?php if ( ! empty( $fields['download_secure_text'] ) ): ?>
					<?php echo wp_kses_post( $fields['download_secure_text'] ); ?> 
                <?php endif; ?>
                <i class="far fa-arrow-to-bottom"></i></a>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php if ( ! empty( $fields['jumbotron'] ) ): ?>

<section class="divMargin">
	<div class="o-wrap u-animated u-animated--btm-top">
		<h1 class="videoHeader <?php echo wp_kses_post($txtdir); ?>"><?php echo wp_kses_post( $fields['logo_header'] ); ?></h1>
	</div>
    <div class="o-wrap u-animated u-animated--btm-top">
		<div class="div100">
			<div class="divRow">
            <?php
			foreach($fields['jumbotron'] as $plogo)
			{
				$logourl = wp_get_attachment_url($plogo['parlogo']); 
				if(!empty($logourl)) {
			?>
				<div class="divCol">
                	<?php if( !empty($plogo['plogolink']) ){ ?>
                	<a href="<?php echo esc_url( $plogo['plogolink'] ); ?>" target="_blank">
                		<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
                	</a>
                    <?php }
					else
					{ ?>
						<img src="<?php echo esc_url( $logourl ); ?>" alt="Staying Safe Online" class="partnerLogo" />
					<?php } ?>
                </div>
                <?php
				}				
			} ?>
            </div>
		</div>
	</div>
</section>
		
<?php endif; ?>

	<div class="c-doodad-footer-resources">
		<div></div>
		<div></div>
		<div></div>
	</div>
	<div class="c-resources-video-player">
		<div class="c-resources-video-player__content">
			<video controls controlsList="nodownload" preload="metadata" playsinline></video>
			<button class="c-resources-video-player__btn-close"><i class="fal fa-times"></i></button>
            </video>
		</div>
	</div>
<?php
get_footer();

?>
<script>
function checkscam(val)
{
	if(val==='ecomm')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#ecomm").offset().top
		}, 1000);                
	}
	if(val==='scamsters')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#scamsters").offset().top
		}, 1000);                
	}
}
</script>

