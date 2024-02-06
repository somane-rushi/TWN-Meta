<?php
/**
 * Template part for displaying taknakscam
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<?php 

$scam_attachment = get_post_meta( get_the_ID(), 'scam_detail' , true );
$preview_img = ''; $safe_img ='';

$preimg = wp_get_attachment_url($scam_attachment['scam_image']);
?>
<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
	<a class="o-box c-listing-item c-listing-item--resources ">
		<div class="c-listing-item__img cimg2"> <img src="<?php echo esc_url( $preimg ); ?>"/> </div>
		<div class="c-listing-item__body">
			<div class="c-listing-item__meta"> </div>
			<h2 class="c-home-section__heading c-heading2 fontOpt_Display"><?php the_title(); ?></h2>
			<p class="c-listing-item__description c-listing-item__description--resource fontOpt_ExtraLight">
            	<?php echo wp_kses( $scam_attachment['description'], array( 
						'br' => array('class' => array() ),
						'a' => array( 'href' => array(), 'title' => array() ),
						'strong' => array(),
				) ); ?>
            </p>
		</div>
	</a>
</div>
