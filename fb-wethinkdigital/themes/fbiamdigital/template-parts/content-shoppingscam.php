<?php
/**
 * Template part for displaying shopping scam
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<?php 
$shop_attachment = get_post_meta( get_the_ID(), 'shopping_detail' , true );
$preview_img = ''; $scam_image ='';
?>

<?php $preview_img = ! empty( $shop_attachment['preview_img'] ) ? $shop_attachment['preview_img'] : false; 
$scam_image = ! empty( $shop_attachment['scam_image'] ) ? $shop_attachment['scam_image'] : false;

$preimg = wp_get_attachment_url($shop_attachment['preview_img']);
$scamimg = wp_get_attachment_url($shop_attachment['scam_image']);
$filevedio = wp_get_attachment_url($shop_attachment['file']);
?>
<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
	<a class="o-box c-listing-item c-listing-item--resources"
	   href="javascript:;" target="_blank" rel="noopener"
		data-video-src="<?php echo esc_url( $filevedio ); ?>" >
		
		<div class="c-listing-item__img"
			<?php if ( ! empty( $preview_img ) ): ?>
				data-preview-img="<?php echo esc_url($preimg) ?>"
			<?php endif; ?>
		>
			<div style="background:url(<?php echo esc_url( $scamimg ); ?>) no-repeat 50% 50%; background-size: cover;"></div>
			<?php if ( ! empty( $preimg ) ): ?>
				<div class="c-listing-item__thumbnail-preview" style="background: no-repeat 50% 50%; background-size: cover;"></div>
				<span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--play"><i class="fas fa-play"></i></span>
				<span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--spinner">
				<div class="o-spinner o-spinner--bbounce">
					<div class="o-spinner__doodad-1"></div>
					<div class="o-spinner__doodad-2"></div>
					<div class="o-spinner__doodad-3"></div>
				</div>
			</span>
			<?php endif; ?>
		</div>

		<div class="c-listing-item__body">
        	<h3 class="c-listing-item__title__security"><?php echo wp_kses_post( the_title() ); ?></h3>
			<p class="c-listing-item__description c-listing-item__description--resource"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
			<p class="c-listing-item__cta">
				<?php echo wp_kses_post( $shop_attachment['boxvideo_text'] ); ?> 
                <?php if(! empty( $filevedio) ) : ?><i class="far fa-video"></i> <?php endif; ?>
			</p>
		</div>
	</a>
</div>