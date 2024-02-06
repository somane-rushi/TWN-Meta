<?php
// Select the partners pages
$the_partners_query = new WP_Query(
	array(
		'post_type'           => 'partners',
		'posts_per_page'      => 20,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	)
);
?>
<?php if ( $the_partners_query->have_posts() ||  get_theme_mod( 'show_about_us', false ) ) : ?>
<a name="about-us" data-scroll-anchor></a>
<section 
	id="about-us" 
	class="about is-light" 
	data-theme-colour="blue"
	style="
		<?php
		// if partners and about us set, display flex
		if ( $the_partners_query->have_posts() && get_theme_mod( 'show_about_us', false ) ) {
			echo 'display: flex;';
		} elseif ( $the_partners_query->have_posts() ) {
			// just partners set
			echo 'display: block; height: auto;';
		} else {
			echo 'display: flex;';
		}
		?>
	"
>

	<div id="sections_wrapper">
		<div id="section_about-us">
			<?php
			if ( $the_partners_query->have_posts() ) : 
			?>

				<div id="companies" class="about__companies companies
					<?php
					if ( get_theme_mod( 'about_us_blue', false ) ) {
						echo 'companies--blue';
					}
					?>
				">
					<div class="container flex">
						<div class="companies__wrap">
							<div class="companies__intro">
								<h4><?php esc_html_e( "We're working with", 'facebook-initiatives' ); ?></h4>
							</div>
							<div class="companies__carousel">
								<?php
								while ( $the_partners_query->have_posts() ) :
									$the_partners_query->the_post();
									$partner_url = '#';
									if ( get_post_meta( get_the_ID(), 'partner_url', true ) ) {
										$partner_url = get_post_meta( get_the_ID(), 'partner_url', true );
									}
									?>
									<div class="company">
										<a href="<?php echo esc_url( $partner_url ); ?>">
											<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>"
												alt="<?php echo esc_attr( the_title() ); ?>"/>
										</a>
									</div>
								<?php
								endwhile;
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'show_about_us', false ) ): ?>
				<div class="about__facebook">
					<div class="container">
						<div class="about__wrap">
							<div class="about__body">
								<?php
								// Use the front-page content and title for the about section
								$frontpage_id = intval( get_option( 'page_on_front' ) );
								?>
								<h2><?php echo esc_html( get_the_title( $frontpage_id ) ); ?></h2>
								<hr align="left"/>
								<?php echo wp_kses_post( apply_filters( 'the_content', get_post_field( 'post_content', $frontpage_id ) ) ); ?>
								<div class="about__profiles">
									<?php
									// Select the team_members page and it's meta data only
									$the_team_members_query = new WP_Query(
										array(
											'post_type'           => 'team-members',
											'posts_per_page'      => 4,
											'post_status'         => 'publish',
											'ignore_sticky_posts' => true,
										)
									);
									
									if ( $the_team_members_query->have_posts() ) {
										while ( $the_team_members_query->have_posts() ) {
											$the_team_members_query->the_post();
											$job_title = get_post_meta( get_the_ID(), 'job_title', true );
											?>
											<div class="profile">
												<?php
												if ( has_post_thumbnail() ) {
													?>
													<div class="profile__image">
														<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>"
															alt="<?php echo esc_attr( get_the_title() ); ?>"/>
													</div>
													<?php
												}
												?>
												<div class="profile__details">
													<div class="profile__name"><?php echo esc_html( get_the_title() ); ?></div>
													<?php
													if ( $job_title ) {
														?>
														<div class="profile__title"><?php echo esc_html( $job_title ); ?></div>
														<?php
													}
													?>
												</div>
											</div>
											<?php
										}
									}
									?>
								</div>
							</div>
							<div class="about__image">
								<?php
								if ( has_post_thumbnail( $frontpage_id ) ) {
									?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( $frontpage_id ) ); ?>"
										alt="<?php esc_attr_e( 'France Office', 'facebook-initiatives' ); ?>"/>
									
									<?php
								} else {
									?>
									<img
										src="<?php echo esc_url( facebook_image_include( '/assets/images/officeimage.jpg' ) ); ?>"
										alt="<?php esc_attr_e( 'France Office', 'facebook-initiatives' ); ?>"/>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>