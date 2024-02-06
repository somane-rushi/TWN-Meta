<?php
/**
 * Custom GLOBAL SEARCH FUNCTIONS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Turn off default WP search at /?s=
 *
 * @return void
 */
function fbsafety_turn_off_wp_default_search( $query, $error=true ) {
  if ( is_search() ) {
    $query->is_search       = false;
    $query->query_vars['s'] = false;
    $query->query['s']      = false;
    if ( $error == true ) {
      $query->is_404 = true;
    }
  }
}
add_action( 'parse_query', 'fbsafety_turn_off_wp_default_search' );


/**
 * Modules Search
 * Default search functionality for modules
 *
 * @return mixed
 */
add_action( 'wp_ajax_fbsafety_module_search', 'fbsafety_module_search' );
add_action( 'wp_ajax_nopriv_fbsafety_module_search', 'fbsafety_module_search' );
function fbsafety_module_search() {
	if ( check_ajax_referer( 'fbsafety--ajax', 'security' ) ) {

		$query        = ( isset($_POST['query']) ) ? str_replace( '__', ' ', sanitize_text_field($_POST['query']) ) : '';
		$version      = ( isset($_POST['version']) ) ? sanitize_text_field( $_POST['version'] ) : '';
		$paged        = ( isset($_POST['paged']) ) ? sanitize_text_field( $_POST['paged'] ) : 1;
		$module_id    = ( isset($_POST['moduleid']) ) ? sanitize_text_field( $_POST['moduleid'] ) : '';
		$all_mod_ids  = array();
		$allowed_tags = allowed_html_tags();

		// search everywhere
	  $args = array(
	  	'post_status'         => 'publish',
	  	's'                   => $query,
	  	'posts_per_page'      => 99,
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
	  	'fields'              => 'ids'
	  );

		if ( ! empty($module_id) ) {
			$pid         = intval( $module_id );
			$all_mod_ids = array( $pid ); 
			$child_args  = array( 
			  'post_type'           => array('module'), 
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
			  'fields'              => 'ids', 
			  'post_parent'         => $pid 
			);
			// add children page ids
			$q0 = new WP_Query( $child_args );
			if ( $q0->have_posts() ) {
				$children_arr = array();
				while ( $q0->have_posts() ) {
					$q0->the_post();
					$children_arr[] = get_the_ID();
				}
				$all_mod_ids = array_merge( $all_mod_ids, $children_arr );
			}

			// add associated lesson page ids
			$all_mod_ids      = array_merge( $all_mod_ids, get_all_lesson_ids($pid) );
			$args['post__in'] = $all_mod_ids;
		}

		$q = new WP_Query( $args );

    ob_start();
	    
		if ( $q->have_posts() ) {
		$i           = 0;
		$g           = 0;
		$num         = intval($q->post_count);
		$result_term = (1 === $num) ? 'result' : 'results';
?>
        <div class="search-results-head" data-total="<?php echo esc_attr( $num ); ?>">
          <h3>Search Term: <?php echo esc_html( $query ); ?></h3>
          <div class="result-count"><?php echo esc_html( $num . ' ' . $result_term ); ?> for '<?php echo esc_html( $query ); ?>'</div>
        </div>
        <div class="search-results-body" id="search-results-inner" data-last="<?php echo esc_attr( intval($paged * 10) ); ?>" data-total="<?php echo esc_attr( $num ); ?>">
<?php
			while ( $q->have_posts() ) {
				$q->the_post();
				$i++;
				$ID = get_the_ID();

				// generate excerpts
				$raw_excerpt   = fbsafety_find_search_phrase( $ID, $query );
				$the_excerpt   = fbsafety_highlight_search_results( $query, $raw_excerpt );

				$the_link      = get_permalink( $ID );
				$the_post_type = get_post_type($ID);
				$parent        = wp_get_post_parent_id( $ID );

				$the_subtitle  = '';
				$the_title     = get_the_title( $ID );
				// module pages
				if ('module' === $the_post_type) {
					// title & subtitle for main module page
					if (!$parent) {
						$the_subtitle = $the_title;
						$the_title    = fbsafety_determine_first_lesson( $ID );
					}
					// title & subtitle for child pages
					if ($parent) {
						$the_subtitle = get_the_title( $parent );
					}
				}
				// title & subtitle for lesson pages
				if ('lesson' === $the_post_type) {
					$module_id    = get_post_meta( $ID, 'module_id', true );
					$the_subtitle = get_the_title( $module_id );
				}	

				$load_more_button = false;

				if ($i > 10) {
					$classes = ' more--group more-group-' . $g;
					$load_more_button = true;
				}

				if ($i % 10 == 0) {
					$g++;
				}
?>
					<div class="result-box <?php echo esc_attr( $classes ); ?>" data-num="<?php echo esc_attr($i); ?>">
						<h5><?php echo esc_html( $the_subtitle); ?></h5>
						<h4><?php echo esc_html( $the_title ); ?></h4>
						<p><?php echo wp_kses( $the_excerpt, allowed_html_tags() ); ?></p>
						<a href="<?php echo esc_url( $the_link ); ?>" class="cta-arrow">View Page</a>
					</div>
<?php
			}//while
			if (true === $load_more_button) {
?>
		      <div class="btn-bottom-group" id="search-actions">
		        <a href="#top" class="btn-bottom">Back to top <i class="fas fa-angle-up"></i></a>
		        <a href="#" class="btn-bottom" id="s--load--more" data-num="<?php echo esc_attr( intval(1) ); ?>">More Results <i class="fas fa-plus"></i></a>
		      </div>

				</div>
<?php
			}
		} else {
			$global_fields      = get_option('global_fields');
			$no_results_message = fbsafety_fm_get_data($global_fields, 'no_search_results_message');
?>
				<div class="search-results-body" id="search-results-inner" data-total="0">
					<h2>Sorry, we didn’t find any matches for<br>&quot;<?php echo esc_html($query); ?>&quot;</h2>
					<?php echo wp_kses( $no_results_message, $allowed_tags ); ?>
				</div>
<?php
		}

		wp_reset_postdata();

		$result  = ob_get_clean();

		echo wp_kses( $result, $allowed_tags );

		wp_die();

	}
}


/**
 * Search results: Highlight search terms in results
 * Looks for variations of the search term
 * 
 * @param string $term - word or phrase to highlight
 * @param string $text - full text
 *
 * @return string
 */
function fbsafety_highlight_search_results( $term='', $text='' ){
  if ( !empty($term) && !empty($text) ) {
    $text  = str_replace($term, '<strong>' . $term . '</strong>', $text);
    $lower = strtolower($term);
    $text  = str_replace($lower, '<strong>' . $lower . '</strong>', $text);
    $caps  = ucwords($lower);
    if ($caps !== $term) {
    	$text  = str_replace($caps, '<strong>' . $caps . '</strong>', $text);
    }
    return $text;
  }
}


/**
 * Search results: Find the query term to display
 * If the search term is not located in body text, will return the_excerpt
 * This may not be needed anymoe (2/22/21)
 *
 * @return string
 */
function fbsafety_find_search_phrase( $post_id='', $query='' ) {
	$text = '';
	if ( !empty($post_id) && !empty($query) ) {

		$excerpt = get_the_excerpt($post_id);
		if ( empty($excerpt) ) {
			$excerpt = 'This page is lacking an excerpt, so you are seeing this as a placeholder instead.';
		}
		
		$meta  = wp_strip_all_tags( strip_shortcodes( get_the_content( $post_id ) ) );
		
		if ( ! empty($meta) ) {
			$pos  = null;
			if ( false !== strpos( $meta, $query ) ) {
				$pos = strpos( $meta, $query );
			} elseif ( false !== strpos( $meta, strtolower($query) ) ) {
				$pos = strpos( $meta, strtolower($query) );
			} elseif ( false !== strpos( $meta, ucwords(strtolower($query)) ) ) {
				$pos = strpos( $meta, ucwords(strtolower($query)) );
			}
			if ($pos) {
				$length  = 140 + strlen($query);
				$excerpt = '... ' . substr($meta, $pos, $length) . ' ...';
			}
		}

	}
	return $excerpt;
}

