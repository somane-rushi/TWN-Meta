<?php
/**
 * Template part for displaying committee members
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>
<div class="o-layout__item u-1/1@lg u-1/2@sm u-1/1 u-animated u-animated--fade-in">
	<div class="o-box o-media c-committee-item">
		<div class="o-media__img c-committee-item__img" style="background: url(<?php the_post_thumbnail_url(); ?>) 50% 50% no-repeat; background-size: cover;"></div>
		<div class="o-media__body c-committee-item__body">
			<h3 class="c-committee-item__name"><?php the_title(); ?></h3>
			<?php $committee_member_headline = get_post_meta( get_the_ID(), 'headline', true ); ?>
			<?php if ( ! empty( $committee_member_headline ) ): ?>
				<div class="c-committee-item__headline">
					<?php echo esc_html( get_post_meta( get_the_ID(), 'headline', true ) ); ?>
				</div>
			<?php endif; ?>
			<div class="c-committee-item__description">
				<?php echo wp_kses( get_post_meta( get_the_ID(), 'excerpt', true ), array(
					'p'      => array(),
					'br'     => array(),
					'em'     => array(),
					'strong' => array(),
				) ); ?>
			</div>
		</div>
	</div>
</div>