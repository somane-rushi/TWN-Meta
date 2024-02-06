<?php
/**
 * Template part for displaying stories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
	<a class="o-box c-listing-item" href="<?php the_permalink(); ?>">
		<div class="c-listing-item__img">
			<div style="background:url(<?php the_post_thumbnail_url(); ?>) no-repeat 50% 50%; background-size: cover;"></div>
		</div>
		<div class="c-listing-item__body">
			<div class="c-listing-item__meta">
				<?php $category = fbiamdigital_get_the_first_term( get_the_ID(), 'story_category' ); ?>
				<?php if ( ! empty( $category ) ): ?>
					<span class="c-listing-item__cat"><?php echo esc_html( $category->name ); ?></span>
				<?php endif; ?>
			</div>
			<h3 class="c-listing-item__title"><?php the_title(); ?></h3>
			<p class="c-listing-item__description"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
		</div>
	</a>
</div>