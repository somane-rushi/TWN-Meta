<?php
/**
 * Template part for displaying Iamdigital
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
$digital_atta = get_post_meta( get_the_ID(), 'pc_attachment' , true );
$head = get_post_meta( get_the_ID(), 'subhead' , true );

?>

<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in" >
	 <?php if ( $digital_atta['pc_type'] === 'download' ): 
	 	$pdfurl = wp_get_attachment_url($digital_atta['pc_download_fields']['file']);
	 ?>
		<a class="o-box c-listing-item c-listing-item--resources" href="<?php echo esc_url($pdfurl) ?>" target="_blank" >
     <?php elseif ( $digital_atta['pc_type'] === 'video' ): 
	 	$vdurl = wp_get_attachment_url($digital_atta['pc_video_fields']['file']);
	 ?>        
        <a class="o-box c-listing-item c-listing-item--resources" data-fancybox href="#myVideo<?php echo get_the_ID(); ?>">
        <video controls id="myVideo<?php echo get_the_ID(); ?>" style="display:none;">
                <source src="<?php echo esc_url($vdurl) ?>" type="video/mp4">
                Your browser doesn't support HTML5 video tag.
            </video>
     <?php endif; ?>
     
		<div class="c-listing-item__img">
        	<div style="background: url('<?php the_post_thumbnail_url(); ?>') no-repeat 50% 50%; background-size: cover;"></div>
            
            <?php if ( $digital_atta['pc_type'] === 'video' ){ ?> 
            <span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--play"><i class="fas fa-play"></i></span>
            <span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--spinner">
				<div class="o-spinner o-spinner--bbounce">
					<div class="o-spinner__doodad-1"></div>
					<div class="o-spinner__doodad-2"></div>
                    <div class="o-spinner__doodad-3"></div>
				</div>
			</span>
            <?php } ?>
		</div>
        <div class="c-listing-item__body">
			<div class="c-listing-item__meta">
				<span class="c-listing-item__cat fontOpt_Light"><?php echo wp_kses_post($head); ?></span>
			</div>
            <h3 class="c-listing-item__title fontOpt_Light"><?php the_title(); ?></h3>
			<p class="c-listing-item__description c-listing-item__description--resource fontOpt_ExtraLight text-black"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
			<p class="c-listing-item__cta">
            <?php if ( $digital_atta['pc_type'] === 'download' ): ?>
            	<?php echo wp_kses_post( $digital_atta['pc_download_fields']['button_pdf'] ); ?> <i class="far fa-arrow-to-bottom"></i></p>
            <?php elseif ( $digital_atta['pc_type'] === 'video' ): ?>
            	<?php echo wp_kses_post( $digital_atta['pc_video_fields']['button_video'] ); ?> <i class="far fa-video"></i></p>
            <?php endif; ?>
		</div>
	</a>
</div>
