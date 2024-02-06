<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
<?php
while ( have_posts() ) : the_post(); ?>
	<?php fbiamdigital_the_archive_masthead( 'partner' ) ?>

	<section class="c-page">
		<article class="c-single c-single--partner">
			<?php $masthead_image_src = wp_get_attachment_url( get_post_meta( $post->ID, 'masthead_image', true ) ); ?>
			<?php if ( ! empty( $masthead_image_src ) ): ?>
				<div class="o-wrap">
					<div class="c-single__hero" style="background:url(<?php echo esc_url( $masthead_image_src ); ?>) 50% 50% no-repeat; background-size: cover;"></div>
				</div>
			<?php endif; ?>
			<div class="o-wrap o-wrap--lg">
				<div class="c-single__layout o-layout o-layout--huge">
					<div class="o-layout__item u-1/3@xl u-1/1"></div>
					<div class="o-layout__item u-2/3@xl u-1/1">
						<div class="c-single__title"><?php the_title(); ?></div>
					</div>
				</div>
			</div>
			<div class="o-wrap o-wrap--lg">
				<div class="c-single__layout o-layout o-layout--huge o-layout--reverse">
					<div class="o-layout__item u-2/3@xl u-1/1@md">
						<div class="c-single__block c-single__block--paragraph">
							<?php echo wp_kses( get_post_meta( get_the_ID(), 'body', true ), array(
								'p'      => array(),
								'a'      => array(
									'href'   => array(),
									'title'  => array(),
									'target' => array( '_blank' ),
								),
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
							) ); ?>
						</div>
                        <?php 
						$data = get_post_meta( get_the_ID(), 'vdcontent', true );
						if ( ! empty( $data['vd_title'] ) ):  ?>
							<div class="c-single__title"><?php echo wp_kses_post( $data['vd_title'] ); ?></div>
                        <?php endif; 
						$fields = get_post_meta( get_the_ID(), 'pvideo', true );
						if ( ! empty( $fields['look_video'] ) ): 
							$fullvedio = wp_get_attachment_url($fields['look_video']);
							$fullposters = wp_get_attachment_url($fields['vimage']);
							if ( ! empty( $fullvedio ) ): ?>
								<div style="width:100%">
									<video poster="<?php echo esc_url( $fullposters ); ?>" preload="none" controls style="width:100%">
										<source src="<?php echo esc_url( $fullvedio ); ?>" type="video/mp4" />
									</video>
								</div>
							<?php endif; ?>
						<?php endif;
                        
						if ( ! empty( $data['description'] ) ):  ?>
                        	<?php echo wp_kses( $data['description'], array(
                                'p'      => array(),
								'a'      => array(
									'href'   => array(),
									'title'  => array(),
									'target' => array( '_blank' ),
								),
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
							) ); ?>
                        <?php endif; ?>
					</div>

					<?php
					$program_partner_ids = get_post_meta( get_the_ID(), 'partners' );
					?>
					<?php if ( ! empty( $program_partner_ids ) ): ?>
						<div class="o-layout__item u-1/3@xl u-1/1">
							<aside class="c-single__partners">
								<h4>
									<?php echo esc_html( _nx(
										'Learn more about our partner',
										'Learn more about our partners',
										count( $program_partner_ids ),
										'Program Page Partner List',
										'fbiamdigital' ) ); ?>
								</h4>
								<div class="o-layout o-layout--stretch">
									<?php foreach ( $program_partner_ids as $program_partner_id ): ?>
										<div class="o-layout__item u-1/1@xl">
											<a class="o-media o-media--flag c-partner-item c-partner-item--aside" href="<?php echo esc_url( get_the_permalink( $program_partner_id ) ); ?>" target="_blank" rel="noopener">
												<div class="o-media__img c-partner-item__logo">
													<div class="c-partner-item__logo-img" style="background: url(<?php echo esc_url( get_the_post_thumbnail_url( $program_partner_id ) ); ?>) 0 50% no-repeat; background-size: contain;"></div>
												</div>
												<div class="o-media__body c-partner-item__body">
													<h3 class="c-partner-item__title"><?php echo esc_html( get_the_title( $program_partner_id ) ); ?></h3>
												</div>
											</a>
										</div>
									<?php endforeach; ?>
								</div>
							</aside>
						</div>
					<?php
					endif; ?>
				</div>
			</div>
		</article>
	</section>
<?php
endwhile; // End of the loop.
?>
<?php
get_footer();
