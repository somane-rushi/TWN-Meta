<?php
/**
 * Template part for displaying Iamdigital
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
$digital_atta = get_post_meta( get_the_ID(), 'pc_attachment' , true );
$head = get_post_meta( get_the_ID(), 'subhead' , true );
?>
<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
	<div class="resourceBox PaddingBottom25">
    	<?php if ( $digital_atta['pc_type'] === 'download' ): 
				$pdfurl = wp_get_attachment_url($digital_atta['pc_download_fields']['file']);
			elseif ( $digital_atta['pc_type'] === 'video' ): 
				$vdurl = wp_get_attachment_url($digital_atta['pc_video_fields']['file']);
		 ?>
		 <?php endif; ?>
    
		<div class="resImgBox MarginBottom15" style="background-image: url('<?php the_post_thumbnail_url(); ?>');"></div>
		<h6  class="txtGrey textLeft fontTxt MarginBottom15"><?php echo wp_kses_post($head); ?></h6>
		<p class="font20 txtDarkBlue textLeft fontDisplay MarginBottom10 resTitle"><?php the_title(); ?></p>
		<p class="font16 txtGrey textLeft fontTxt MarginBottom15 resDesc"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
		<p class="MarginBottom15 txtMetaBlue">
        	<?php if ( $digital_atta['pc_type'] === 'download' ): ?>
				<a href="<?php echo esc_url($pdfurl) ?>" target="_blank" class="font14 txtMetaBlue textLeft fontTxt MarginBottom15"><?php echo wp_kses_post( $digital_atta['pc_download_fields']['button_pdf'] ); ?>&nbsp;&nbsp;</a>             
            <?php elseif ( $digital_atta['pc_type'] === 'video' ): ?>
            	<a data-toggle="modal" data-target="#digipopup<?php the_ID();?>" class="font14 txtMetaBlue textLeft fontTxt MarginBottom15">
            		<?php echo wp_kses_post( $digital_atta['pc_video_fields']['button_video'] ); ?>&nbsp;&nbsp;</a>
            <?php endif; ?>       
        </p>
	</div>
</div>
<?php if ( $digital_atta['pc_type'] === 'video' ) : ?>
<div class="modal fade aboutmodal" id="digipopup<?php the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body bgLightGrey">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
				</button>
				<div class="container-full">
					<div class="TopBottomPadding35">
						<video width="100%" height="auto" controls autoplay muted class="resvd">
							<source src="<?php echo esc_url($vdurl) ?>" type="video/mp4">
								Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
