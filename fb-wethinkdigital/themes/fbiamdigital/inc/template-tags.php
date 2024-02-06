<?php
/**
 * Custom template tags for this theme
 *
 * @package fbiamdigital
 */


/**
 * Displays the post type archive masthead
 *
 * @param $post_type
 */
function fbiamdigital_the_archive_masthead( $post_type = false ) {
	if ( empty( $post_type ) ) {
		$post_type = get_post_type();
	}

	if ( ! empty( $post_type ) ) {
		$fields = get_option( "archive_{$post_type}", array() );
		?>
		<section class="c-masthead c-masthead--<?php echo esc_attr( $post_type ); ?>">
			<div class="c-masthead__content o-wrap">
				<?php if ( ! empty( $fields['heading'] ) ): ?>
					<h1 class="c-masthead__heading u-animated u-animated--left-right"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $fields['description'] ) ): ?>
					<div class="c-masthead__description u-animated u-animated--left-right">
						<?php echo wp_kses_post( $fields['description'], array(
							'br' => array(
								'class' => array()
							),
						) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}

/**
 * Prints Facebook SDK JS script
 */
function fbiamdigital_the_fb_jdsdk() {
	// @formatter:off
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
	<?php
	// @formatter:on
}

/**
 * Display load more button for infinite scroll (click)
 */
 
function fbiamdigital_the_infinite_load_button() {
	//Custom Button
	
}

/**
 * Outputs Google Tag Manager noscript code
 */
function fbiamdigital_the_gtm_code_noscript() {
	if ( VIP_GO_ENV === 'production' ) {
		// @formatter:off
		?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KPLNN68"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<?php
		// @formatter:on
	}
}

/**
 * Prints the facebook share button
 */
function fbiamdigital_the_fb_share_button() {
	$permalink  = get_the_permalink();
	$sharer_url = add_query_arg( array(
		'u' => rawurlencode( get_the_permalink() ),
	), 'https://www.facebook.com/sharer/sharer.php' );

	if ( ! empty( $permalink ) ) {
		?>
		<div class="fb-share-button" data-href="<?php echo esc_url( $permalink ); ?>" data-layout="button_count" data-size="small">
			<a target="_blank" href="<?php echo esc_url( $sharer_url ); ?>" class="fb-xfbml-parse-ignore"><?php echo esc_html_x( 'Share', 'Facebook share button', 'fbiamdigital' ); ?></a>
		</div>
		<?php
	}
}

/**
 * Output resources filter
 */
function fbiamdigital_the_resources_filter_options() {
	$resource_audience_terms = fbiamdigital_get_terms( array(
		'taxonomy' => 'audience',
	) );
	$resource_topic_terms    = fbiamdigital_get_terms( array(
		'taxonomy' => 'topic',
	) );
	echo '<div class="lang-direction-vertical">';
	if ( ! empty( $resource_topic_terms ) ): ?>
		<div class="lang-direction-horizontal">
			<?php echo esc_html_x( "I want to learn more about", 'Resources Filter', 'fbiamdigital' ); ?>
			<select name="topic" class="c-select">
				<option value=""><?php echo esc_html_x( 'all topics', 'Resources Filter', 'fbiamdigital' ); ?></option>
				<?php foreach ( $resource_topic_terms as $topic_term ): ?>
					<option <?php selected( $topic_term->slug, get_query_var( 'topic' ), true ); ?> value="<?php echo esc_attr( $topic_term->slug ); ?>"><?php echo esc_html( $topic_term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $resource_audience_terms ) ): ?>
		<div class="lang-direction-horizontal">
			<?php echo esc_html_x( "for", 'Resources Filter', 'fbiamdigital' ); ?>
			<select name="audience" class="c-select">
				<option value=""><?php echo esc_html_x( 'everyone', 'Resources Filter', 'fbiamdigital' ); ?></option>
				<?php foreach ( $resource_audience_terms as $audience_term ): ?>
					<option <?php selected( $audience_term->slug, get_query_var( 'audience' ), true ); ?> value="<?php echo esc_attr( $audience_term->slug ); ?>"><?php echo esc_html( $audience_term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	<?php endif;
	echo '</div>';
}


/**
 * Output resources filter
 */
function fbiamdigital_the_resources_filter_options2() {
	$resource_audience_terms = fbiamdigital_get_terms( array(
		'taxonomy' => 'audience',
	) );
	$resource_topic_terms    = fbiamdigital_get_terms( array(
		'taxonomy' => 'topic',
	) );
	echo '<div class="lang-direction-vertical">';
	if ( ! empty( $resource_audience_terms ) ): ?>
		<div class="lang-direction-horizontal">
			<?php echo esc_html_x( "I am a/an ", 'Resources Filter', 'fbiamdigital' ); ?>
			<select name="audience" class="c-select">
				<option value=""><?php echo esc_html_x( 'everyone', 'Resources Filter', 'fbiamdigital' ); ?></option>
				<?php foreach ( $resource_audience_terms as $audience_term ): ?>
					<option <?php selected( $audience_term->slug, get_query_var( 'audience' ), true ); ?> value="<?php echo esc_attr( $audience_term->slug ); ?>"><?php echo esc_html( $audience_term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	<?php endif; ?> 

	<?php if ( ! empty( $resource_topic_terms ) ): ?>
		<div class="lang-direction-horizontal">
			<?php echo esc_html_x( "I want to learn more about", 'Resources Filter', 'fbiamdigital' ); ?>
			<select name="topic" class="c-select">
				<option value=""><?php echo esc_html_x( 'all topics', 'Resources Filter', 'fbiamdigital' ); ?></option>
				<?php foreach ( $resource_topic_terms as $topic_term ): ?>
					<option <?php selected( $topic_term->slug, get_query_var( 'topic' ), true ); ?> value="<?php echo esc_attr( $topic_term->slug ); ?>"><?php echo esc_html( $topic_term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	<?php endif;
	echo '</div>';
}

/**
 * Display jumbotron component
 *
 * @param array $fields
 */
function fbiamdigital_the_jumbotron( $fields = array() ) {
	if ( is_array( $fields ) &&
	     ( ! empty( $fields['jumbotron_bg'] ) ||
	       ! empty( $fields['jumbotron_heading'] ) ||
	       ! empty( $fields['jumbotron_description'] ) ||
	       ! empty( $fields['jumbotron_resource'] ) ||
	       ! empty( $fields['jumbotron_button_text'] ) ) ) {
		?>
		<section class="jumbotron o-wrap u-animated u-animated--btm-top">
			<?php $jumbotron_bg_src = wp_get_attachment_url( $fields['jumbotron_bg'] ); ?>
			<div class="jumbotron__bg-wrapper" style="background: url(<?php echo esc_url( $jumbotron_bg_src ); ?>) 50% 50% no-repeat; background-size: cover;">
				<div class="jumbotron__body">
					<?php if ( ! empty( $fields['jumbotron_heading'] ) ): ?>
						<h3 class="jumbotron__heading"><?php echo esc_html( $fields['jumbotron_heading'] ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $fields['jumbotron_description'] ) ): ?>
						<div class="jumbotron__description">
							<?php echo wp_kses( $fields['jumbotron_description'], array(
									'p'      => array(),
									'br'     => array(),
									'strong' => array(),
									'em'     => array(),
									'a'      => array(
										'href'   => array(),
										'title'  => array(),
										'target' => array( '_blank' ),
									),
								)
							); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $fields['jumbotron_resource'] ) ): ?>
						<?php $resource_attachment = fbiamdigital_get_resource_attachment( get_post_meta( $fields['jumbotron_resource'], 'resource_attachment' ) ); ?>
						<a class="jumbotron__cta" href="<?php echo esc_url( $resource_attachment['url'] ); ?>" target="_blank" rel="noopener"
							<?php echo esc_html( $resource_attachment['resource_type'] ? 'download' : '' ); ?>
						>
							<?php if ( ! empty( $fields['jumbotron_button_text'] ) ): ?>
								<?php echo esc_html( $fields['jumbotron_button_text'] ); ?>
							<?php else: ?>
								<?php if ( $resource_attachment['resource_type'] === 'link' ): ?>
									<?php esc_html_e( 'Access', 'fbiamdigital' ); ?> <i class="far fa-external-link"></i>
								<?php elseif ( $resource_attachment['resource_type'] === 'download' ): ?>
									<?php esc_html_e( 'Download', 'fbiamdigital' ); ?><?php echo esc_html( ! empty( $resource_attachment['size'] ) ? sprintf( ' (%s)', $resource_attachment['size'] ) : '' ); ?> <i class="far fa-arrow-to-bottom"></i>
								<?php endif; ?>
							<?php endif; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

function fbiamdigital_the_resource_content_type_label( $resource_attachment ) {
	$file_type_mapping = array(
		'learning_module'         => _x( 'Learning Module', 'Resource File Content Type', 'fbiamdigital' ),
		'learning_module_package' => _x( 'Learning Module (Package)', 'Resource File Content Type', 'fbiamdigital' ),
		'infographic'             => _x( 'Infographic', 'Resource File Content Type', 'fbiamdigital' ),
	);

	$website_type_mapping = array(
		'website'      => _x( 'Website', 'Resource Website Content Type', 'fbiamdigital' ),
		'lesson_plans' => _x( 'Lesson Plans (Website)', 'Resource Website Content Type', 'fbiamdigital' ),
	);

	if (
		is_array( $resource_attachment ) &&
		! empty( $resource_attachment['resource_type'] ) &&
		! empty( $resource_attachment['content_type'] )
	) {
		if ( $resource_attachment['resource_type'] === 'link' ) {
			if ( ! empty( $website_type_mapping[ $resource_attachment['content_type'] ] ) ) {
				echo esc_html( $website_type_mapping[ $resource_attachment['content_type'] ] );
			}
		} else if ( $resource_attachment['resource_type'] === 'download' ) {
			if ( ! empty( $file_type_mapping[ $resource_attachment['content_type'] ] ) ) {
				echo esc_html( $file_type_mapping[ $resource_attachment['content_type'] ] );
			} else {
				// Legacy fallback
				echo esc_html( $resource_attachment['content_type'] );
			}
		} else if ( $resource_attachment['resource_type'] === 'video' ) {
			echo esc_html_x( 'Video', 'Resource File Content Type', 'fbiamdigital' );
		}
	}
}
/**
 * Output the site selector
 */
function fbiamdigital_the_site_selector($showCountry=false) {
	$sites_data        = fbiamdigital_get_site_selector_data();
	$current_site_data = $sites_data['current'];
	$all_sites_data    = $sites_data['all'];
	
	?>
	<?php if ( ! empty( $current_site_data ) && ! empty( $all_sites_data ) && count( $all_sites_data ) > 1 ): ?>
		<nav class="c-site-selector">
			<ul class="menu">
				<li class="menu-item menu-item-has-children">
					<a href="javascript:;"><span class="o-icon-flag o-icon-flag--<?php echo esc_attr( $current_site_data['country_code'] ); ?>"></span><span><?php echo esc_html( $current_site_data['name'] ) ?></span></a>
					<ul class="sub-menu">
						<?php foreach ( $all_sites_data as $site ): ?>
							<li class="menu-item<?php echo esc_attr( $sites_data['current']['country_code'] === $site['country_code'] ? ' menu-item-active' : '' ); ?>">
								<a href="<?php echo esc_url( $site['url'] ); ?>">
									<span><?php echo esc_html( $site['name'] ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</nav>
	<?php endif; ?>
	<?php if ($showCountry && !empty($current_site_data['country_lang'])) : ?>
		<nav class="c-site-selector c-site-selector-country_lang">
			<ul class="menu">
				<li class="menu-item menu-item-has-children">
					<a href="javascript:;" class="menu-item-selected">
					<?php echo esc_html(strtoupper($sites_data['current_lang'])) ?>
					</a>
					<ul class="sub-menu">
						<?php 
						sort($current_site_data['country_lang']);
						foreach($current_site_data['country_lang'] as $lang): ?>
						<li class="menu-item">
                        	<?php  
								$rdurl='';
								$siteurl = $current_site_data['url'];
								$expurl = explode('/',$siteurl);
								
								if($expurl[3]==='ph' && $lang['code']==='tl-ph')
								{
									$rdurl = esc_url($current_site_data['url'] . $lang['code']).'/stayingsafeonline/';
								}
								else if($expurl[3]==='ph' && $lang['code']==='en-ph')
								{
									$rdurl = esc_url($current_site_data['url'] . $lang['code']).'/stayingsafeonline/';
								}
								else if($expurl[3]==='jp' && $lang['code']==='en-jp')
								{
									$rdurl = esc_url($current_site_data['url'] . $lang['code']).'/stayingsafeonline/';
								}
								else if($expurl[3]==='sg' && $lang['code']==='en-sg')
								{
									$rdurl = esc_url($current_site_data['url']);
								}
								else if($expurl[3]==='sg' && $lang['code']==='ch-sg')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/ch-sg/stayingsafeonline/';
								}
								else if($expurl[3]==='sg' && $lang['code']==='ta-sg')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/ta-sg/stayingsafeonline/';
								}
								else if($expurl[3]==='sg' && $lang['code']==='ms-sg')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/ms-sg/stayingsafeonline/';
								}
								else if($expurl[3]==='lk' && $lang['code']==='si-lk')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/si-lk/stayingsafeonline/';
								}
								else if($expurl[3]==='lk' && $lang['code']==='ta-lk')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/ta-lk/stayingsafeonline/';
								}
								else if($expurl[3]==='th' && $lang['code']==='en-th')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-th/stayingsafeonline/';
								}
								else if($expurl[3]==='id' && $lang['code']==='en-id')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-id/stayingsafeonline/';
								}
								else if($expurl[3]==='bd' && $lang['code']==='en-bd')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-bd/stayingsafeonline/';
								}
								else if($expurl[3]==='pk' && $lang['code']==='en-pk')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-pk/stayingsafeonline/';
								}
								else if($expurl[3]==='tw' && $lang['code']==='en-tw')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-tw/stayingsafeonline/';
								}
								else if($expurl[3]==='vn' && $lang['code']==='en-vn')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-vn/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='as-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/as-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='bn-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/bn-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='gu-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/gu-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='hi-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/hi-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='kn-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/kn-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='mr-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/mr-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='ta-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/ta-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='te-in')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/te-in/stayingsafeonline/';
								}
								else if($expurl[3]==='in' && $lang['code']==='en-vn')
								{
									$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-vn/stayingsafeonline/';
								}
								else if($expurl[3]==='pc' && $lang['code']==='en-us')
								{
									$rdurl = esc_url($current_site_data['url']);
								}
								else
								{
									$rdurl = esc_url($current_site_data['url'] . $lang['code']);
								}
								if($expurl[3]==='ph' && $lang['code']==='en-us')
								{ }
								else{
								?>
                                    <a href="<?php echo esc_url($rdurl); ?>">
                                        <span><?php echo esc_html($lang['name']) ?></span>
                                    </a>
                                 <?php } ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</nav>
	<?php endif; ?>
	<?php
}

/**
 * Output the site custom logo
 */
function fbiamdigital_the_custom_logo() {
	$logo_src = get_theme_file_uri( '/images/logo-wethinkdigital.svg' );
	if ( ! empty( get_theme_mod( 'fbiamdigital_custom_logo' ) ) ) {
		$logo_src = get_theme_mod( 'fbiamdigital_custom_logo' );
	}
	?>
	<img class="c-site-logo__iad" height="34" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( wp_get_document_title() ) ?>">
	<?php
}
