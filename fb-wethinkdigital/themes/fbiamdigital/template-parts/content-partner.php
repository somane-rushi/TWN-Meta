<?php
/**
 * Template part for displaying partners
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
	<?php $partner_program_post_id = get_post_meta( get_the_ID(), 'program', true ); ?>
	<a class="o-box o-media c-partner-item" href="<?php echo esc_url( get_the_permalink( $partner_program_post_id ) ); ?>">
		<div class="o-media__img c-partner-item__logo">
			<div class="c-partner-item__logo-img" style="background: url(<?php the_post_thumbnail_url(); ?>) 50% 50% no-repeat; background-size: contain;"></div>
		</div>
		<div class="o-media__body c-partner-item__body">
			<?php $partner_country_term = fbiamdigital_get_the_first_term( get_the_ID(), 'country' ); ?>
			<?php if ( ! empty( $partner_country_term ) ): ?>
				<div class="c-partner-item__cat"><?php echo esc_html( $partner_country_term->name ); ?></div>
			<?php endif; ?>
			<h3 class="c-partner-item__title"><?php the_title(); ?></h3>
			<p class="c-partner-item__description"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array() ) ); ?></p>
		</div>
	</a>
</div>