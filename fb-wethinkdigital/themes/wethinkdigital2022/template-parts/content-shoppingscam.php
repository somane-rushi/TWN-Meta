<?php
/**
 * Template part for displaying shopping scam
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<?php 
$shop_attachment = get_post_meta( get_the_ID(), 'shopping_detail' , true );
$preview_img = ''; $scam_image =''; $shopcnt=get_the_ID();
?>

<?php $preview_img = ! empty( $shop_attachment['preview_img'] ) ? $shop_attachment['preview_img'] : false; 
$scam_image = ! empty( $shop_attachment['scam_image'] ) ? $shop_attachment['scam_image'] : false;

$preimg = wp_get_attachment_url($shop_attachment['preview_img']);
$scamimg = wp_get_attachment_url($shop_attachment['scam_image']);
$filevedio = wp_get_attachment_url($shop_attachment['file']);
?>

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
	<div class="resourceBox PaddingBottom25">
		<div class="campaignImgBox MarginBottom25" style="background-image: url('<?php echo esc_url( $scamimg ); ?>');">
			<a data-toggle="modal" data-target="#modalPop<?php echo esc_html( $shopcnt ); ?>" class="">
				<img src="<?php echo esc_url( get_theme_file_uri( 'images/res-play.png' ) ); ?>" alt="WTD" class="resPlayIcon">
			</a>
		</div>
        <p class="font24 txtDarkBlue dirRTL fontDisplay MarginBottom10 resTitle"><?php echo wp_kses_post( the_title() ); ?></p>
		<p class="font16 txtGrey dirRTL fontTxt MarginBottom15 resDesc"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
	</div>
</div>
<div class="modal fade aboutmodal modalPop<?php echo esc_html( $shopcnt ); ?>" id="modalPop<?php echo esc_html( $shopcnt ); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body bgLightGrey">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="container-full">
					<div class="TopBottomPadding35">
						<video width="100%" height="auto" controls autoplay muted class="resvd">
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

