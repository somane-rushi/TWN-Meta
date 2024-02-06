<?php
/**
 * Template part for displaying Partner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
	<div class="partnerBox MarginBottom25">
		<div class="row verticalAlign">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 paddingZero">
				<a href="<?php echo esc_url(get_post_meta( get_the_ID(), 'partner-link', true )); ?>" target="_blank"> 
					<img src="<?php the_post_thumbnail_url(); ?>" class="imgPartner" />
				</a>
			</div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				<?php $partner_country_term = get_the_terms( get_the_ID(), 'country' ); ?>
				<?php if ( ! empty( $partner_country_term ) ): ?>
					<p class="font14 txtDarkBlue dirRTL fontDisplay marginZero"><?php echo esc_html( $partner_country_term[0]->name ); ?></p>
				<?php endif; ?>    
				<a href="<?php echo esc_url(get_post_meta( get_the_ID(), 'partner-link', true )); ?>" target="_blank"> 
				  <p class="font20 txtGrey dirRTL fontTxt MarginBottom15"><?php the_title(); ?></p>
				</a>
				<p class="font16 txtGrey dirRTL fontTxt MarginBottom15"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array() ) ); ?></p>
			</div>
		</div>
	</div><!--1-->
</div>
