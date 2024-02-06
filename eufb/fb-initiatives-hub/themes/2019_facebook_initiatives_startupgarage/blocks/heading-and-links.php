<?php
$allowed_html = fb_allowed_tags();

if ( 'left' === $alignment ) {
	$alignment_class = 'flex-lg-row-reverse';
} else {
	$alignment_class = '';
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
                        <ul class="list-unstyled startups-links">
							<?php foreach ( $links as $link_item ) : ?>
								<?php
								if ( $link_item['link']['link_image']  ) :
									?>
                                    <li>
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
                                    <li>
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
