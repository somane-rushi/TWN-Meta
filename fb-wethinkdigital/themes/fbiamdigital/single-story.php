<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
<?php
while ( have_posts() ) : the_post(); ?>
	<?php $masthead_image_src = wp_get_attachment_url( get_post_meta( $post->ID, 'masthead_image', true ) ); ?>
	<?php if ( ! empty( $masthead_image_src ) ): ?>
		<section class="c-masthead" style="background:url(<?php echo esc_url( $masthead_image_src ); ?>) 50% 50% no-repeat; background-size: cover;"></section>
	<?php endif; ?>

	<article class="c-single">
		<div class="o-wrap o-wrap--lg">
			<header class="c-single__header">
				<?php $category = fbiamdigital_get_the_first_term( get_the_ID(), 'story_category' ); ?>
				<?php if ( ! empty( $category ) ): ?>
					<span class="c-single__cat"><?php echo esc_html( $category->name ); ?></span>
				<?php endif; ?>
				<h1 class="c-single__title"><?php the_title(); ?></h1>
				<div class="c-single__author">
					<div class="c-author">
						<?php if ( ! empty( get_post_meta( get_the_ID(), 'author_profile', true ) ) ): ?>
							<div class="c-author__img">
								<img src="<?php echo esc_url( wp_get_attachment_url( get_post_meta( get_the_ID(), 'author_profile', true ) ) ); ?>" alt="<?php echo esc_attr( get_post_meta( get_the_ID(), 'author', true ) ); ?>">
							</div>
						<?php endif; ?>
						<div class="c-author__body">
							<?php if ( ! empty( get_post_meta( get_the_ID(), 'author', true ) ) ): ?>
								<div class="c-author__name">
									<?php echo esc_html( get_post_meta( get_the_ID(), 'author', true ) ); ?>
								</div>
							<?php endif; ?>
							<div class="c-author__headline">
								<?php if ( ! empty( get_post_meta( get_the_ID(), 'author_headline', true ) ) ): ?>
									<?php echo esc_html( get_post_meta( get_the_ID(), 'author_headline', true ) ); ?>
									|
								<?php endif; ?>
								<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'M Y' ) ); ?></time>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div class="c-single__block c-single__block--intro">
				<p><?php echo wp_kses( nl2br( get_post_meta( $post->ID, 'intro', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
			</div>
			<?php
			$components = get_post_meta( get_the_ID(), 'body', true );
			if ( ! empty( $components ) ): foreach ( $components as $component ):
				$field_name = 'component_' . $component['component_type'] . '_fields';
				if ( empty( $component[ $field_name ] ) ) {
					continue;
				}
				$fields = $component[ $field_name ];

				switch ( $component['component_type'] ):
					// Text
					case 'text':
						if ( ! empty( $fields['body'] ) ):
							?>
							<div class="c-single__block c-single__block--paragraph">
								<?php echo wp_kses( $fields['body'], array(
									'p'      => array(),
									'a'      => array(
										'href'   => array(),
										'title'  => array(),
										'target' => array( '_blank' ),
									),
									'br'     => array(),
									'em'     => array(),
									'strong' => array(),
									'ul'     => array(),
									'li'     => array(),
								) ); ?>
							</div>
						<?php
						endif;
						break;

					// Gallery
					case 'gallery':
						$gallery_slides = $fields['slide'];
						if ( ! empty( $gallery_slides ) ):
							?>
							<div class="c-single__block c-single__block--gallery">
								<div class="c-single-gallery">
									<?php foreach ( $gallery_slides as $slide ): ?>
										<?php if ( empty( $slide['image'] ) ) {
											continue;
										} ?>
										<div class="c-single-gallery__item">
											<figure>
												<img src="<?php echo esc_url( wp_get_attachment_url( $slide['image'] ) ); ?>" alt="">
												<?php if ( ! empty( $slide['caption'] ) ): ?>
													<figcaption><?php echo esc_html( $slide['caption'] ); ?></figcaption>
												<?php endif; ?>
											</figure>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php
						break;

					// Block Quote
					case 'blockquote':
						if ( ! empty( $fields['quote'] ) ):
							?>
							<blockquote class="c-single__block c-single__block--quote">
								<p><?php echo esc_html( $fields['quote'] ); ?></p>
								<?php if ( ! empty( $fields['cite'] ) ): ?>
									<footer>
										<cite>- <?php echo esc_html( $fields['cite'] ); ?></cite>
									</footer>
								<?php endif; ?>
							</blockquote>
						<?php endif; ?>
						<?php
						break;

					// Video
					case 'video':
						if ( ! empty( $fields['video'] ) ): ?>
							<div class="c-single__block c-single__block--video">
								<?php echo wp_video_shortcode( array(
									'src' => esc_url( wp_get_attachment_url( $fields['video'] ) ),
								) ); ?>
							</div>
						<?php
						endif;
						break;
				endswitch;
			endforeach; endif; ?>

			<footer class="c-single__footer u-tar">
				<?php fbiamdigital_the_fb_share_button(); ?>
			</footer>
		</div>

		<?php $related_posts = get_post_meta( get_the_ID(), 'related', true ); ?>
		<?php if ( ! empty( $related_posts ) ): ?>
			<?php $related_post_ids = fbiamdigital_parse_ids_from_related_story_post_meta( $related_posts ); ?>
			<?php $related_posts_query = fbiamdigital_get_related_story_posts( $related_post_ids ); ?>
			<div class="o-wrap">
				<aside class="c-single__related">
					<h4><?php esc_html_e( 'Related stories', 'fbiamdigital' ); ?></h4>
					<div class="o-layout o-layout--stretch">
						<?php
						while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post();

							get_template_part( 'template-parts/content', 'story' );

						endwhile;

						wp_reset_postdata();
						?>
					</div>
				</aside>
			</div>
		<?php endif; ?>
	</article>
<?php
endwhile;
?>
<?php
get_footer();
