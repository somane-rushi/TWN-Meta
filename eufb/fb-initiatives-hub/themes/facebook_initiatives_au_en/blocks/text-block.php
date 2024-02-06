<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
} else {
	$alignment_class = '';
}

if($text_color){
    $btntextcol = 'style="color: ' . $text_color . '"';
    $btnarrowcol = 'style="color:' . $text_color . '; border-color: ' . $text_color . ';"';
}else{
    $btntextcol = '';
    $btnarrowcol = '';
}

?>

<section class="container-fluid section section-startups-container text-block" <?php if($background_color){echo "style='background:".esc_attr($background_color)."' ";} ?>>
    <div class="text-block-inner">
        <div class="container">
            <div class="row <?php echo esc_attr( $alignment_class ); ?>">
                <div class="col-12 col-lg-6 text-col no-bottom-padding">
                    <div class="title">
                        <h2 <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
							<?php echo wp_kses( $heading, $allowed_html ); ?>
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-col no-top-padding">
                    <div class="text">

                        <div class="grey-dark startups-copy" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?> ><?php echo wp_kses(  ($body), $allowed_html   ); ?></div>
						
						<?php
						if ( '' !== $button_text and '' !== $button_url ) :
							?>
                            <a <?php echo esc_attr($btntextcol); ?> href="<?php echo esc_url( $button_url ); ?>" class="arrow-btn">
                                <span <?php echo esc_attr($btnarrowcol); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span>
                                <?php echo esc_html( $button_text ); ?>
                            </a>
						<?php
						endif;
						?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
