<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wethinkdigital2022
 */

if ( ! function_exists( 'wethinkdigital2022_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wethinkdigital2022_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'wethinkdigital2022' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wethinkdigital2022_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wethinkdigital2022_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'wethinkdigital2022' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wethinkdigital2022_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wethinkdigital2022_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'wethinkdigital2022' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wethinkdigital2022' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wethinkdigital2022' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wethinkdigital2022' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wethinkdigital2022' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wethinkdigital2022' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'wethinkdigital2022_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function wethinkdigital2022_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


function wethinkdigital22_the_infinite_load_button() {
	//Custom Button
}
/**
 * Output the site custom logo
 */
function wethinkdigital2022_the_custom_logo() {
	$logo_src = get_theme_file_uri( '/images/logo-wethinkdigital.svg' );
	if ( ! empty( get_theme_mod( 'fbiamdigital_custom_logo' ) ) ) {
		$logo_src = get_theme_mod( 'fbiamdigital_custom_logo' );
	}
	?>
	<img height="34" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( wp_get_document_title() ) ?>">
	<?php
}

/**
 * Output resources filter
 */
function wethinkdigital2022_the_resources_filter_options($aud,$topic) {
	$resource_audience_terms = WTD_get_terms( array(
		'taxonomy' => 'audience',
	) );
	$resource_topic_terms    = WTD_get_terms( array(
		'taxonomy' => 'topic',
	) );
	if ( ! empty( $resource_audience_terms ) ):
		echo '<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-center">';
			 ?>
				<select class="form-select fontTxt txtDarkBlue font20 padding15 MarginBottom15 bgWhite div100" id="audience" name="audience" aria-label="">
					<option value="" selected class="fontTxt font14 txtDarkBlue" ><?php echo esc_html_x( $aud, 'Resources Filter', 'wethinkdigital2022' ); ?>
					<?php foreach ( $resource_audience_terms as $audience_term ): ?>
					<option <?php selected( $audience_term->slug, get_query_var( 'audience' ), true ); ?> value="<?php echo esc_attr( $audience_term->slug ); ?>" class="fontTxt font14 txtDarkBlue"><?php echo esc_html( ucfirst($audience_term->name) ); ?></option>
					<?php endforeach; ?>
				</select>
			<?php ;
		echo '</div>';
	endif;
	if ( ! empty( $resource_topic_terms ) ):
		echo '<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-center">';
			 ?>
				<select class="form-select fontTxt txtDarkBlue font20 padding15 MarginBottom15 bgWhite div100" id="topic" name="topic" aria-label="">
					<option value="" selected class="fontTxt font14 txtDarkBlue" ><?php echo esc_html_x( $topic, 'Resources Filter', 'wethinkdigital2022' ); ?></option>
					<?php foreach ( $resource_topic_terms as $topic_term ): ?>
						  <option <?php selected( $topic_term->slug, get_query_var( 'topic' ), true ); ?> value="<?php echo esc_attr( $topic_term->slug ); ?>" class="fontTxt font14 txtDarkBlue"><?php echo esc_html( ucfirst($topic_term->name) ); ?></option>
					<?php endforeach; ?>
				</select>
			<?php 
		echo '</div>';
	endif;
}
/**
 * Display jumbotron component
 *
 * @param array $fields
 */
function wethinkdigital2022_the_resource( $fields = array() ) {
}
function wethinkdigital2022_the_resource_content_type_label( $resource_attachment ) {
	
	$file_type_mapping = array(
		'learning_module'         => _x( 'Learning Module', 'Resource File Content Type', 'wethinkdigital2022' ),
		'learning_module_package' => _x( 'Learning Module (Package)', 'Resource File Content Type', 'wethinkdigital2022' ),
		'infographic'             => _x( 'Infographic', 'Resource File Content Type', 'wethinkdigital2022' ),
		'guide'             => _x( 'Guide', 'Resource File Content Type', 'wethinkdigital2022' ),
	);

	$website_type_mapping = array(
		'website'      => _x( 'Website', 'Resource Website Content Type', 'wethinkdigital2022' ),
		'lesson_plans' => _x( 'Lesson Plans (Website)', 'Resource Website Content Type', 'wethinkdigital2022' ),
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
			echo esc_html_x( 'Video', 'Resource File Content Type', 'wethinkdigital2022' );
		}
		else if ( $resource_attachment['resource_type'] === 'content' ) {
			$chktype=0;
			$field_group = $resource_attachment['con_fields'];
			foreach ( $field_group as $field_data ) {
				foreach ( $field_data as $data ) {
					if($field_data['sec_type']==='accordian')
					{
						if( !empty($data['con_accor']) ) {
							foreach ($data['con_accor'] as $acc ) {
								if ( !empty( $acc['acc_file'] ) ){
									$chktype=1;
								}
							}
						}
					}
				}
			}
			if($chktype===1){ echo esc_html_x( 'Video', 'Resource File Content Type', 'wethinkdigital2022' ); }
			else{ echo esc_html_x( 'Learning Module', 'Resource File Content Type', 'wethinkdigital2022' ); }
		}
	}
}

/**
 * Output the site selector
 */
function wethinkdigital2022_the_site_selector($showCountry=false) {
	$sites_data        = wethinkdigital2022_get_site_selector_data();
	$current_site_data = $sites_data['current'];
	$all_sites_data    = $sites_data['all'];
	?>
	<?php if ( ! empty( $current_site_data ) && ! empty( $all_sites_data ) && count( $all_sites_data ) > 1 ): ?>
			<ul class="nav navbar marginZero paddingZero">
				<li class="nav-item dropdown">
                	<a class="nav-link dropdown-toggle fontTxt txtGrey font16 padding15 menuTxt" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo esc_html( $current_site_data['name'] ) ?>&nbsp;&nbsp;</a>
                    <div class="dropdown-menu">
                    	<?php foreach ( $all_sites_data as $site ): ?>
							<a class="dropdown-item fontTxt txtGrey font16" href="<?php echo esc_url( $site['url'] ); ?>">
                            <?php echo esc_html( $site['name'] ); ?></a>
                        <?php endforeach; ?>
                    </div>
				</li>
                <?php if ($showCountry && !empty($current_site_data['country_lang'])) : ?>
                <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle fontTxt txtGrey font16 padding15 menuTxt" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<?php echo esc_html(strtoupper($sites_data['current_lang'])) ?>&nbsp;&nbsp;</a>
					<div class="dropdown-menu">
                    	<?php 
						sort($current_site_data['country_lang']);
						foreach($current_site_data['country_lang'] as $lang): 
							$rdurl='';
							$siteurl = $current_site_data['url'];
							$expurl = explode('/',$siteurl);
							if($expurl[3]==='ph' && $lang['code']==='tl-ph')
							{
								$rdurl = esc_url($current_site_data['url'] . $lang['code']).'/stayingsafeonline/';
							}
							else if($expurl[3]==='ph' && $lang['code']==='en-ph')
							{
								$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/'.$lang['code'];
							}
							else if($expurl[3]==='jp' && $lang['code']==='en-jp')
							{
								$rdurl = esc_url($current_site_data['url'] . $lang['code']).'/stayingsafeonline/';
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
							else if($expurl[3]==='sg' && $lang['code']==='en-sg')
							{
								$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-sg/';
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
							else if($expurl[3]==='pk' && $lang['code']==='ur-pk')
							{
								$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/ur-pk/';
							}
							else if($expurl[3]==='pk' && $lang['code']==='en-pk')
							{
								$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-pk/';
							}
							else if($expurl[3]==='my' && $lang['code']==='en-my')
							{
								$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/en-my/';
							}
							else if($expurl[3]==='my' && $lang['code']==='bm-my')
							{
								$rdurl = $expurl[1].'//'.$expurl[2].'/'.$expurl[3].'/bm-my';
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
								<a class="dropdown-item fontTxt txtGrey font16" href="<?php echo esc_url($rdurl); ?>">
                                <?php echo esc_html($lang['name']) ?></a>
						<?php } endforeach; ?>
					</div>
				</li>
                <?php endif; ?>
                
			</ul>
	<?php endif;
}
