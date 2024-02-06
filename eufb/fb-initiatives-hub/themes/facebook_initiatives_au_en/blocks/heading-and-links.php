<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
} else {
	$alignment_class = '';
}

if($text_color){
    $listarrowcol = 'style="color:' . $text_color . ';"';
}else{
    $listarrowcol = '';
}
if($link_twocol){
    $linkcol = 'link-two-col';
}else{
    $linkcol = '';
}

?>

<section class="container-fluid section section-startups-container text-block heading-and-links" <?php if($background_color){echo "style='background:".esc_attr($background_color)."' ";} ?>>
    <div class="text-block-inner">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 text-col">
                    <div class="title">
                        <h2    <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
							<?php echo wp_kses( $heading, $allowed_html ); ?>
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-6  text-col">
                    <div class="text">
                        <ul class="link-list <?php echo esc_attr($linkcol); ?>">
							<?php foreach ( $links as $link_item ) : ?>
								<?php
								if ( $link_item['link']['link_image']  ) :
									?>
                                    <li><span <?php echo esc_attr($listarrowcol); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span>
										<?php $pdf_url = wp_get_attachment_url( $link_item['link']['link_image'] ) ;
										?>
                                        <a
											<?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>
                                                class="dark-primary"
                                                href="<?php echo esc_url( $pdf_url ); ?> "
                                                target="<?php echo esc_attr( $link_item['link']['link_attribute'] );?>
                ">
											<?php echo esc_html( $link_item['link']['link_text'] ); ?>
                                        </a>
                                    </li>
								<?php
								else :
									?>
                                    <li><span <?php echo esc_attr($listarrowcol); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span>
                                        <a
											<?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>
                                                class="dark-primary"
                                                href="<?php echo esc_url( $link_item['link']['link_url'] ); ?>"
                                                target="<?php echo esc_attr( $link_item['link']['link_attribute'] );?>
                ">
											<?php echo esc_html( $link_item['link']['link_text'] ); ?>
                                        </a>
                                    </li>
								<?php
								endif;
								?>
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
