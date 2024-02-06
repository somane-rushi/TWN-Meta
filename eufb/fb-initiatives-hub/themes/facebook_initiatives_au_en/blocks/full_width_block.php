<?php
$allowed_html = fb_allowed_tags();

if ($background_color) {
	$fwBG = 'style="background-color: ' . $background_color . ';"';
} else {
	$fwBG = '';
}

if($text_color){
    $btntextcol = 'style="color: ' . $text_color . '"';
    $btnarrowcol = 'style="color:' . $text_color . '; border-color: ' . $text_color . ';"';
}else{
    $btntextcol = '';
    $btnarrowcol = '';
}

?>

<section class="full-width-content" <?php echo esc_attr($fwBG); ?>>
    <div class="fw-container" <?php echo esc_attr($btntextcol); ?>>
        <h4 <?php if($title_color){echo "style='color:".esc_attr($title_color)."' ";} ?>>
            <?php echo wp_kses( $heading, $allowed_html ); ?>
        </h4>

        <?php echo wp_kses( $body, $allowed_html   ); ?>

        <?php if($button_text): ?>
        <a <?php echo esc_attr($btntextcol); ?> href="<?php echo esc_url( $button_url ); ?>" class="arrow-btn">
            <span <?php echo esc_attr($btnarrowco); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span><?php echo esc_html( $button_text ); ?>
        </a>
        <?php endif; ?>
    </div>
</section>
