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


<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
    <div class="tnsBox flexDirColumn MarginBottom15">
        <div class="div100">
            <img src="<?php echo esc_url( $preimg ); ?>" class="img100">
        </div>
        <div class="padding25">
            <p class="font22 txtDarkBlue dirRTL fontDisplay MarginBottom25 kenalPastTitle"><?php the_title(); ?></p>
            <p class="font16 txtGrey dirRTL fontTxt MarginBottom15 kenalPastContent">
                <?php echo wp_kses( $scam_attachment['description'], array( 
                    'br' => array('class' => array() ),
                    'a' => array( 'href' => array(), 'title' => array() ),
                    'strong' => array(),
                ) ); ?>
            </p>
            <p class="txtMetaBlue resCTA"></p>
        </div>
    </div><!--1-->
</div><!-- col4-->

