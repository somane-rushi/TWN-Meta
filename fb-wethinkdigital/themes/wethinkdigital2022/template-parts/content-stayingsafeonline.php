<?php
/**
 * Template part for displaying stayingsafeonline
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<?php 

$safe_attachment = get_post_meta( get_the_ID(), 'safeonline_detail' , true );
$preview_img = ''; $safe_img =''; $safecnt=get_the_ID();
?>

<?php $preview_img = ! empty( $safe_attachment['preview_img'] ) ? $safe_attachment['preview_img'] : false; 
$safe_img = ! empty( $safe_attachment['safe_image'] ) ? $safe_attachment['safe_image'] : false;

$preimg = wp_get_attachment_url($safe_attachment['preview_img']);
$safeimg = wp_get_attachment_url($safe_attachment['safe_image']);
$filevedio = wp_get_attachment_url($safe_attachment['file']);
?>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	<div class="resourceBox PaddingBottom25">
		<div class="campaignImgBox MarginBottom25" style="background-image: url('<?php echo esc_url( $safeimg ); ?>');">
			<a data-toggle="modal" data-target="#modalsafe<?php echo esc_html( $safecnt ); ?>" class="">
				<img src="<?php echo esc_url( get_theme_file_uri( 'images/res-play.png' ) ); ?>" alt="Staying safe" class="resPlayIcon">
			</a>
		</div>
        <p class="font24 txtDarkBlue dirRTL fontDisplay MarginBottom10 resTitle"><?php echo wp_kses_post( $safe_attachment['safe_subtitle'] ); ?></p>
		<p class="font16 txtGrey dirRTL fontTxt MarginBottom15 staySafeDesc">
        	<?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?>
        </p>        
	</div>
</div>
<div class="modal fade aboutmodal" id="modalsafe<?php echo esc_html( $safecnt ); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body bgLightGrey">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="container-full">
					<div class="TopBottomPadding35">
						<video width="100%" height="auto" controls autoplay muted class="resvd" id="safelist<?php echo esc_html( $safecnt ); ?>">
							<source src="<?php echo esc_url( $filevedio ); ?>" type="video/mp4">
								Your browser does not support the video tag.
                            </source>    
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $safecnt++; ?>
