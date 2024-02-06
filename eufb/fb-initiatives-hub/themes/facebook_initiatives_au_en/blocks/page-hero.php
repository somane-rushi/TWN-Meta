<?php
$allowed_html = fb_allowed_tags();
if($caption_overlay){
    $cpbgColor = 'caption-has-bg';
}else{
    $cpbgColor = '';
}
?>
<div class="hero-wrapper">
    <section class="container-fluid page-hero" <?php if($background_color){echo "style='background:".esc_attr($background_color)."' ";} ?>>
        <div class="hero-image" >
			<?php
			$image= esc_url( wp_get_attachment_image_src( $desktop_image, 'full' )[0] );
			if ( jetpack_is_mobile() ) {
				$image= esc_url( wp_get_attachment_image_src( $mobile_image, 'full' )[0] );
			}
			
			?>
            <img
                    src="<?php echo esc_url( $image ); ?>"
                    alt="hero background"/>
            <div class="hero-overlay"></div>        
        </div>
        <div class="container">
            <div class="row">
                <div class="text-col col col-lg-5 hero-content <?php echo esc_attr($cpbgColor); ?>">
                    <h1 class="js-in-viewport--move_up_fade_in" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
						<?php echo wp_kses( $heading, $allowed_html ); ?>
                    </h1>
                    <div class="col col-lg-12 section-hero-copy">
                        <div class="js-in-viewport--move_up_fade_in" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
                            <?php echo wp_kses(  ($body), $allowed_html   ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


