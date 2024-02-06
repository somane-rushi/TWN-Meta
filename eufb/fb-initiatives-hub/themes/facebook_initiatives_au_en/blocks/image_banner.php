<?php
$allowed_html = fb_allowed_tags();

if($text_color){
    $captioncolor = 'style="color: ' . $text_color . '"';
}else{
    $captioncolor = '';
}

?>


<section class="full-width-banner">
    <img src="<?php echo esc_url(wp_get_attachment_url( $banner_img )); ?>" alt="<?php echo esc_attr($banner_caption); ?>">
    <h3 <?php echo esc_attr($captioncolor); ?>><?php echo wp_kses( $banner_caption, $allowed_html ); ?></h3>
</section>

