<?php
$allowed_html = fb_allowed_tags();

if($text_color){
    $captioncolor = 'style="color: ' . $text_color . '"';
}else{
    $captioncolor = '';
}

?>

<section class="video-container">
    <img src="<?php echo esc_url(get_theme_file_uri( 'images/video-img-preview.jpg' )); ?>" alt="">
    <div id="fullVideo" class="media">
        <?php
        // This output uses wpcom_vip_wp_oembed_get() in plugins/startup-garage-block-manager
        // which produces a chunk of HTML from a list of trusted providers. As such, the result
        // is not escaped here, but is considered safe.
        echo $video_embed; // @codingStandardsIgnoreLine
        ?>
    </div>
    <?php if($video_img): ?>
    <div class="fullvideo-overlay" style="background-image: url(<?php echo esc_url(wp_get_attachment_url( $video_img )); ?>);">
        <div class="fullvideo-content" <?php echo esc_attr($captioncolor); ?>>
            <h2 <?php echo esc_attr($captioncolor); ?>><?php echo wp_kses( $video_caption, $allowed_html ); ?></h2>
            <a class="vid-play-btn" href="javascript:void(0);"><span><i class="fas fa-caret-right"></i></span>Watch the Video</a>
        </div>
    </div>
    <?php endif; ?>

</section>
