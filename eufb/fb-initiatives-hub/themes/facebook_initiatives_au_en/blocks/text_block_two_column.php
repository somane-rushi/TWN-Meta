<?php
$allowed_html = fb_allowed_tags();
if ( 'left' === $alignment ) {
    $alignment_class = 'flex-lg-row-reverse';
} else {
    $alignment_class = '';
}

if($text_color){
    $listarrowcol = 'style="color:' . $text_color . '; border-color: ' . $text_color . ';"';
}else{
    $listarrowcol = '';
}

?>

<section class="container-fluid section section-startups-container text-block tbtc-section" <?php if($background_color){echo "style='background:".esc_attr($background_color)."' ";} ?>>
    <div class="text-block-inner">
        <div class="container">
            <div class="row <?php echo esc_attr( $alignment_class ); ?>">
                <div class="col-12 col-lg-6 text-col no-bottom-padding">
                    <div class="text">
                         <h2 <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
                            <?php echo wp_kses( $left_title, $allowed_html ); ?>
                        </h2>
                        <div class="grey-dark startups-copy" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?> ><?php echo wp_kses(  ($left_content), $allowed_html   ); ?></div>

                    </div>
                </div>
                <div class="col-12 col-lg-6 text-col no-top-padding">
                    <div class="text">
                        <?php if($link_title): ?>
                        <h4 <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
                            <?php echo wp_kses( $link_title, $allowed_html ); ?>
                        </h4>
                        <?php endif; ?>

                        <ul class="link-list">
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


                        <?php if($more_link_title): ?>
                        <h4 class="morelink-title" <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>>
                            <?php echo wp_kses( $more_link_title, $allowed_html ); ?>
                        </h4>
                        <?php endif; ?>

                       
                        <ul class="link-list">
                            <?php foreach ( $morelinks as $mlink_item ) : ?>
                                <?php
                                if ( $mlink_item['link']['link_image']  ) :
                                    ?>
                                    <li><span <?php echo esc_attr($listarrowcol); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span>
                                        <?php $mpdf_url = wp_get_attachment_url( $mlink_item['link']['link_image'] ) ;
                                        ?>
                                        <a
                                            <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>
                                                class="dark-primary"
                                                href="<?php echo esc_url( $mpdf_url ); ?> "
                                                target="<?php echo esc_attr( $mlink_item['link']['link_attribute'] );?>
                ">
                                            <?php echo esc_html( $mlink_item['link']['link_text'] ); ?>
                                        </a>
                                    </li>
                                <?php
                                else :
                                    ?>
                                    <li><span <?php echo esc_attr($listarrowcol); ?> class="arrow-icon"><i class="far fa-arrow-alt-circle-right"></i></span>
                                        <a
                                            <?php if($text_color){echo "style='color:".esc_attr($text_color)."' ";} ?>
                                                class="dark-primary"
                                                href="<?php echo esc_url( $mlink_item['link']['link_url'] ); ?>"
                                                target="<?php echo esc_attr( $mlink_item['link']['link_attribute'] );?>
                ">
                                            <?php echo esc_html( $mlink_item['link']['link_text'] ); ?>
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
