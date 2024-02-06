<?php
/*
Template Name: Home Page
*/

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<section class="c-masthead c-masthead--home">
		<div class="c-masthead__content o-wrap">
			<?php
			$heading     = get_post_meta( get_the_ID(), 'heading', true );
			$description = get_post_meta( get_the_ID(), 'description', true );
			?>
			<?php if ( ! empty( $heading ) ): ?>
				<h1 class="c-masthead__heading u-animated u-animated--left-right"><?php echo wp_kses_post( $heading ); ?></h1>
			<?php endif; ?>
			<?php if ( ! empty( $description ) ): ?>
				<div class="c-masthead__description u-animated u-animated--left-right">
					<?php echo wp_kses_post( $description ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php $section_funfacts = get_post_meta( get_the_ID(), 'section_funfacts', true ); ?>
	<section class="c-home-section c-home-section--funfacts">
		<div class="o-wrap">
			<?php if ( ! empty( $section_funfacts['heading'] ) ): ?>
				<h2 class="c-home-section__heading c-heading2 u-tac"><?php echo esc_html( $section_funfacts['heading'] ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $section_funfacts['description'] ) ): ?>
				<div class="c-home-section__description u-tac">
					<?php echo wp_kses_post( $section_funfacts['description'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $section_funfacts['funfacts'] ) ): ?>
			<div class="c-funfacts u-animated u-animated--btm-top">
				<?php foreach ( $section_funfacts['funfacts'] as $funfact ): ?>
					<blockquote class="c-funfacts__item o-box o-media c-funfact">
						<?php if ( ! empty( $funfact['icon'] ) ): ?>
							<?php $icon_src = wp_get_attachment_url( $funfact['icon'] ); ?>
							<div class="o-media__img c-funfact__icon" style="background: url(<?php echo esc_url( $icon_src ); ?>) 50% 50% no-repeat; background-size: cover;"></div>
						<?php endif; ?>
						<div class="o-media__body c-funfact__body">
							<?php if ( ! empty( $funfact['heading'] ) ): ?>
								<h4 class="c-funfact__heading"><?php echo esc_html( $funfact['heading'] ); ?></h4>
							<?php endif; ?>
							<?php if ( ! empty( $funfact['description'] ) ): ?>
								<div class="c-funfact__description"><?php echo wp_kses_post( $funfact['description'] ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $funfact['cite'] ) ): ?>
								<cite class="c-funfact__cite">
									&ndash;
									<?php echo wp_kses( $funfact['cite'], array(
										'sup' => array(),
										'a'   => array(
											'href'   => array(),
											'title'  => array(),
											'target' => array( '_blank' ),
										),
									) ); ?>
								</cite>
							<?php endif; ?>
						</div>
					</blockquote>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
    <?php
    $queryev = get_EventsHome();
    if ( $queryev->have_posts() ) { ?>
    	<?php $i=1;
			while ( $queryev->have_posts() ) : $queryev->the_post();
				$ev_attachment = get_post_meta( get_the_ID(), 'events_detail' , true );
				$evimage = wp_get_attachment_url($ev_attachment['evimage']);
				if($i%2!=0){
		?>
        		<section class="c-home-section c-home-section--partners u-animated u-animated--btm-top u-animated--animate" style="transition-delay: 0ms;">
                    <div class="o-wrap">
                        <div class="o-box o-media o-media--reverse c-home-section__media">
                            <div class="o-media__body c-home-section__body">
                            	<?php if ( ! empty( get_the_title() ) ): ?>
                                <h2 class="c-home-section__heading c-heading2"><?php echo wp_kses_post(get_the_title()); ?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['welcome_content'] ) ): ?>
                                    <p class="c-home-section__description">
                                        <?php echo wp_kses( $ev_attachment['welcome_content'], array( 
                                            'br' => array('class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array() ),
                                            'strong' => array(),
                                        ) ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['button_text'] ) ): ?>
                                	<a class="c-btn" target="_blank" href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>">
										<?php echo wp_kses_post($ev_attachment['button_text']); ?>
                                        <i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
                            </div>
                        <div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( $evimage ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
                        </div>
                    </div>
                </section>
                <?php } else { ?>
                <section class="c-home-section c-home-section--partners u-animated u-animated--btm-top u-animated--animate" style="transition-delay: 0ms;">
                    <div class="o-wrap">
                        <div class="o-box o-media o-media--reverse c-home-section__media">
                        	 <div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( $evimage ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
                            <div class="o-media__body c-home-section__body">
                            	<?php if ( ! empty( get_the_title() ) ): ?>
                                <h2 class="c-home-section__heading c-heading2"><?php echo wp_kses_post(get_the_title()); ?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['welcome_content'] ) ): ?>
                                    <p class="c-home-section__description">
                                        <?php echo wp_kses( $ev_attachment['welcome_content'], array( 
                                            'br' => array('class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array() ),
                                            'strong' => array(),
                                        ) ); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $ev_attachment['button_text'] ) ): ?>
                                	<a class="c-btn" target="_blank" href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>">
										<?php echo wp_kses_post($ev_attachment['button_text']); ?>
                                        <i class="fas fa-chevron-right"></i></a>
                                <?php endif; ?>
                            </div>
                       
                        </div>
                    </div>
                </section>
                <?php } ?>
        <?php $i++;	 endwhile; wp_reset_postdata(); ?>
    <?php } ?>
    <?php $section_stories = get_post_meta( get_the_ID(), 'section_stories', true ); ?>
	<?php if ( fbiamdigital_home_section_has_content( $section_stories ) ) : ?>
	<section class="c-home-section c-home-section--stories u-animated u-animated--btm-top">
		<div class="o-wrap">
			<div class="o-box c-home-section__box">
				<div class="o-media o-media--flag c-home-section__body">
					<div class="o-media__body">
						<?php if ( ! empty( $section_stories['heading'] ) ): ?>
							<h2 class="c-home-section__heading c-heading2"><?php echo esc_html( $section_stories['heading'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $section_stories['description'] ) ): ?>
							<p class="c-home-section__description">
								<?php echo wp_kses_post( $section_stories['description'] ); ?>
							</p>
						<?php endif; ?>
					</div>
					<a class="o-media__img c-home-section__btn c-btn" href="<?php echo esc_url( get_post_type_archive_link( 'story' ) ); ?>"><?php esc_html_e( 'Discover now', 'fbiamdigital' ); ?> <i class="fas fa-chevron-right"></i></a>
				</div>
				<?php if ( ! empty( $section_stories['featured'] ) ): ?>
					<div class="c-home-stories o-layout o-layout--flush">
						<?php foreach ( $section_stories['featured'] as $featured_post ): ?>
							<?php $featured_post_id = $featured_post['post_id']; ?>
							<?php $story_item_width = count( $section_stories['featured'] ); ?>
							<div class="o-layout__item u-1/<?php echo esc_attr( $story_item_width ); ?>@xl u-1/<?php echo esc_attr( $story_item_width ); ?>@md u-1/1@xs">
								<a class="c-listing-item c-listing-item--frontpage" href="<?php echo esc_url( get_the_permalink( $featured_post_id ) ); ?>">
									<div class="c-listing-item__img">
										<div style="background:url(<?php echo esc_url( get_the_post_thumbnail_url( $featured_post_id ) ); ?>) no-repeat 50% 50%; background-size: cover;"></div>
									</div>
									<div class="c-listing-item__body">
										<div class="c-listing-item__meta">
											<?php $category = fbiamdigital_get_the_first_term( $featured_post_id, 'story_category' ); ?>
											<?php if ( ! empty( $category ) ): ?>
												<span class="c-listing-item__cat"><?php echo esc_html( $category->name ); ?></span>
											<?php endif; ?>
										</div>
										<h3 class="c-listing-item__title"><?php echo esc_html( get_the_title( $featured_post_id ) ); ?></h3>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif ?>

	<?php $section_resources = get_post_meta( get_the_ID(), 'section_resources', true ); ?>
	<?php if ( fbiamdigital_home_section_has_content( $section_resources ) ) : ?>
	<section class="c-home-section c-home-section--resources u-animated u-animated--btm-top">
		<div class="o-wrap">
			<div class="o-box o-media c-home-section__media">
				<form class="o-media__body c-home-section__body" action="<?php echo esc_url( get_post_type_archive_link( 'resource' ) ); ?>">
					<?php if ( ! empty( $section_resources['heading'] ) ): ?>
						<h2 class="c-home-section__heading c-heading2"><?php echo esc_html( $section_resources['heading'] ); ?></h2>
					<?php endif; ?>
					<div class="c-home-section__description">
						<?php if ( ! empty( $section_resources['description'] ) ): ?>
							<p>
								<?php echo wp_kses( $section_resources['description'], array(
									'br' => array(
										'class' => array()
									),
								) ); ?>
							</p>
						<?php endif; ?>
						<p class="u-lh-1/6">
							<?php fbiamdigital_the_resources_filter_options(); ?>
						</p>
					</div>
					<button class="c-btn" type="submit"><?php esc_html_e( 'Explore resources', 'fbiamdigital' ); ?> <i class="fas fa-chevron-right"></i></button>
				</form>
				<div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( get_theme_file_uri( 'images/home-resources.png' ) ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
			</div>
		</div>
	</section>
<?php endif; ?>

<!-- SECTION VIDEO HIGHTLIGHTS -->
	<?php $section_hightlights = get_post_meta(get_the_ID(), 'section_video_hightlights', true); ?>
	<?php if (!empty($section_hightlights) && !empty($section_hightlights['videos'])): ?>
	<div class="c-home-section c-home-section--video-highlights u-animated u-animated--btm-top ">
		<div class="c-home-section-contain">
			<div class="o-wrap">
				<div class="c-home-section--resources__header">
					<h2 class="c-home-section__heading c-heading2"><?php echo esc_html($section_hightlights['heading']) ?></h2>
				</div>
				<?php if (!empty($section_hightlights['videos'])) : ?>
					<div class="c-home-section__video u-animated u-animated--btm-top">
						<?php foreach ($section_hightlights['videos'] as $video) :
							$url = wp_get_attachment_url($video['video']);
							$bg = wp_get_attachment_url($video['bg']);
							$pTitle = $video['title'];
						?>
							<div class="c-video-hightlights-item" data-preview-img="<?php echo esc_url($bg) ?>" data-video-url="<?php echo esc_url($url) ?>">
								<div class="c-video-hightlights-item__bg">
									<img class="bg-img" src="<?php echo esc_url($bg) ?>" alt="">
									<img class="bg-gradient" src="<?php echo esc_url(get_theme_file_uri('images/bg__hightlights.jpg')) ?>" alt="">
									<div class="c-video-hightlights-item__title">
										<?php echo esc_html($pTitle) ?>
									</div>
								</div>
								<div class="c-video-hightlights-item__icon">
									<span class="c-video-hightlights-item__thumbnail-icon c-video-hightlights-item__thumbnail-icon--play"><i class="fas fa-play"></i></span>
									<span class="c-video-hightlights-item_thumbnail-icon c-video-hightlights-item__thumbnail-icon--spinner">
										<div class="o-spinner o-spinner--bbounce">
											<div class="o-spinner__doodad-1"></div>
											<div class="o-spinner__doodad-2"></div>
											<div class="o-spinner__doodad-3"></div>
										</div>
									</span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- END SECTION VIDEO HIGHTLIGHTS -->

	<?php fbiamdigital_the_jumbotron( get_post_meta( get_the_ID(), 'jumbotron', true ) ); ?>

	<?php $section_partners = get_post_meta( get_the_ID(), 'section_partners', true ); ?>
	<?php if ( fbiamdigital_home_section_has_content( $section_partners ) ) : ?>
	<section class="c-home-section c-home-section--partners u-animated u-animated--btm-top">
		<div class="o-wrap">
			<div class="o-box o-media o-media--reverse c-home-section__media">
				<div class="o-media__body c-home-section__body">
					<?php if ( ! empty( $section_partners['heading'] ) ): ?>
						<h2 class="c-home-section__heading c-heading2"><?php echo esc_html( $section_partners['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $section_partners['description'] ) ): ?>
						<p class="c-home-section__description">
							<?php echo wp_kses_post( $section_partners['description'] ); ?>
						</p>
					<?php endif; ?>
					<a class="c-btn" href="<?php echo esc_url( get_post_type_archive_link( 'partner' ) ); ?>"><?php esc_html_e( 'Learn more', 'fbiamdigital' ); ?> <i class="fas fa-chevron-right"></i></a>
				</div>
				<div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( get_theme_file_uri( 'images/home-partners.png' ) ); ?>) 50% 100% no-repeat #b2caf1; background-size: cover;"></div>
			</div>
		</div>
	</section>
<?php endif; ?>

	<?php $section_committee = get_post_meta( get_the_ID(), 'section_committee', true ); ?>
	<?php if ( fbiamdigital_home_section_has_content( $section_committee ) ) : ?>
	<section class="c-home-section c-home-section--committee u-animated u-animated--btm-top">
		<div class="o-wrap">
			<div class="o-box o-media c-home-section__media">
				<div class="o-media__body c-home-section__body">
					<?php if ( ! empty( $section_committee['heading'] ) ): ?>
						<h2 class="c-home-section__heading c-heading2"><?php echo esc_html( $section_committee['heading'] ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $section_committee['description'] ) ): ?>
						<p class="c-home-section__description">
							<?php echo wp_kses_post( $section_committee['description'] ); ?>
						</p>
					<?php endif; ?>
					<a class="c-btn" href="<?php echo esc_url( get_post_type_archive_link( 'committee' ) ) ?>"><?php esc_html_e( 'View Committee', 'fbiamdigital' ); ?> <i class="fas fa-chevron-right"></i></a>
				</div>
				<div class="o-media__img c-home-section__img" style="background: url(<?php echo esc_url( get_theme_file_uri( 'images/home-committee.png' ) ); ?>) 50% 50% no-repeat #b2caf1; background-size: cover;"></div>
			</div>
		</div>
	</section>
<?php endif; ?>

	<?php if ( ! empty( $section_funfacts['cite_reference'] ) ): ?>
	<section class="c-home-cite-ref">
		<div class="o-wrap">
			<?php echo wp_kses( $section_funfacts['cite_reference'], array(
				'p'      => array(),
				'strong' => array(),
				'br'     => array(),
				'sup'    => array(),
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'target' => array( '_blank' ),
				),
			) ); ?>
		</div>
	</section>
<?php endif; ?>

<?php endwhile; ?>
<div class="c-home--player c-resources-video-player">
	<div class="c-resources-video-player__content">
		<video controls="" controlslist="nodownload" preload="metadata" playsinline=""></video>
		<button class="c-resources-video-player__btn-close"><i class="fal fa-times"></i></button>
	</div>
</div>
<?php
get_footer();
