<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
} else {
	$alignment_class = '';
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
                            <a <?php if($text_color){echo "style='".($background_color?"color:".esc_attr($background_color).';':'')."background:".esc_attr($text_color)."' ";} ?>  href="<?php echo esc_url( $button_url ); ?>" class="btn-cta d-sm-inline-block"><?php echo esc_html( $button_text ); ?>
                                <span class="arrow">&#8594;</span>
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
